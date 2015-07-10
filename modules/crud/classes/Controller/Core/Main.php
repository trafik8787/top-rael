<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by JetBrains PhpStorm.
 * User: Vitalik
 * Date: 08.05.14
 * Time: 0:55
 * To change this template use File | Settings | File Templates.
 */
abstract class Controller_Core_Main extends Controller_Template {

    public $template = 'page/main_template';
    public static $title_page;
    public static $meny;
    public function before () {

        parent::before();

        $this->template->title_page = self::$title_page;

        $this->template->meny = self::meny_admin();

    }


    public static function meny_admin () {
        return array('Главная' => URL::site('administrator'),
            'О проекте' => URL::site('administrator/about'));
    }

}