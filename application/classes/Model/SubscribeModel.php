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
    public function addSubskribeLodatey ($email, $action = 0, $uid){

        if ($action == 0) {
            try {
                $query = DB::insert('subscription', array('email', 'action', 'uid'))
                    ->values(array($email, $action, $uid))->execute();

                return array('susses'=>'На вашу почту '.$email.' было отправлено письмо для подтверждения подписки');

            } catch (Exception $x) {
                return  array('dublicate_email'=>'Такой Email уже существует');
            }
        } else {
            DB::update('subscription')->set(array('action' => 1, 'ip' => $_SERVER['REMOTE_ADDR'], 'date_active' => date('Y-m-d')))
                ->where('email', '=', $email)
                ->and_where('uid', '=', $uid)
                ->execute();
        }

    }


    /**
     * @param $email
     * @param $uid
     * @return bool
     * todo проверить
     */
    public function getActiveSelect ($email, $uid){

        $query = DB::select()
            ->from('subscription')
            ->where('email', '=', $email)
            ->and_where('uid', '=', $uid)
            ->and_where('action', '=', 0)
            ->execute()->as_array();

        if (!empty($query)) {
            return true;
        } else {
            return false;
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


        $query_bus = DB::select('business.*',
            array('city.name', 'CityName'),
            array('cat2.id', 'CatId'),
            array('cat2.name', 'CatName')

        )
            ->from('business')

            ->join(array('businesscategory', 'buscat'))
            ->on('buscat.business_id', '=', 'business.id')

            ->join(array('category', 'cat'))
            ->on('buscat.category_id', '=', 'cat.id')

            ->join(array('category', 'cat2'))
            ->on('cat.parent_id', '=', 'cat2.id')

            ->join('city', 'LEFT')
            ->on('business.city','=','city.id')

            ->where('business.status_subscribe','=', 0)
            ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'))
            ->and_where('business.status', '=', 1)
            ->and_where('business.name', '<>', '')
            ->and_where('business.city', '<>', '')
            ->and_where('business.address', '<>', '')
            ->and_where('business.tel', '<>', '')
            ->and_where('business.home_busines_foto', '<>', '')
            ->and_where('business.logo', '<>', '')
            ->and_where('business.info', '<>', '')
            ->execute()->as_array();


        $result_bus = array();
        foreach ($query_bus as $rows_bus) {

            if (empty($result_bus[$rows_bus['CatId']]['CatName'])) {
                $result_bus[$rows_bus['CatId']]['CatName'] = $rows_bus['CatName'];
                $result_bus[$rows_bus['CatId']]['BusArr'][$rows_bus['id']] = $rows_bus;
            } else {
                $result_bus[$rows_bus['CatId']]['BusArr'][$rows_bus['id']] = $rows_bus;
            }

        }



        if (!empty($result_bus)) {

            //записываем id рассылки
            if ($this->id_arhiv_subskribe === null) {
                $this->id_arhiv_subskribe = $this->insertSubscribeArhiv();
            }

            $id_business = array();

            foreach ($result_bus as $rows) {

                if (!empty($rows['BusArr'])){
                    foreach ($rows['BusArr'] as $bus_item) {
                        $id_business[] = $bus_item['id'];
                    }
                }
            }

            DB::update('business')
                ->set(array('status_subscribe' => $this->id_arhiv_subskribe))
                ->where('id', 'IN', $id_business)
                ->execute();

        }

        return $result_bus;
    }

    /**
     * @return mixed
     * todo полечить все статьи для рассылки
     */
    public function getSubskribeArticless(){

        $query = DB::select()
            ->from('articles')
            ->where('status_subscribe','=', 0)
            ->order_by('id', 'DESC')
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
     * todo  получить все купоны для рассылки
     */
    public function getSubskribeCoupons (){

        $query = DB::select('coup.*',
            array('bus.name', 'BusName'),
            array('bus.logo', 'BusLogo'),
            array('bus.url', 'BusUrl'),
            array('bus.info', 'BusInfo'),
            array('bus.tel', 'BusTel'),
            array('bus.schedule', 'BusSchedule'),
            array('bus.address', 'BusAddress')
        )

            ->from(array('coupon', 'coup'))
            ->join(array('business', 'bus'))
            ->on('coup.business_id', '=', 'bus.id')

            ->where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('coup.datestart AND coup.dateoff'))
            ->and_where('coup.status_subscribe','=', 0)
            ->cached()
            ->execute()->as_array();


        if (!empty($query)) {

            //записываем id рассылки
            if ($this->id_arhiv_subskribe === null) {
                $this->id_arhiv_subskribe = $this->insertSubscribeArhiv();
            }

            $id_coupons = array();
            foreach ($query as $rows) {
                $id_coupons[] = $rows['id'];
            }

            DB::update('coupon')
                ->set(array('status_subscribe' => $this->id_arhiv_subskribe))
                ->where('id', 'IN', $id_coupons)
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

        $query_bus = DB::select('bus.*',

            array('city.name', 'CityName'),
            array('cat2.id', 'CatId'),
            array('cat2.name', 'CatName')

        )

            ->from(array('business', 'bus'))


            ->join(array('businesscategory', 'buscat'))
            ->on('buscat.business_id', '=', 'bus.id')

            ->join(array('category', 'cat'))
            ->on('buscat.category_id', '=', 'cat.id')

            ->join(array('category', 'cat2'))
            ->on('cat.parent_id', '=', 'cat2.id')

            ->join('city', 'LEFT')
            ->on('bus.city','=','city.id')

            ->where('bus.status_subscribe','=',$id)
            ->cached()
            ->execute()
            ->as_array();

        $result_bus = array();
        foreach ($query_bus as $rows_bus) {

            if (empty($result_bus[$rows_bus['CatId']]['CatName'])) {
                $result_bus[$rows_bus['CatId']]['CatName'] = $rows_bus['CatName'];
                $result_bus[$rows_bus['CatId']]['BusArr'][$rows_bus['id']] = $rows_bus;
            } else {
                $result_bus[$rows_bus['CatId']]['BusArr'][$rows_bus['id']] = $rows_bus;
            }

        }

        //HTML::x($result_bus, true);

        $query_artic = DB::select('artic.*')

            ->from(array('articles', 'artic'))
            ->where('artic.status_subscribe','=',$id)
            ->order_by('id', 'DESC')
            ->cached()
            ->execute()
            ->as_array();


        $query_lotery = DB::select()
            ->from('lotarey')
            ->where('status_subscribe', '=', $id)
            ->cached()
            ->execute()
            ->as_array();

        $query_coupons = DB::select('coup.*',
            array('bus.name', 'BusName'),
            array('bus.logo', 'BusLogo'),
            array('bus.url', 'BusUrl'),
            array('bus.info', 'BusInfo'),
            array('bus.tel', 'BusTel'),
            array('bus.schedule', 'BusSchedule'),
            array('bus.address', 'BusAddress')
        )

        ->from(array('coupon', 'coup'))
        ->join(array('business', 'bus'))
        ->on('coup.business_id', '=', 'bus.id')


        ->where('coup.status_subscribe','=', $id)
        ->cached()
        ->execute()->as_array();

        return array($query[0], 'DataBus' => $result_bus, 'DataArtic' => $query_artic, 'DataCoup' => $query_coupons, 'DataLotery' => $query_lotery);
    }


    /**
     * @param $id
     * @return mixed
     * todo получем для бизнес профиля рассылки к которым имеет отношение бизнес и его статьи
     */
    public function getSubscribeAcountBusiness ($id_subs, $id_business){

        $query = DB::select()
            ->from('subscription_arhiv')
            ->where('id', '=', $id_subs)
            ->cached()
            ->execute()
            ->as_array();
        //есть ли статья в той же рассылке что и бизнес
        $query2 = DB::select()
            ->from('articles')
            ->where('status_subscribe', '=', $id_subs)
            ->cached()
            ->execute()
            ->as_array();
        //была ли статья в отдельной рассылке\

        $query3 = DB::select()
            ->from('articles_relation_business')
            ->join('articles')
            ->on('articles_relation_business.id_articles', '=', 'articles.id')
            ->join('subscription_arhiv')
            ->on('articles.status_subscribe','=','subscription_arhiv.id')
            ->where('articles_relation_business.id_business', '=', $id_business)
            ->and_where('articles.status_subscribe', '<>', $id_subs)
            ->cached()->execute()->as_array();


        return  array('business' => $query, 'articles' => $query2, 'articles2' => $query3);

    }


    /**
     * @param $email
     * @return object
     * todo отписатся от рассылки
     */
    public function Unsubscribe ($email) {

        return DB::update('subscription')
            ->set(array('enable_all' => 0))
            ->where('email', '=', $email)
            ->execute();
    }

}