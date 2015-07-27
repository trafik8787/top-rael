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
            'Бизнесы' => array('url' => '/bussines', 'icon' => 'glyphicon-th'),
            'Купоны' => array('url' => '/coupons', 'icon' => 'glyphicon-tags'),
            'Галереи' => array('url'=> '/galery', 'icon'=>'glyphicon-picture'),
            'Обзоры' => array('url' => '/articles', 'icon' => 'glyphicon-th'),
            'Лотерея' => array('url' => '/lotarey', 'icon' => 'glyphicon-bell'),
            'Письма' => array('url'=> '/contacts', 'icon'=>'glyphicon-globe'),
            'Подписчики' => array('url'=> '/subscription', 'icon'=>'glyphicon-envelope'),
            'Пользователи' => array('url'=>'/users?section=1', 'icon'=>'glyphicon-user'),
            'Разделы' => array('url' => '/sections', 'icon' => 'glyphicon-th-list'),
            'Категории' => array('url' => '/category', 'icon' => 'glyphicon-list-alt'),
            'Теги' => array('url' => '/tags', 'icon' => 'glyphicon-tags'),
            'Банеры' => array('url' => '/banners', 'icon' => 'glyphicon-cloud-download'),
            'О проекте' => array('url' => '/about', 'icon' => 'glyphicon-star'),
            'Главная' => array('url' => '', 'icon' => 'glyphicon-home')

            );
    }

}