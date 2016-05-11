<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 06.09.2015
 * Time: 18:20
 */


class Controller_ArticleFavorit extends Controller {

    public function action_saveArticleFavorit () {

        if (Request::initial()->is_ajax()) {

            //todo Rediset
            Rediset::getInstance()->set_articles_favor($this->request->post('id_articles'));

            if (Auth::instance()->get_user()) {
                $data = Model::factory('ArticlesModel')->saveArticlesFavoritesUser(Auth::instance()->get_user()->id, $this->request->post('id_articles'));
                //пишем в куки
                Cookie::update_and_set_json('favoritartic', $this->request->post('id_articles'));

            } else {
                //если не авторизован
                Cookie::update_and_set_json('favoritartic', $this->request->post('id_articles'));
            }
        }

    }


    public function action_deleteArticleFavorit(){

        if (Request::initial()->is_ajax()) {

            if (Auth::instance()->get_user()) {
                Model::factory('ArticlesModel')->deleteArticlesFavoritesUser($this->request->post('id_articles'));
                Cookie::del_articles($this->request->post('id_articles'));
            } else {

                Cookie::del_articles($this->request->post('id_articles'));
            }
        }
    }
    
}