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
        //$viws = View::factory('adm/tab_page');
       // $viws->edit_render = self::adminHome()->edit_render(1);
        $this->response->body(self::adminHome()->render());


    }

    public function action_about(){
        Controller_Core_Main::$title_page = 'О проекте';
        $this->response->body(self::adminAbout()->edit_render(1));
    }










    public static function adminHome (){
        $crud = new Cruds();
        $crud->load_table('city');
        $crud->set_lang('ru');

        //$crud->show_name_column(array('email' => 'Email', 'seo_title' => 'SEO Title', 'seo_description' => 'SEO Desc', 'seo_keywords' => 'SEO keywords'));
        return $crud;
    }

    public static function adminAbout (){
        $crud = new Cruds();
        $crud->load_table('about');
        $crud->set_lang('ru');
        $crud->edit_fields('text');
        $crud->show_name_column(array('text' => 'Описание'));
        return $crud;
    }

}