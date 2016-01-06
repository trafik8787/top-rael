<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 31.07.2015
 * Time: 14:17
 */

class Controller_Pages_Contacts extends Controller_BaseController {

    public function action_index (){

        $content = View::factory('pages/contacts');
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
                $m->From("TopIsrael;contact@topisrael.ru"); // от кого отправляется почта
                $m->To('leon@topisrael.ru'); // кому адресованно
                $m->Cc('boris@briker.biz');
                $m->Subject('Контактная форма');
                $m->Body($html_mail, "html");
                $m->Priority(3);
                $m->Send();


                if ($result === true) {
                    $this->redirect('/contacts?susses=true');
                } else {
                    HTML::x($result);
                }
            } else {
                $this->redirect('/contacts?err_cap='.base64_encode('Неверно введен проверочный код'));
            }
        }


        $this->template->content = $content;
    }

}