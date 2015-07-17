<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.05.2015
 * Time: 18:54
 */

abstract class Controller_BaseController extends Controller_Template {

    public $template = 'main';
    public $top_meny;
    public static $detect_uri;
    //public $general_meny;



    public function before () {

        parent::before();

        self::$detect_uri = '/'.Request::detect_uri();

        $this->top_meny = array('Купоны' => '/coupons',
            'Обзоры' => '/articles',
            'Тель-Авив' => '/city/telaviv',
            'Иерусалим' => '/city/ierusalim',
            'Эйлат' => '/city/eilat',
            'На карте' => '/maps');

        $header = View::factory('/temp_pages/header');
        $header->top_meny = $this->top_meny; //самое верхнее меню
        $header->general_meny = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', 0)); //меню разделов

        $this->template->header = $header;
        $this->template->footer = View::factory('/temp_pages/footer');


        $this->template->style = array('bootstrap.min', 'style');
        $this->template->script = array('jquery-1.11.2.min', 'bootstrap.min', 'jquery.validate.min','app');

    }





    /**
     * @param null $title
     * @param null $description
     * @param null $keywords
     * @param null $arrQuery
     * Сео
     */
    public function SeoViewsGlobal($title=null, $description =null, $keywords =null, $arrQuery = null){

        if ($arrQuery != null) {

            if (!empty($arrQuery[0]['seo_title'])) {
                $title_seo = $arrQuery[0]['seo_title'];
            } else {
                $title_seo = $title;
            }

            if (!empty($arrQuery[0]['seo_description'])) {
                $description_seo = $arrQuery[0]['seo_description'];
            } else {
                $description_seo = strip_tags($description);
            }

            if (!empty($arrQuery[0]['seo_keywords'])) {
                $keywords_seo = $arrQuery[0]['seo_keywords'];
            } else {
                $keywords_seo = strip_tags($keywords);
            }

        } else {
            $title_seo = $title;
            $description_seo = strip_tags($description);
            $keywords_seo = strip_tags($keywords);
        }

        View::set_global('seo_keywords', $keywords_seo);
        View::set_global('seo_title', $title_seo);
        View::set_global('seo_description', strip_tags($description_seo));
    }

}