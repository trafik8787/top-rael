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
     * метод получаем купоны по id бизнеса
     */
    public function getCouponsInBusinessId($business_id){
        return DB::select('id', 'name')
            ->from('coupon')
            ->where('business_id', '=', $business_id)
            ->cached()
            ->execute()->as_array();
    }

    /**
     * @param $id
     * @return mixed
     * получить купон по его id или купоны
     */
    public function getCouponsId($id){


        if (is_array($id)) {

            return DB::select('coup.*',
                array('bus.name', 'BusName'),
                array('bus.logo', 'BusLogo'),
                array('bus.url', 'BusUrl'),
                array('bus.info', 'BusInfo'),
                array('bus.tel', 'BusTel'),
                array('bus.schedule', 'BusSchedule')

            )
                ->from(array('coupon', 'coup'))
                ->join(array('business', 'bus'))
                ->on('coup.business_id', '=', 'bus.id')
                ->where('coup.id', 'IN', $id)
                ->cached()
                ->execute()->as_array();

        } else {
            return DB::select('coup.*',
                array('bus.name', 'BusName'),
                array('bus.logo', 'BusLogo'),
                array('bus.url', 'BusUrl'),
                array('bus.info', 'BusInfo'),
                array('bus.tel', 'BusTel'),
                array('bus.schedule', 'BusSchedule')

            )
                ->from(array('coupon', 'coup'))
                ->join(array('business', 'bus'))
                ->on('coup.business_id', '=', 'bus.id')
                ->where('coup.id', '=', $id)
                ->cached()
                ->execute()->as_array();
        }

    }

    /**
     * @param null $url_section
     * @param null $limit
     * @param null $num_page
     * @param null $id_city
     * @return array
     * Получить купоны по урлу раздела
     */
    public function getCouponsSectionUrl ($url_section = null, $limit = null, $num_page = null, $id_city = null){

        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }
        if ($url_section != null) {


            if ($id_city != null) {
                $result = DB::select('coup.*', array('bus.name', 'BusName'))
                    ->from(array('coupon', 'coup'))

                    ->join(array('business', 'bus'))
                    ->on('coup.business_id', '=', 'bus.id')

                    ->join(array('category', 'cat'))
                    ->on('coup.id_section', '=', 'cat.id')

                    ->where_open()
                    ->where('cat.url', '=', $url_section)
                    ->and_where('coup.city', '=', $id_city)
                    ->where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'))
                    ->where_close()

                    ->limit($limit)
                    ->offset($ofset)
                    ->order_by('coup.id', 'DESC')
                    ->cached()
                    ->execute()->as_array();

                //количество
                $count = DB::select(array(DB::expr('COUNT(coup.id)'), 'total'))
                    ->from(array('coupon', 'coup'))

                    ->join(array('business', 'bus'))
                    ->on('coup.business_id', '=', 'bus.id')

                    ->join(array('category', 'cat'))
                    ->on('coup.id_section', '=', 'cat.id')

                    ->where_open()
                    ->where('cat.url', '=', $url_section)
                    ->and_where('coup.city', '=', $id_city)
                    ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'))
                    ->where_close()

                    ->order_by('coup.id', 'DESC')
                    ->cached()
                    ->execute()->as_array();

                $count = $count[0]['total'];

            } else {

                $result = DB::select('coup.*', array('bus.name', 'BusName'))
                    ->from(array('coupon', 'coup'))

                    ->join(array('business', 'bus'))
                    ->on('coup.business_id', '=', 'bus.id')

                    ->join(array('category', 'cat'))
                    ->on('coup.id_section', '=', 'cat.id')

                    ->where('cat.url', '=', $url_section)
                    ->limit($limit)
                    ->offset($ofset)
                    ->where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'))
                    ->order_by('coup.id', 'DESC')
                    ->cached()
                    ->execute()->as_array();
                //количество
                $count = DB::select(array(DB::expr('COUNT(coup.id)'), 'total'))
                    ->from(array('coupon', 'coup'))

                    ->join(array('business', 'bus'))
                    ->on('coup.business_id', '=', 'bus.id')

                    ->join(array('category', 'cat'))
                    ->on('coup.id_section', '=', 'cat.id')

                    ->where('cat.url', '=', $url_section)
                    ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'))
                    ->order_by('coup.id', 'DESC')
                    ->cached()
                    ->execute()->as_array();

                $count = $count[0]['total'];
            }

        } else {
            if ($id_city != null) {
                $result = DB::select('coup.*', array('bus.name', 'BusName'))
                    ->from(array('coupon', 'coup'))
                    ->join(array('business', 'bus'))
                    ->on('coup.business_id', '=', 'bus.id')
                    ->where('coup.city', '=', $id_city)
                    ->limit($limit)
                    ->offset($ofset)
                    ->where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'))
                    ->order_by('coup.id', 'DESC')
                    ->cached()
                    ->execute()->as_array();
                $count = $this->table_count('coupon', 'id', array('city', '=', $id_city));
            } else {
                $result = DB::select('coup.*', array('bus.name', 'BusName'))
                    ->from(array('coupon', 'coup'))
                    ->join(array('business', 'bus'))
                    ->on('coup.business_id', '=', 'bus.id')
                    ->limit($limit)
                    ->offset($ofset)
                    ->where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'))
                    ->order_by('coup.id', 'DESC')
                    ->cached()
                    ->execute()->as_array();

                $count = $this->table_count('coupon', 'id', null);
            }

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


        $city_arr = $this->getCityCouponInSection($url_section);

        return array('data' => $result, 'count' => $count, 'city' => $city_arr);
    }


    /**
     * @param null $arrSection
     * @return array
     * Получить
     */
    public function getCityCouponInSection($arrSection = null){

        if ($arrSection == null) {
            $result = DB::select('coupon.*', array('city.name', 'CityName'))
                ->from('coupon')
                ->join('city', 'LEFT')
                ->on('coupon.city', '=', 'city.id')
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
     * сохраняем купон в избранное пользователя
     */
    public function saveCouponsFavoritesUser($id_user, $id_coupons){
        $query = DB::insert('users_relation_favorites_coup', array('user_id', 'coupon_id'))
            ->values(array($id_user, $id_coupons))->execute();
        return json_encode($query);
    }

    /**
     * @param $id_coupons
     * удалить купон из избранного текущего пользователя
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
     * получить избранные купоны по id пользователя
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
     * КУПОНЫ ГРУППЫ ЛАКШЕРИ (ТЕГИ)
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

                ->where_open()
                ->where('tag.url_tags', '=', $url_tags)
                ->and_where('cat.url', '=', $url_section)
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'))
                ->where_close()

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

}