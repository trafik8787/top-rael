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
    public static $count_coupon = 0;
    public static $count_bussines = 0;
    public static $favorits_coupon = null;
    public static $favorits_bussines = null;
    public static $favorits_articles = null;

    //храним блок верхних банеров
    public static $top_baners = null;
    //храним блок правих банеров
    public static $right_baners = null;
    //public $RightBloc;
    //public $general_meny;



    public function before () {

        parent::before();

        //избранные купоны в куки
       self::favorits_coupon();
        //избранные бизнесы в куки
       self::favorits_bussines();
        //избранные статьи
        self::favorits_articles();

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
        //теги лакшери
        $this->header->tags = $this->tags();
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
            'public/stylesheets/jquery.bxslider.min.css',
            'public/stylesheets/common.css',
            'public/stylesheets/ie.css',
            '/fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic'
        );

        $this->template->script = array(
            'public/javascripts/jquery.min.js',
            'public/javascripts/jquery-ui.min.js',
            'public/javascripts/bootstrap.min.js',
            'public/javascripts/owl.carousel.min.js',
            'public/javascripts/jquery.bxslider.min.js',
            'public/javascripts/orb.min.js',
            'public/javascripts/jquery.validate.min.js',
            'public/javascripts/common.js',
            'public/javascripts/jquery.print.js',

            '/maps.googleapis.com/maps/api/js?v=3&libraries=places',
            'public/javascripts/markerclusterer_compiled.js',
            'public/javascripts/infobox.js',

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
     * избранные купоны получаем в куки
     */
    public static function favorits_coupon (){

        if (Cookie::get('favoritcoup') != '') {
            self::$count_coupon = json_decode(Cookie::get('favoritcoup'));
            //получаем масив купонов из куки
            self::$favorits_coupon = self::$count_coupon;
            // количество купонов
            self::$count_coupon = count(self::$count_coupon);
        }
    }

    /**
     * избранные бизнесы в куки получаем
     */
    public static function favorits_bussines (){

        if (Cookie::get('favoritbus') != '') {
            self::$count_bussines = json_decode(Cookie::get('favoritbus'));
            //получаем масив купонов из куки
            self::$favorits_bussines = self::$count_bussines;
            // количество купонов
            self::$count_bussines = count(self::$count_bussines);
        }
    }

    /**
     * избранные статьи в куки получаем
     */
    public static function favorits_articles (){

        if (Cookie::get('favoritartic') != '') {
            self::$favorits_articles = json_decode(Cookie::get('favoritartic'));
        }
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
    public static function convertArrayVievData($data){

        return array_chunk($data, 2);
    }


    public static function convertArrayTagsBusiness ($data, $count = 3){

        return array_chunk($data, $count);
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

    /**
     * @return mixed
     * блок розыграша
     */
    public function lotarey(){
        $content = View::factory('blocks_includ/lotareya');
        $data = Model::factory('LotareyModel')->getLotareya();
        if (!empty($data)) {
            $content->data = $data[0];
        } else {
            $content->data = array();
        }
        return $content;
    }

    private function tags (){
        return Model::factory('TagsModel')->getAllTags();
    }

    /**
     * @param $url
     * Рендеринг банеров
     */
    public function getBaners ($url, $url_section_category){

        $top_content = View::factory('blocks_includ/top_banners');
        $right_content =  View::factory('blocks_includ/baners_right');
        $data = Model::factory('BaseModel')->getBaners($url, $url_section_category);

        if (!empty($data['top_baners'])) {
            $top_content->data = $data['top_baners'];
        } else {
            $top_content->data = array();
        }

        if (!empty($data['right_baners'])) {
            $right_content->data = $data['right_baners'];
        } else {
            $right_content->data = array();
        }
        //верхний банер
        self::$top_baners = $top_content;
        //парвый банер
        self::$right_baners = $right_content;
    }
}