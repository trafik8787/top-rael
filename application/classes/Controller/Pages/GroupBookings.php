<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.01.2016
 * Time: 15:43
 */

/**
 * Class Controller_Pages_GroupBookings
 * Страница групповых заказов
 */
class Controller_Pages_GroupBookings extends Controller_BaseController {

    public function action_index(){

        $content = View::factory('pages/group_bookings');
        $content->captcha = Captcha::instance();


        if (!empty($_POST)) {
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
                $m->Cc('boris@briker.biz');
                $m->Subject('Групповой заказ TopIsrael.ru');
                $m->Body($html_mail, "html");
                $m->Priority(3);
                $m->Send();


                if ($result === true) {
                    $this->redirect('/group_bookings?susses=true');
                }
            } else {
                $this->redirect('/group_bookings?err_cap='.base64_encode('Неверно введен проверочный код'));
            }
        }

        $this->SeoShowPage(array('Групповые заказы на отдых, развлечения и покупки в Израиле', ''),
            array('Эксклюзивные скидки для группы, на отдых и развлечения в Израиле. Более 500 мест.',''),
            array('Эксклюзивные скидки для группы, на отдых и развлечения в Израиле. Более 500 мест.', ''));


        $this->template->content = $content;

    }

}