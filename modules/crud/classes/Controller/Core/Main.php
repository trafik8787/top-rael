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
    public static $filtr;
    public static $meny;
    public function before () {

        parent::before();

        $this->template->title_page = self::$title_page;
        $this->template->filtr = self::$filtr;

        $this->template->meny = self::meny_admin();

    }


    public static function meny_admin () {


        return array(
            'Бизнесы' => array('url' => URL::site('administrator/bussines'), 'icon' => 'glyphicon-th'),
            'Купоны' => array('url' => URL::site('administrator/coupons'), 'icon' => 'glyphicon-tags'),
            'Галереи' => array('url'=>URL::site('administrator/galery'), 'icon'=>'glyphicon-picture'),
            'Обзоры' => array('url' => URL::site('administrator/articles'), 'icon' => 'glyphicon-th'),
            'Лотерея' => array('url' => URL::site('administrator/lotarey'), 'icon' => 'glyphicon-bell'),
            'Письма' => array('url'=>URL::site('administrator/contacts'), 'icon'=>'glyphicon-globe'),
            'Подписчики' => array('url'=>URL::site('administrator/subscription'), 'icon'=>'glyphicon-envelope'),
            'Пользователи' => array('url'=>URL::site('administrator/users?section=1'), 'icon'=>'glyphicon-user'),
            'Разделы' => array('url' => URL::site('administrator/sections'), 'icon' => 'glyphicon-th-list'),
            'Категории' => array('url' => URL::site('administrator/category'), 'icon' => 'glyphicon-list-alt'),
            'Теги' => array('url' => URL::site('administrator/tags'), 'icon' => 'glyphicon-tags'),
            'О проекте' => array('url' => URL::site('administrator/about'), 'icon' => 'glyphicon-star'),
            'Главная' => array('url' => URL::site('administrator'), 'icon' => 'glyphicon-home')








            );
    }

}