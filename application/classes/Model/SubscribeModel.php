<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 18.08.2015
 * Time: 23:06
 */

class Model_SubscribeModel extends Model_BaseModel {

    private $id_arhiv_subskribe = null;
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
            ->where('business.status_subscribe','=', 0)
            ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'))
            ->and_where('business.status', '=', 1)
            ->execute()->as_array();

        if (!empty($query)) {

            //записываем id рассылки
            if ($this->id_arhiv_subskribe === null) {
                $this->id_arhiv_subskribe = $this->insertSubscribeArhiv();
            }

            $id_business = array();
            foreach ($query as $rows) {
                $id_business[] = $rows['id'];
            }

            DB::update('business')
                ->set(array('status_subscribe' => $this->id_arhiv_subskribe))
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

            //записываем id рассылки
            if ($this->id_arhiv_subskribe === null) {
                $this->id_arhiv_subskribe = $this->insertSubscribeArhiv();
            }

            $id_articless = array();
            foreach ($query as $rows) {
                $id_articless[] = $rows['id'];
            }

            DB::update('articles')
                ->set(array('status_subscribe' => $this->id_arhiv_subskribe))
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


    /**
     * @return object
     * @throws Kohana_Exception
     * todo запись рассылки в архив
     */
    public function insertSubscribeArhiv(){
        $query = DB::insert('subscription_arhiv', array('data'))
            ->values(array(date('Y-m-d')))
            ->execute();

        return $query[0];
    }


    /**
     * @param $id
     * @return array
     * todo получаем данные для вывода архива рассылки
     */
    public function getMailSubskribe ($id){

        $query = DB::select()
            ->from('subscription_arhiv')
            ->where('id','=',$id)
            ->execute()
            ->as_array();

        $query_bus = DB::select('bus.*', array('city.name', 'CityName'))
            ->from(array('subscription_arhiv', 'subarhiv'))
            ->join(array('business', 'bus'), 'LEFT')
            ->on('subarhiv.id', '=', 'bus.status_subscribe')

            ->join('city', 'LEFT')
            ->on('bus.city','=','city.id')

            ->where('subarhiv.id','=',$id)
            ->execute()
            ->as_array();

        $query_artic = DB::select('artic.*')

            ->from(array('subscription_arhiv', 'subarhiv'))
            ->join(array('articles', 'artic'), 'LEFT')
            ->on('subarhiv.id', '=', 'artic.status_subscribe')
            ->where('subarhiv.id','=',$id)
            ->execute()
            ->as_array();

        return array($query[0], 'DataBus' => $query_bus, 'DataArtic' => $query_artic);
    }


    /**
     * @param $id
     * @return mixed
     * todo получем для бизнес профиля рассылки к которым имеет отношение бизнес и его статьи
     */
    public function getSubscribeAcountBusiness ($id){

        $query = DB::select()
            ->from('subscription_arhiv')
            ->where('id', '=', $id)
            ->cached()
            ->execute()
            ->as_array();

        $query2 = DB::select()
            ->from('articles')
            ->where('status_subscribe', '=', $id)
            ->cached()
            ->execute()
            ->as_array();

        return  array('business' => $query, 'articles' => $query2);

    }

}