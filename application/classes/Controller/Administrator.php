<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.06.2015
 * Time: 17:20
 */

class Controller_Administrator extends Controller_Core_Main {

    public $adm;
    public $logged_in;
    public static $ter;

    public $auth;
    public $session;
    public $class_id;
    public $user;
    public $user_roles;

    //масив победителей в лотареи
    private static $lotery_users_prizer;


    public function before (){

        parent::before();
        $this->auth     = Auth::instance();
        $this->session  = Session::instance();
        $this->class_id = Get_class($this);


//        # Проверка прав доступа
//        $this->_check_permission();

//        $arrar = array('username' => 'admin','email'=>'trafik8787@gmail.com', 'password'=>'admin', 'password_confirm' => 'admin');
//        $user = ORM::factory('User');
//
//        $user->username = 'admin';
//        $user->password = '123456';
//        $user->email = 'trafik8787@gmail.com';
//
//        $user->save();
//        $user->add('roles', ORM::factory('Role', array('name' => 'login')));
            //->create_user($arrar, array('username', 'email', 'password')) // Регистрируем пользователя
            //->add('roles', ORM::factory('Role', array('name' => 'login')));

       // $this->logged_in = Auth::instance()->logged_in('admin');

        $this->adm = View::factory('/adm/auth_admin');


        if ($this->auth->logged_in('admin') !== false OR $this->auth->logged_in('manager') !== false OR $this->auth->logged_in('redactor') !== false OR $this->auth->logged_in('control') !== false) {

            $this->user = $this->auth->get_user();
           $this->user_roles = $this->user->roles->find_all()->as_array(NULL,'name');
            $this->_check_permission();
        } else {

            $this->response->body($this->adm);
        }

    }


    public function after () {

        if ($this->auth->logged_in('admin') !== false OR $this->auth->logged_in('manager') !== false OR $this->auth->logged_in('redactor') !== false OR $this->auth->logged_in('control') !== false) {

            $this->_check_permission();
        } else {
            $this->response->body($this->adm);
        }

    }

    public function action_login () {


        $post = $this->request->post();

        if(!empty($post['login']) && !empty($post['password'])) {

            $status = $this->auth->login($post['login'], $post['password']);

            if ($status) {

                $this->redirect('/administrator/welcome');

            } else {

                $this->response->body($this->adm);
            }

        } else {
            $this->response->body($this->adm);
        }
        $this->logged_in =  $this->auth->logged_in('admin');

    }

    public function action_logout () {
        Auth::instance()->logout();
        $this->redirect('/administrator');
    }




    private function _check_permission()
    {
        $check_permission = FALSE;

        $config_security = Kohana::$config->load('security')->as_array();
        $action = Request::current()->action();

        //die(var_dump($this->user_roles));
        if(isset($config_security[$this->class_id][$action]))
        {
            foreach($config_security[$this->class_id][$action] as $users_role)
                if(in_array($users_role, $this->user_roles) || in_array($users_role, array('public')))
                    $check_permission = TRUE;
        }

        if(isset($config_security[$this->class_id]['all_actions']))
        {
            foreach($config_security[$this->class_id]['all_actions'] as $users_role)
                if(in_array($users_role, $this->user_roles))
                    $check_permission = TRUE;
        }

//        if($check_permission != TRUE)
//            exit('Access deny - 403 ');
    }


    public function action_welcome (){
        $this->template->title_page = 'Приветствуем '. isset($this->user->secondname) ? $this->user->secondname : '';

        $welcome = View::factory('adm/welcome');
        $this->template->render = $welcome;

        $this->response->body($this->template);
    }


    public function action_index() {

        Controller_Core_Main::$title_page = 'Главная';
        $this->response->body(self::adminHome()->edit_render(1));


    }

    public function action_about(){

        Controller_Core_Main::$title_page = 'О проекте';
        $this->response->body(self::adminAbout()->edit_render(1));
    }



    public function action_sections (){
        Controller_Core_Main::$title_page = 'Разделы';
        $this->response->body(self::adminSections()->render());
    }

    public function action_category(){

        if (!empty($_GET['section'])) {
            Session::instance()->set('customer_id_section', $_GET['section']);
        } else {
            Session::instance()->set('customer_id_section', null);
        }

        $filtr = View::factory('adm/filtr_admin_section');
        $filtr->data = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'));
        Controller_Core_Main::$filtr[] = $filtr;

        Controller_Core_Main::$title_page = 'Категории';
        $this->response->body(self::adminCategory()->render());
    }

    public function action_tags (){
        Controller_Core_Main::$title_page = 'Теги Глобальные разделы';
        $this->response->body(self::adminTags()->render());
    }

    public function action_locat (){
        Controller_Core_Main::$title_page = 'Локации';
        $this->response->body(self::adminLocat()->render());
    }

    public function action_banners (){

        $city_id = null;

        if (!empty($_GET['city']) and $_GET['city'] != '') {
            $city_id = $_GET['city'];
        }

        if (!empty($_GET['activ'])) {

            $get_activ = $_GET['activ'];

        } else {
            $get_activ = 3;
        }


        if (!empty($_GET['section'])) {

            $category = Model::factory('CategoryModel')->recurs_catalog($_GET['section']);
            //HTML::x($category);
            $data = Model::factory('BaseModel')->getBanersAdminFiltr($category, $city_id, $get_activ);

        } else {
            $data = Model::factory('BaseModel')->getBanersAdminFiltr(null, $city_id, $get_activ);
        }


        Session::instance()->set('customer_id_baners', $data['arrIdbaners']);

        //HTML::x($data);

        $filtr = View::factory('adm/filtr_admin_section');
        $filtr->data = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'));
        $filtr->city = $data['city'];


        $form_activ = View::factory('adm/filtr_activ');
        $form_activ->form = '#w-form-filtr-adm';

        $filtr->activ = $form_activ;

        Controller_Core_Main::$filtr[] = $filtr;

        Controller_Core_Main::$title_page = 'Банеры';
        $this->response->body(self::adminBanners($_GET)->render());
    }
    
    public function action_lotarey (){
        Controller_Core_Main::$title_page = 'Лотерея';
        $this->response->body(self::adminLotarey()->render());
    }


    public function action_bussines (){


        $city_id = null;

        if (!empty($_GET['city']) and $_GET['city'] != '') {
            $city_id = $_GET['city'];
        }

        if (!empty($_GET['section'])) {

            $category = Model::factory('CategoryModel')->recurs_catalog($_GET['section']);
            $data =  Model::factory('BussinesModel')->getBussinesSectionUrl($category[0]['url'], null ,null, $city_id, true);
            $name = $category[0]['name'];

        } else {
            $busssines = null;
            $name = '';
            $data =  Model::factory('BussinesModel')->getBussinesSectionUrl(null, null ,null, $city_id, true);
            $data['city'] = Model::factory('BussinesModel')->getCityInSection(null, true);
        }

        $busssines = array();
        foreach ($data['data'] as $row_cat) {
            $busssines[] = $row_cat['id'];
        }

        $busssines = '('.implode(",", $busssines).')';
        $city = $data['city'];

        $filtr = View::factory('adm/filtr_admin_section');
        $filtr->data = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'));
        $filtr->city = $city;


        $form_activ = View::factory('adm/filtr_activ');
        $form_activ->form = '#w-form-filtr-adm';

        $filtr->activ = $form_activ;

        Controller_Core_Main::$filtr[] = $filtr;


        if (!empty($_GET['activ'])) {

            if ($_GET['activ'] == 3) {
                Session::instance()->set('bussines_activ', null);
            } elseif ($_GET['activ'] == 2){
                Session::instance()->set('bussines_activ', 0);
            } elseif ($_GET['activ'] == 1){
                Session::instance()->set('bussines_activ', 1);
            }


        } else {
            Session::instance()->set('bussines_activ', null);
        }

        Session::instance()->set('customer_id_bussines', $busssines);

        if (empty($_GET['section']) and empty($_GET['city'])) {
            Session::instance()->set('customer_id_bussines', null);
        }

        Controller_Core_Main::$title_page = 'Бизнесы '.$name;
        $this->response->body(self::adminBussines($_GET)->render());

    }


    public function action_articles (){
        if (!empty($_GET['section'])) {
            Session::instance()->set('customer_id_articles', $_GET['section']);
        } else {
            Session::instance()->set('customer_id_articles', null);
        }

        $filtr = View::factory('adm/filtr_admin_section');
        $filtr->data = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'));
        Controller_Core_Main::$filtr[] = $filtr;

        Controller_Core_Main::$title_page = 'Обзоры';
        $this->response->body(self::adminArticles()->render());
    }


    public function action_news () {
        Controller_Core_Main::$title_page = 'Новости';
        $this->response->body(self::adminNews()->render());
    }


    public function action_statistik () {

        $form = View::factory('adm/statistik_page');
        //обновление таблицы mysql
        if ($this->request->post('import_static')) {
           Model::factory('StatisticModel')->import_bussines();

        }

        //обновление информеров
        if ($this->request->post('update_informer')) {
            Model::factory('BussinesModel')->getInformersBussinesId();
            Model::factory('CouponsModel')->getInformersCouponsId();
            Model::factory('ArticlesModel')->getInformersArticlesId();
        }

        $data_bus = array();
        $data_articles = array();
        $data_coupons = array();
        $data_baners = array();

        if ($_GET['tab'] == 'bus') {
            //фильтр по бизнесам
            if ($this->request->post('filtr_bussines')) {

                $date = explode(' - ', $this->request->post('daterange'));

                $form->daterange_bus = $this->request->post('daterange');

                $date_start = Date::convert_Date($date[0]);
                $date_end = Date::convert_Date($date[1]);

                $data_bus = Model::factory('StatisticModel')->show_bussines($date_start, $date_end);

            } else {
                $data_bus = Model::factory('StatisticModel')->show_bussines();
            }
        }

        if ($_GET['tab'] == 'articles') {
            //фильтр по статьям
            if ($this->request->post('filtr_articles')) {

                $date = explode(' - ', $this->request->post('daterange_article'));
                $form->daterange_article = $this->request->post('daterange_article');

                $date_start = Date::convert_Date($date[0]);
                $date_end = Date::convert_Date($date[1]);

                $data_articles = Model::factory('StatisticModel')->show_articles($date_start, $date_end);
            } else {
                $data_articles = Model::factory('StatisticModel')->show_articles();
            }
        }


        if ($_GET['tab'] == 'coupons') {
            //фильтр по купонам
            if ($this->request->post('filtr_coupons')) {

                $date = explode(' - ', $this->request->post('daterange_coupons'));
                $form->daterange_coupons = $this->request->post('daterange_coupons');

                $date_start = Date::convert_Date($date[0]);
                $date_end = Date::convert_Date($date[1]);

                $data_coupons = Model::factory('StatisticModel')->show_coupons($date_start, $date_end);
            } else {
                $data_coupons = Model::factory('StatisticModel')->show_coupons();
            }
        }


        if ($_GET['tab'] == 'baners') {


            if ($this->request->post('filtr_baners')) {

                $date = explode(' - ', $this->request->post('daterange_baners'));
                $form->daterange_baners = $this->request->post('daterange_baners');

                $date_start = Date::convert_Date($date[0]);
                $date_end = Date::convert_Date($date[1]);

                $data_baners = Model::factory('StatisticModel')->show_baners($date_start, $date_end);
            } else {
                $data_baners = Model::factory('StatisticModel')->show_baners();
            }

        }



        //HTML::x(Model::factory('StatisticModel')->show_bussines('2016-01-20', '2016-05-05'));

        Controller_Core_Main::$title_page = 'Статистика';


        $form->data_bus = $data_bus;
        $form->data_articles = $data_articles;
        $form->data_coupons = $data_coupons;
        $form->data_baners = $data_baners;

        $this->template->render = $form;
        $this->response->body($this->template);
    }

