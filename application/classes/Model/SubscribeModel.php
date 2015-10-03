<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 18.08.2015
 * Time: 23:06
 */

class Model_SubscribeModel extends Model_BaseModel {

    /**
     * @param $email
     * @return array
     * todo добавляем подписчика
     */
    public function addSubskribeLodatey ($email, $action = 0){

        if ($action == 0) {
            try {
                $query = DB::insert('subscription', array('email', 'action'))
                    ->values(array($email, $action))->execute();

                return array('susses'=>'На вашу почту '.$email.' было отправлено письмо для подтверждения подписки');

            } catch (Exception $x) {
                return  array('dublicate_email'=>'Такой Email уже существует');
            }
        } else {
            DB::update('subscription')->set(array('action' => 1))->where('email', '=', $email)->execute();
        }

    }


    //управление подпиской из профиля
    public function updateSubskribEmail($post){

        return DB::update('subscription')
            ->set(array('enable_all' => $post['subscrib_disable']))
            ->where('action', '=', 1)
            ->and_where('email','=', $post['email'])
            ->execute();
    }


    /**
     * @return mixed
     * todo получить все бизнесы для рассылки
     */
    public function getSubskribeBusiness(){

        $query = DB::select('business.*', array('city.name', 'CityName'))
            ->from('business')
            ->join('city', 'LEFT')
            ->on('business.city','=','city.id')
            ->where('status_subscribe','=', 0)
            ->execute()->as_array();

        if (!empty($query)) {
            $id_business = array();
            foreach ($query as $rows) {
                $id_business[] = $rows['id'];
            }

            DB::update('business')
                ->set(array('status_subscribe' => 1))
                ->where('id', 'IN', $id_business)
                ->execute();

        }

        return $query;
    }

    /**
     * @return mixed
     * todo полечить все статьи для рассылки
     */
    public function getSubskribeArticless(){

        $query = DB::select()
            ->from('articles')
            ->where('status_subscribe','=', 0)
            ->execute()->as_array();


        if (!empty($query)) {

            $id_articless = array();
            foreach ($query as $rows) {
                $id_articless[] = $rows['id'];
            }

            DB::update('articles')
                ->set(array('status_subscribe' => 1))
                ->where('id', 'IN', $id_articless)
                ->execute();

        }

        return $query;
    }


    /**
     * @return mixed
     * todo получаем список подпищиков
     */
    public function getSubskribeUsers(){
        return DB::select()
            ->from('subscription')
            ->where('action','=', 1)
            ->and_where('enable_all','=',1)
            ->execute()->as_array();
    }

}