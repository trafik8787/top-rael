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


    public function getSubskribe(){
        
    }
}