    public function action_coupons (){

        if (!empty($_GET['activ'])) {

            if ($_GET['activ'] == 3) {
                Session::instance()->set('coupons_activ', null);
            } elseif ($_GET['activ'] == 2){
                Session::instance()->set('coupons_activ', 0);
            } elseif ($_GET['activ'] == 1){
                Session::instance()->set('coupons_activ', 1);
            }


        } else {
            Session::instance()->set('coupons_activ', null);
        }


        $form_activ = View::factory('adm/filtr_activ');
        Controller_Core_Main::$filtr[] = $form_activ;

        Controller_Core_Main::$title_page = 'Купоны';
        $this->response->body(self::adminCoupons()->render());
    }


    public function action_galery (){

        Controller_Core_Main::$title_page = 'Галереи';
        $this->response->body(self::adminGalery()->render());
    }

    public function action_contacts (){
        Controller_Core_Main::$title_page = 'Обратная связь';
        $this->response->body(self::adminContacts()->render());
    }


    public function action_order_celebrations (){
        Controller_Core_Main::$title_page = 'Заказ торжеств';
        $this->response->body(self::adminOrderCelebrations()->render());
    }

    public function action_subscription (){
        Controller_Core_Main::$title_page = 'Список подписчиков';
        $this->response->body(self::adminSubscription()->render());
    }

    public function action_users (){

        if (empty($_GET['section'])) {
            $_GET['section'] = 1;
        }

        Session::instance()->set('customer_id_users', $_GET['section']);

        switch ($_GET['section']) {
            case 1:
                $title_page = 'Зарегистрированные пользователи';
                break;
            case 5:
                $title_page = 'Бизнес пользователи';
                break;
            case 2:
                $title_page = 'Пользователи админки';
                break;
        }


        $users = array(
            array('id' => 1, 'name' => 'Пользователи'),
            array('id' => 5, 'name' => 'Бизнесы'),
            array('id' => 2, 'name' => 'Сотрудники')
        );

        $filtr = View::factory('adm/filtr_admin_section');
        $filtr->data = $users;
        Controller_Core_Main::$filtr[] = $filtr;

        Controller_Core_Main::$title_page = $title_page;
        $this->response->body(self::adminUsers()->render());
    }


    /**
     * журналирование
     */
    public function action_logs (){

        Controller_Core_Main::$title_page = 'Журнал';
        $number_page = $this->request->param('page');
        $logs = View::factory('adm/logs');
        $data = Model::factory('Adm')->get_log(35, $number_page);
        $logs->data = $data['data'];
        $logs->pagination = Pagination::factory(array('total_items' => $data['count'], 'items_per_page' => 35));
        $this->template->render = $logs;

        $this->response->body($this->template);
    }


    public function action_jornal() {
        Controller_Core_Main::$title_page = 'Печатный журнал';
        $this->response->body(self::adminJornal()->render());
    }


    /**
     * @return Cruds
     * end ections
     */









    public static function adminHome (){
        $crud = new Cruds();
        $crud->load_table('home_seo');
        $crud->set_lang('ru');
        $crud->disable_editor('description');
        $crud->disable_editor('keywords');
        $crud->show_name_column(array(
            'description' => 'SEO Description',
            'title'=> 'SEO Title',
            'keywords'=> 'SEO Keywords'));

        return $crud;
    }

    public static function adminAbout (){
        $crud = new Cruds();
        $crud->load_table('about');
        $crud->set_lang('ru');
        $crud->disable_search();
        $crud->show_name_column(array('text' => 'Описание','description' => 'SEO Description',
            'title'=> 'SEO Title',
            'keywords'=> 'SEO Keywords'));
        return $crud;
    }


    public static function adminSections (){
        $crud = new Cruds();
        $crud->load_table('category', array('0', 'DESC'));
        $crud->set_lang('ru');
        $crud->disable_search();
        $crud->show_columns('id', 'name', 'url');
        $crud->edit_fields('name', 'url', 'title', 'description', 'keywords');
        $crud->disable_editor('description');
        $crud->disable_editor('keywords');
        $crud->show_name_column(array('name' => 'Название раздела',
            'url' => 'URL',
            'description' => 'SEO Description',
            'title'=> 'SEO Title',
            'keywords'=> 'SEO Keywords'));
        $crud->set_where('parent_id', '=', 0);
        return $crud;
    }

    public static function adminCategory (){
        $crud = new Cruds();
        $crud->load_table('category', array('0', 'DESC'));
        $crud->set_lang('ru');
        $crud->disable_search();

        if (Session::instance()->get('customer_id_section') != null) {
            $crud->set_where('parent_id', '=', Session::instance()->get('customer_id_section'));
        } else {
            $crud->set_where('parent_id', '<>', 0);
        }

        $crud->disable_editor('description');
        $crud->disable_editor('keywords');
        $crud->show_columns('id', 'name', 'url');
        $crud->edit_fields('name', 'url', 'parent_id', 'title', 'description', 'keywords');
        $crud->add_field('name', 'url', 'parent_id', 'title', 'description', 'keywords');
        $crud->set_field_type('parent_id', 'select', '', '', '', array('category', 'name','id', array('parent_id','=', '0')));



        $crud->validation('url', array('required' => true, 'minlength' => 4, 'regexp' => '^[a-zA-Z0-9_]+$'),
           array('minlength' => 'URL должен быть минимум 4 символа',
               'required' => 'Это поле обязательно для заполнения',
               'regexp' => 'Url может состоять только из латинских букв, цифр и знака подчеркивания'));
        $crud->show_name_column(array('name' => 'Название категории',
            'url' => 'URL',
            'parent_id' => 'Раздел',
            'description' => 'SEO Description',
            'title'=> 'SEO Title',
            'keywords'=> 'SEO Keywords'));
        return $crud;
    }


    public static function adminTags (){
        $crud = new Cruds();
        $crud->load_table('tags', array('0', 'DESC'));
        $crud->set_lang('ru');
        $crud->disable_search();
        $crud->disable_editor('description');
        $crud->disable_editor('keywords');
        $crud->show_name_column(array('name_tags' => 'Название',
            'url_tags' => 'URL',
            'description' => 'SEO Description',
            'title' => 'SEO Title',
            'keywords' => 'SEO Keywords',));
        return $crud;
    }


    public static function adminLocat (){
        $crud = new Cruds();
        $crud->load_table('city', array('0', 'DESC'));
        $crud->set_lang('ru');
        $crud->disable_search();
        $crud->remove_delete();
        $crud->show_columns('id', 'name', 'url', 'name_en', 'name_he');
        $crud->edit_fields('name', 'name_en', 'name_he', 'url', 'title', 'description', 'keywords');
        $crud->add_field('name', 'name_en', 'name_he', 'url', 'title', 'description', 'keywords');
        $crud->set_where('parent_id', '<>', '0');
        $crud->show_name_column(array('name' => 'Название',
            'name_en' => 'Название_en',
            'name_he' => 'Название_he',
            'url' => 'URL',
            'title' => 'SEO Title',
            'description' => 'SEO Description',
            'keywords' => 'SEO Keywords'));
        return $crud;
    }


    public static function adminLotarey (){

        self::$lotery_users_prizer = Model::factory('LotareyModel')->getUserLotarey(null, null, true);
        //HTML::x(self::$lotery_users_prizer);

        $crud = new Cruds();
        $crud->load_table('lotarey', array('0', 'DESC'));
        $crud->set_lang('ru');
        $crud->set_field_type('status', 'radio', array('1' => 'Ожидает', '2' => 'Идет', '3' => 'Завершен'));
        $crud->set_field_type('business_id', 'select', '', '', '', array('business', 'name','id'));
        $crud->set_field_type('img', array('file', 'uploads/img_lotarey', 'lot_', '', 'img'),'', '');
        $crud->show_columns('id', 'secondname', 'date_start', 'date_end', 'dop_field_lotery_user',  'status');

        $crud->edit_fields('secondname','description','img','business_id','date_start','date_end','status');
        $crud->add_field('secondname','description','img','business_id','date_start','date_end','status');
        $crud->disable_editor('description');


        $crud->callback_befor_show_edit('call_bef_show_edit_lotery');
        $crud->callback_before_insert('call_bef_insert_lotery');
        $crud->callback_before_edit('call_bef_edit_lotery');
        $crud->callback_list_table('call_list_table_lotery');


        $crud->rows_color_where(4, '==', 3, ' #cccccc');

        $crud->show_name_column(array(
            'secondname' => 'Заголовок',
            'description' => 'Описание',
            'img' => 'Картинка - 300х300 px',
            'business_id'=> 'Бизнес',
            'date_start'=> 'Дата начала',
            'date_end' => 'Дата конца',
            'dop_field_lotery_user' => 'Победители',
            'status' => 'Статус'));
        $crud->disable_search();
        return $crud;
    }


