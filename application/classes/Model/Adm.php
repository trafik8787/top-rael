<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 14.07.2015
 * Time: 23:59
 */

class Model_Adm extends Model {

    /**
     * @param $table
     * @param $where
     * @return mixed
     * todo получить данные произвольной таблицы по условию
     */
    public function get_table ($table, $where=null){

        if ($where === null) {
            return DB::select()
                ->from($table)
                ->execute()->as_array();
        } else {
            return DB::select()
                ->from($table)
                ->where($where[0], $where[1], $where[2])
                ->execute()->as_array();
        }

    }

    /**
     * @param null $filename
     * @param $title
     * @param $id
     *  todo обновление галереи из админки
     */
    public function update_galery ($filename = null, $title, $id) {
        if ($filename == null) {
            $query = DB::update('files')
                ->set(array('title' => $title))
                ->where('id', '=', $id)->execute();
        } else {
            $query = DB::update('files')
                ->set(array('filename' => $filename,
                    'title' => $title
                ))
                ->where('id', '=', $id)->execute();
        }

    }

    /**
     * @param $filename
     * @param $title
     * @param $gallery_id
     * @throws Kohana_Exception
     * todo Добавление в галерею из админки
     */
    public function insert_galery ($filename, $title, $gallery_id){
        $query = DB::insert('files', array('filename', 'title', 'gallery'))
            ->values(array($filename, $title, $gallery_id))->execute();
    }

    /**
     * @param $id
     * todo удаление из галереи
     */
    public function delete_galery ($id){
        $query = DB::delete('files')
            ->where('id', 'IN', $id)->execute();
    }

    /**
     * @param null $name_user
     * @param null $secondname_user
     * @param null $email_user
     * @param null $age
     * @param null $sex
     * @param null $telephone
     * @param null $password
     * @param null $id_business
     * @throws Kohana_Exception
     * todo добавление собственника бизнеса в админке
     */
    public function add_busines_user ($name_user = null, $name='', $secondname_user = '', $email_user = null, $age = '', $sex = '', $telephone = '', $password = null, $id_business = null){

        $user = ORM::factory('User')->where('business_id', '=', $id_business)->find();

        //die(HTML::x($user->business_id));
        if (!empty($user->business_id)) {
            $user->username = $name_user;
            $user->name = $name;
            $user->secondname = $secondname_user;
            $user->business_id = $id_business;
            $user->password = $password;
            $user->email = $email_user;
            $user->tel = $telephone;
            $user->age = $age;
            $user->sex = $sex;
            $user->id_role = 5;
            $user->save();
        } else {
            $user_insert = ORM::factory('User');
            $user_insert->username = $name_user;
            $user_insert->name = $name;
            $user_insert->secondname = $secondname_user;
            $user_insert->business_id = $id_business;
            $user_insert->password = $password;
            $user_insert->email = $email_user;
            $user_insert->tel = $telephone;
            $user_insert->age = $age;
            $user_insert->sex = $sex;
            $user_insert->id_role = 5;
            $user_insert->save();
            $user_insert->add('roles', ORM::factory('Role', array('name' => 'login')));
            $user_insert->add('roles', ORM::factory('Role', array('name' => 'business')));
        }
    }


    /**
     * @param $type_node
     * @param $name_node
     * @param $status_node
     * @throws Kohana_Exception
     * todo сохраняем событие в админке в таблицу log
     * $type_node - тип (бизнес, статья купон)
     * $name_node - название
     * $status_node - что это редактирование удаление или создание
     */
    public function log_add ($type_node, $name_node, $status_node, $id_business = 0){


        $status = null;
        $text = null;
        switch ($status_node) {
            case 'add':
                $status = 1;
                $text = 'Пользователь '.Auth::instance()->get_user()->username.' добавил '.$type_node.' '. $name_node;
                break;
            case 'edit':
                $status = 2;
                $text = 'Пользователь '.Auth::instance()->get_user()->username.' отредактировал '.$type_node.' '. $name_node;
                break;
            case 'del':
                $status = 3;
                $text = 'Пользователь '.Auth::instance()->get_user()->username.' удалил '.$type_node.' '. $name_node;
                break;
        }

        DB::insert('log', array('text', 'status', 'business_id'))
            ->values(array($text, $status, $id_business))
            ->execute();

    }

    /**
     * @param null $limit
     * @param null $num_page
     * @return array
     * todo получить лог
     */
    public function get_log ($limit = null, $num_page = null){

        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }

        $query = DB::select()
            ->from('log')
            ->limit($limit)
            ->offset($ofset)
            ->order_by('date', 'DESC')
            ->execute()->as_array();

        $count = Model::factory('BaseModel')->table_count('log', 'id');
        return array('data' => $query, 'count' => $count);
    }

    /**
     * @param $id_business
     * @return mixed
     * todo получить лог по бизнесу
     */
    public function get_log_business ($id_business)
    {
        return DB::select()
            ->from('log')
            ->where('business_id','=', $id_business)
            ->order_by('date', 'DESC')
            ->execute()->as_array();
    }

    /**
     * @param $user_id
     * @return array
     * todo получаем статистику добавленную в избранное пользователя для админки вывод в каточке пользователя
     */
    public function getFaforitUser($user_id){

        $articles = DB::select('articles.name')
            ->from('users_relation_favorites_article')
            ->join('articles')
            ->on('articles.id', '=', 'users_relation_favorites_article.article_id')
            ->where('users_relation_favorites_article.user_id', '=', $user_id)
            ->execute()->as_array();

        $business = DB::select('business.name')
            ->from('users_relation_favorites_bus')
            ->join('business')
            ->on('business.id', '=', 'users_relation_favorites_bus.business_id')
            ->where('users_relation_favorites_bus.user_id', '=', $user_id)
            ->execute()->as_array();

        $coupons = DB::select('coupon.secondname', 'coupon.id')
            ->from('users_relation_favorites_coup')
            ->join('coupon')
            ->on('coupon.id', '=', 'users_relation_favorites_coup.coupon_id')
            ->where('users_relation_favorites_coup.user_id', '=', $user_id)
            ->execute()->as_array();

        return array('articles' => $articles, 'business' => $business, 'coupons' =>  $coupons);

    }

    /**
     * @param $id
     * @return ORM
     * @throws Kohana_Exception
     * todo получить данные пользователя по ID
     */
    public function getUserId ($id)
    {
        $user = ORM::factory('user');
        $user->where('id', ' = ', $id)
            ->find();
        return $user;
    }


    /**
     * todo переносим из базы Redis в MySQL данные по кликам банеров
     */
    public function saveMySQLclickBaners (){

        $baners = DB::select()
            ->from('banners')
            ->where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('date_start AND date_end'))
            ->execute()
            ->as_array();

        foreach ($baners as $row) {
            DB::update('banners')->set(array('count_clik' => Rediset::getInstance()->get_baner($row['id'])))
                ->where('id', '=', $row['id'])
                ->execute();
        }


    }
    
    
}