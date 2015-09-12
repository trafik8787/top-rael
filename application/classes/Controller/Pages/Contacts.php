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

                if ($result === true) {
                    $this->redirect('/contacts?susses=true');
                } else {
                    HTML::x($result);
                }
            } else {
                $this->redirect('/contacts?err_cap=Неверно введен проверочный код');
            }
        }


        $this->template->content = $content;
    }

}