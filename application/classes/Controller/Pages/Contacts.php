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


        $this->SeoShowPage(array('Контакты TopIsrael.ru', ''),
            array('Контакты TopIsrael.ru', ''),
            array('Контакты TopIsrael.ru', ''));

        $this->template->content = $content;
    }

}