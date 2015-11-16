<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Ajax extends Controller {

    /**
     * добавляем подписчика
     */
	public function action_index()
	{
        if (Request::initial()->is_ajax()) {

            $query = Model::factory('SubscribeModel')->addSubskribeLodatey($this->request->post('email'));
            Session::instance()->set('uniqid', uniqid());

            $html_mail = View::factory('email/mail_subskribe_enable');
            $html_mail->message = '<a href="http://'.$_SERVER['HTTP_HOST'].'/susses_subscribe?qid='.Session::instance()->get('uniqid').'&email='.$this->request->post('email').'">Подтвердить подписку</a>';

            $m = Email::factory();
            $m->From("TopIsraelSubscribe@top.com"); // от кого отправляется почта
            $m->To($this->request->post('email')); // кому адресованно
            $m->Subject('Подтверждение подписки');
            $m->Body($html_mail, "html");
            $m->Priority(3);
            $m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/1.png", "", "image/png");
            $m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/2.png", "", "image/png");
            //$m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/3.jpg", "", "image/jpeg");
            $m->Send();
            echo json_encode($query);
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
        echo json_encode($query);
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
     * екшены запускаемые по крону для отправки емейлов бизнесам
     */


    /**
     * РАССЫЛКА ДЛЯ ПОДПИЩИКОВ
     */
    public function SendEmailSubscribe(){



        //каждый четверг
        if (date('l') == 'Thursday') {

            //получаем бизнесы которые еще не попадали в рассылку
            $business = Model::factory('SubscribeModel')->getSubskribeBusiness();
            $articless = Model::factory('SubscribeModel')->getSubskribeArticless();
            $users = Model::factory('SubscribeModel')->getSubskribeUsers();

            if (!empty($business) OR !empty($articless)) {

                $data = View::factory('email/mail');
                $data->business = $business;
                $article_shift = array_shift($articless);
                $data->article_shift = $article_shift;
                $data->articless = $articless;

                $m = Email::factory();
                foreach ($users as $user_rows) {

                    $m->reloadTo();
                    $m->From("TopIsrael;send@topisrael.ru"); // от кого отправляется почта
                    $m->To($user_rows['email']); // кому адресованно
                    $m->Subject('Рассылка TopIsrael');
                    $m->Body($data, "html");
                    $m->Priority(3);

                    if (!empty($article_shift)) {
                        $m->Attach($_SERVER['DOCUMENT_ROOT'] . '/uploads/img_articles/thumbs/' . basename($article_shift['images_article']), "", "");
                    }

                    foreach ($articless as $artic) {
                        $m->Attach($_SERVER['DOCUMENT_ROOT'] . '/uploads/img_articles/thumbs/' . basename($artic['images_article']), "", "");
                    }

                    foreach ($business as $bus) {
                        $m->Attach($_SERVER['DOCUMENT_ROOT'] . '/uploads/img_business/thumbs/' . basename($bus['home_busines_foto']), "", "");
                    }

                    $m->Attach($_SERVER['DOCUMENT_ROOT'] . "/public/mail/images/1.png", "", "image/png");
                    $m->Attach($_SERVER['DOCUMENT_ROOT'] . "/public/mail/images/2.png", "", "image/png");
                    $m->Send();

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


        //запуск рассылки
        $dat = $this->SendEmailSubscribe();
        //лотарея
        $this->LotareyCron();

        //сохраняем базу редис один рас в сутки
        Rediset::getInstance()->save();

        $obj = new Model_BussinesModel();
        //пользователи и бизнесы
        $data = $obj->getBusinesUserAll();
        $curent_date = date('Y-m-d');

        foreach ($data as $rows) {

            $d = new DateTime($rows['date_end']);
            $ert = $d->modify('-7 days')->format("Y-m-d");
            //за 7 дней перед отключением
            if ($curent_date == $ert) {
                $message = 'Ваш бизнес <a href="http://'.$_SERVER['SERVER_NAME'].'/business/'.$rows['url'].'">'.$rows['name'].'</a> будет отключен через 7 дней';
                $this->template_mail_message($rows['email'], $rows['EmailRedactor'], 'Увидомление о отключении бизнеса', $message);
            }

            if ($curent_date == $rows['date_end']) {
                //меняем статус бизнеса в базе
                $obj->disableBusines($rows['id']);
                $message = 'Ваш бизнес <a href="http://'.$_SERVER['SERVER_NAME'].'/business/'.$rows['url'].'">'.$rows['name'].'</a> отключен';
                $this->template_mail_message($rows['email'], $rows['EmailRedactor'], 'Отключение бизнеса', $message);
            }

            if ($curent_date == $rows['date_create']) {
                $message = 'Ваш бизнес <a href="http://'.$_SERVER['SERVER_NAME'].'/business/'.$rows['url'].'">'.$rows['name'].'</a> подключен.';
                $this->template_mail_message($rows['email'], $rows['EmailRedactor'], 'Подключение бизнеса', $message);
            }
        }
    }


    /*
     * запускается по крону каждый день поиск лотареи по конечной дате находим победителя и отправляем ему письмо
     * с уведомлением
     */
    public function LotareyCron(){

        $lotery = Model::factory('LotareyModel')->getLoteryActual();

        if ($lotery !== false) {

            $message = 'Победитель лотареи';
            $m = Email::factory();
            $m->From("admin@top.com"); // от кого отправляется почта
            $m->To($lotery['email']); // кому адресованно
            $m->Subject('Победитель лотареи');
            $m->Body($message, "html");
            $m->Priority(3);
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
        $m->From("TopIsrael;send@topisrael.ru"); // от кого отправляется почта
        $m->To($to); // кому адресованно
        $m->Cc($cc);
        $m->Subject($subject);
        $m->Body($html_mail, "html");
        $m->Priority(3);
        $m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/1.png", "", "image/png");
        $m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/2.png", "", "image/png");
        $m->Send();
    }
}
