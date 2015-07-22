<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.06.2015
 * Time: 17:20
 */

class Controller_Administrator extends Controller {

    public $adm;
    public $logged_in;
    public static $ter;

    public function before (){
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

        $this->logged_in = Auth::instance()->logged_in('admin');

        $this->adm = View::factory('/adm/auth_admin');


        if ($this->logged_in === false) {
            $this->response->body($this->adm);
        }

    }


    public function after () {

        if ($this->logged_in === false) {
            $this->response->body($this->adm);
        }

    }

    public function action_login () {


        $post = $this->request->post();

        if(!empty($post['login']) && !empty($post['password'])) {

            $status = Auth::instance()->login($post['login'], $post['password']);

            if ($status) {

                $this->redirect('/administrator');
            } else {
                $this->response->body($this->adm);
            }

        } else {
            $this->response->body($this->adm);
        }
        $this->logged_in = Auth::instance()->logged_in('admin');

    }

    public function action_logout () {
        Auth::instance()->logout();
        $this->redirect('/administrator');
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
        Controller_Core_Main::$title_page = 'Категории';
        $this->response->body(self::adminCategory()->render());
    }

    public function action_tags (){
        Controller_Core_Main::$title_page = 'Теги Глобальные разделы';
        $this->response->body(self::adminTags()->render());
    }

    public function action_lotarey (){
        Controller_Core_Main::$title_page = 'Розыграши';
        $this->response->body(self::adminLotarey()->render());
    }


    public function action_bussines (){


       // die(HTML::x('sdf'));
        $category = Model::factory('CategoryModel')->recurs_catalog($this->request->param('id'));
        $arrChild = array();
        foreach ($category[0]['childs'] as $row_cat) {
            $arrChild[] = $row_cat['id'];
        }

        $busssines = Model::factory('CategoryModel')->businesscategory($arrChild);

        //die(HTML::x($busssines));

        Session::instance()->set('customer_id', $busssines);
        Controller_Core_Main::$title_page = 'Бизнесы';
        $this->response->body(self::adminBussines()->render());

    }


    public function action_articles (){

        Session::instance()->set('customer_id', $this->request->param('id'));
        Controller_Core_Main::$title_page = 'Обзоры';
        $this->response->body(self::adminArticles()->render());
    }

    public function action_coupons (){

        Controller_Core_Main::$title_page = 'Купоны';
        $this->response->body(self::adminCoupons()->render());
    }


    public function action_galery (){

        Controller_Core_Main::$title_page = 'Галереи';
        $this->response->body(self::adminGalery()->render());
    }

    public function action_contacts (){
        Controller_Core_Main::$title_page = 'Контакты';
        $this->response->body(self::adminContacts()->render());
    }


    public function action_users (){
        Controller_Core_Main::$title_page = 'Пользователи';
        $this->response->body(self::adminUsers()->render());
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
        $crud->edit_fields('text');
        $crud->show_name_column(array('text' => 'Описание'));
        return $crud;
    }

    public static function adminSections (){
        $crud = new Cruds();
        $crud->load_table('category');
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
        $crud->load_table('category');
        $crud->set_lang('ru');
        $crud->disable_search();
        $crud->disable_editor('description');
        $crud->disable_editor('keywords');
        $crud->show_columns('id', 'name', 'url');
        $crud->edit_fields('name', 'url', 'parent_id', 'title', 'description', 'keywords');
        $crud->add_field('name', 'url', 'parent_id', 'title', 'description', 'keywords');
        $crud->set_field_type('parent_id', 'select', array('y' => 'Да', 'n' => 'Нет'), '', '', array('category', 'name','id', array('parent_id','=', '0')));
        $crud->set_where('parent_id', '<>', 0);
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
        $crud->load_table('tags');
        $crud->set_lang('ru');
        $crud->disable_search();
        $crud->show_name_column(array('name_tags' => 'Название',
            'url_tags' => 'URL'));
        return $crud;
    }


    public static function adminLotarey (){

        $crud = new Cruds();
        $crud->load_table('lotarey');
        $crud->set_lang('ru');
        $crud->set_field_type('status', 'radio', array('1' => 'Ожидает', '2' => 'Идет', '3' => 'Завершен'));
        $crud->set_field_type('business_id', 'select', '', '', '', array('business', 'name','id'));
        $crud->set_field_type('img', array('file', 'uploads/img_lotarey', 'lot_', '', 'img'),'', '');
        $crud->show_columns('id', 'name', 'date_start', 'date_end');
        $crud->show_name_column(array('name' => 'Название',
            'secondname' => 'Заголовок',
            'description' => 'Описание',
            'img' => 'Картинка',
            'business_id'=> 'Бизнес',
            'date_start'=> 'Дата начала',
            'date_end' => 'Дата конца',
            'status' => 'Статус'));
        $crud->disable_search();
        return $crud;
    }
    

