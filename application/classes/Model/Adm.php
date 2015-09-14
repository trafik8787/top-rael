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
    public function get_table ($table, $where){
        return DB::select()
            ->from($table)
            ->where($where[0], $where[1], $where[2])
            ->execute()->as_array();
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
    public function add_busines_user ($name_user = null, $secondname_user = null, $email_user = null, $age = null, $sex = null, $telephone = null, $password = null, $id_business = null){

        $user = ORM::factory('User')->where('business_id', '=', $id_business)->find();

        //die(HTML::x($user->business_id));
        if (!empty($user->business_id)) {
            $user->username = $name_user;
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
    
    
}