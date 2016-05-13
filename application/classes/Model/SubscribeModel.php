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
     * todo добавляем подписчика для полной рассылки
     */
    public function addSubskribeLodatey ($email, $action = 0, $uid){

        //флаг изминения если не 0 то это подтверждение подписки
        if ($action == 0) {

            //проверяем прошел ли подтверждение о подписке даный емейл
            $query = DB::select()
                ->from('subscription')
                ->where('email', '=', $email)
                ->and_where('action', '=', 0)
                ->execute()->as_array();

            if (!empty($query)) {

                if ($query[0]['uid'] == '') {
                    //переписываем uid
                    DB::update('subscription')->set(array('uid' => $uid))
                        ->where('email', '=', $email)
                        ->and_where('action', '=', 0)
                        ->execute();
                    $quid = $uid;
                } else {
                    $quid = $query[0]['uid'];
                }

                 return array('susses'=>'На вашу почту '.$email.' было отправлено письмо для подтверждения подписки', 'uid' => $quid);

            } else {

                 try {
                     $query = DB::insert('subscription', array('email', 'action', 'all_subscribe', 'uid'))
                         ->values(array($email, $action, 1, $uid))->execute();

                     return array('susses'=>'На вашу почту '.$email.' было отправлено письмо для подтверждения подписки');

                 } catch (Exception $x) {
                     return  array('dublicate_email'=>'Такой Email уже существует');
                 }

            }

        } else {
            //подтверждение подписки
            DB::update('subscription')->set(array('action' => 1,
                                                    'ip' => $_SERVER['REMOTE_ADDR'],
                                                    'date_active' => date('Y-m-d')))
                ->where('email', '=', $email)
                ->and_where('uid', '=', $uid)
                ->execute();
        }

    }


    /**
     * @param $email
     * @param null $bussines_id
     * @param int $action
     * @param null $uid
     * @return array
     * @throws Kohana_Exception
     * todo подписка на конкретный бизнес
     */
    public function addSubskribeBussines ($email, $bussines_id = null, $action = 0, $uid = null){

        //подписка пользователя на бизнес
        if ($action == 0) {

            //существует ли емейл в таблице подпищиков
            $query = DB::select()
                ->from('subscription')
                ->where('email', '=', $email)
                ->execute()->as_array();

            //если подпищик существует
            if (!empty($query)) {

                //проверяем подтвердил ли он свою подписку
                if ($query[0]['action'] == 1) {

                    //смотрим подписывался ли пользователь на этот бизнес
                    $query2 = DB::select()
                        ->from('subscription_relation_bussines')
                        ->where('subscription_id', '=', $query[0]['id'])
                        ->and_where('bussines_id', '=', $bussines_id)
                        ->execute()->as_array();

                    //если пользователь подписывался на этот бизнес
                    if (!empty($query2)) {

                        return  array('dublicate_email'=>'Вы уже подписаны на рассылку из этого завидения');

                        //если не подписывался
                    } else {

                        $query_relat = DB::insert('subscription_relation_bussines', array('bussines_id', 'action', 'subscription_id', 'ip', 'uid'))
                            ->values(array($bussines_id, 1, $query[0]['id'], $_SERVER['REMOTE_ADDR'], $uid))->execute();

                        return array('susses_message'=>'Спасибо за подписку на это завидение', 'no_mail' => 1);
                    }

                //если не подтвердил подписку
                } else {

                    $query_relat = DB::insert('subscription_relation_bussines', array('bussines_id', 'action', 'subscription_id', 'uid'))
                        ->values(array($bussines_id, 1, $query[0]['id'], $uid))->execute();

                    return array('susses'=>'На вашу почту '.$email.' было отправлено письмо для подтверждения подписки', 'uid' => $uid, 'bussines_id' => $bussines_id);

                }



            //если подпищика не существует то создаем
            } else {

                //вписываем подпищика со статусом не подтвержден и с флагом
                $query_subs = DB::insert('subscription', array('email', 'action', 'uid'))
                    ->values(array($email, 0, $uid))->execute();

                //вписываем подпищика на бизнес
                $query_relat = DB::insert('subscription_relation_bussines', array('bussines_id', 'action', 'subscription_id', 'ip', 'uid'))
                    ->values(array($bussines_id, 1, $query_subs[0], $_SERVER['REMOTE_ADDR'], $uid))->execute();

                return array('susses'=>'На вашу почту '.$email.' было отправлено письмо для подтверждения подписки', 'uid' => $uid, 'bussines_id' => $bussines_id);
            }



        //подтверждение подписки на бизнес
        } else {

            //подтверждение подписки
            DB::update('subscription')->set(array('action' => 1,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'date_active' => date('Y-m-d')))
                ->where('email', '=', $email)
                ->and_where('uid', '=', $uid)
                ->execute();

            DB::update('subscription_relation_bussines')->set(array('action' => 1, 'ip' => $_SERVER['REMOTE_ADDR']))
                ->where('uid', '=', $uid)
                ->and_where('bussines_id', '=', $bussines_id)
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
            ->and_where('all_subscribe','=', 1)
            ->execute()->as_array();
    }


    /**
     * @return mixed
     * todo рассылка конкретно по бизнесам
     */
    public function getSubskribeBussinesUsers(){


        $query =  DB::select(
            array('subscription.id', 'SubscID'),
            array('subscription.email', 'SubscEmail'),
            array('subscription_relation_bussines.bussines_id', 'SubsRelBusID'),

            array('articles.id', 'ArticID'),
            array('articles.name', 'ArticName'),
            array('articles.url', 'ArticUrl'),
            array('articles.content', 'ArticContent'),
            array('articles.images_article', 'ArticImg'),
            array('articles.status_subscribe_bussines', 'ArticStatusSubs'),

            array('coupon.id', 'CoupId'),
            array('coupon.url', 'CoupUrl'),
            array('coupon.name', 'CoupName'),
            array('coupon.secondname', 'CoupSecondname'),
            array('coupon.img_coupon', 'CoupImg'),
            array('coupon.dateoff', 'CoupDateoff'),
            array('coupon.status_subscribe_bussines', 'CoupStatusSubs'),


            array('news.id', 'NewsId'),
            array('news.name', 'NewsName'),
            array('news.text', 'NewsText'),
            array('news.status_subscribe_bussines', 'NewsStatusSubs'),


            array('business.id', 'BusId'),
            array('business.name', 'BusName'),
            array('business.url', 'BusUrl')


        )
            ->from('subscription')
            ->join('subscription_relation_bussines')

            ->on('subscription.id', '=', 'subscription_relation_bussines.subscription_id')

            //articles
            ->join('articles_relation_business', 'LEFT')
            ->on('subscription_relation_bussines.bussines_id', '=', 'articles_relation_business.id_business')

            ->join('articles',  'LEFT')
            ->on('articles.id', '=', 'articles_relation_business.id_articles')


            //coupons
            ->join('coupon', 'LEFT')
            ->on('coupon.business_id', '=', 'subscription_relation_bussines.bussines_id')

            //bussines
            ->join('business')
            ->on('coupon.business_id', '=', 'business.id')


            //news
            ->join('news', 'LEFT')
            ->on('news.bussines_id', '=', 'subscription_relation_bussines.bussines_id')

            ->where('subscription.action','=', 1)
            ->and_where('subscription.enable_all','=',1)
            ->and_where('subscription.all_subscribe','=', 0)
            ->and_where('subscription_relation_bussines.action','=', 1)

            ->execute()->as_array();


        $end_result = array();

        foreach ($query as $item) {

            $CoupTmp = array();
            $ArticTmp = array();
            $NewsTmp = array();
            $BusTmp = array();

            if (!array_key_exists($item['SubscID'], $end_result)) {



                foreach ($query as $rows) {

                   if ($item['SubscID'] == $rows['SubscID']) {

                       if (!empty($rows['CoupId'])) {
                           //coupons
                           if (!array_key_exists($rows['CoupId'], $CoupTmp) AND ($rows['CoupStatusSubs'] == 0)) {
                               $CoupTmp[$rows['CoupId']] = array('CoupId' => $rows['CoupId'],
                                                                    'CoupUrl' => $rows['CoupUrl'],
                                                                    'CoupName' => $rows['CoupName'],
                                                                    'CoupSecondname' => $rows['CoupSecondname'],
                                                                    'CoupImg' => $rows['CoupImg'],
                                                                    'CoupDateoff' => $rows['CoupDateoff'],
                                                                    'BusName' => $rows['BusName'],
                                                                    'BusUrl' => $rows['BusUrl']);
                           }
                       }

                       if (!empty($rows['ArticID'])) {
                           //articles
                           if (!array_key_exists($rows['ArticID'], $ArticTmp) AND ($rows['ArticStatusSubs'] == 0)) {
                               $ArticTmp[$rows['ArticID']] = array('ArticID' => $rows['ArticID'],
                                                                    'ArticContent' => $rows['ArticContent'],
                                                                    'ArticImg' => $rows['ArticImg'],
                                                                    'ArticUrl' => $rows['ArticUrl'],
                                                                    'ArticName' => $rows['ArticName']);
                           }
                       }


                       if (!empty($rows['NewsId'])) {
                           //news
                           if (!array_key_exists($rows['NewsId'], $NewsTmp) AND ($rows['NewsStatusSubs'] == 0)) {
                               $NewsTmp[$rows['NewsId']] = array('NewsId' => $rows['NewsId'],
                                                                    'NewsName' => $rows['NewsName'],
                                                                    'NewsText' => $rows['NewsText']);
                           }
                       }


                       if (!empty($rows['SubsRelBusID'])) {
                           //bussines id
                           if (!array_key_exists($rows['SubsRelBusID'], $BusTmp)) {
                               $BusTmp[$rows['SubsRelBusID']] = $rows['SubsRelBusID'];
                           }
                       }

                    }


                }


                $end_result[$item['SubscID']] = array('email' => $item['SubscEmail'],
                    'CoupArr' => $CoupTmp,
                    'ArticArr' => $ArticTmp,
                    'NewsArr' => $NewsTmp,
                    'BusArr' => $BusTmp
                );
            }


        }

        return  $end_result;

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

    /**
     * @param $bussines_id
     * @param $uid
     * @return object
     * todo удалить подписку на конкретный бизнес
     */
    public function UnsubscribeBussines ($bussines_id, $uid) {
        return DB::delete('subscription_relation_bussines')
            ->where('bussines_id', '=', $bussines_id)
            ->and_where('uid', '=', $uid)->execute();
    }

}