    /**
     * @return Cruds
     * Форма бизнесов
     */
    public static function adminBussines ($get=null){

        $query = DB::select('user_id')->from('roles_users')->where('role_id','IN', array(4,3,2))->execute()->as_array();
        $arr_user = array();

        if (!empty($query)) {
            foreach ($query as $row_user) {
                $arr_user[] = $row_user['user_id'];
            }
        }

        $recurs_cat = Model::factory('CategoryModel')->recurs_catalog();

        $crud = new Cruds();
        //номер поля по порядку с лева начинается с нуля
        $crud->load_table('business', array('0', 'DESC'));
        $crud->set_lang('ru');


        $activ_bussines = '';

        if (Session::instance()->get('customer_id_bussines') != null) {
            //$crud->set_where('id', 'IN', Session::instance()->get('customer_id_bussines')); Session::instance()->get('bussines_activ')
            if (Session::instance()->get('bussines_activ') !== null) {
                $activ_bussines = ' AND status = '.Session::instance()->get('bussines_activ');
            }
            $crud->set_where(' WHERE id IN '.Session::instance()->get('customer_id_bussines').$activ_bussines);
        } else {

            if (Session::instance()->get('bussines_activ') !== null) {
                $activ_bussines = ' WHERE status = '.Session::instance()->get('bussines_activ');
                $crud->set_where($activ_bussines);
            }

        }

        $crud->disable_editor('description');
        $crud->disable_editor('keywords');
        $crud->disable_editor('address');
        $crud->disable_editor('services');

        $crud->toptip_fields(array('address' => 'Если адресов несколько то каждый новы аресс пишется с новой строки. Сначала пишется город потом знак | и адрес',
                                'services' => 'Каждая услуга пишется с новой строки.'));

        $crud->disable_editor('title');
        $crud->select_multiselect('cat_id');
        $crud->show_columns('id', 'name', 'show_bussines', 'date_end', 'status');

        $crud->set_field_type('city', 'select', '', '', '', array('city', 'name','id', array('parent_id','<>','0')));
        $crud->set_field_type('dop_address', 'hidden', '', '', '', '');

        $crud->set_field_type('client_status', 'radio', array(1 => 'Стандарт', 2 => 'Топ', 3 => 'Базовый', 4 => 'Бесплатно'), '', array('style' => 'margin-top: 10px; margin-bottom: 12px'), '');


        $crud->set_field_type('redactor_user', 'select', '', '', '', array('users', 'username', 'id', array('id', 'IN', $arr_user)));

        $crud->set_field_type('cat_id', 'select', $recurs_cat, 'multiple', '', '');
        $crud->set_one_to_many('businesscategory', 'cat_id','category_id', 'business_id');

        $crud->set_field_type('home_busines_foto', array('file', 'uploads/img_business', 'bus_', '', 'img'),'', '');
        $crud->set_field_type('logo', array('file', 'uploads/img_business', 'buslogo_', '', 'img'),'', '');

        $crud->set_field_type('file_meny', array('file', 'uploads/img_business/file_meny', 'meny_', '', 'others'),'', '');

        $crud->set_field_type('top_slider', array('file', 'uploads/img_business/top_slider', 'slid_', '', 'img'),'', 'multiple');
        $crud->set_one_to_many('top_slider_bussines', 'top_slider','img_path', 'bussines_id');

        $crud->set_field_type('tags', 'checkbox', '', 'multiple', '', array('tags', 'name_tags','id'));
        $crud->set_one_to_many('tags_relation_business', 'tags', 'id_tags', 'id_business');

        $status['page'] = 'status';
        $status['position'][0] = array('class' =>'btn-warning', 'text' => 'OFF');
        $status['position'][1] = array('class' =>'btn-success', 'text' => 'ON');

        $crud->add_action('StatusBusiness', 'ON', 'ban/actionAdd', '', $status);


        $crud->links('name', '/business/', 'url');
        $crud->rows_color_where(3, '==', 0, ' #cccccc');


        $crud->edit_fields('redactor_user',
            'date_create',
            'date_end',
            'client_status',
            'name',
            'title',
            'description',
            'keywords',
            'city',
            'address',
            'tel',
            'schedule',
            'maps_cordinate_x',
            'maps_cordinate_y',
            'dop_address',
            'website',
            'video',
            'home_busines_foto',
            'logo',
            'top_slider',
            'info',
            'services',
            'url',
            'cat_id',
            'tags',
            'file_meny');

        $crud->add_field('redactor_user',
            'date_create',
            'date_end',
            'client_status',
            'name',
            'title',
            'description',
            'keywords',
            'city',
            'address',
            'tel',
            'schedule',
            'maps_cordinate_x',
            'maps_cordinate_y',
            'dop_address',
            'website',
            'video',
            'home_busines_foto',
            'logo',
            'top_slider',
            'info',
            'services',
            'url',
            'cat_id',
            'tags',
            'file_meny');

        $crud->show_name_column(array('name' => 'Название',
            'url' => 'URL',
            'show_bussines' => 'Просмотры',
            'description' => 'SEO Description',
            'title' => 'SEO Title',
            'keywords' => 'SEO Keywords',
            'client_status' => 'Тип рекламы',
            'city' => 'Город',
            'address' => 'Адрес',
            'maps_cordinate_x' => 'Широта',
            'maps_cordinate_y' => 'Долгота',
            'tel' => 'Телефон',
            'schedule' => 'Pасписание',
            'services' => 'Приемущества и услуги',
            'website' => 'Веб сайт бизнеса',
            'video' => 'Видео',
            'home_busines_foto' => 'Главное фото бизнеса - 350х230',
            'top_slider' => 'Обои - 1136х320',
            'file_meny' => 'Файл меню',
            'info' => 'Описание',
            'logo' => 'Логотип - 360х360',
            'cat_id' => 'Категория',
            'redactor_user' => 'Ответственный',
            'date_create' => 'Дата создания',
            'date_end' => 'Дата окончания',
            'tags' => 'Теги',
            'status' => 'Статус'
            ));

        $crud->validation('url', array('required' => true, 'minlength' => 4, 'regexp' => '^[a-zA-Z0-9_]+$',
            'remote' => array('url' => "/chec_url_bus", 'type' => 'post')),
            array('minlength' => 'URL должен быть минимум 4 символа',
                'required' => 'Это поле обязательно для заполнения',
                'regexp' => 'Url может состоять только из латинских букв, цифр и знака подчеркивания',
                'remote' => 'Такой URL уже существует'));

        $crud->validation('name', array('required' => true),
            array('required' => 'Это поле обязательно для заполнения'));

        $crud->validation('address', array('required' => true),
            array('required' => 'Это поле обязательно для заполнения'));

        $crud->validation('info', array('required' => true),
            array('required' => 'Это поле обязательно для заполнения'));

        $crud->validation('tel', array('required' => true),
            array('required' => 'Это поле обязательно для заполнения'));


        $crud->validation('top_slider', array('required' => true),
            array('required' => 'Это поле обязательно для заполнения'));

        $crud->callback_before_edit('call_bef_edit_business');
        $crud->callback_after_insert('call_after_insert_business');
        $crud->callback_before_insert('call_bef_insert_business');

        $crud->callback_befor_show_edit('call_bef_show_edit_bus');
        $crud->callback_befor_show_add('call_bef_show_insert_bus');
        $crud->callback_before_delete('call_befor_del_business');

        //$crud->callback_list_table('call_list_table_bussines');

        return $crud;
    }


    /**
     * @return Cruds
     * Обзоры
     */
    public static function adminArticles (){

        $recurs_cat = Model::factory('CategoryModel')->recurs_catalog();

        $crud = new Cruds();
        $crud->load_table('articles', array('0', 'DESC'));
        if (Session::instance()->get('customer_id_articles') != null) {
            $crud->set_where('id_section', '=', Session::instance()->get('customer_id_articles'));
        }

        $crud->disable_editor('description');
        $crud->disable_editor('keywords');
        $crud->disable_editor('short_previev');
        $crud->disable_editor('big_previev');
        $crud->set_lang('ru');
        $crud->show_columns('id', 'name', 'url');
        $crud->set_field_type('in_home', 'checkbox', '', '', '','');
        $crud->set_field_type('city', 'select', '', '', '', array('city', 'name','id', array('parent_id','<>','0')));
        $crud->set_field_type('id_section', 'select', '', '', '', array('category', 'name','id', array('parent_id','=','0')));
        $crud->set_field_type('id_category', 'select', $recurs_cat, '', '', '');
        $crud->set_field_type('bussines_id', 'select', '', 'multiple', '', array('business', 'name','id'));
        $crud->set_field_type('coupon', 'select', '', 'multiple', '', array('coupon', '{name} - {secondname}','id', array(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('datestart AND dateoff'))));

        $crud->set_field_type('tags', 'checkbox', '', 'multiple', '', array('tags', 'name_tags','id'));
        $crud->set_one_to_many('tags_relation_articles', 'tags', 'id_tags', 'id_articles');

        $crud->select_multiselect('coupon');
        $crud->set_one_to_many('articles_relation_coupon', 'coupon', 'id_coupon', 'id_articles');

        $crud->select_multiselect('bussines_id');
        $crud->set_one_to_many('articles_relation_business', 'bussines_id', 'id_business', 'id_articles');

        $crud->set_field_type('images_article', array('file', 'uploads/img_articles', 'artic_', '', 'img'),'', '');

        //добавляем ссылку записи в поле
        $crud->links('name', '/article/', 'url');

        $crud->toptip_fields(array('images_article' => 'Минимальный размер 750 px'));

        $crud->validation('url', array('required' => true, 'minlength' => 4, 'regexp' => '^[a-zA-Z0-9_]+$',
            'remote' => array('url' => "/chec_url_articles", 'type' => 'post')),
            array('minlength' => 'URL должен быть минимум 4 символа',
                'required' => 'Это поле обязательно для заполнения',
                'regexp' => 'Url может состоять только из латинских букв, цифр и знака подчеркивания',
                'remote' => 'Такой URL уже существует'));

        $crud->validation('name', array('required' => true),
            array('required' => 'Это поле обязательно для заполнения'));

        $crud->edit_fields('name',
            'title',
            'description',
            'keywords',
            'secondname',
            'short_previev',
            'big_previev',
            'content',
            'images_article',
            'url',
            'id_section',
            'id_category',
            'bussines_id',
            'city',
            'coupon',
            'tags',
            'datecreate',
            'in_home'
        );

        $crud->add_field('name',
            'title',
            'description',
            'keywords',
            'secondname',
            'short_previev',
            'big_previev',
            'content',
            'images_article',
            'url',
            'id_section',
            'id_category',
            'bussines_id',
            'city',
            'coupon',
            'tags',
            'datecreate',
            'in_home'

        );

        $crud->show_name_column(array('name' => 'Название',
            'secondname' => 'Подзаголовок',
            'short_previev' => 'Короткий анонс',
            'big_previev' => 'Длинный анонс',
            'url' => 'URL',
            'description' => 'SEO Description',
            'title' => 'SEO Title',
            'keywords' => 'SEO Keywords',
            'city' => 'Город',
            'id_section' => 'Раздел',
            'coupon' => 'Купон',
            'content' => 'Текст статьи',
            'images_article' => 'Главное фото - 750х562 px',
            'bussines_id' => 'Бизнес',
            'id_category' => 'Категория',
            'tags' => 'Теги',
            'datecreate' => 'Дата создания',
            'in_home' => 'На главной'

        ));

        $crud->callback_before_edit('call_bef_edit_articles');
        $crud->callback_befor_show_edit('call_bef_show_edit_articles');
        $crud->callback_after_insert('call_after_insert_articles');
        $crud->callback_before_insert('call_bef_insert_articles');
        $crud->callback_before_delete('call_bef_del_articles');

        return $crud;
    }



