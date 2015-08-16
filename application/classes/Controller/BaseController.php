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
    public static $general_meny;
    public static $urlPars;
    public $header;
    public $footer;
    //public $RightBloc;
    //public $general_meny;



    public function before () {

        parent::before();

        $url = Request::detect_uri();
        self::$detect_uri = '/'.$url;
        self::$urlPars = explode('/', $url);


        $this->top_meny = array('Купоны' => '/coupons',
            'Обзоры' => '/articles',
            'Тель-Авив' => '/city/telaviv',
            'Иерусалим' => '/city/ierusalim',
            'Эйлат' => '/city/eilat',
            'На карте' => '/maps');

        $this->header = View::factory('/temp_pages/header');
        $this->footer = View::factory('/temp_pages/footer');
        $this->header->top_meny = $this->top_meny; //самое верхнее меню
        $this->footer->top_meny = $this->top_meny;

        if (Auth::instance()->get_user('login')) { // смотрим - если пользователь авторизован

            $this->header->user = Auth::instance()->get_user();

        }

        if (Cache::instance()->get('general_meny') == null) {
            self::$general_meny = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', 0)); //меню разделов
            Cache::instance()->set('general_meny', self::$general_meny);
        } else {
            self::$general_meny = Cache::instance()->get('general_meny');
        }
        $this->header->general_meny = self::$general_meny;
        $this->footer->general_meny = self::$general_meny;

        $this->template->header = $this->header;
        $this->template->footer = $this->footer;


        $this->template->style = array(
            'public/stylesheets/jquery.ui/all.css',
            'public/stylesheets/bootstrap.min.css',
            'public/stylesheets/bootstrap-social.css',
            'public/stylesheets/font-awesome.min.css',
            'public/stylesheets/screen.css',
            'public/stylesheets/print.css',
            'public/stylesheets/owl.carousel.min.css',
            'public/stylesheets/common.css',
            'public/stylesheets/ie.css'

        );

        $this->template->script = array(
            'public/javascripts/jquery.min.js',
            'public/javascripts/jquery-ui.min.js',
            'public/javascripts/bootstrap.min.js',
            'public/javascripts/owl.carousel.min.js',
            'public/javascripts/common.js',
            'public/javascripts/jquery.print.js',
            'public/javascripts/app.js'
        );

    }


    /**
     * @param array $data_arr
     * @return View
     * метод рендеринга правого блока
     */
    public static function RightBloc (array $data_arr){
        $data = View::factory('/temp_pages/bloc_right');
        $data->data_bloc = $data_arr;
        return $data;
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


    /**
     * @param $data
     * @return array
     * преобразование масиива для вывода бизнесов например в две колонки
     */
    public function convertArrayVievData($data){
        $resultData = array();
        $dataTmp = array();
        $i = 0;
        foreach ($data as $key => $data_row) {

            $i = $i + 1;
            $dataTmp[] = $data_row;

            if ($i>1) {
                $i = 0;
                $resultData[] = $dataTmp;
                $dataTmp = array();
            }
            //если последний елемент не парный
            if (!next($data)) {
                if (!empty($dataTmp)) {
                    $resultData[] = $dataTmp;
                }
            }
        }
        return $resultData;
    }

    /**
     * @return View
     * блок последних обзоров
     */
    public function blocArticlesAfter (){
        $content = View::factory('blocks_includ/articles_after');
        $content->data = Model::factory('ArticlesModel')->getArticlesAfter();
        return $content;
    }

}