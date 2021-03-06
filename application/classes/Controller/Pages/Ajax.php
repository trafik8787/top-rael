<?php defined('SYSPATH') or die('No direct script access.');
set_time_limit(5000);
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Ajax extends Controller {

    private $obj_mail_user_bussines = null;


    /**
     * добавляем подписчика по Ajax
     */
	public function action_index()
	{
        if (Request::initial()->is_ajax()) {

            $uniqid = uniqid();

            //разделяем обычную подписку и подписку на бизнес
            if (!empty($this->request->post('subscribe_bussines'))) {
                //подписка на конкретный бизнес
                $query = Model::factory('SubscribeModel')->addSubskribeBussines($this->request->post('email'), $this->request->post('subscribe_bussines'), 0, $uniqid);
            } else {
                $query = Model::factory('SubscribeModel')->addSubskribeLodatey($this->request->post('email'), 0, $uniqid);
            }


            if (empty($query['dublicate_email']) AND empty($query['no_mail']) ) {
                //проверяем есть ли этот емейл в неактивированых если есть то берем его код их таблицы
                if (!empty($query['uid'])) {
                    $uniqid = $query['uid'];
                }

                $bus_url = '';
                //проверяем является ли это подпиской на бизнес
                if (!empty($query['bussines_id'])) {
                    $bus_url = '&bus='.$query['bussines_id'];
                }


                $html_mail = View::factory('email/mail_subskribe_enable');
                $html_mail->email = $this->request->post('email');
                $html_mail->message = '<strong><a href="http://' . $_SERVER['HTTP_HOST'] . '/susses_subscribe?qid=' . $uniqid . '&email=' . $this->request->post('email') . $bus_url.'">Нажмите на эту ссылку, чтобы подтвердить и получать рассылку</a></strong>';

                $m = Email::factory();
                $m->From("TopIsrael;noreplay@topisrael.ru"); // от кого отправляется почта
                $m->To($this->request->post('email')); // кому адресованно
                $m->Subject('Подтвердите подписку на рассылку новинок Topisrael');
                $m->Body($html_mail, "html");
                $m->Priority(3);
                $m->Attach($_SERVER['DOCUMENT_ROOT'] . "/public/images/logo-new.png", "", "image/png");
                $m->Attach($_SERVER['DOCUMENT_ROOT'] . "/public/mail/images/2.png", "", "image/png");
                //$m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/3.jpg", "", "image/jpeg");
                $m->Send();
            }
            echo json_encode($query);
        }
	}


    /**
     *
     * todo отправка контакта
     */
    public function action_sendContact(){

        if (Request::initial()->is_ajax()) {

            $data = array();

            if (Captcha::valid($_POST['captcha'])) {
                $result = Model::factory('BaseModel')->addContacts($_POST);


                $html_mail = 'Имя: '.$_POST['fullname'].'<br>'.
                    'Страна: '.$_POST['city'].'<br>'.
                    'Email: '.$_POST['email'].'<br>'.
                    'Телефон: '.$_POST['tel'].'<br>'.
                    'Сообщение: '.$_POST['desc'];

                $m = Email::factory();
                $m->From($_POST['email']); // от кого отправляется почта
                $m->To('leon@topisrael.ru'); // кому адресованно
                $m->Subject('Письмо от пользователя TopIsrael');
                $m->Body($html_mail, "html");
                $m->Priority(3);
                $m->Send();


                if ($result === true) {
                    $data = array('susses' => 1);
                }

            } else {

                $data = array('err_cap' => 'Неправильно введен проверочный код');
            }

            echo json_encode($data);
        }

    }

    /**
     * @return string
     * todo Заказ торжеств
     */
    public function action_sendOrderCelebration () {

        if (Request::initial()->is_ajax()) {

            $result = Model::factory('BaseModel')->addOrderCelebration($this->request->post());

            $html_mail = 'Имя: '.$_POST['last_name'].'<br>'.
                'Страна: '.$_POST['city'].'<br>'.
                'Email: '.$_POST['email'].'<br>'.
                'Телефон: '.$_POST['tel'].'<br>'.
                'Событие: '.$_POST['event'].'<br>'.
                'Количество человек: '.$_POST['count_human'].'<br>'.
                'Дата события: '.$_POST['date_event'].'<br>'.
                'Дополнительное сообщение: '.$_POST['desk'].'<br>'.
                'Отправлено со страницы: <a href="'.HTML::HostSite('/business/'. $_POST['bussines_url']).'">'.$_POST['bussines_name'].'</a>';

            $m = Email::factory();
            $m->From($_POST['email']); // от кого отправляется почта
            $m->To('leon@topisrael.ru'); // кому адресованно
            $m->Subject('Заказ торжества - '.$_POST['bussines_name']);
            $m->Body($html_mail, "html");
            $m->Priority(3);
            $m->Send();


            if ($result === true) {
                $data = array('susses' => 'Ваш заказ отправлен. Спасибо.');
            } else {
                $data = array('error' => 'Произошла непредвиденная ошибка закройте окно и попробуйте с нова.');
            }

            echo json_encode($data);

        } else {
            die('No direct script access.');
        }

    }


    /**
     * груповые заказы
     */
    public function action_sendGroupBookins() {

        if (Request::initial()->is_ajax()) {

            $data = array();


            if (Captcha::valid($_POST['captcha'])) {
                $result = Model::factory('BaseModel')->addContacts($_POST);


                $html_mail = 'Имя: '.$_POST['fullname'].'<br>'.
                    'Страна: '.$_POST['city'].'<br>'.
                    'Email: '.$_POST['email'].'<br>'.
                    'Телефон: '.$_POST['tel'].'<br>'.
                    'Сообщение: '.$_POST['desc'];

                $m = Email::factory();
                $m->From($_POST['fullname'].";".$_POST['email']); // от кого отправляется почта
                $m->To('leon@topisrael.ru'); // кому адресованно
                $m->Subject('Групповой заказ TopIsrael.ru');
                $m->Body($html_mail, "html");
                $m->Priority(3);
                $m->Send();


                if ($result === true) {
                    $data = array('susses' => 1);
                }

            } else {
                $data = array('err_cap' => 'Неправильно введен проверочный код');
            }

            echo json_encode($data);
        }
    }
    
    


    /**
     * сортировка по категориям БИЗНЕСОВ группы лакшери (теги)
     */
    public function action_tagscatselest (){

        if (Request::initial()->is_ajax()) {

            if ($this->request->post('cat') != 'undefined') {
                $data = Model::factory('BussinesModel')->getBussinesCategoryTagsUrl($this->request->post('cat'),$this->request->post('tags_url'));
            } else {
                //die(HTML::x($_POST));
                $data = Model::factory('BussinesModel')->getBussinesSectionTagsUrl($this->request->post('section'),$this->request->post('tags_url'));
            }

            foreach ($data['data'] as $key => $rows) {
                //заглушка если файл картинки не обнаружен
                $busines_foto = '/public/uploade/thumbnail.jpg';
                if (file_exists($_SERVER['DOCUMENT_ROOT'].$rows['home_busines_foto'])) {
                    $busines_foto = '/uploads/img_business/thumbs/'.basename($rows['home_busines_foto']);
                }
                $data['data'][$key]['home_busines_foto'] = $busines_foto;
                $data['data'][$key]['info'] = Text::limit_chars(strip_tags($rows['info']), 150, null, true);
            }

            $data = Controller_BaseController::convertArrayTagsBusiness($data['data']);
            $content = View::factory('ajax_views/business_list_ajax');
            $content->data = $data;
            echo $content;
        }
    }

    /**
     * сортировка по разделам СТАТЬИ группы лакшери (теги)
     */
    public function action_tagsecartic(){

        if (Request::initial()->is_ajax()) {
            //die(HTML::x($this->request->post()));
            if ($this->request->post('section') != 'undefined') {
                $data = Model::factory('ArticlesModel')->getArticlesSectionTagsUrl($this->request->post('section'), $this->request->post('tags_url'));
            } else {
                $data = Model::factory('ArticlesModel')->getArticlesSectionTagsUrl(null, $this->request->post('tags_url'));
            }

            foreach ($data as $key => $rows) {
                $data[$key]['images_article'] = '/uploads/img_articles/thumbs/'.basename($rows['images_article']);
                $data[$key]['content'] = Text::limit_chars(strip_tags($rows['content']), 200, null, true);
            }

            $content = View::factory('ajax_views/articles_list_ajax');
            $content->data = $data;

            echo $content;
        }
    }

    /**
     * сортировка по разделам КУПОНЫ группы лакшери (теги)
     */
    public function action_tagseccoupon (){
        if (Request::initial()->is_ajax()) {

            if ($this->request->post('section') != 'undefined') {
                $data = Model::factory('CouponsModel')->getCouponsSectionTagsUrl($this->request->post('section'), $this->request->post('tags_url'));
            } else {
                $data = Model::factory('CouponsModel')->getCouponsSectionTagsUrl(null, $this->request->post('tags_url'));
            }

            foreach ($data as $key => $rows) {
                //$data[$key]['img_coupon'] = '/uploads/img_coupons/thumbs/'.basename($rows['img_coupon']);
                $data[$key]['dateoff'] = Date::rusdate(strtotime($rows['dateoff']), 'j %MONTH% Y');
            }

            $data = Controller_BaseController::convertArrayVievData($data);

            $content = View::factory('ajax_views/coupons_list_ajax');
            $content->data_coupon = $data;
            echo $content;
            //echo json_encode($data);
        }

    }


    //включение и отключение рассылки из профиля
    public function action_subscribeEnable(){

        $query = Model::factory('SubscribeModel')->updateSubskribEmail($this->request->post());
        echo json_encode(array('status' => $this->request->post('subscrib_disable'), 'susses' => $query));
    }


    /**
     * todo мутод валидации поля URL в бизнесах
     */
    public function action_checUrlBusiness(){

        if (!empty($_GET['id'])) {
            $query = Model::factory('BaseModel')->table_count('business', 'id', array('id', '<>', $_GET['id']), array('url', '=', $this->request->post('url')));
        } else {
            $query = Model::factory('BaseModel')->table_count('business', 'id', array('url', '=', $this->request->post('url')));
        }

        if ($query != 0) {
            echo "false";
        } else {
            echo "true";
        }

    }

    /**
     * todo мутод валидации поля URL в обзорах
     */
    public function action_checUrlArticles(){

        if (!empty($_GET['id'])) {
            $query = Model::factory('BaseModel')->table_count('articles', 'id', array('id', '<>', $_GET['id']), array('url', '=', $this->request->post('url')));
        } else {
            $query = Model::factory('BaseModel')->table_count('articles', 'id', array('url', '=', $this->request->post('url')));
        }

        if ($query != 0) {
            echo "false";
        } else {
            echo "true";
        }
    }


    /**
     * todo запись кликов по банерам
     */
    public function action_SetBaners (){
        if (Request::initial()->is_ajax()) {
           Rediset::getInstance()->set_baners($this->request->post('id_baner'));
            echo json_encode(array('qwe' => 1));
        }
    }










    /**
     * екшены запускаемые по крону для отправки емейлов бизнесам
     */


    /**
     * РАССЫЛКА ДЛЯ ПОДПИЩИКОВ
     * /subskribe_mail_all
     */

    public function action_SendEmailSubscribe() {


        if (isset($_GET['flag'])) {
            $flag = $_GET['flag'];
        } else {
            $flag = null;
        }

        //каждый четверг
        if (date('l') == 'Thursday' or $flag !== null) {

            //получаем бизнесы которые еще не попадали в рассылку
            $SubscribeModel = new Model_SubscribeModel();

            $users = $SubscribeModel->getSubskribeUsers();

            $business = $SubscribeModel->getSubskribeBusiness();
            $articless = $SubscribeModel->getSubskribeArticless();
            $coupons = $SubscribeModel->getSubskribeCoupons();
            $lotery = Model::factory('LotareyModel')->getLotareya();
            $users_lotery =  Model::factory('LotareyModel')->getUserLotarey(3);


            $i = 0;
            if (!empty($business) OR !empty($articless) OR !empty($coupons)) {

                $data = View::factory('email/mail');
                $data->business = $business;
                $data->coupons = Controller_BaseController::convertArrayVievData($coupons);

                $data->users = $users_lotery;
                $data->lotarey = $lotery;

                $article_shift = array_shift($articless);
                $data->article_shift = $article_shift;
                $data->articless = $articless;

                $m = Email::factory();
                foreach ($users as $key_num => $user_rows) {

                    $m->reloadTo();
                    $m->From("TopIsrael;noreplay@topisrael.ru"); // от кого отправляется почта
                    $m->To($user_rows['email']); // кому адресованно
                    $m->Subject('Новые обзоры, купоны и места отдыха и развлечений');
                    $m->Body($data, "html");
                    $m->Priority(3);

                    $m->Send();

                    HTML::x($user_rows['email']);
                    //usleep(400000);
                    sleep(1);
//                    if ($i++ == 100) {
//                        sleep(3);
//                        $i = 0;
//                    }

                }
            }
        }
    }


    /**
     * запускается по крону и сравнивает даты если до даты окончания бизнеса остается 7 дней
     * то отправляет письмо пользователю
     * sendbusiness
     */
    public function action_BussinesDisableEmailSevenDays() {

        $curent_date = date('Y-m-d');

        if (empty(Model::factory('SubscribeModel')->getDateCron($curent_date))) {

            //формируем файл карты сайта в /uploads
            Sitemap::FileGenerane(array('/coupons',
                '/articles',
                '/maps',
                '/account/login',
                '/account/registration',
                '/about', '/rss', '/account#izbran', '/account#coupons', '/newsletter'));


            //сохраняем в таблицу банеров количество кликов
            Model::factory('Adm')->saveMySQLclickBaners();


            //лотарея
            $this->LotareyCron();

            //включение отключение уведомление по банерам
            $this->subskribeBaners();
            //включение отключение уведомление по купонам
            $this->subskribeCoupons();

            //сохраняем базу редис один рас в сутки
            Rediset::getInstance()->save();

            //каждый день генерируем фаллы json для информеров
            $this->generateFileInformer();

            $obj = new Model_BussinesModel();
            //пользователи и бизнесы
            $data = $obj->getBusinesUserAll();
            //получаем бизнесы для смены статуса
            $business_data = $obj->getBusinesDateDisable();


            foreach ($data as $rows) {

                //эжемесячная рассылка по числу создания бизнеса исключает определенные типы реклами базовый и бесплатно
                if ($rows['client_status'] != 3 and $rows['client_status'] != 4) {
                    $this->sendBussinesMount($rows);
                }

                $d = new DateTime($rows['date_end']);
                $ert = $d->modify('-7 days')->format("Y-m-d");


                $ToEmail = $rows['email'];

                if (!empty($rows['UsersEmailManager'])) {
                    $ToEmail = array($rows['email'], $rows['UsersEmailManager']);
                }

                //за 7 дней перед отключением
                if ($curent_date == $ert) {
                    $message = View::factory('email/text_bussines_warning');
                    $message->data = $rows;
                    $this->template_mail_message($ToEmail, $rows['EmailRedactor'], 'התראה לסיום פרסום באתר טופ ישראל', $message);
                }

                if ($curent_date == $rows['date_end']) {
                    $message = View::factory('email/text_bussines_end');
                    $message->data = $rows;
                    $this->template_mail_message($ToEmail, $rows['EmailRedactor'], 'הפסקת פרסום', $message);
                }

                if ($curent_date == $rows['date_create']) {
                    $message = View::factory('email/text_bussines_start');
                    $message->data = $rows;
                    $this->template_mail_message($ToEmail, $rows['EmailRedactor'], 'החלת פרסום באתר טופ ישראל', $message);
                }

            }

            if (!empty($business_data)) {
                $obj->disableBusines($business_data);
            }

            Model::factory('SubscribeModel')->insertDateCron($curent_date);

        }

    }


    /**
     * todo запускается по крону увидомление пользователей бизнеса об боновлениях относящихся к бизнесу статьи новости лотареи
     * URL - send_user_bussines
     */
    public function action_UserBusinessSend() {


        $data = Model::factory('BaseModel')->getArticleNewsBussines();
        //HTML::x($data, true);

        if (!empty($data)) {

            $message = View::factory('mail_user_bussines/mail_general');
            $message_manager = View::factory('mail_user_bussines/mail_manager');
            $message_bugalter = View::factory('mail_user_bussines/mail_bugalter');

            foreach ($data as $item) {


                $message->data = $item;
                $this->message_user_bussines($item['UsersEmail'], null, 'ההודעה של האתר Topisrael.ru', $message);

                if (!empty($item['UsersEmailManager']) AND (!empty($item['ArrLotery']) OR !empty($item['ArrNews']) OR !empty($item['ArrArticle'])) ) {

                    $message_manager->data = $item;
                    $this->message_user_bussines($item['UsersEmailManager'], null, 'ההודעה של האתר Topisrael.ru', $message_manager);
                }

                //для бугалтеров
                if (!empty($item['UsersEmailBugalter']) AND (!empty($item['ArrBrif']) OR !empty($item['ArrKvitanciy']) OR !empty($item['ArrZacaz'])))  {

                    $message_bugalter->data = $item;
                    $this->message_user_bussines($item['UsersEmailBugalter'], null, 'ההודעה של האתר Topisrael.ru', $message_bugalter);
                }

            }

        }

    }


    public function message_user_bussines ($to, $cc = null, $subject, $message){

        $html_mail = View::factory('email/mail_business');
        $html_mail->content = $message;
        $this->obj_mail_user_bussines = Email::factory();
        //$this->obj_mail_user_bussines->reloadTo();
        $this->obj_mail_user_bussines->From("TopIsrael;top@topisrael.ru"); // от кого отправляется почта
        $this->obj_mail_user_bussines->To($to); // кому адресованно
        if ($cc != null) {
            $this->obj_mail_user_bussines->Bcc(array($cc));
        }

        $this->obj_mail_user_bussines->Subject($subject);
        $this->obj_mail_user_bussines->Body($html_mail, "html");
        $this->obj_mail_user_bussines->Priority(3);
        $this->obj_mail_user_bussines->Attach( $_SERVER['DOCUMENT_ROOT']."/public/images/logo-new-h.png", "", "image/png");
        $this->obj_mail_user_bussines->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/2.png", "", "image/png");
        $this->obj_mail_user_bussines->Send();

    }


    /**
     * todo рассылка отвецтвенному по бизнесам кототорые не обновлялись больше 60 дней url - sendbusiness_warning
     */
    public function action_MailSubscribeBusWarting (){


        //HTML::x(date_diff(new DateTime(),new DateTime(date('Y-m-d', strtotime('2016-05-20 20:23:23'))))->days);

        $bussines = Model::factory('BussinesModel')->getBusinessAll();


        $bus_id = array();

        $bussines_result = array();
        $bussines_result2 = array();


        foreach ($bussines as $bussine_row) {

            if ($bussine_row['BusDateUpdate'] == '0000-00-00 00:00:00' ) {
                $bus_id[] = $bussine_row['BusId'];
            } else {
                //получаем бизнесы дата обновления которых превысила 60 дней
                if (date_diff(new DateTime(), new DateTime(date('Y-m-d', strtotime($bussine_row['BusDateUpdate']))))->days >= 60) {
                    $bussines_result[] = $bussine_row;
                }
            }

        }

        //если 0000-00-00 00:00:00 то присваиваем текущую дату
        if (!empty($bus_id)) {
            Model::factory('BussinesModel')->setUpdateBussinesChange($bus_id);
        }

        
        if (!empty($bussines_result)) {
            //сортируем бизнесы по отвецтвенным
            foreach ($bussines_result as $item) {
                $bussines_result2[$item['RedactorEmail']][] = $item;
            }
        }


        if (!empty($bussines_result2)) {

            $bus_id = array();

            foreach ($bussines_result2 as $key_email => $item_users) {

                $message = '<p>Данные бизнесы не обновлялись более 60 дней</p>';

                foreach ($item_users as $item_bus) {
                    $message .= '<a href="'.HTML::HostSite('/business/'.$item_bus['BusUrl']).'" target="_blank">'.$item_bus['BusName'].'</a><br>';
                    $bus_id[] = $item_bus['BusId'];
                }

               $this->template_mail_bussines_warning($key_email, null, 'Бизнесы которые не обновлялись более 60 дней', $message);

            }

            if (!empty($bus_id)) {
                Model::factory('BussinesModel')->setUpdateBussinesChange($bus_id);
            }
        }



    }




    /**
     * todo рассылка по бизнесам запускаетя по крону url - sendbusiness_bussines
     */
    public function action_MailSubscribeBussines (){

        $views = View::factory('email/mail_subscribe_bussines');

        $data = Model::factory('SubscribeModel')->getSubskribeBussinesUsers();
        //HTML::x($data);
        $m = Email::factory();

        if (!empty($data)) {

            foreach ($data as $item) {

                $article_shift = array_shift($item['ArticArr']);
                $views->article_shift = $article_shift;
                $views->articless = $item['ArticArr'];
                $views->news = $item['NewsArr'];
                $views->coupons = Controller_BaseController::convertArrayVievData($item['CoupArr']);

                $m->reloadTo();
                $m->From("TopIsrael;noreplay@topisrael.ru"); // от кого отправляется почта
                $m->To($item['email']); // кому адресованно
                $m->Subject('Новые обзоры, купоны и места отдыха и развлечений');
                $m->Body($views, "html");
                $m->Priority(3);

                if (!empty($article_shift)) {
                    $m->Attach($_SERVER['DOCUMENT_ROOT'] . '/uploads/img_articles/' . basename($article_shift['ArticImg']), "", "");
                }

                if (!empty($item['ArticArr'])) {
                    foreach ($item['ArticArr'] as $artic) {
                        $m->Attach($_SERVER['DOCUMENT_ROOT'] . '/uploads/img_articles/thumbs/' . basename($artic['ArticImg']), "", "");
                    }
                }

                if (!empty($item['CoupArr'])) {
                    foreach ($item['CoupArr'] as $row_coupon) {
                        $m->Attach($_SERVER['DOCUMENT_ROOT'] . '/uploads/img_coupons/' . basename($row_coupon['CoupImg']), "", "");
                    }
                }


                $m->Attach($_SERVER['DOCUMENT_ROOT'] . "/public/images/logo-new.png", "", "");
                //$m->Attach($_SERVER['DOCUMENT_ROOT'] . "/public/mail/images/2.png", "", "");
                $m->Send();

            }


            Model::factory('SubscribeModel')->UpdateStatusSubscribeBussines();

        }

    }








    /*
     * запускается по крону каждый день поиск лотареи по конечной дате находим победителя и отправляем ему письмо
     * с уведомлением
     */
    public function LotareyCron(){

        $lotery = Model::factory('LotareyModel')->getLoteryActual();

        if ($lotery !== false) {

            $html_mail = View::factory('email/mail_lotery');
            $html_mail->email = $lotery['user']['email'];
            $html_mail->name = $lotery['lotery']['secondname'];


            $m = Email::factory();
            $m->From("TopIsrael;noreplay@topisrael.ru"); // от кого отправляется почта
            $m->To($lotery['user']['email']); // кому адресованно
            $m->Subject('Поздравляем Вас! Вы выиграли в Лотерее Topisrael');
            $m->Body($html_mail, "html");
            $m->Priority(3);
            $m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/images/logo-new.png", "", "image/png");
            $m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/2.png", "", "image/png");
            $m->Send();
        }
    }

    /**
     * @param $to
     * @param null $cc
     * @param $subject
     * @param $message
     * todo шаблон письма для отправки увидомительных писем
     */
    public function template_mail_message ($to, $cc = null, $subject, $message){

        $html_mail = View::factory('email/mail_business');
        $html_mail->content = $message;

        $m = Email::factory();
        $m->From("TopIsrael;top@topisrael.ru"); // от кого отправляется почта
        $m->To($to); // кому адресованно
        if ($cc != null) {
            $m->Bcc(array($cc));
        }

        $m->Subject($subject);
        $m->Body($html_mail, "html");
        $m->Priority(3);
        $m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/images/logo-new-h.png", "", "image/png");
        $m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/2.png", "", "image/png");
        $m->Send();

    }


    public function template_mail_bussines_warning ($to, $cc = null, $subject, $message){

        $html_mail = View::factory('email/mail_business_warning');
        $html_mail->content = $message;

        $m = Email::factory();
        $m->From("TopIsrael;top@topisrael.ru"); // от кого отправляется почта
        $m->To($to); // кому адресованно
        if ($cc != null) {
            $m->Bcc(array($cc));
        }

        $m->Subject($subject);
        $m->Body($html_mail, "html");
        $m->Priority(3);
        $m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/images/logo-new-h.png", "", "image/png");
        $m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/2.png", "", "image/png");
        $m->Send();

    }


    /**
     * todo рассылка по банерам
     */
    public function subskribeBaners (){

        $baners = Model::factory('BussinesModel')->getBannersUser();
        $curent_date = date('Y-m-d');

        foreach ($baners as $rows) {

            $d = new DateTime($rows['BanersDateEnd']);
            $ert = $d->modify('-7 days')->format("Y-m-d");


            $ToEmail = $rows['UserEmail'];

            if (!empty($rows['UsersEmailManager'])) {
                $ToEmail = array($rows['UserEmail'], $rows['UsersEmailManager']);
            }

            //за 7 дней перед отключением
            if ($curent_date == $ert) {
                $message = View::factory('email/text_baner_warning');
                $message->data = $rows;
                $this->template_mail_message($ToEmail, $rows['EmailRedactor'], 'התראה לסיום פרסום באנר', $message);
            }

            if ($curent_date == $rows['BanersDateEnd']) {
                $message = View::factory('email/text_baner_end');
                $message->data = $rows;
                $this->template_mail_message($ToEmail, $rows['EmailRedactor'], ' הפסקת באנר', $message);
            }

            if ($curent_date == $rows['BanersDateStart']) {
                $message = View::factory('email/text_baner_start');
                $message->data = $rows;
                $this->template_mail_message($ToEmail, $rows['EmailRedactor'], 'הפעלת הבאנר באתר טופ ישראל', $message);
            }

        }
    }


    /**
     * todo рассылка по купонам
     */
    public function subskribeCoupons (){

        $coupons = Model::factory('BussinesModel')->getCouponsUser();
        $curent_date = date('Y-m-d');

        foreach ($coupons as $rows) {

            $d = new DateTime($rows['CouponsDateEnd']);
            $ert = $d->modify('-7 days')->format("Y-m-d");


            $ToEmail = $rows['UserEmail'];

            if (!empty($rows['UsersEmailManager'])) {
                $ToEmail = array($rows['UserEmail'], $rows['UsersEmailManager']);
            }

            //за 7 дней перед отключением
            if ($curent_date == $ert) {
                $message = View::factory('email/text_coupon_warning');
                $message->data = $rows;
                $this->template_mail_message($ToEmail, $rows['EmailRedactor'], 'התראה לסיום פרסום הקופון', $message);
            }

            if ($curent_date == $rows['CouponsDateEnd']) {
                $message = View::factory('email/text_coupon_end');
                $message->data = $rows;
                $this->template_mail_message($ToEmail, $rows['EmailRedactor'], 'ניתוק קופון ', $message);
            }

            if ($curent_date == $rows['CouponsDateStart']) {
                $message = View::factory('email/text_coupon_start');
                $message->data = $rows;
                $this->template_mail_message($ToEmail, $rows['EmailRedactor'], 'הפעלת קופון באתר טופ ישראל', $message);
            }

        }
    }

    /**
     * @param $data_business
     * todo отправка ежемесячной рассылки
     */
    public function sendBussinesMount($data_business){

        //получаем меся последней отправки письма
        $date_subs_mount = date('m', strtotime($data_business['date_subscribe_mount']));
        $date_curent_mount = date('m');

        //если рассылки еще не было
        if (($data_business['date_subscribe_mount'] == null) and ($date_subs_mount < $date_curent_mount)) {

            DB::update('business')->set(array('date_subscribe_mount' => date('Y-m-d')))->where('id', '=', $data_business['id'])->execute();
            $message = View::factory('email/text_reminders');
            $message->data = $data_business;
            $this->template_mail_message($data_business['email'], $data_business['EmailRedactor'], 'ספר על עצמך יותר באתר טופ ישראל', $message);
        } else {

            if (($date_subs_mount < $date_curent_mount) and (date('d', strtotime($data_business['date_create'])) == date('d'))) {
                DB::update('business')->set(array('date_subscribe_mount' => date('Y-m-d')))->where('id', '=', $data_business['id'])->execute();
                $message = View::factory('email/text_reminders');
                $message->data = $data_business;
                $this->template_mail_message($data_business['email'], $data_business['EmailRedactor'], 'ספר על עצמך יותר באתר טופ ישראל', $message);

            }
        }
    }


    public function action_getAjaxInformerSection ()
    {
        $section = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'));

        $arr_result = array();
        $arr_result[] = array("value" => 0, "label" => 'Все');
        foreach ($section as $item) {
            $arr_result[] = array("value" => $item['id'], "label" => $item['name']);
        }

        echo json_encode($arr_result);

    }


    public function action_getAjaxInformerCity () {

        $page = parse_url($_GET['page']);
        $city = array();



       if ($page['path'] == '/informers') {
           $city = Model::factory('BaseModel')->getCityListInformersBusiness();
       } elseif ($page['path'] == '/informers/coupon') {
           $city = Model::factory('BaseModel')->getCityListInformersCoupons();
       } elseif ($page['path'] == '/informers/article') {
           $city = Model::factory('BaseModel')->getCityListInformersArticles();
       }


        $arr_result = array();
        $arr_result[] = array("value" => 0, "label" => 'Все');
        foreach ($city as $item) {
            $arr_result[] = array("value" => $item['cityId'], "label" => $item['cityName']);
        }

        echo json_encode($arr_result);

    }



    public function generateFileInformer (){
        Model::factory('BussinesModel')->getInformersBussinesId();
        Model::factory('CouponsModel')->getInformersCouponsId();
        Model::factory('ArticlesModel')->getInformersArticlesId();
    }

}