    public static function adminNews () {

        $recurs_cat = Model::factory('CategoryModel')->recurs_catalog();

        $crud = new Cruds();
        $crud->load_table('news', array('0', 'DESC'));
        $crud->set_lang('ru');
        $crud->disable_editor('text');

        $crud->set_field_type('id_section', 'select', '', '', '', array('category', 'name','id', array('parent_id','=','0')));
        $crud->set_field_type('id_category', 'select', $recurs_cat, '', '', '');
        $crud->set_field_type('bussines_id', 'select', '', '', '', array('business', 'name','id'));
        $crud->set_field_type('city', 'select', '', '', '', array('city', 'name','id', array('parent_id','<>','0')));

        $crud->set_field_type('img', array('file', 'uploads/img_news', 'news_', '', 'img'),'', '');

        $crud->set_field_type('tags', 'checkbox', '', 'multiple', '', array('tags', 'name_tags','id'));
        $crud->set_one_to_many('tags_relation_news', 'tags', 'id_tags', 'id_news');

        $crud->show_columns('id', 'name', 'text', 'date');


        $crud->show_name_column(array('name' => 'Название',
            'text' => 'Текст',
            'img' => 'Картинка',
            'city' => 'Город',
            'id_section' => 'Раздел',
            'bussines_id' => 'Бизнес',
            'id_category' => 'Категория',
            'tags' => 'Теги',
            'date' => 'Дата создания'
        ));


        $crud->edit_fields('name',
            'text',
            'img',
            'city',
            'id_section',
            'bussines_id',
            'id_category',
            'tags',
            'date'
        );

        $crud->add_field('name',
            'text',
            'img',
            'city',
            'id_section',
            'bussines_id',
            'id_category',
            'tags',
            'date'
        );

        $crud->callback_after_insert('call_after_insert_news');
        $crud->callback_befor_show_edit('call_bef_show_edit_news');
        $crud->callback_before_insert('call_bef_insert_news');
        $crud->callback_before_edit('call_bef_edit_news');

        $crud->callback_list_table('call_list_table_news');


        return $crud;
    }


    /**
     * @return Cruds
     * купоны
     */
    public static function adminCoupons (){

        $crud = new Cruds();
        $crud->load_table('coupon', array('0', 'DESC'));

        if (Session::instance()->get('coupons_activ') !== null) {

            if (Session::instance()->get('coupons_activ') == 1) {
                $crud->set_where('dateoff', '>', DB::expr('DATE(NOW())'));
            } elseif (Session::instance()->get('coupons_activ') == 0){
                $crud->set_where('dateoff', '<', DB::expr('DATE(NOW())'));
            }

        }

        $crud->set_lang('ru');
        $crud->show_columns('id', 'name', 'business_id', 'dateoff');
        $crud->set_field_type('business_id', 'select', '', '', '', array('business', 'name','id'));
        $crud->set_field_type('city', 'select', '', '', '', array('city', 'name','id', array('parent_id','<>','0')));
        $crud->set_field_type('id_section', 'select', '', '', '', array('category', 'name','id', array('parent_id','=','0')));

        $crud->set_field_type('img_coupon', array('file', 'uploads/img_coupons', 'coup_', '', 'img'),'', '');

        $crud->validation('url', array('required' => true, 'minlength' => 4, 'regexp' => '^[a-zA-Z0-9_]+$'),
            array('minlength' => 'URL должен быть минимум 4 символа',
                'required' => 'Это поле обязательно для заполнения',
                'regexp' => 'Url может состоять только из латинских букв, цифр и знака подчеркивания'));

        $crud->validation('name', array('required' => true),
            array('required' => 'Это поле обязательно для заполнения'));

        $crud->set_field_type('tags', 'checkbox', '', 'multiple', '', array('tags', 'name_tags','id'));
        $crud->set_one_to_many('tags_relation_coupons', 'tags', 'id_tags', 'id_coupons');

        //метод подставляет значения в таблицу из другой таблицы по join
        /**
         * 'business_id' - поле текущей таблицы
         * 'business' - другая таблица из которой будем брать данные
         * 'name' - поле из которого будем брать
         * 'id' - поле по которому будем джойнить с 'business_id'
         */
        $crud->show_name_old_table('business_id', 'business', 'name', 'id');
        $crud->disable_editor('info');

        $crud->rows_color_where(3, '<', date('Y-m-d'), ' #cccccc', 'date');

        $crud->edit_fields('name',
            'secondname',
            'info',
            'url',
            'img_coupon',
            'id_section',
            'business_id',
            'city',
            'datecreate',
            'datestart',
            'dateoff',
            'tags'
        );

        $crud->add_field('name',
            'secondname',
            'info',
            'url',
            'img_coupon',
            'id_section',
            'business_id',
            'city',
            'datecreate',
            'datestart',
            'dateoff',
            'tags'
        );
        $crud->show_name_column(array(
            'name' => 'Название',
            'secondname' => 'Подзаголовок',
            'info' => 'Иврит',
            'url' => 'URL',
            'img_coupon' => 'Фото купона - 440х365 px',
            'id_section' => 'Раздел',
            'business_id' => 'Бизнес',
            'city' => 'Город',
            'datecreate' => 'Дата создания',
            'datestart' => 'Дата начала',
            'dateoff' => 'Дата конца',
            'tags' => 'Теги'
        ));

        $crud->callback_before_edit('call_bef_edit_coupons');
        $crud->callback_before_insert('call_bef_insert_coupons');
        $crud->callback_befor_show_edit('call_bef_show_edit_coupons');
        $crud->callback_after_insert('call_after_insert_coupons');
        $crud->callback_before_delete('call_befor_del_coupons');

        $crud->callback_list_table('call_list_table_coupons');

        return $crud;
    }

    /**
     * @return Cruds
     * галерея
     */
    public static function adminGalery (){
        $crud = new Cruds();
        $crud->load_table('gallery', array('0', 'DESC'));
        $crud->set_lang('ru');
        $crud->show_columns('id','name', 'business_id');
        $crud->disable_editor('galery_text');



        $crud->show_name_old_table('business_id', 'business', 'name', 'id');

        $crud->show_name_column(array(
            'name' => 'Название',
            'galery_text'=> 'Описание',
            'business_id' => 'Бизнес'));
        $crud->edit_fields('name','business_id', 'galery_text');
        $crud->add_field('name','business_id', 'galery_text');

        $crud->set_field_type('business_id', 'select', '', '', '', array('business', 'name','id'));

        $crud->callback_befor_show_edit('call_bef_edit_show_galery');
        $crud->callback_befor_show_add('call_bef_insert_show_galery');
        $crud->callback_before_edit('call_bef_edit_galery');
        $crud->callback_after_insert('call_after_insert_galery');
        $crud->callback_before_delete('call_bef_delete_galery');
        return $crud;
    }


    public static function adminContacts (){
        $crud = new Cruds();
        $crud->load_table('contacts', array('0', 'DESC'));
        $crud->set_lang('ru');
        $crud->disable_search();
        $crud->remove_add();
        $crud->remove_edit();
        $crud->icon_delete('glyphicon-remove-sign');
        $crud->show_views('glyphicon-list-alt');
        $crud->show_name_column(array(
            'name' => 'Имя',
            'city'=> 'Город',
            'tel' => 'Телефон',
            'email'=>'Email',
            'date_create' => 'Дата',
            'description' => 'Сообщение'));

        $crud->callback_list_table('call_list_table_contact');

        return $crud;
    }


    public static function adminOrderCelebrations (){
        $crud = new Cruds();
        $crud->load_table('order_celebrations', array('0', 'DESC'));
        $crud->set_lang('ru');
        $crud->remove_add();
        $crud->remove_edit();
        $crud->show_views('glyphicon-list-alt');

        $crud->links('bussines_name', '/business/', 'bussines_link');

        $crud->show_columns('id', 'last_name', 'city', 'tel', 'email', 'event', 'count_human', 'date_event', 'discription', 'bussines_name', 'date');

        $crud->show_name_column(array(
            'last_name' => 'Имя',
            'city'=> 'Город',
            'tel' => 'Телефон',
            'email'=>'Email',
            'event' => 'Событие',
            'count_human' => 'Количество человек',
            'date_event' => 'Дата события',
            'discription' => 'Сообщение',
            'bussines_name' => 'Страница бизнеса',
            'date' => 'Дата создания'
        ));
        return $crud;
    }


    public static function adminJornal () {
        $crud = new Cruds();
        $crud->load_table('jornal', array('0', 'DESC'));
        $crud->set_lang('ru');
        $crud->disable_search();
        $crud->show_columns('id', 'info', 'date');
        $crud->disable_editor('info');
        $crud->set_field_type('file', array('file', 'uploads/file_jornal', 'jornal_', '', 'others'),'', '');
        $crud->set_field_type('img', array('file', 'uploads/img_jornal', 'jornal_', '', 'img'),'', '');
        $crud->show_name_column(array(
            'id' => 'ID',
            'info'=> 'Краткое описание',
            'file' => 'Файл журнала',
            'img' => 'Фото',
            'date'=>'Дата выпуска'));



        $crud->callback_befor_show_edit('call_bef_show_edit_jornal');
        $crud->callback_before_insert('call_bef_insert_jornal');
        $crud->callback_before_edit('call_bef_edit_jornal');
        $crud->callback_list_table('call_list_table_jornal');

        return $crud;
    }


    public static function adminSubscription (){

        $crud = new Cruds();
        $crud->load_table('subscription', array('0', 'DESC'));
        $crud->set_lang('ru');
        $crud->remove_edit();
        $crud->remove_add();
        $crud->show_columns('id','email',  'date', 'ip', 'all_subscribe', 'date_active');

        $crud->show_name_column(array(
            'email' => 'Email',
            'date' => 'Дата подписки',
            'ip' => 'IP',
            'all_subscribe' => 'Тип подписки',
            'date_active' => 'Дата активации'
            ));

        $status['page'] = 'action';
        $status['position'][0] = array('class' =>'btn-warning', 'text' => 'OFF');
        $status['position'][1] = array('class' =>'btn-success', 'text' => 'ON');

        $crud->add_action('StatusSubscribers', 'ON', 'ban/actionAdd', '', $status);

        $crud->callback_list_table('call_list_table_subscription');

        return $crud;
    }


