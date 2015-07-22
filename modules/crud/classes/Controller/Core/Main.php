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

        $section = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'));

        return array('Главная' => array('url' => URL::site('administrator'), 'icon' => 'glyphicon-home'),
            'О проекте' => array('url' => URL::site('administrator/about'), 'icon' => 'glyphicon-star'),
            'Разделы' => array('url' => URL::site('administrator/sections'), 'icon' => 'glyphicon-th-list'),
            'Категории' => array('url' => URL::site('administrator/category'), 'icon' => 'glyphicon-list-alt'),
            'Теги' => array('url' => URL::site('administrator/tags'), 'icon' => 'glyphicon-tags'),
            'Розыграши' => array('url' => URL::site('administrator/lotarey'), 'icon' => 'glyphicon-bell'),
            'Бизнесы по разделам' => array('category' => $section, 'url' => URL::site('administrator/bussines'), 'icon' => 'glyphicon-th'),
            'Обзоры по разделам' => array('category' => $section, 'url' => URL::site('administrator/articles'), 'icon' => 'glyphicon-th'),
            'Купоны' => array('url' => URL::site('administrator/coupons'), 'icon' => 'glyphicon-tags'),
            'Галереи' => array('url'=>URL::site('administrator/galery'), 'icon'=>'glyphicon-picture'),
            'Контакты' => array('url'=>URL::site('administrator/contacts'), 'icon'=>'glyphicon-envelope'),
            'Пользователи' => array('url'=>URL::site('administrator/users'), 'icon'=>'glyphicon-user')
            );
    }

}