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
    public static $count_articles = 0;
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

        //проверяем если запрос Ajax то отменяем рендеринг главного шаблона
        if (in_array($this->request->action(), array('changepass', 'profile_he','info'))) {
            $this->auto_render = FALSE;
        }
//        if ($_SERVER['REMOTE_ADDR'] != '178.94.172.183') {
//            die('Сайт временно закрыт ведутся работы');
//        }


        //избранные купоны в куки
       self::favorits_coupon();
        //избранные бизнесы в куки
       self::favorits_bussines();
        //избранные статьи
        self::favorits_articles();

        $url = Request::detect_uri();
        self::$detect_uri = '/'.$url;
        self::$urlPars = explode('/', $url);

        $this->top_meny = array(
            'Обзоры' => '/articles',
            'Купоны' => '/coupons',
            'LUX' => '/tags/luxury',
            'Праздники' => '/tags/celebration',
            'Детский мир' => '/tags/for_children'
        );
        
        $this->header = View::factory('/temp_pages/header');
        $this->footer = View::factory('/temp_pages/footer');
        //теги лакшери
        $this->header->tags = $this->tags();
        $this->header->top_meny = $this->top_meny; //самое верхнее меню
        $this->footer->top_meny = $this->top_meny;

        $this->footer->jornal = Model::factory('JornalModel')->rowJornal();

        if (Auth::instance()->get_user('login')) { // смотрим - если пользователь авторизован

            $this->header->user = Auth::instance()->get_user();

        }

        if (Cache::instance()->get('general_meny') == null) {
            self::$general_meny = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', 0), 'order_by'); //меню разделов
            Cache::instance()->set('general_meny', self::$general_meny);
        } else {
            self::$general_meny = Cache::instance()->get('general_meny');
        }

        $this->header->city_list = $this->listCity('', true);

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
            //'public/stylesheets/print.css',
            'public/stylesheets/owl.carousel.min.css',
            'public/stylesheets/jquery.bxslider.min.css',
            'public/stylesheets/jquery.minicolors.css',
            'public/stylesheets/common.css',
            'public/stylesheets/ie.css',
            'public_a/css/bootstrap-datetimepicker.min.css',
            '/fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic'
        );

        $this->template->script = array(
            'public/javascripts/jquery.min.js',
            'public/javascripts/jquery-ui.min.js',
            'public/javascripts/bootstrap.min.js',
            'public/javascripts/owl.carousel.min.js',
            'public/javascripts/jquery.bxslider.min.js',
            'public/javascripts/jquery.minicolors.js',


            'public_a/js/min/moment.min.js',
            'public_a/js/min/moment-with-locales.min.js',
            'public_a/js/bootstrap-datetimepicker.min.js',

            'public/javascripts/orb.min.js',
            'public/javascripts/jquery.validate.min.js',
            'public/javascripts/common.js',
            'public/javascripts/jquery.print.js',

            '/maps.googleapis.com/maps/api/js?v=3&libraries=places',
            'public/javascripts/markerclusterer_compiled.js',
            'public/javascripts/infobox.js',
            'public/javascripts/jquery.printElement.min.js',
            'public/javascripts/app.js'
        );

        //выводим модальное окно подписки везде кроме главной
        if (!Cookie::get('topsubscrib') and Request::detect_uri() != '') {
            $this->header->modal_subskribe = View::factory('blocks_includ/modal_subscribe');
            Cookie::set('topsubscrib', '1', Date::YEAR);
        }
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
            self::$count_articles = count(self::$favorits_articles);
        }
    }




    /**
     * @param $data
     * @return array
     * преобразование масиива для вывода бизнесов например в две колонки
     */
    public static function convertArrayVievData($data, $count = 2){
        if (!empty($data)) {
            return array_chunk($data, $count);
        } else {
            return false;
        }
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
    public function lotarey($bussines_id = null){
        $content = View::factory('blocks_includ/lotareya');
        $data = Model::factory('LotareyModel')->getLotareya($bussines_id);

        if (!empty($data)) {
            $content->data = $data[0];
            $content->data_user = Model::factory('LotareyModel')->getUserLotarey(4);
        } else {
            if ($bussines_id === null) {
                $content = $this->show_bloc_right_subscribe();
            }
        }
        return $content;
    }


    public function show_bloc_right_subscribe (){
        return  View::factory('blocks_includ/bloc_right_subscribe');
    }



    /*
     * блок форма подписки на конкретный бизнес
     */
    public function showBlocBussinesSubscribe($bussines_id){
        $data = View::factory('blocks_includ/bloc_right_bussines_subscribe');
        $data->bussines_id = $bussines_id;
        return  $data;
    }


    public function google_adssens (){
        $content = View::factory('blocks_includ/google_adssens');

        return $content;
    }


    private function tags (){
        return Model::factory('TagsModel')->getAllTags();
    }

    /**
     * @param $url
     * Рендеринг банеров
     */
    public function getBaners ($url, $url_section_category, $city_id){

        $top_content = View::factory('blocks_includ/top_banners');
        $right_content =  View::factory('blocks_includ/baners_right');
        $data = Model::factory('BaseModel')->getBaners($url, $url_section_category, $city_id);

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


    /**
     * только гугловская реклама
     */
    public function getBanersGoogle(){

        $top_content = View::factory('blocks_includ/top_banners');
        $right_content =  View::factory('blocks_includ/baners_right');

        //верхний банер
        self::$top_baners = $top_content;
        //парвый банер
        self::$right_baners = $right_content;

    }


    /**
     * @param null $name
     * @param null $secondname
     * @param null $info
     * @param null $busname
     * @param null $city_name
     * @param null $img
     * @param null $url
     * @param null $type флаг определяет на какой странице отображаются кнопки
     * @return View
     * todo метод вставки шаред кнопок
     */
    public static function getViewsSharedButtonsCoupon ($name = null, $secondname = null, $info = null, $busname = null, $city_name = null, $img = null, $url = null, $type = null) {



        $data = View::factory('blocks_includ/shared_buttons_coupon');
        $data->name = strip_tags($name);
        $data->secondname = strip_tags($secondname);
        $data->info = Text::limit_chars(strip_tags($info), 150, null, true);
        $data->busname = $busname;
        $data->city_name = $city_name;
        $data->img = HTML::HostSite($img);

        $urls = Request::full_current_url();

        $data->type = $type;


        if ($url != null) {
            $urls = HTML::HostSite('/coupon/'.$url);
        }

        $data->url = $urls;

        return $data;

    }


    public function SeoShowPage(array $title_seo, array $keywords_seo, array $description_seo){

        if ($title_seo[0] == '') {
            View::set_global('seo_title', $title_seo[1]);
        } else {
            View::set_global('seo_title', $title_seo[0]);
        }


        if ($keywords_seo[0] == '') {
            View::set_global('seo_keywords', Text::limit_chars(strip_tags($keywords_seo[1]), 300, null, true));
        } else {
            View::set_global('seo_keywords', $keywords_seo[0]);
        }

        if ($description_seo[0] == '') {
            View::set_global('seo_description', Text::limit_chars(strip_tags($description_seo[1]), 300, null, true));
        } else {
            View::set_global('seo_description', $description_seo[0]);
        }

    }


    /**
     * @return View
     * todo блок городов справа
     */
    public function blocCity (){
        $content = View::factory('blocks_includ/bloc_city');
        $content->data = $this->listCity();
        return $content;
    }

    public function listCity ($limit = 9, $all_city = false) {
        return Model::factory('BussinesModel')->getCityListBlocRight($limit, $all_city);
    }

    public function blocTags (){
        $content = View::factory('blocks_includ/bloc_tags');
        $content->data = Model::factory('TagsModel')->getAllTags();
        return $content;
    }

    //блок слайдер новостей на главной
    public function blocNewsSlider ($count_news){

        $content = View::factory('blocks_includ/bloc_news_slider_home');
        $content->data = Model::factory('NewsModel')->getBigBlocNews($count_news);
        return $content;
    }


    /**
     * @param null $url
     * @param $flag
     * @param null $count
     * @return View
     *  //правий блок новостей в категория обхорах городах и тегах
     */
    public function blocNews ($url=null, $flag = null){

        $content = View::factory('blocks_includ/bloc_right_news');

        switch ($flag) {

            case 'section':
                $content->data = Model::factory('NewsModel')->getSectionNews($url);
                break;
            case 'category':
                $content->data = Model::factory('NewsModel')->getCategoryNews($url);
                break;
            case 'tags':
                $content->data = Model::factory('NewsModel')->getTagsNews($url);
                break;
            case 'city':
                $content->data = Model::factory('NewsModel')->getCityNews($url);
                break;
            default:
                $content->data = Model::factory('NewsModel')->getBigBlocNews(5);
        }

        return $content;
    }

}