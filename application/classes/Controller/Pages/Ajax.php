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
            //echo json_encode($data);
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

           // die(HTML::x($data));

            $content = View::factory('ajax_views/coupons_list_ajax');
            $content->data_coupon = $data;
            echo $content;
            //echo json_encode($data);
        }

    }













    /**
     * екшены запускаемые по крону для отправки емейлов бизнесам
     */


    /**
     * РАССЫЛКА ДЛЯ ПОДПИЩИКОВ
     */
    public function action_SendEmailSubscribe(){

        //каждый четверг
        if (date('l') == 'Thursday') {

        }

    }



    /**
     * запускается по крону и сравнивает даты если до даты окончания бизнеса остается 7 дней
     * то отправляет письмо пользователю
     * sendbusiness
     */
    public function action_BussinesDisableEmailSevenDays() {

        $obj = new Model_BussinesModel();

        //пользователи и бизнесы
        $data = $obj->getBusinesUserAll();


        //HTML::x($data);
        $this->LotareyCron();

        foreach ($data as $rows) {

            $d = new DateTime($rows['date_end']);
            $ert = $d->modify('-7 days')->format("Y-m-d");

            //за 7 дней перед отключением
            if (date('Y-m-d') == $ert) {
                $message = 'Ваш бизнес будет отключен через 7 дней';

                $m = Email::factory();
                $m->From("admin@top.com"); // от кого отправляется почта
                $m->To($rows['email']); // кому адресованно
                $m->Subject('Отключение бизнеса');
                $m->Body($message, "html");
                $m->Priority(3);
                $m->Send();

            }

            if (date('Y-m-d') == $rows['date_end']) {

                //меняем статус бизнеса в базе
                $obj->disableBusines($rows['id']);

                $message = 'Ваш бизнес отключен';

                $m = Email::factory();
                $m->From("admin@top.com"); // от кого отправляется почта
                $m->To($rows['email']); // кому адресованно
                $m->Subject('Отключение бизнеса');
                $m->Body($message, "html");
                $m->Priority(3);
                $m->Send();
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

        //HTML::x($lotery);
    }


}
