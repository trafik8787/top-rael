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

        return array('Главная' => URL::site('administrator'),
            'О проекте' => URL::site('administrator/about'),
            'Разделы' => URL::site('administrator/sections'),
            'Категории' => URL::site('administrator/category'),
            '<b>Бизнесы по разделам</b>' => array('category' => $section, 'url' => '/administrator/bussines/'),
            '<b>Обзоры по разделам</b>' => array('category' => $section, 'url' => '/administrator/articles/'),
            'Купоны' => URL::site('administrator/coupons'),
            'Галереи' => URL::site('administrator/galery'),
            'Контакты' => URL::site('administrator/contacts'),
            );
    }

}