    /**
     * @return Cruds
     * Форма бизнесов
     */
    public static function adminBussines (){

        $crud = new Cruds();
        $crud->load_table('business');
        $crud->set_lang('ru');
        $crud->set_where('id','IN', Session::instance()->get('customer_id'));
        $crud->disable_editor('description');
        $crud->disable_editor('keywords');
        $crud->disable_editor('address');
        $crud->disable_editor('services');

        $crud->toptip_fields(array('address' => 'Если адресов несколько то каждый новы аресс пишется с новой строки. Сначала пишется город потом знак | и адрес',
                                'services' => 'Каждая услуга пишется с новой строки.'));

        $crud->disable_editor('title');
        $crud->select_multiselect('cat_id');
        $crud->show_columns('id', 'name', 'url');
        $crud->set_field_type('city', 'select', '', '', '', array('city', 'name','id', array('parent_id','<>','0')));
        $crud->set_field_type('cat_id', 'select', '', 'multiple', '', array('category', 'name','id', array('parent_id','<>','0')));
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
        $status['position'][1] = array('class' =>'btn-success', 'text' => 'ON');;

        $crud->add_action('StatusBusiness', 'ON', 'ban/actionAdd', '', $status);

        $crud->edit_fields('name', 'title',
            'description',
            'keywords',
            'city',
            'address',
            'services',
            'website',
            'video',
            'home_busines_foto',
            'top_slider',
            'file_meny',
            'info',
            'logo',
            'url',
            'cat_id',
            'date_create', 'date_end', 'tags');

        $crud->add_field('name', 'title',
            'description',
            'keywords',
            'city',
            'address',
            'services',
            'website',
            'video',
            'home_busines_foto',
            'top_slider',
            'file_meny',
            'info',
            'logo',
            'url',  'cat_id', 'date_create', 'date_end', 'tags');

        $crud->show_name_column(array('name' => 'Название',
            'url' => 'URL',
            'description' => 'SEO Description',
            'title' => 'SEO Title',
            'keywords' => 'SEO Keywords',
            'city' => 'Город',
            'address' => 'Адреса',
            'services' => 'Приемущества и услуги',
            'website' => 'Веб сайт бизнеса',
            'video' => 'Видео',
            'home_busines_foto' => 'Главное фото бизнеса',
            'top_slider' => 'Верхний слайдер',
            'file_meny' => 'Файл меню',
            'info' => 'Описание',
            'logo' => 'Логотип',
            'cat_id' => 'Категория',
            'date_create' => 'Дата создания',
            'date_end' => 'Дата окончания',
            'tags' => 'Теги',
            'status' => 'Статус'

            ));

        $crud->validation('url', array('required' => true, 'minlength' => 4, 'regexp' => '^[a-zA-Z0-9_]+$'),
            array('minlength' => 'URL должен быть минимум 4 символа',
                'required' => 'Это поле обязательно для заполнения',
                'regexp' => 'Url может состоять только из латинских букв, цифр и знака подчеркивания'));



        $crud->validation('name', array('required' => true),
            array('required' => 'Это поле обязательно для заполнения'));

        $crud->validation('top_slider', array('required' => true),
            array('required' => 'Это поле обязательно для заполнения'));


        $crud->callback_before_edit('call_bef_edit_business');
        $crud->callback_after_insert('call_after_insert_business');
        $crud->callback_befor_show_edit('call_bef_show_edit_bus');

        return $crud;
    }


