<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */

class Model_CouponsModel extends Model_BaseModel {

    /**
     * @param $business_id
     * @return mixed
     * todo метод получаем купоны по id бизнеса
     */
    public function getCouponsInBusinessId($business_id){
        return DB::select('id', 'name')
            ->from('coupon')
            ->where('business_id', '=', $business_id)
            ->cached()
            ->execute()->as_array();
    }

    /**
     * @param null $id
     * @param null $coupon_url
     * @return mixed
     * todo получить купон по его id или url купона
     */
    public function getCouponsId($id = null, $coupon_url = null){

        $query = DB::select('coup.*',
            array('bus.name', 'BusName'),
            array('bus.logo', 'BusLogo'),
            array('bus.url', 'BusUrl'),
            array('bus.info', 'BusInfo'),
            array('bus.tel', 'BusTel'),
            array('bus.schedule', 'BusSchedule'),
            array('cit.name', 'CityName'),
            array('bus.address', 'BusAddress')

            );

            $query->from(array('coupon', 'coup'));
            $query->join(array('business', 'bus'));
            $query->on('coup.business_id', '=', 'bus.id');

            $query->join(array('city', 'cit'), 'LEFT');
            $query->on('coup.city', '=', 'cit.id');

            if ($id != null) {
                if (is_array($id)) {
                    $query->where('coup.id', 'IN', $id);
                } else {
                    $query->where('coup.id', '=', $id);
                }
            }

            if ($coupon_url != null) {
                $query->where('coup.url', '=', $coupon_url);
            }

            $query->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('bus.date_create AND bus.date_end'));

