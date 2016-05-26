<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.07.2015
 * Time: 19:27
 */



class Model_BaseModel extends Model {

    public $post;

    /**
     * @param $table
     * @param $column
     * @param null $where
     * @return mixed
     * todo метод получения количества записей произвольной таблицы
     */
    public function table_count ($table, $column, $where = null, $and_where = null) {

        if ($where == null and $and_where == null ) {

            $row = DB::select(array(DB::expr('COUNT(`'.$column.'`)'), 'total'))->from($table)
                ->cached()
                ->execute()->as_array();

        } elseif ($where != null and $and_where != null) {
            $row = DB::select(array(DB::expr('COUNT(`'.$column.'`)'), 'total'))->from($table)
                ->where($where[0], $where[1], $where[2])
                ->and_where($and_where[0], $and_where[1], $and_where[2])
                ->cached()
                ->execute()->as_array();
        } elseif ($where != null and $and_where == null) {
            $row = DB::select(array(DB::expr('COUNT(`'.$column.'`)'), 'total'))->from($table)
                ->where($where[0], $where[1], $where[2])
                ->cached()
                ->execute()->as_array();
        }

        return $row[0]['total'];
    }


    /**
     * @param $PostArr
     * @return array|bool
     * @throws Kohana_Exception
     * todo добавляет сообщение пользователя
     */
    public function addContacts ($PostArr){

       $this->post = Validation::factory($PostArr);

        $this->post -> rule(true, 'not_empty')
            -> rule('email', 'email');

        if($this->post->check()) {

            $fullname = Arr::get($PostArr, 'fullname');
            $city = Arr::get($PostArr, 'city');
            $tel = Arr::get($PostArr, 'tel');
            $email = Arr::get($PostArr, 'email');
            $desc = Arr::get($PostArr, 'desc');


            $query = DB::insert('contacts', array('name', 'city', 'tel', 'email', 'description'))
                ->values(array($fullname, $city, $tel, $email, $desc))->execute();

            return true;
        } else {

            return $this->post->errors();
        }
    }



    public function addOrderCelebration ($PostArr){

        $post = Validation::factory($PostArr);
        $post->rule('last_name', 'not_empty')
            ->rule('city', 'not_empty')
            ->rule('email', 'email')
            ->rule('tel', 'not_empty')
            ->rule('event', 'not_empty')
            ->rule('count_human', 'not_empty')
            ->rule('count_human',  'min_length', array(':value', 1))
            ->rule('date_event', 'not_empty')
            ->rule('bussines_name', 'not_empty')
            ->rule('bussines_url', 'not_empty');

        if ($post->check()) {

            $query = DB::insert('order_celebrations', array('last_name', 'city', 'tel', 'email', 'event', 'count_human', 'date_event', 'discription', 'bussines_name', 'bussines_link'))
                ->values(array($PostArr['last_name'],
                    $PostArr['city'],
                    $PostArr['tel'],
                    $PostArr['email'],
                    $PostArr['event'],
                    $PostArr['count_human'],
                    $PostArr['date_event'],
                    $PostArr['desk'],
                    $PostArr['bussines_name'],
                    $PostArr['bussines_url']
                ))->execute();

            return true;
        } else {
            return $post->errors();
        }

    }


    /**
     * @return mixed
     * todo получаем текст для страницы О проекте
     */
    public function getAbout (){
        return DB::select()
            ->from('about')
            ->where('id', '=', 1)
            ->cached()
            ->execute()->as_array();
    }

    /**
     * @return mixed
     * todo получаем SEO для главной
     */
    public function getHome(){
        return DB::select()
            ->from('home_seo')
            ->where('id', '=', 1)
            ->cached(10000)
            ->execute()->as_array();
    }

    /**
     * @param $url
     * @param $url_section_category
     * @return array
     *  todo вывод банеров в разделах и категориях
     */
    public function getBaners($url, $url_section_category, $city_id){


        $query = DB::select('ban.*', array('bus.id', 'BusId'),
            array('bus.url', 'BusUrl'));
        $query->from(array('banners', 'ban'));
        $query->join(array('business', 'bus'));
        $query->on('ban.business_id', '=', 'bus.id');
        //вывод в категориях
            if ($url_section_category == 'category') {
                $query->join(array('banners_relation', 'banrel'));
                $query->on('banrel.banners_id', '=', 'ban.id');
                $query->join(array('category','cat'));
                $query->on('banrel.category_id', '=', 'cat.id');
                //вывод в разделах
            } elseif ($url_section_category == 'section') {
                $query->join(array('banners_relation_section', 'banrel'));
                $query->on('banrel.banners_id', '=', 'ban.id');
                $query->join(array('category','cat'));
                $query->on('banrel.section_id', '=', 'cat.id');
            }


        $query->where('cat.url', '=', $url);
        if ($city_id != ''){
            $query->and_where('ban.city_banners','=', $city_id);
        }
        $query->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('ban.date_start AND ban.date_end'));
        $query->cached();
        $query = $query->execute()->as_array();