    /**
     * @return Cruds
     * Обзоры
     */
    public static function adminArticles (){

        $crud = new Cruds();
        $crud->load_table('articles');
        $crud->set_where('id_section','=', Session::instance()->get('customer_id'));
        $crud->disable_editor('description');
        $crud->disable_editor('keywords');
        $crud->set_lang('ru');
        $crud->show_columns('id', 'name', 'url');
        $crud->set_field_type('in_home', 'checkbox', '', '', '','');
        $crud->set_field_type('city', 'select', '', '', '', array('city', 'name','id', array('parent_id','<>','0')));
        $crud->set_field_type('id_section', 'select', '', '', '', array('category', 'name','id', array('parent_id','=','0')));
        $crud->set_field_type('id_category', 'select', '', '', '', array('category', 'name','id', array('parent_id','<>','0')));
        $crud->set_field_type('bussines_id', 'select', '', 'multiple', '', array('business', 'name','id'));
        $crud->set_field_type('coupon', 'select', '', 'multiple', '', array('coupon', 'name','id'));

        $crud->select_multiselect('coupon');
        $crud->set_one_to_many('articles_relation_coupon', 'coupon', 'id_coupon', 'id_articles');

        $crud->select_multiselect('bussines_id');
        $crud->set_one_to_many('articles_relation_business', 'bussines_id', 'id_business', 'id_articles');

        $crud->set_field_type('images_article', array('file', 'uploads/img_articles', 'artic_', '', 'img'),'', '');

        $crud->validation('url', array('required' => true, 'minlength' => 4, 'regexp' => '^[a-zA-Z0-9_]+$'),
            array('minlength' => 'URL должен быть минимум 4 символа',
                'required' => 'Это поле обязательно для заполнения',
                'regexp' => 'Url может состоять только из латинских букв, цифр и знака подчеркивания'));

        $crud->validation('name', array('required' => true),
            array('required' => 'Это поле обязательно для заполнения'));

        $crud->edit_fields('name',
            'images_article',
            'content',
            'url',
            'id_section',
            'id_category',
            'bussines_id',
            'city',
            'coupon',
            'title',
            'description',
            'keywords',
            'tags',
            'datecreate',
            'in_home'

        );

        $crud->add_field('name',
            'images_article',
            'content',
            'url',
            'id_section',
            'id_category',
            'bussines_id',
            'city',
            'coupon',
            'title',
            'description',
            'keywords',
            'tags',
            'datecreate',
            'in_home'

        );

        $crud->show_name_column(array('name' => 'Название',
            'url' => 'URL',
            'description' => 'SEO Description',
            'title' => 'SEO Title',
            'keywords' => 'SEO Keywords',
            'city' => 'Город',
            'id_section' => 'Раздел',
            'coupon' => 'Купон',
            'content' => 'Описание',
            'images_article' => 'Главное фото',
            'bussines_id' => 'Бизнес',
            'id_category' => 'Категория',
            'tags' => 'Теги',
            'datecreate' => 'Дата создания',
            'in_home' => 'На главной'

        ));

        $crud->callback_before_edit('call_bef_edit_articles');
        $crud->callback_after_insert('call_after_insert_articles');

        return $crud;
    }