            $result = $query->cached()->execute()->as_array();
            return $result;

    }



    /**
     * @param null $url_section
     * @param null $limit
     * @param null $num_page
     * @param null $id_city
     * @return array
     * todo Получить купоны по урлу раздела
     */
    public function getCouponsSectionUrl ($url_section = null, $limit = null, $num_page = null, $id_city = null){

        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }



        $query = DB::select('coup.*', array('bus.name', 'BusName'));
            $query->from(array('coupon', 'coup'));

            $query->join(array('business', 'bus'));
            $query->on('coup.business_id', '=', 'bus.id');

            $query->join(array('category', 'cat'));
            $query->on('coup.id_section', '=', 'cat.id');

            if ($url_section != null) {
                $query->where('cat.url', '=', $url_section);
            }
            if ($id_city != null) {
                $query->and_where('coup.city', '=', $id_city);
            }
            $query->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'));
            $query->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('bus.date_create AND bus.date_end'));

            $query->limit($limit);
            $query->offset($ofset);
            $query->order_by('coup.id', 'DESC');
            $query->cached();

            $result = $query->execute()->as_array();



        //количество
        $count_query = DB::select(array(DB::expr('COUNT(coup.id)'), 'total'));
            $count_query->from(array('coupon', 'coup'));

            $count_query->join(array('business', 'bus'));
            $count_query->on('coup.business_id', '=', 'bus.id');

            $count_query->join(array('category', 'cat'));
            $count_query->on('coup.id_section', '=', 'cat.id');

            if ($url_section != null) {
                $count_query->where('cat.url', '=', $url_section);
            }
            if ($id_city != null) {
                $count_query->and_where('coup.city', '=', $id_city);
            }
            $count_query->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'));
            $count_query->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('bus.date_create AND bus.date_end'));

            $count_query->order_by('coup.id', 'DESC');
            $count_query->cached();
            $result_count = $count_query->execute()->as_array();

            $count = $result_count[0]['total'];


        //вызываем метод получения данных из куки
        Controller_BaseController::favorits_coupon();
        //добавляем элемент масива если добавлен в избранное
        if (!empty(Controller_BaseController::$favorits_coupon)) {

            $new_result = array();
            foreach ($result as $result_row) {

                if (in_array($result_row['id'], Controller_BaseController::$favorits_coupon)) {
                    $result_row['coupon_favorit'] = 1;
                }

                $new_result[] = $result_row;
            }
            $result = $new_result;
        }


        $city_arr = $this->getCityCouponInSection($url_section);

        return array('data' => $result, 'count' => $count, 'city' => $city_arr);
    }


    /**
     * @param null $arrSection
     * @return array
     * todo Получить города
     */
    public function getCityCouponInSection($arrSection = null){

        if ($arrSection == null) {
            $result = DB::select('coupon.*', array('city.name', 'CityName'))
                ->from('coupon')
                ->join('city', 'LEFT')
                ->on('coupon.city', '=', 'city.id')
                ->where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coupon.datestart AND coupon.dateoff'))
                ->and_where('coupon.city', '<>', 0)
                ->cached()
                ->execute()->as_array();
        } else {

            $result = DB::select('coupon.*', array('city.name', 'CityName'))
                ->from('coupon')
                ->join('category')
                ->on('coupon.id_section', '=', 'category.id')
                ->join('city')
                ->on('coupon.city', '=', 'city.id')
                ->where('category.url', '=', $arrSection)
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coupon.datestart AND coupon.dateoff'))
                ->and_where('coupon.city', '<>', 0)
                ->cached()
                ->execute()->as_array();

        }

        $city_arr = array();
        foreach ($result as $row_city) {
            if ($row_city['city'] != '') {
                $city_arr[$row_city['city']] = $row_city['CityName'];
            }
        }

        return $city_arr;

    }

    /**
     * @param $id_user
     * @param $id_coupons
     * @return object
     * @throws Kohana_Exception
     * todo сохраняем купон в избранное пользователя
     */
    public function saveCouponsFavoritesUser($id_user, $id_coupons){
        $query = DB::insert('users_relation_favorites_coup', array('user_id', 'coupon_id'))
            ->values(array($id_user, $id_coupons))->execute();
        return json_encode($query);
    }

    /**
     * @param $id_coupons
     * todo удалить купон из избранного текущего пользователя
     */
    public function deleteCouponsFavoritesUser ($id_coupons){

        $id_user = Auth::instance()->get_user()->id;
        $query = DB::delete('users_relation_favorites_coup')
            ->where('user_id', '=', $id_user)
            ->and_where('coupon_id', '=', $id_coupons)
            ->execute();
    }

    /**
     * @param $user_id
     * @return mixed
     * todo получить избранные купоны по id пользователя
     */
    public function getCouponsFavoritesUserId ($user_id){

        $query = DB::select('coupon_id')
            ->from('users_relation_favorites_coup')
            ->where('user_id', '=', $user_id)
            ->execute()->as_array();

        if (!empty($query)) {
            $result = array();
            foreach ($query as $row) {
                $result[] = $row['coupon_id'];
            }

            return $result;
        } else {
            return false;
        }
    }

    /**
     * @param null $url_section
     * @param $url_tags
     * @param null $limit
     * @return array
     * todo КУПОНЫ ГРУППЫ ЛАКШЕРИ (ТЕГИ)
     */
    public function getCouponsSectionTagsUrl ($url_section = null, $url_tags, $limit = null){

        if ($url_section != null) {

            $result = DB::select('coup.*', array('bus.name', 'BusName'))
                ->from(array('coupon', 'coup'))
                ->join(array('business', 'bus'))
                ->on('coup.business_id', '=', 'bus.id')
                ->join(array('category', 'cat'))
                ->on('coup.id_section', '=', 'cat.id')
                ->join(array('tags_relation_coupons', 'tagrelcoup'))
                ->on('tagrelcoup.id_coupons', '=', 'coup.id')
                ->join(array('tags', 'tag'))
                ->on('tag.id', '=', 'tagrelcoup.id_tags')

                ->where('tag.url_tags', '=', $url_tags)
                ->and_where('cat.url', '=', $url_section)
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'))
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('bus.date_create AND bus.date_end'))


                ->order_by('coup.id', 'DESC')
                ->cached()
                ->execute()->as_array();
        } else {
            $result = DB::select('coup.*', array('bus.name', 'BusName'))
                ->from(array('coupon', 'coup'))
                ->join(array('business', 'bus'))
                ->on('coup.business_id', '=', 'bus.id')
                ->join(array('category', 'cat'))
                ->on('coup.id_section', '=', 'cat.id')
                ->join(array('tags_relation_coupons', 'tagrelcoup'))
                ->on('tagrelcoup.id_coupons', '=', 'coup.id')
                ->join(array('tags', 'tag'))
                ->on('tag.id', '=', 'tagrelcoup.id_tags')
                ->where('tag.url_tags', '=', $url_tags)
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'))
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('bus.date_create AND bus.date_end'))
                ->order_by('coup.id', 'DESC')
                ->cached()
                ->execute()->as_array();
        }

        //вызываем метод получения данных из куки
        Controller_BaseController::favorits_coupon();
        //добавляем элемент масива если добавлен в избранное
        if (!empty(Controller_BaseController::$favorits_coupon)) {

            $new_result = array();
            foreach ($result as $result_row) {

                if (in_array($result_row['id'], Controller_BaseController::$favorits_coupon)) {
                    $result_row['coupon_favorit'] = 1;
                }

                $new_result[] = $result_row;
            }
            $result = $new_result;
        }

        return $result;

    }

    /**
     * @return mixed
     * todo получить разделы в которых есть купоны и их дата актуальна
     */
    public function CouponsSectionCountCoupon($general_meny){

        if (Cache::instance()->get('coupons_general_meny') == null) {

            $query = DB::select()
                ->from('coupon')
                ->where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coupon.datestart AND coupon.dateoff'))
                ->cached()
                ->execute()->as_array();


            $new_meny = array();
            foreach ($general_meny as $rows_meny) {

                foreach ($query as $rows_coupon) {

                    if ($rows_coupon['id_section'] == $rows_meny['id']) {
                        $new_meny[$rows_meny['id']] = $rows_meny;
                    }

                }

            }

            Cache::instance()->set('coupons_general_meny', $new_meny);

        } else {
            $new_meny = Cache::instance()->get('coupons_general_meny');
        }

        return $new_meny;
    }


    /**
     * @param $url_tags
     * @return mixed
     * todo получить разделы в в теге которых есть купоны и их дата актуальна
     */
    public function CouponsSectionCountCouponTags($url_tags){

        return DB::select('category.*')
            ->from('coupon')
            ->join('category')
            ->on('coupon.id_section', '=', 'category.id')

            ->join('tags_relation_coupons')
            ->on('tags_relation_coupons.id_coupons','=','coupon.id')

            ->join('tags')
            ->on('tags.id','=','tags_relation_coupons.id_tags')

            ->where('tags.url_tags','=',$url_tags)
            ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coupon.datestart AND coupon.dateoff'))
            ->group_by('category.id')
            ->cached()
            ->execute()->as_array();

    }

    /**
     * @param int $limit
     * @return mixed
     * todo получить последние добвленные купоны
     */
    public function getCouponsAfter($limit = 10){
        return DB::select(array('coupon.name', 'CoupName'),
            array('coupon.url','CoupUrl'),
            array('coupon.datecreate', 'CoupDatcreate'),
            array('coupon.img_coupon', 'CoupImg'),
            array('coupon.secondname', 'CoupSecond'),
            array('business.name', 'BusName'),
            array('business.info', 'BusInfo')
            )
            ->from('coupon')
            ->join('business')
            ->on('coupon.business_id', '=', 'business.id')
            ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coupon.datestart AND coupon.dateoff'))
            ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'))
            ->order_by('coupon.id', 'DESC')
            ->limit($limit)
            ->cached(10000)
            ->execute()->as_array();
    }


    public function getInformersCouponsId (){

        $query = DB::select(
            array('coupon.id', 'CoupId'),
            array('coupon.name', 'CoupName'),
            array('coupon.secondname', 'CoupSecondname'),
            array('coupon.info', 'CoupInfo'),
            array('coupon.url', 'CoupUrl'),
            array('coupon.img_coupon', 'CoupImg'),
            array('category.name', 'CatName'),
            array('category.id', 'CatId'),
            array('city.id', 'CityId'),
            array('city.name', 'CityName'),
            array('business.name', 'BusName'),
            array('business.address', 'BusAddress')


        )
            ->from('coupon')
            ->join('category')
            ->on('coupon.id_section','=','category.id')
            ->join('city')
            ->on('coupon.city','=','city.id')
            ->join('business')
            ->on('coupon.business_id','=','business.id')
            ->order_by('coupon.id', 'DESC')
            ->execute()->as_array();

            //HTML::x($query);

            $arr_in_json = array();
            foreach ($query as $rows) {

                $arr_in_json[] = array('category' => array('value' => $rows['CatId'], 'label' => $rows['CatName']),
                    'city' => array('value' => $rows['CityId'], 'label' => $rows['CityName']),
                    'url' => $rows['CoupUrl'],
                    'image' => array('url' => $rows['CoupImg']),
                    'title' => $rows['CoupName'],
                    'secondname' => $rows['CoupSecondname'],
                    'description' => '',
                    'adress' => $rows['BusName']

                );
            }

        $coup = View::factory('render_informer/coupons');
        $coup->json = json_encode($arr_in_json);

        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/public/javascripts/data/coupon.js')) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/public/javascripts/data/coupon.js');
        }
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/public/javascripts/data/coupon.js', $coup->render());

    }

}