    public static function adminUsers (){

        $crud = new Cruds();
        $crud->load_table('users', array('0', 'DESC'));
        $crud->set_lang('ru');

        if (Session::instance()->get('customer_id_users') == 1 OR Session::instance()->get('customer_id_users') == 5) {
            $crud->set_where('id_role', '=', Session::instance()->get('customer_id_users'));
        } else {
            $crud->set_where('id_role', 'NOT IN', '(1, 5)');
        }


        $crud->set_field_type('password', 'password');
        $crud->set_field_type('email', 'email');

        $crud->show_columns('id', 'email', 'username', 'secondname', 'date_registration');
        $crud->set_field_type('sex', 'select', array('2' => 'Мужчина', '1' => 'Женщина'), '', '', '');



        if (Session::instance()->get('customer_id_users') == 1) {

            //если это обычные пользователи
            $crud->remove_add();
            $crud->set_field_type('photo', array('file', 'uploads/img_users', 'user_', '', 'img'),'','');
            $crud->edit_fields('email', 'username', 'name', 'secondname', 'sex', 'bdate', 'tel', 'city', 'ip', 'photo', 'date_registration');
            $crud->add_field('email', 'username', 'date_registration');

            $crud->callback_befor_show_edit('call_bef_show_edit_users');
            $crud->callback_before_edit('call_bef_edit_user');


        } elseif (Session::instance()->get('customer_id_users') == 5) {

            $crud->set_field_type('business_id', 'select', '', '', '', array('business', 'name','id'));
            $crud->edit_fields('email', 'password', 'username', 'name', 'secondname', 'sex', 'bdate', 'tel', 'email_manager', 'email_bugalter', 'business_id', 'file_zacaz', 'file_brif', 'file_cvitanciy', 'date_registration');
            $crud->add_field('email', 'password', 'username', 'name', 'secondname', 'sex', 'bdate', 'tel',  'email_manager', 'email_bugalter', 'business_id', 'file_zacaz', 'file_brif', 'file_cvitanciy', 'date_registration');
            $crud->callback_after_insert('call_after_insert_userBusines');


            $crud->set_field_type('file_zacaz', array('file', 'uploads/file_zacaz', 'zacaz_', '', 'others'),'', 'multiple');
            $crud->set_field_type('file_brif', array('file', 'uploads/file_brif', 'brif_', '', 'others'),'', 'multiple');
            $crud->set_field_type('file_cvitanciy', array('file', 'uploads/file_cvitanciy', 'cvitanc_', '', 'others'),'', 'multiple');

            $crud->set_one_to_many('users_relation_zacaz', 'file_zacaz','path', 'user_id');
            $crud->set_one_to_many('users_relation_brif', 'file_brif','path', 'user_id');
            $crud->set_one_to_many('users_relation_kvitanciy', 'file_cvitanciy','path', 'user_id');

            //изминение пароля бизнеса
            $crud->callback_before_edit('call_befor_edit_userAdmin');

        } else {

            $crud->select_multiselect('id_role');
            $crud->set_one_to_many('roles_users', 'id_role','role_id', 'user_id');
            $crud->add_field('email', 'username', 'name', 'secondname', 'password', 'id_role');
            $crud->edit_fields('email', 'username', 'name', 'secondname', 'password', 'id_role');
            $crud->set_field_type('id_role', 'select', '', 'multiple', '', array('roles','description','id', array('id', 'NOT IN', array(5, 1))));
            $crud->callback_after_insert('call_after_insert_userAdmin');
            $crud->callback_before_edit('call_befor_edit_userAdmin');
            $crud->callback_after_edit('call_after_edit_userAdmin');
        }



        //метод подставляет значения в таблицу из другой таблицы по join
        /**
         * 'business_id' - поле текущей таблицы
         * 'business' - другая таблица из которой будем брать данные
         * 'name' - поле из которого будем брать
         * 'id' - поле по которому будем джойнить с 'business_id'
         */
        //$crud->show_name_old_table('id_role', 'roles', 'description', 'id');



        $crud->show_name_column(array(
            'email'=> 'Email',
            'username' => 'Логин',
            'name' => 'Имя',
            'secondname' => 'Фамилия',
            'sex' => 'Пол',
            'bdate' => 'Возраст',
            'tel' => 'Телефон',
            'city' => 'Город',
            'ip' => 'IP адрес',
            'photo' => 'Фото',
            'password' => 'Пароль',
            'id_role' => 'Группа',
            'business_id' => 'Бизнес',
            'file_zacaz' => 'Заказ',
            'file_brif' => 'Бриф',
            'file_cvitanciy' => 'Квитанции',
            'email_manager' => 'Email PR отдела',
            'email_bugalter' => 'Email бухгалтерия',
            'date_registration' => 'Дата регистрации'
            ));

        $crud->validation('email', array('required' => true, 'email' => true),
            array('required' => 'Это поле обязательно для заполнения', 'email' => 'Неверный формат'));

        $crud->validation('email_manager', array('email' => true),
            array('email' => 'Неверный формат'));

        $crud->validation('email_bugalter', array('email' => true),
            array('email' => 'Неверный формат'));

        $crud->validation('username', array('required' => true, 'minlength' => 3),
            array('required' => 'Это поле обязательно для заполнения', 'minlength' => 'Минимальное количество символов 3'));

        $crud->validation('password', array('required' => true, 'minlength' => 6),
            array('required' => 'Это поле обязательно для заполнения', 'minlength' => 'Минимальное количество символов 6'));

        $crud->callback_before_insert('call_bef_insert_user');

        $crud->callback_befor_show_edit('call_bef_show_user');
        $crud->callback_list_table('call_list_table_user');

        return $crud;
    }


    /**
     * @return Cruds
     * Банеры
     */
    public static function adminBanners ($get=null){

        $recurs_cat = Model::factory('CategoryModel')->recurs_catalog();

        $crud = new Cruds();
        $crud->load_table('banners', array('0', 'DESC'));

        if (Session::instance()->get('customer_id_baners') != null) {

            $crud->set_where('id', 'IN', Session::instance()->get('customer_id_baners'));

        }

        $crud->set_lang('ru');
        $crud->select_multiselect('category');
        $crud->select_multiselect('section');
        $crud->set_field_type('category', 'select', $recurs_cat, 'multiple', '');
        $crud->set_one_to_many('banners_relation', 'category', 'category_id', 'banners_id');

        $crud->set_field_type('section', 'select', '', 'multiple', '', array('category', 'name','id', array('parent_id','=','0')));
        $crud->set_one_to_many('banners_relation_section', 'section', 'section_id', 'banners_id');

        $crud->set_field_type('images', array('file', 'uploads/img_banners', 'baner_', '', 'img'),'','');
        $crud->set_field_type('position', 'select', array('1' => 'Верхний', '2' => 'Правый'), '', '', '');
        $crud->set_field_type('business_id', 'select', '', '', '', array('business', 'name','id'));

        $crud->set_field_type('city_banners', 'select', '', '', '', array('city', 'name','id', array('parent_id','<>','0')));

        $crud->set_field_type('type_baners', 'radio', array('1' => 'Картинка Верхний - 1136х240, Правый - 350х350', '2' => 'HTML банер Верхний фон 900х240, Правый 350х200'));

        $crud->show_columns('id', 'name', 'date_start', 'date_end', 'count_clik');


        $crud->edit_fields('name', 'section', 'category', 'city_banners', 'business_id', 'website', 'type_baners', 'images', 'position', 'text_banners', 'date_start', 'date_end');
        $crud->add_field('name','section', 'category', 'city_banners', 'business_id', 'website', 'type_baners', 'images', 'position',  'text_banners', 'date_start', 'date_end');

        $crud->rows_color_where(3, '<', date('Y-m-d'), ' #cccccc', 'date');


        $crud->toptip_fields(array('text_banners' => '50 символов'));


        $crud->show_name_column(array(
            'name'=> 'Название',
            'images' => 'Картинка',
            'section' => 'Раздел',
            'category' => 'Категории',
            'city_banners' => 'Город',
            'business_id' => 'Бизнес',
            'website' => 'Внешняя ссылка',
            'position' => 'Позиция',
            'type_baners' => 'Тип банера',
            'text_banners' => 'Текст банера',
            'date_start' => 'Дата старта',
            'date_end' => 'Дата конца',
            'count_clik' => 'Клики'
        ));


        $crud->validation('type_baners', array('required' => true),
            array('required' => 'Вам нужно сделать выбор'));

        $crud->validation('text_banners', array('maxlength' => 50),
            array('maxlength' => 'Не более 50 символов'));

        $crud->callback_before_delete('call_bef_del_banners');
        $crud->callback_after_insert('call_after_insert_banners');
        $crud->callback_before_edit('call_bef_edit_banners');
        $crud->callback_before_insert('call_bef_add_banners');

        $crud->callback_list_table('call_list_table_banners');

        $crud->callback_befor_show_edit('call_bef_show_edit_baners');

        return $crud;
    }





























    /**
     * hooks
     */

    public static function call_bef_show_edit_baners($key_array = null){

        $static = View::factory('adm/statistic_baners');

        if ($key_array['type_baners'] == 2) {
            $in =  unserialize($key_array['images']);
            $key_array['images'] = $in['images'];
        }

        $static->data = Rediset::getInstance()->get_baner_date($key_array['id'], $key_array['date_start'], $key_array['date_end']);
        Cruds::$adon_top_form[] = $static;


        $key_array['date_start'] = date('d/m/Y', strtotime($key_array['date_start']));
        $key_array['date_end'] = date('d/m/Y', strtotime($key_array['date_end']));

        return $key_array;
    }





    public static function call_bef_del_banners ($key_array = null){
        Model::factory('Adm')->log_add('банер', $key_array['name'], 'del');
        Rediset::getInstance()->del_baner($key_array['id']);
    }


    public static  function call_list_table_banners ($new_array){
        $new_array['date_start'] =  date('d/m/Y', strtotime($new_array['date_start']));
        $new_array['date_end'] =  date('d/m/Y', strtotime($new_array['date_end']));
        return $new_array;
    }


    public static function call_after_insert_banners($key_array = null){

        if (!empty($key_array['business_id'])) {
            Model::factory('BussinesModel')->setUpdateBussinesChange(array($key_array['business_id']));
        }

        Model::factory('Adm')->log_add('банер', $key_array['name'], 'add');
    }




