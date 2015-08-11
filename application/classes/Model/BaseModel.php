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
     * метод получения количества записей произвольной таблицы
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
     * добавляет сообщение пользователя
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
     * получаем текст для страницы О проекте
     */
    public function getAbout (){
        $row = DB::select()
            ->from('about')
            ->where('id', '=', 1)
            ->cached()
            ->execute()->as_array();
        return $row[0]['text'];
    }
    
}