    /**
     * @return Cruds
     * купоны
     */
    public static function adminCoupons (){

        $crud = new Cruds();
        $crud->load_table('coupon');
        $crud->set_lang('ru');
        $crud->show_columns('id', 'name', 'business_id');
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

        //метод подставляет значения в таблицу из другой таблицы по join
        /**
         * 'business_id' - поле текущей таблицы
         * 'business' - другая таблица из которой будем брать данные
         * 'name' - поле из которого будем брать
         * 'id' - поле по которому будем джойнить с 'business_id'
         */
        $crud->show_name_old_table('business_id', 'business', 'name', 'id');

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
            'info' => 'Описание',
            'url' => 'URL',
            'img_coupon' => 'Фото купона',
            'id_section' => 'Раздел',
            'business_id' => 'Бизнес',
            'city' => 'Город',
            'datecreate' => 'Дата создания',
            'datestart' => 'Дата начала',
            'dateoff' => 'Дата конца',
            'tags' => 'Теги'
        ));

        $crud->callback_before_edit('call_bef_edit_coupons');
        $crud->callback_after_insert('call_after_insert_coupons');

        return $crud;
    }

    /**
     * @return Cruds
     * галерея
     */
    public static function adminGalery (){
        $crud = new Cruds();
        $crud->load_table('gallery');
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
        return $crud;
    }


    public static function adminContacts (){
        $crud = new Cruds();
        $crud->load_table('contacts');
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
            'description' => 'Сообщение'));


        return $crud;
    }


    public static function adminUsers (){
        $crud = new Cruds();
        $crud->load_table('users');
        $crud->set_lang('ru');
        $crud->set_field_type('id_role', 'select', '', 'multiple', '', array('roles','description','id'));
        $crud->set_field_type('password', 'password');
        $crud->set_field_type('email', 'email');

        $crud->show_columns('id', 'email', 'username');
        $crud->select_multiselect('id_role');
        $crud->set_one_to_many('roles_users', 'id_role','role_id', 'user_id');

        $crud->add_field('email', 'username', 'password', 'id_role');

        $crud->edit_fields('email', 'username', 'id_role');

        $crud->show_name_column(array(
            'email'=> 'Email',
            'username' => 'Имя',
            'id_role' => 'Группа'
            ));

        $crud->validation('email', array('required' => true, 'email' => true),
            array('required' => 'Это поле обязательно для заполнения', 'email' => 'Неверный формат'));

        $crud->validation('username', array('required' => true, 'minlength' => 3),
            array('required' => 'Это поле обязательно для заполнения', 'minlength' => 'Минимальное количество символов 3'));

        $crud->validation('password', array('required' => true, 'maxlength' => 16, 'minlength' => 6),
            array('required' => 'Это поле обязательно для заполнения', 'maxlength' => 'Максимальная длина пароля 16 символов', 'minlength' => 'Минимальное количество символов 6'));

        $crud->callback_before_insert('call_bef_insert_user');

        return $crud;
    }



























    /**
     * hooks
     */


    public static function call_bef_edit_business ($new_array = null, $old_array = null) {

        //die(HTML::x($old_array));
        if (!empty($new_array['home_busines_foto'])) {
            $img = self::create_images($new_array['home_busines_foto'], '/uploads/img_business/thumbs/', 370, 237);

            //удаляем старые картинки
            if ($img === true and file_exists($_SERVER['DOCUMENT_ROOT'] . $old_array['home_busines_foto'])) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $old_array['home_busines_foto']);
                unlink($_SERVER['DOCUMENT_ROOT'] . '/uploads/img_business/thumbs/' . basename($old_array['home_busines_foto']));
            }
        }
    }


    public static function call_after_insert_business ($key_array = null) {

        if (!empty($key_array['home_busines_foto'])) {
            self::create_images($key_array['home_busines_foto'], '/uploads/img_business/thumbs/', 370, 237);
        }

    }


    public static function call_bef_show_edit_bus ($new_array){
        //die(HTML::x($new_array));
        $query = DB::select('id', 'name')
            ->from('gallery')
            ->where('business_id', '=', $new_array['id'])
            ->cached()
            ->execute()->as_array();
        $cont = View::factory('adm/adon_links_galery_for_business');
        $cont->data = $query;
        Cruds::$adon_form = $cont;
    }

    //articles


    public static function call_bef_edit_articles ($new_array = null, $old_array = null){

        //die(HTML::x($new_array));

        if (!empty($new_array['images_article'])) {
            $img = self::create_images($new_array['images_article'], '/uploads/img_articles/thumbs/', 260, 186);
            //die(HTML::x($old_array[0]['images_article']));
            //удаляем старые картинки
            if ($img === true and file_exists($_SERVER['DOCUMENT_ROOT'] . $old_array['images_article'])) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $old_array['images_article']);
                unlink($_SERVER['DOCUMENT_ROOT'] . '/uploads/img_articles/thumbs/' . basename($old_array['images_article']));
            }
        }

    }

    public static function call_after_insert_articles ($key_array = null){
        if (!empty($key_array['images_article'])) {
            self::create_images($key_array['images_article'], '/uploads/img_articles/thumbs/', 260, 186);
        }
    }


    //coupons

    public static function call_bef_edit_coupons ($new_array = null, $old_array = null){

        if (!empty($new_array['img_coupon'])) {
            $img = self::create_images($new_array['img_coupon'], '/uploads/img_coupons/thumbs/', 234, 196);
            //удаляем старые картинки
            if ($img === true and file_exists($_SERVER['DOCUMENT_ROOT'] . $old_array['img_coupon'])) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $old_array['img_coupon']);
                unlink($_SERVER['DOCUMENT_ROOT'] . '/uploads/img_coupons/thumbs/' . basename($old_array['img_coupon']));
            }
        }
    }


    public static function call_after_insert_coupons ($key_array = null){
        if (!empty($key_array['img_coupon'])) {
            self::create_images($key_array['img_coupon'], '/uploads/img_coupons/thumbs/', 234, 196);
        }
    }



    public static function call_bef_edit_show_galery ($new_array){
        $data = View::factory('adm/adon_form');
        $data->list = Model::factory('Adm')->get_table('files', array('gallery', '=', $new_array['id']));
        Cruds::$adon_form = $data;
    }

    public static function call_bef_insert_show_galery ($new_array){
        Cruds::$adon_form = View::factory('adm/adon_form');
    }






    //реализация добавления удаления редактирования фото в галереи в форме редактирования
    public static function call_bef_edit_galery ($new_array = null, $old_array = null){
        //определяем отностельные и абсолютные пути
        $thumbs = '/uploads/img_galery/thumbs/';
        $img_galery = '/uploads/img_galery/';
        $file_path_thumbs = $_SERVER['DOCUMENT_ROOT'] . $thumbs;
        $file_path = $_SERVER['DOCUMENT_ROOT'] . $img_galery;

        //получаем первоначальный список картинок
        $file_start = Model::factory('Adm')->get_table('files', array('gallery', '=', Cruds::$post['id']));
        //формируем масив для сравнения
        $file_result_filename = array();
        $file_result_title = array();
        foreach ($file_start as $key => $row_value) {
            $file_result_filename[$row_value['id']] = $row_value['filename'];
            $file_result_title[$row_value['id']] = $row_value['title'];
        }
        //вычисляем расхождение масивов для удаление
        $diferen = array_diff($file_result_filename, Cruds::$post['filename']);

        //если не пустой значит некоторые картинки были удалены
        if (!empty($diferen)) {
            foreach ($diferen as $key =>$dif) {
                $del[] = $key;
                self::unlink_file($dif, $thumbs);
            }
            //удаляем
            Model::factory('Adm')->delete_galery($del);
        }

        //редактирование картинки
        foreach (Cruds::$post['filename'] as $key => $rows_filename) {
            //редактирование картинки
            if (!empty(Cruds::$files['filename']['tmp_name'][$key])) {
                //формируем имя файла с раширением
                $type_file = '.'. strtolower(pathinfo(Cruds::$files['filename']['name'][$key], PATHINFO_EXTENSION));
                $name_file = uniqid().$type_file;

                Model::factory('Adm')->update_galery($img_galery.$name_file, Cruds::$post['title'][$key], $key);
                self::save_img(Cruds::$files['filename']['tmp_name'][$key], $name_file, $file_path);
                $img = self::create_images($img_galery.$name_file, $thumbs, 300, 196);
                //удаление старых катинок
                self::unlink_file($rows_filename, $thumbs);

            }
        }


        //новые добавления картинок
        foreach (Cruds::$files['filename']['tmp_name'] as $key => $tmp_name) {

            if (empty(Cruds::$post['filename'][$key])) {
                $type_file = '.'. strtolower(pathinfo(Cruds::$files['filename']['name'][$key], PATHINFO_EXTENSION));
                $name_file = uniqid().$type_file;

                Model::factory('Adm')->insert_galery($img_galery.$name_file, Cruds::$post['title'][$key], Cruds::$post['id']);
                self::save_img($tmp_name, $name_file, $file_path);
                $img = self::create_images($img_galery.$name_file, $thumbs, 300, 196);
            }

        }

        //вычисляем расхождение масивов для редактирования существующих title
        $diferen_title = array_diff(Cruds::$post['title'], $file_result_title);

        foreach ($diferen_title as $key => $edit_title) {
            if (!empty(Cruds::$post['filename'][$key])) {
                Model::factory('Adm')->update_galery(null, Cruds::$post['title'][$key], $key);
            }
        }

    }

    public static function call_after_insert_galery ($key_array = null){

        //определяем отностельные и абсолютные пути
        $thumbs = '/uploads/img_galery/thumbs/';
        $img_galery = '/uploads/img_galery/';
        $file_path_thumbs = $_SERVER['DOCUMENT_ROOT'] . $thumbs;
        $file_path = $_SERVER['DOCUMENT_ROOT'] . $img_galery;


        //новые добавления картинок
        foreach (Cruds::$files['filename']['tmp_name'] as $key => $tmp_name) {

            $type_file = '.'. strtolower(pathinfo(Cruds::$files['filename']['name'][$key], PATHINFO_EXTENSION));
            $name_file = uniqid().$type_file;

            Model::factory('Adm')->insert_galery($img_galery.$name_file, Cruds::$post['title'][$key], $key_array['id']);
            self::save_img($tmp_name, $name_file, $file_path);
            $img = self::create_images($img_galery.$name_file, $thumbs, 300, 196);

        }

    }


    //добавление пользователя из админки
    public static function call_bef_insert_user ($new_array = null){

//        $user = ORM::factory('User');
//        $user->username = $new_array['username'];
//        $user->password = $new_array['password'];
//        $user->email = $new_array['email'];
//        $user->save();
        $new_array['password'] = Auth::instance()->hash($new_array['password']);
        return $new_array;
    }



    public static function StatusBusiness ($key_array = null) {

        if ($key_array['status'] == 1) {
            //die(HTML::x($key_array));
            $status = 0;
        } else {
            $status = 1;
        }
        $query = DB::update('business')->set(array('status' => $status))->where('id', '=', $key_array['id'])->execute();
        //die(var_dump($query));
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
            $image->resize($w, $h, Image::NONE);
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