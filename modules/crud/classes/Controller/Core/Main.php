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
        $this->template->security = Kohana::$config->load('security')->as_array();

        $get_user = Auth::instance()->get_user();

        if (!empty($get_user)) {
            $this->template->role = $get_user->roles->find_all()->as_array(NULL,'name');
        }


        //die(var_dump(Auth::instance()->get_user()));
    }


    public function after () {


        if (Auth::instance()->logged_in() === false) {

            $this->redirect('/administrator');
        }
        parent::after();
    }

    public static function meny_admin () {


        return array(
            'Бизнесы' => array('metod' => 'bussines', 'url' => 'bussines', 'icon' => 'glyphicon-th'),
            'Галереи' => array('metod' => 'galery', 'url'=> 'galery', 'icon'=>'glyphicon-picture'),
            'Обзоры' => array('metod' => 'articles', 'url' => 'articles', 'icon' => 'glyphicon-th'),
            'Новости' => array('metod' => 'news', 'url' => 'news', 'icon' => 'glyphicon-th'),
            'Купоны' => array('metod' => 'coupons', 'url' => 'coupons', 'icon' => 'glyphicon-tags'),
            'Банеры' => array('metod' => 'banners', 'url' => 'banners', 'icon' => 'glyphicon-cloud-download'),
            'Лотерея' => array('metod' => 'lotarey', 'url' => 'lotarey', 'icon' => 'glyphicon-bell'),
            'Печатный журнал' => array('metod' => 'jornal', 'url' => 'jornal', 'icon' => 'glyphicon-list-alt'),

            '1' => array(),
            'Статистика' => array('metod' => 'statistik', 'url' => 'statistik?tab=bus', 'icon' => 'glyphicon-list-alt'),
            '2' => array(),

            'Локации' => array('metod' => 'locat', 'url' => 'locat', 'icon' => 'glyphicon-flag'),
            'Разделы' => array('metod' => 'sections', 'url' => 'sections', 'icon' => 'glyphicon-th-list'),
            'Категории' => array('metod' => 'category', 'url' => 'category', 'icon' => 'glyphicon-list-alt'),
            'Теги' => array('metod' => 'tags', 'url' => 'tags', 'icon' => 'glyphicon-tags'),
            'Главная' => array('metod' => 'index', 'url' => '', 'icon' => 'glyphicon-home'),
            'О проекте' => array('metod' => 'about', 'url' => 'about', 'icon' => 'glyphicon-star'),

            '3' => array(),

            'Пользователи' => array('metod' => 'users', 'url'=>'users?section=1', 'icon'=>'glyphicon-user'),
            'Подписчики' => array('metod' => 'subscription', 'url'=> 'subscription', 'icon'=>'glyphicon-envelope'),
            'Обратная связь' => array('metod' => 'contacts', 'url'=> 'contacts', 'icon'=>'glyphicon-globe'),
            'Заказ торжеств' => array('metod' => 'order_celebrations', 'url'=> 'order_celebrations', 'icon'=>'glyphicon-globe'),
            '4' => array(),
            'Profile He' => array('metod' => 'profile_he', 'url' => 'profile_he', 'icon'=>'glyphicon-pushpin'),
            'Info' => array('metod' => 'info', 'url' => 'info', 'icon'=>'glyphicon-pushpin'),
            'Протокол' => array('metod' => 'logs', 'url' => 'logs', 'icon' => 'glyphicon-list-alt')


            );
    }

}