    public static function call_bef_edit_banners ($key_array = null,  $old_array = null){


        if (!empty($key_array['business_id'])) {
            Model::factory('BussinesModel')->setUpdateBussinesChange(array($key_array['business_id']));
        }

        $key_array['date_start'] = Date::convert_Date($key_array['date_start']);
        $key_array['date_end'] = Date::convert_Date($key_array['date_end']);

        Model::factory('Adm')->log_add('банер', $key_array['name'], 'edit');

        if ($key_array['type_baners'] == 2) {

            if ($key_array['position'] == 1) {
                $baner = View::factory('blocks_includ/template_baner');
            } else {
                $baner = View::factory('blocks_includ/template_baner_right');
            }

            $data_business = DB::select()->from('business')->where('id', '=', $key_array['business_id'])->execute()->as_array();

            if (empty($key_array['images'])) {
                $in =  unserialize($old_array['images']);
                $key_array['images'] = $in['images'];
            }


            $data = $key_array;
            $data['logo'] = $data_business[0]['logo'];
            $baner->data = $data;
            $key_array['images'] = serialize(array('html' => htmlspecialchars($baner->render()), 'images' =>  $key_array['images']));

        }

        return $key_array;
    }




    public static function call_bef_add_banners($key_array = null) {

        $key_array['date_start'] = Date::convert_Date($key_array['date_start']);
        $key_array['date_end'] = Date::convert_Date($key_array['date_end']);


        if ($key_array['type_baners'] == 2) {

            if ($key_array['position'] == 1) {
                $baner = View::factory('blocks_includ/template_baner');
            } else {
                $baner = View::factory('blocks_includ/template_baner_right');
            }


            $data_business = DB::select()->from('business')->where('id', '=', $key_array['business_id'])->execute()->as_array();

            $data = $key_array;
            $data['logo'] = $data_business[0]['logo'];
            $baner->data = $data;
            $key_array['images'] = serialize(array('html' => htmlspecialchars($baner->render()), 'images' =>  $key_array['images']));

        }
        return $key_array;
    }




