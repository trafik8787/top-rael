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
            'Купоны' => array('metod' => 'coupons', 'url' => 'coupons', 'icon' => 'glyphicon-tags'),
            'Галереи' => array('metod' => 'galery', 'url'=> 'galery', 'icon'=>'glyphicon-picture'),
            'Банеры' => array('metod' => 'banners', 'url' => 'banners', 'icon' => 'glyphicon-cloud-download'),
            'Обзоры' => array('metod' => 'articles', 'url' => 'articles', 'icon' => 'glyphicon-th'),
            'Лотерея' => array('metod' => 'lotarey', 'url' => 'lotarey', 'icon' => 'glyphicon-bell'),
            'Письма' => array('metod' => 'contacts', 'url'=> 'contacts', 'icon'=>'glyphicon-globe'),
            'Подписчики' => array('metod' => 'subscription', 'url'=> 'subscription', 'icon'=>'glyphicon-envelope'),
            'Пользователи' => array('metod' => 'users', 'url'=>'users?section=1', 'icon'=>'glyphicon-user'),
            'Разделы' => array('metod' => 'sections', 'url' => 'sections', 'icon' => 'glyphicon-th-list'),
            'Категории' => array('metod' => 'category', 'url' => 'category', 'icon' => 'glyphicon-list-alt'),
            'Теги' => array('metod' => 'tags', 'url' => 'tags', 'icon' => 'glyphicon-tags'),
            'О проекте' => array('metod' => 'about', 'url' => 'about', 'icon' => 'glyphicon-star'),
            'Главная' => array('metod' => 'index', 'url' => '', 'icon' => 'glyphicon-home')

            );
    }

}