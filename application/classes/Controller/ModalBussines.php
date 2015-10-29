<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 20.08.2015
 * Time: 17:42
 */

class Controller_ModalBussines extends Controller {

    public function action_saveFovarites (){

        if (Request::initial()->is_ajax()) {

            //todo Rediset
            Rediset::getInstance()->set_business_favor($this->request->post('id_bussines'));

            //если пользователь авторизован
            if (Auth::instance()->get_user()) {
                $data = Model::factory('BussinesModel')->saveBussinesFavoritesUser(Auth::instance()->get_user()->id, $this->request->post('id_bussines'));
                //пишем в куки
                Cookie::update_and_set_json('favoritbus', $this->request->post('id_bussines'));

            } else {
                //если не авторизован
                Cookie::update_and_set_json('favoritbus', $this->request->post('id_bussines'));
            }
        }
    }


    public function action_deleteFovarites (){
        if (Request::initial()->is_ajax()) {
            if (Auth::instance()->get_user()) {
                Model::factory('BussinesModel')->deleteBussinesFavoritesUser($this->request->post('id_bussines'));
                Cookie::del_bussines($this->request->post('id_bussines'));
            } else {
                Cookie::del_bussines($this->request->post('id_bussines'));
            }
        }
    }
}