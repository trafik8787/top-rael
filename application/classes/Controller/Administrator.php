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

        $this->logged_in = Auth::instance()->logged_in();
        $this->adm = View::factory('/adm/auth_admin');

    }


    public function after () {

        if ($this->logged_in === false) {
            $this->response->body($this->adm);
        }

    }

    public function action_login () {

        $post = $this->request->post();

        if(!empty($post['login']) && !empty($post['password'])) {

            Auth::instance()->login($post['login'], $post['password']);
            $this->redirect('/administrator');

        }


    }

    public function action_logout () {
        Auth::instance()->logout();
        $this->redirect('/administrator');
    }

    public function action_index() {
        Controller_Core_Main::$title_page = 'Главная';
        $this->response->body(self::adminHome()->render());


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
    
    /**
     * @return Cruds
     * end ections
     */









    public static function adminHome (){
        $crud = new Cruds();
        $crud->load_table('city');
        $crud->set_lang('ru');
        $crud->disable_search();
        //$crud->show_name_column(array('email' => 'Email', 'seo_title' => 'SEO Title', 'seo_description' => 'SEO Desc', 'seo_keywords' => 'SEO keywords'));
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
        $crud->disable_editor('title');
        $crud->select_multiselect('cat_id');
        $crud->show_columns('id', 'name', 'url');
        $crud->set_field_type('status', 'checkbox', '', '', '','');
        $crud->set_field_type('city', 'select', '', '', '', array('city', 'name','id', array('parent_id','<>','0')));
        $crud->set_field_type('cat_id', 'select', '', 'multiple', '', array('category', 'name','id', array('parent_id','<>','0')));
        $crud->set_one_to_many('businesscategory', 'cat_id','category_id', 'business_id');


        $crud->set_field_type('home_busines_foto', array('file', 'uploads/img_business', 'bus_', '', 'img'),'', '');
        $crud->set_field_type('logo', array('file', 'uploads/img_business', 'buslogo_', '', 'img'),'', '');

        $crud->edit_fields('name', 'title',
            'description',
            'keywords',
            'city',
            'address',
            'website',
            'video',
            'home_busines_foto',
            'info',
            'logo',
            'url', 'cat_id', 'date_create', 'date_end', 'tags', 'status');

        $crud->add_field('name', 'title',
            'description',
            'keywords',
            'city',
            'address',
            'website',
            'video',
            'home_busines_foto',
            'info',
            'logo',
            'url',  'cat_id', 'date_create', 'date_end', 'tags', 'status');

        $crud->show_name_column(array('name' => 'Название',
            'url' => 'URL',
            'description' => 'SEO Description',
            'title' => 'SEO Title',
            'keywords' => 'SEO Keywords',
            'city' => 'Город',
            'address' => 'Адреса',
            'website' => 'Веб сайт бизнеса',
            'video' => 'Видео',
            'home_busines_foto' => 'Главное фото бизнеса',
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


        $crud->callback_before_edit('call_bef_edit_business');
        $crud->callback_after_insert('call_after_insert_business');

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
        $crud->set_field_type('bussines_id', 'select', '', '', '', array('business', 'name','id'));
        $crud->set_field_type('coupon', 'select', '', '', '', array('coupon', 'name','id'));

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
        $crud->show_columns('id', 'name');
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


    public static function adminGalery (){
        $crud = new Cruds();
        $crud->load_table('gallery');
        $crud->set_lang('ru');
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





}