        $result = array();
        foreach ($query as $row) {

            if ($row['position'] == 1) {
                $result['top_baners'][] = $row;
            } else {
                $result['right_baners'][] = $row;
            }

        }

        //перемешиваем масивы случайным образом
        if (!empty($result['top_baners'])) {
            shuffle($result['top_baners']);
        }

        if (!empty($result['right_baners'])) {
            shuffle($result['right_baners']);
        }
        return $result;
        //Kohana::debug((string) $row);
        //Kohana_Debug::dump($row);
    }








    /**
     * @param $table
     * @param $user_id
     * @param $field
     * @param $arr_favorits
     * @param $table_object
     * @param $cooki_name
     * todo удаляем все добавленые в избранное элементы а потом добавляем основываясь на содержимом куки
     */
    public function UpdateFavoritCookie ($table, $user_id, $field, $arr_favorits, $table_object, $cooki_name){

        $query1 = DB::select()
            ->from($table_object)->execute()->as_array();

        $arra_id = array();
        foreach ($query1 as $rows) {
            $arra_id[] = $rows['id'];
        }

        $arr_favorits = array_intersect($arra_id, $arr_favorits);
        $arr_favorits = array_values($arr_favorits);
        $query2 = DB::delete($table)
            ->where('user_id', '=', $user_id)->execute();

        if (!empty($arr_favorits)) {

            Cookie::update_Arr_set_json($cooki_name, $arr_favorits);
            $val = '';
            $coma = '';
            foreach ($arr_favorits as $key=>$row_id) {

                if ($key !== 0) {
                    $coma = ',';
                }

                $val .= ' '.$coma.'('.$user_id.', '.$row_id.')';
            }

            $query3 = DB::query(Database::INSERT, 'INSERT INTO '.$table.' (user_id, '.$field.') VALUES '.$val.' ')->execute();
        }

    }

    /**
     * @param $id_business
     * @return mixed
     * todo получить банеры по id бизнеса
     */
    public function getBanersBusinessId ($id_business){
        return DB::select()
            ->from('banners')
            ->where('business_id', '=', $id_business)
            ->cached()->execute()->as_array();
    }


    /**
     * @param $url_city
     * @return mixed
     * todo получить ID города по URl
     */
    public function getCityUrl($url_city){
        $query = DB::select()
            ->from('city')
            ->where('url', '=', $url_city)
            ->limit(1)
            ->cached()->execute()->as_array();

        if (empty($query)){
            throw new HTTP_Exception_404;
        }

        return $query;
    }


    /**
     * @return mixed
     * todo получаем города для бизнесов информера
     */
    public function getCityListInformersBusiness(){

        $query = DB::select(array(DB::expr('COUNT(city.id)'), 'total'),
            array('city.id', 'cityId'),
            array('city.name', 'cityName'),
            array('city.url', 'cityUrl')
        )
            ->from('city')
            ->join('business')
            ->on('city.id', '=', 'business.city')
            ->group_by('city.id')
            ->order_by('total', 'DESC')
            ->cached()
            ->execute()->as_array();

        return $query;
    }

    /**
     * @return mixed
     * todo получаем города для купонов информера
     */
    public function getCityListInformersCoupons(){

        $query = DB::select(array(DB::expr('COUNT(city.id)'), 'total'),
            array('city.id', 'cityId'),
            array('city.name', 'cityName'),
            array('city.url', 'cityUrl')
        )
            ->from('coupon')
            ->join('city')
            ->on('city.id', '=', 'coupon.city')
            ->group_by('city.id')
            ->order_by('total', 'DESC')
            ->cached()
            ->execute()->as_array();

        return $query;
    }

    /**
     * @return mixed
     * todo получаем города для статей информера
     */
    public function getCityListInformersArticles(){

        $query = DB::select(array(DB::expr('COUNT(city.id)'), 'total'),
            array('city.id', 'cityId'),
            array('city.name', 'cityName'),
            array('city.url', 'cityUrl')
        )
            ->from('articles')
            ->join('city')
            ->on('city.id', '=', 'articles.city')
            ->group_by('city.id')
            ->order_by('total', 'DESC')
            ->cached()
            ->execute()->as_array();

        return $query;
    }

}