    public static function call_bef_edit_business ($new_array = null, $old_array = null) {


        //преобразование дат
        $new_array['date_create'] = Date::convert_Date($new_array['date_create']);
        $new_array['date_end'] = Date::convert_Date($new_array['date_end']);

        Model::factory('Adm')->log_add('бизнес', $old_array['name'], 'edit', $old_array['id']);

        //die(HTML::x($old_array));
        if (!empty($new_array['home_busines_foto'])) {
            $img = self::create_images($new_array['home_busines_foto'], '/uploads/img_business/thumbs/', 240, 158);

            //удаляем старые картинки
            if ($img === true and file_exists($_SERVER['DOCUMENT_ROOT'] . $old_array['home_busines_foto'])) {
                if (!empty($old_array['home_busines_foto'])) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $old_array['home_busines_foto']);
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/uploads/img_business/thumbs/' . basename($old_array['home_busines_foto']));
                }
            }
        }

        if (!empty(Cruds::$post['name_user']) and !empty(Cruds::$post['email_user'])
            and !empty(Cruds::$post['id'])) {
            Model::factory('Adm')->add_busines_user(Cruds::$post['name_user'],
                                                    Cruds::$post['nameses'],
                                                    Cruds::$post['secondname_user'],
                                                    Cruds::$post['email_user'],
                                                    Cruds::$post['telephone'],
                                                    Cruds::$post['email_manager'],
                                                    Cruds::$post['email_bugalter'],
                                                    Cruds::$post['password'],
                                                    Cruds::$post['id']);
        }
        //die(HTML::x(Cruds::$post));
        if (!empty(Cruds::$post['dop_sity']) and !empty(Cruds::$post['dop_addres'])) {

            foreach (Cruds::$post['dop_sity'] as $key => $dop_sity) {
                $arr_add_city[] = array('name' => $dop_sity,
                                        'address' => Cruds::$post['dop_addres'][$key],
                                        'tel_dop_adress' => Cruds::$post['tel_dop_adress'][$key],
                                        'dop_sheduler' => Cruds::$post['dop_sheduler'][$key],
                                        'maps_x' => Cruds::$post['maps_x'][$key],
                                        'maps_y' => Cruds::$post['maps_y'][$key]);
            }

            $arr_add_city = serialize($arr_add_city);

            $new_array['dop_address'] = $arr_add_city;
            return $new_array;
        } else {
            $new_array['dop_address'] = '';
            return $new_array;
        }

    }

    public static function call_bef_insert_business ($new_array){

        //преобразование дат
        $new_array['date_create'] = Date::convert_Date($new_array['date_create']);
        $new_array['date_end'] = Date::convert_Date($new_array['date_end']);

        if (!empty(Cruds::$post['dop_sity']) and !empty(Cruds::$post['dop_addres'])) {

            foreach (Cruds::$post['dop_sity'] as $key => $dop_sity) {
                $arr_add_city[] = array('name' => $dop_sity,
                                        'address' => Cruds::$post['dop_addres'][$key],
                                        'tel_dop_adress' => Cruds::$post['tel_dop_adress'][$key],
                                        'dop_sheduler' => Cruds::$post['dop_sheduler'][$key],
                                        'maps_x' => Cruds::$post['maps_x'][$key],
                                        'maps_y' => Cruds::$post['maps_y'][$key]);
            }
            $arr_add_city = serialize($arr_add_city);
            $new_array['dop_address'] = $arr_add_city;
        }
        return $new_array;

    }


    public static function call_list_table_bussines ($new_array){
        $new_array['date_end'] =  date('d/m/Y', strtotime($new_array['date_end']));
        $new_array['show_bussines'] = Rediset::getInstance()->get_business_all($new_array['id']);
        return $new_array;
    }


    public static function call_after_insert_business ($key_array = null) {

        if (!empty($key_array['home_busines_foto'])) {
            self::create_images($key_array['home_busines_foto'], '/uploads/img_business/thumbs/', 240, 158);
        }

        if (!empty(Cruds::$post['name_user']) and !empty(Cruds::$post['email_user'])
            and !empty($key_array['id']) and !empty(Cruds::$post['password'])) {

            Model::factory('Adm')->add_busines_user(Cruds::$post['name_user'],
                                                    Cruds::$post['nameses'],
                                                    Cruds::$post['secondname_user'],
                                                    Cruds::$post['email_user'],
                                                    Cruds::$post['telephone'],
                                                    Cruds::$post['email_manager'],
                                                    Cruds::$post['email_bugalter'],
                                                    Cruds::$post['password'],
                                                    $key_array['id']);
        }

        Model::factory('Adm')->log_add('бизнес', $key_array['name'], 'add');
    }


    //хук перед открытием страницы редактирования
    public static function call_bef_show_edit_bus ($new_array){

        //преобразование дат
        $new_array['date_create'] = date('d/m/Y', strtotime($new_array['date_create']));
        $new_array['date_end'] = date('d/m/Y', strtotime($new_array['date_end']));


        Session::instance()->set('busines_id_adon', $new_array['id']);

        //die(HTML::x($new_array));
        $query = DB::select('id', 'name')
            ->from('gallery')
            ->where('business_id', '=', $new_array['id'])
            ->cached()
            ->execute()->as_array();
        $cont = View::factory('adm/adon_links_galery_for_business');

        $cont->data = $query;
        Cruds::$adon_form[] = array('page' => 'tags', 'view' => $cont);


        //дополнительные адреса
        $city = View::factory('adm/adon_city_business');
        $city->list_sity = Model::factory('CategoryModel')->get_section('city', array('parent_id','<>','0'));
        try {
            $city->data = unserialize($new_array['dop_address']);
        } catch (Exception $x) {
            $city->data = null;
        }

        Cruds::$adon_form[] = array('page' => 'maps_cordinate_y', 'view' => $city);


        $static = View::factory('adm/statistic_business');
        $static->business_favorit = Rediset::getInstance()->get_business_favor($new_array['id']);
        $static->business_show = Rediset::getInstance()->get_business_all($new_array['id']);
        $static->bussines_subscribe = Model::factory('BaseModel')->table_count('subscription_relation_bussines', 'id', array('bussines_id','=', $new_array['id']));

        //получаем купоны бизнеса если они есть
        $coupon_business = Model::factory('CouponsModel')->getCouponsInBusinessId($new_array['id']);

        if (!empty($coupon_business)) {
            $count_coupon_show = null;
            foreach ($coupon_business as $row_coupon) {
                $count_coupon_show += Rediset::getInstance()->get_coupon_show($row_coupon['id']);
            }
            $static->coupons_show = $count_coupon_show;
        }

        $article_business = Model::factory('ArticlesModel')->getArticlesInBusinessId($new_array['id']);
        if (!empty($article_business)) {
            $article_count_show = null;
            foreach ($article_business as $row_article) {
                $article_count_show += Rediset::getInstance()->get_articles($row_article['id']);
            }
            $static->article_show = $article_count_show;
        }

        Cruds::$adon_top_form[] = $static;



        $log = View::factory('adm/log_business');
        $data = Model::factory('Adm')->get_log_business($new_array['id']);
        $log->data = $data;
        Cruds::$adon_top_form[] = $log;



        $user = View::factory('adm/form_add_user_business');
        $orm_user = ORM::factory('User')->where('business_id', '=', $new_array['id'])->find()->as_array();

        if (!empty($orm_user)) {
            $user->age = $orm_user['age'];
            $user->sex = $orm_user['sex'];
            $user->telephone = $orm_user['tel'];
            $user->email_manager = $orm_user['email_manager'];
            $user->email_bugalter = $orm_user['email_bugalter'];
            $user->name_user = $orm_user['username'];
            $user->nameses = $orm_user['name'];
            $user->secondname_user = $orm_user['secondname'];
            $user->email_user = $orm_user['email'];
        }

        Cruds::$adon_top_form[] = $user;

        //вивод связаных купонов с этим бизнесом
        $cont = View::factory('adm/adon_links_coupon_for_business');
        $coupons = Model::factory('CouponsModel')->getCouponsInBusinessId($new_array['id']);
        $cont->data = $coupons;

        Cruds::$adon_form[] = array('page' => 'tags', 'view' => $cont);

        //вывод связаных обзоров с этим бизнесом
        $cont = View::factory('adm/adon_links_articles_for_business');
        $articles = Model::factory('ArticlesModel')->getArticlesInBusinessId($new_array['id']);
        $cont->data = $articles;

        Cruds::$adon_form[] = array('page' => 'tags', 'view' => $cont);
        //die(HTML::x($articles));
        return $new_array;
    }


    public static  function call_list_table_coupons ($new_array){
        $new_array['dateoff'] =  date('d/m/Y', strtotime($new_array['dateoff']));
        return $new_array;
    }


    public static function call_bef_show_insert_bus ($new_array){

        $user = View::factory('adm/form_add_user_business');
        Cruds::$adon_top_form = $user;

        $city = View::factory('adm/adon_city_business');
        $city->list_sity = Model::factory('CategoryModel')->get_section('city', array('parent_id','<>','0'));
        $city->data = null;
        Cruds::$adon_form[] = array('page' => 'maps_cordinate_y', 'view' => $city);
    }


    public static function call_befor_del_business ($new_array){
        Model::factory('Adm')->log_add('бизнес', $new_array['name'], 'del', $new_array['id']);
        $user = DB::delete('users')->where('business_id', '=', $new_array['id'])->execute();
        Rediset::getInstance()->del_business_favor($new_array['id']);
        Rediset::getInstance()->del_business($new_array['id']);
    }


    //articles

    public static function call_bef_insert_articles ($new_array){
        $new_array['datecreate'] = Date::convert_Date($new_array['datecreate']);
        return $new_array;
    }


    public static function call_bef_show_edit_articles ($new_array){

        //преобразование дат
        $new_array['datecreate'] = date('d/m/Y', strtotime($new_array['datecreate']));
        return $new_array;
    }


    public static function call_bef_edit_articles ($new_array = null, $old_array = null){


        if (!empty($new_array['bussines_id'])) {
            Model::factory('BussinesModel')->setUpdateBussinesChange($new_array['bussines_id']);
        }


        //преобразование дат
        $new_array['datecreate'] = Date::convert_Date($new_array['datecreate']);

        Model::factory('Adm')->log_add('статью', $old_array['name'], 'edit');

        if (!empty($new_array['images_article'])) {
            $img = self::create_images($new_array['images_article'], '/uploads/img_articles/thumbs/', 260, 190);
            //die(HTML::x($old_array['images_article']));
            //удаляем старые картинки
            if ($img === true and file_exists($_SERVER['DOCUMENT_ROOT'] . $old_array['images_article'])) {
                //todo не работает удаление на продакшене
                //unlink($_SERVER['DOCUMENT_ROOT'] . $old_array['images_article']);
               // unlink($_SERVER['DOCUMENT_ROOT'] . '/uploads/img_articles/thumbs/' . basename($old_array['images_article']));
            }
        }

        return $new_array;

    }

    public static function call_after_insert_articles ($key_array = null){

        //меняем статус бизнеса
        if (!empty(Cruds::$post['bussines_id'])) {
            Model::factory('BussinesModel')->setUpdateBussinesChange(Cruds::$post['bussines_id']);
        }

        Model::factory('Adm')->log_add('статью', $key_array['name'], 'add');

        if (!empty($key_array['images_article'])) {
            self::create_images($key_array['images_article'], '/uploads/img_articles/thumbs/', 260, 190);
        }
    }

    public static function call_bef_del_articles ($key_array = null){
        Model::factory('Adm')->log_add('статью', $key_array['name'], 'del');
        Rediset::getInstance()->del_articles($key_array['id']);
    }


    public static function call_after_insert_news ($key_array) {

        if (!empty($key_array['bussines_id'])) {
            Model::factory('BussinesModel')->setUpdateBussinesChange(array($key_array['bussines_id']));
        }

        if (!empty($key_array['img'])) {
            self::create_images($key_array['img'], '/uploads/img_news/thumbs/', 260, 190);
        }
    }

    public static function call_list_table_news ($new_array){

        $new_array['date'] =  date('d/m/Y', strtotime($new_array['date']));
        return $new_array;
    }

    public static function call_bef_show_edit_news ($new_array) {

        $new_array['date'] = date('d/m/Y', strtotime($new_array['date']));
        return $new_array;
    }

    public static function call_bef_insert_news ($new_array) {
        $new_array['date'] = Date::convert_Date($new_array['date']);
        return $new_array;
    }

    public static function call_bef_edit_news ($new_array) {

        if (!empty($new_array['bussines_id'])) {
            Model::factory('BussinesModel')->setUpdateBussinesChange(array($new_array['bussines_id']));
        }

        $new_array['date'] = Date::convert_Date($new_array['date']);
        return $new_array;
    }




    //coupons

    public static function call_bef_edit_coupons ($new_array = null, $old_array = null){


        if (!empty($new_array['business_id'])) {
            Model::factory('BussinesModel')->setUpdateBussinesChange(array($new_array['business_id']));
        }

        $new_array['datecreate'] = Date::convert_Date($new_array['datecreate']);
        $new_array['datestart'] = Date::convert_Date($new_array['datestart']);
        $new_array['dateoff'] = Date::convert_Date($new_array['dateoff']);

        Model::factory('Adm')->log_add('купон', $old_array['name'], 'edit');

        if (!empty($new_array['img_coupon'])) {
            $img = self::create_images($new_array['img_coupon'], '/uploads/img_coupons/thumbs/', 234, 196);
            //удаляем старые картинки
            if ($img === true and file_exists($_SERVER['DOCUMENT_ROOT'] . $old_array['img_coupon'])) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $old_array['img_coupon']);
                unlink($_SERVER['DOCUMENT_ROOT'] . '/uploads/img_coupons/thumbs/' . basename($old_array['img_coupon']));
            }
        }
        return $new_array;
    }

    public static function call_bef_insert_coupons ($new_array){
        $new_array['datecreate'] = Date::convert_Date($new_array['datecreate']);
        $new_array['datestart'] = Date::convert_Date($new_array['datestart']);
        $new_array['dateoff'] = Date::convert_Date($new_array['dateoff']);
        return $new_array;
    }

    public static function call_bef_show_edit_coupons ($new_array){
        $new_array['datecreate'] = date('d/m/Y', strtotime($new_array['datecreate']));
        $new_array['datestart'] = date('d/m/Y', strtotime($new_array['datestart']));
        $new_array['dateoff'] = date('d/m/Y', strtotime($new_array['dateoff']));

        return $new_array;
    }



    public static function call_after_insert_coupons ($key_array = null){

        if (!empty($key_array['business_id'])) {
            Model::factory('BussinesModel')->setUpdateBussinesChange(array($key_array['business_id']));
        }

        Model::factory('Adm')->log_add('купон', $key_array['name'], 'add');

        if (!empty($key_array['img_coupon'])) {
            self::create_images($key_array['img_coupon'], '/uploads/img_coupons/thumbs/', 234, 196);
        }
    }

    public static function call_befor_del_coupons($key_array = null){
        Model::factory('Adm')->log_add('купон', $key_array['name'], 'del');
        Rediset::getInstance()->del_coupon($key_array['id']);
        Rediset::getInstance()->del_coupon_show($key_array['id']);
    }



    public static function call_bef_edit_show_galery ($new_array){
        $data = View::factory('adm/adon_form');
        $data->list = Model::factory('Adm')->get_table('files', array('gallery', '=', $new_array['id']));
        Cruds::$adon_form[] = array('page' => 'galery_text', 'view' => $data);
    }

    public static function call_bef_insert_show_galery ($new_array){
        Cruds::$adon_form[] =  array('page' => 'galery_text', 'view' => View::factory('adm/adon_form'));
    }






    //реализация добавления удаления редактирования фото в галереи в форме редактирования
    public static function call_bef_edit_galery ($new_array = null, $old_array = null){


        if (!empty($new_array['bussines_id'])) {
            Model::factory('BussinesModel')->setUpdateBussinesChange(array($new_array['business_id']));
        }

        //определяем отностельные и абсолютные пути
        $thumbs = '/uploads/img_galery/thumbs/';
        $img_galery = '/uploads/img_galery/';
        $img_galery_original = '/uploads/img_galery_original/';
        $file_path_thumbs = $_SERVER['DOCUMENT_ROOT'] . $thumbs;
        //$file_path = $_SERVER['DOCUMENT_ROOT'] . $img_galery;
        $file_path = $_SERVER['DOCUMENT_ROOT'] . $img_galery_original;

        //получаем первоначальный список картинок
        $file_start = Model::factory('Adm')->get_table('files', array('gallery', '=', Cruds::$post['id']));
        //формируем масив для сравнения
        $file_result_filename = array();
        $file_result_title = array();
        foreach ($file_start as $key => $row_value) {
            $file_result_filename[$row_value['id']] = $row_value['filename'];
            $file_result_title[$row_value['id']] = $row_value['title'];
        }

       // HTML::x($file_result_filename);


        if (!empty(Cruds::$post['filename'])) {
            //вычисляем расхождение масивов для удаление
            $diferen = array_diff($file_result_filename, Cruds::$post['filename']);
        } else {
            $diferen = $file_result_filename;
        }
        //если не пустой значит некоторые картинки были удалены
        if (!empty($diferen)) {
            foreach ($diferen as $key =>$dif) {
                $del[] = $key;
                self::unlink_file($dif, $thumbs);
            }
            //удаляем
            Model::factory('Adm')->delete_galery($del);
        }

        if (!empty(Cruds::$post['filename'])) {
            //редактирование картинки
            foreach (Cruds::$post['filename'] as $key => $rows_filename) {
                //редактирование картинки
                if (!empty(Cruds::$files['filename']['tmp_name'][$key])) {
                    //формируем имя файла с раширением
                    $type_file = '.' . strtolower(pathinfo(Cruds::$files['filename']['name'][$key], PATHINFO_EXTENSION));
                    $name_file = uniqid() . $type_file;

                    Model::factory('Adm')->update_galery($img_galery . $name_file, Cruds::$post['title'][$key], $key);
                    self::save_img(Cruds::$files['filename']['tmp_name'][$key], $name_file, $file_path);

                    $img = self::create_images($img_galery_original . $name_file, $thumbs, 300, 196);
                    $img2 = self::create_images($img_galery_original . $name_file, $img_galery, 475, 350);
                    //удаление старых катинок
                    self::unlink_file($rows_filename, $thumbs);

                }
            }
        }


        //новые добавления картинок
        foreach (Cruds::$files['filename']['tmp_name'] as $key => $tmp_name) {

            if (empty(Cruds::$post['filename'][$key])) {
                $type_file = '.'. strtolower(pathinfo(Cruds::$files['filename']['name'][$key], PATHINFO_EXTENSION));
                $name_file = uniqid().$type_file;

                Model::factory('Adm')->insert_galery($img_galery.$name_file, Cruds::$post['title'][$key], Cruds::$post['id']);
                self::save_img($tmp_name, $name_file, $file_path);
                $img = self::create_images($img_galery_original.$name_file, $thumbs, 300, 196);
                $img2 = self::create_images($img_galery_original.$name_file, $img_galery, 475, 350);
            }

        }

        //вычисляем расхождение масивов для редактирования существующих title
        $diferen_title = array_diff(Cruds::$post['title'], $file_result_title);

        foreach ($diferen_title as $key => $edit_title) {
            if (!empty(Cruds::$post['filename'][$key])) {
                Model::factory('Adm')->update_galery(null, Cruds::$post['title'][$key], $key);
            }
        }


        Model::factory('Adm')->log_add('галерею', $old_array['name'].'ID '.$old_array['id'], 'edit');

    }

    public static function call_after_insert_galery ($key_array = null){


        if (!empty($new_array['bussines_id'])) {
            Model::factory('BussinesModel')->setUpdateBussinesChange(array($new_array['business_id']));
        }

        //определяем отностельные и абсолютные пути
        $thumbs = '/uploads/img_galery/thumbs/';
        $img_galery = '/uploads/img_galery/';
        $img_galery_original = '/uploads/img_galery_original/';

        $file_path_thumbs = $_SERVER['DOCUMENT_ROOT'] . $thumbs;
        //$file_path = $_SERVER['DOCUMENT_ROOT'] . $img_galery;
        $file_path = $_SERVER['DOCUMENT_ROOT'] . $img_galery_original;


        //новые добавления картинок
        foreach (Cruds::$files['filename']['tmp_name'] as $key => $tmp_name) {

            $type_file = '.'. strtolower(pathinfo(Cruds::$files['filename']['name'][$key], PATHINFO_EXTENSION));
            $name_file = uniqid().$type_file;

            Model::factory('Adm')->insert_galery($img_galery.$name_file, Cruds::$post['title'][$key], $key_array['id']);
            self::save_img($tmp_name, $name_file, $file_path);
            $img = self::create_images($img_galery_original.$name_file, $thumbs, 300, 196);
            $img2 = self::create_images($img_galery_original.$name_file, $img_galery, 475, 350);

        }

        Model::factory('Adm')->log_add('галерею', $key_array['name'].'ID '.$key_array['id'], 'add');

    }


    public static function call_bef_delete_galery ($key_array = null){
        Model::factory('Adm')->log_add('галерею', $key_array['name'].'ID '.$key_array['id'], 'del');
    }


    //добавление пользователя из админки
    public static function call_bef_insert_user ($new_array = null){

        $new_array['bdate'] = Date::convert_Date($new_array['bdate']);
        //если не пустой значит добавляется бизнес пользователь
        $new_array['password'] = Auth::instance()->hash($new_array['password']);
        return $new_array;
    }


    public static function call_bef_edit_user ($new_array, $old_array){

        if (!empty($new_array['bdate'])) {
            $new_array['bdate'] = Date::convert_Date($new_array['bdate']);
        }
        return $new_array;
    }

    //срабатывает только при добавлении бизнес пользователей
    public static function call_after_insert_userBusines ($new_array){
        //die(HTML::x($new_array));
        DB::update('users')->set(array('id_role' => 5))->where('id', '=', $new_array['id'])->execute();
        DB::insert('roles_users', array('user_id', 'role_id'))->values(array($new_array['id'], 1))->execute();
        DB::insert('roles_users', array('user_id', 'role_id'))->values(array($new_array['id'], 5))->execute();

    }


    public static function call_befor_edit_userAdmin ($new_array = null, $old_array = null){


        if (!empty($new_array['bdate'])) {
            $new_array['bdate'] = Date::convert_Date($new_array['bdate']);
        }
        if ($old_array['password'] != $new_array['password']) {
            $new_array['password'] = Auth::instance()->hash($new_array['password']);
        }

        return $new_array;
    }

    public static function call_after_edit_userAdmin ($new_array = null, $old_array = null){
        DB::insert('roles_users', array('user_id', 'role_id'))->values(array($new_array['id'], 1))->execute();
    }

    //срабатывает при добавлении сотрудников и добвляет группу 1
    public static function call_after_insert_userAdmin ($new_array){
        DB::insert('roles_users', array('user_id', 'role_id'))->values(array($new_array['id'], 1))->execute();
    }


    public static function StatusBusiness ($key_array = null) {
        //die(HTML::x($key_array));
        if ($key_array['status'] == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $query = DB::update('business')->set(array('status' => $status))->where('id', '=', $key_array['id'])->execute();
    }

    public static function StatusSubscribers ($key_array = null) {
        //die(HTML::x($key_array));
        if ($key_array[0]['action'] == 1) {
            //die(HTML::x($key_array));
            $status = 0;
        } else {
            $status = 1;
        }
        $query = DB::update('subscription')->set(array('action' => $status))->where('id', '=', $key_array[0]['id'])->execute();
    }


    public static function call_bef_show_edit_users($new_array)
    {

        $data = View::factory('adm/statistic_user');
        $data->data = Model::factory('Adm')->getFaforitUser($new_array['id']);
        $user = Model::factory('Adm')->getUserId($new_array['id']);
        $data->last_login = date('d-m-Y', strftime($user->last_login));
        Cruds::$adon_form[] = array('page' => 'date_registration', 'view' => $data);
    }


    public static  function call_bef_show_edit_lotery ($new_array){

        $new_array['date_start'] = date('d/m/Y', strtotime($new_array['date_start']));
        $new_array['date_end'] = date('d/m/Y', strtotime($new_array['date_end']));

        Session::instance()->set('customer_id', 1);
        $cont = View::factory('adm/adon_links_user_for_lotery');
        $data = Model::factory('LotareyModel')->getUserLotarey(null, array('lotarey.id', '=', $new_array['id']));
        if (!empty($data)) {
            $cont->data = $data;
            Cruds::$adon_top_form[] = $cont;
        }

        return $new_array;
    }

    public static  function call_list_table_lotery ($new_array){
        $new_array['date_start'] =  date('d/m/Y', strtotime($new_array['date_start']));
        $new_array['date_end'] =  date('d/m/Y', strtotime($new_array['date_end']));

        foreach (self::$lotery_users_prizer as $rows) {
            if ($rows['loteryId'] == $new_array['id']) {

                //если пользователь зарегестированый то на email вешаем ссылку
                if (!empty($rows['usersEmail'])) {
                    $new_array['dop_field_lotery_user'] = '<a href="/admin/edit?obj=YToyOntzOjU6InRhYmxlIjtzOjU6InVzZXJzIjtzOjI0OiJjYWxsYmFja19mdW5jdGlvbnNfYXJyYXkiO2E6Mzp7czo4OiJmdW5jdGlvbiI7czoxMDoiYWRtaW5Vc2VycyI7czo1OiJjbGFzcyI7czoyNDoiQ29udHJvbGxlcl9BZG1pbmlzdHJhdG9yIjtzOjIyOiJjYWxsYmFja19mdW5jdGlvbl9uYW1lIjtzOjEwOiJsb2FkX3RhYmxlIjt9fQ%3D%3D&id='.$rows['usersId'].'">'.$rows['usersEmail'].'</a>';
                } else {
                    $new_array['dop_field_lotery_user'] = $rows['subscriptionEmail'];
                }

            }
        }

        return $new_array;
    }

    public static function  call_bef_insert_lotery ($new_array){

        $new_array['date_start'] = Date::convert_Date($new_array['date_start']);
        $new_array['date_end'] = Date::convert_Date($new_array['date_end']);

        return $new_array;
    }

    public static function  call_bef_edit_lotery ($new_array, $old_array){

        if (!empty($new_array['date_start']) AND !empty($new_array['date_end'])) {
            $new_array['date_start'] = Date::convert_Date($new_array['date_start']);
            $new_array['date_end'] = Date::convert_Date($new_array['date_end']);
        }

        return $new_array;
    }


    public static function  call_bef_show_edit_jornal ($new_array){

        $new_array['date'] = date('d/m/Y', strtotime($new_array['date']));
        return $new_array;
    }

    public static  function call_list_table_jornal ($new_array){
        $new_array['date'] =  date('d/m/Y', strtotime($new_array['date']));
        return $new_array;
    }

    public static function call_bef_insert_jornal ($new_array){

        $new_array['date'] = Date::convert_Date($new_array['date']);
        return $new_array;
    }

    public static function call_bef_edit_jornal ($new_array){

        $new_array['date'] = Date::convert_Date($new_array['date']);
        return $new_array;
    }


    public static  function call_list_table_user ($new_array){
        $new_array['date_registration'] =  date('d/m/Y H:m:s', strtotime($new_array['date_registration']));
        return $new_array;
    }

    public static function call_bef_show_user($new_array){

        if (!empty($new_array['bdate'])) {
            $new_array['bdate'] = date('d/m/Y', strtotime($new_array['bdate']));
        }

        $cont = View::factory('adm/adon_lotery_for_users');
        $data = Model::factory('LotareyModel')->getUserLotarey(null, array('users.id', '=', $new_array['id']));
        if (!empty($data)) {
            $cont->data = $data;
            Cruds::$adon_top_form[] = $cont;
        }

        return $new_array;
    }


    public static  function call_list_table_subscription ($new_array){
        $new_array['date'] =  date('d/m/Y H:m:s', strtotime($new_array['date']));

        switch ($new_array['all_subscribe']) {
            case 1:
                $new_array['all_subscribe'] = '[все]';
                break;
            case 0:
                $new_array['all_subscribe'] = '[биз]';
                break;
            case 2:
                $new_array['all_subscribe'] = '[все][биз]';
                break;
        }

        return $new_array;
    }

    public static  function call_list_table_contact ($new_array){
        $new_array['date_create'] =  date('d/m/Y H:m:s', strtotime($new_array['date_create']));
        return $new_array;
    }























    /**
     * medods
     */
    /**
     * @param $img_src
     * @param $upload_src
     * @param $w
     * @param $h
     * @param int $flag
     * @throws Kohana_Exception
     * метод для создания превюшек
     */
    public static function create_images ($img_src, $upload_src, $w, $h, $flag = 100){
        if (!empty($img_src)) {
            $image = Image::factory('.' . $img_src);
            $image->resize($w, $h, Image::AUTO);
            $image->save('.'.$upload_src . basename($img_src), $flag);
            return true;
        } else {
            return false;
        }
    }

    //функция загрузки кртинки на сервер
    private static function save_img ($tmp_file, $name_file, $file_path)
    {
        if (is_uploaded_file($tmp_file)) {
            // проверяется перемещение файла
            // в файловую систему хостинга
            if (move_uploaded_file($tmp_file, $file_path.$name_file)) {
               return true;
            } else {
                return false;
            }
        }
    }


    private static function unlink_file ($old_array, $path_thumbs){
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $old_array)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $old_array);
            unlink($_SERVER['DOCUMENT_ROOT'] . $path_thumbs . basename($old_array));
        }
    }


}