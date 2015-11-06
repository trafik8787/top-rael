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
    public function getBaners($url, $url_section_category){

        //вывод в категориях
        if ($url_section_category == 'category') {
            $query = DB::query(Database::SELECT, "SELECT `ban`.*, `bus`.`id` AS
                                                    `BusId`, `bus`.`url` AS
                                                    `BusUrl` FROM `banners` AS `ban`
                                                    JOIN `business` AS `bus` ON (`ban`.`business_id` = `bus`.`id`)
                                                    JOIN `banners_relation` AS `banrel` ON (`banrel`.`banners_id` = `ban`.`id`)
                                                    JOIN `category` AS `cat` ON (`banrel`.`category_id` = `cat`.`id`)
                                                    WHERE `cat`.`url` = '".$url."' AND DATE(NOW()) BETWEEN ban.date_start AND ban.date_end")
                ->cached()
                ->execute()
                ->as_array();

            //вывод в разделах
        } elseif ($url_section_category == 'section') {
            $query = DB::query(Database::SELECT, "SELECT `ban`.*, `bus`.`id` AS
                                                    `BusId`, `bus`.`url` AS
                                                    `BusUrl` FROM `banners` AS `ban`
                                                    JOIN `business` AS `bus` ON (`ban`.`business_id` = `bus`.`id`)
                                                    JOIN `banners_relation_section` AS `banrel` ON (`banrel`.`banners_id` = `ban`.`id`)
                                                    JOIN `category` AS `cat` ON (`banrel`.`section_id` = `cat`.`id`)
                                                    WHERE `cat`.`url` = '".$url."' AND DATE(NOW()) BETWEEN ban.date_start AND ban.date_end")
                ->cached()
                ->execute()
                ->as_array();
        }


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

}