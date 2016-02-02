<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 14.11.2015
 * Time: 23:27
 */

class Controller_Pages_ArhivSubscribe extends Controller_BaseController {



    public function action_index (){

        $content = View::factory('pages/subscribe_arhiv');

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
        ));


        if ($this->request->param('id')) {

            $result = Model::factory('SubscribeModel')->getMailSubskribe($this->request->param('id'));

            $data = View::factory('email/mail_arhiv');
            $data->date_subscribe = $result[0]['data'];
            $data->business = $result['DataBus'];
            $data->coupons = parent::convertArrayVievData($result['DataCoup']);
            $data->lotarey = $result['DataLotery'];

            $article_shift = array_shift($result['DataArtic']);
            $data->article_shift = $article_shift;
            $data->articless = $result['DataArtic'];
            $content->data = $data;

        } else  {
            $data_list = Model::factory('CategoryModel')->get_section('subscription_arhiv');
            $content->data_list = $data_list;
        }

        $this->SeoShowPage(array('Архив рассылок TopIsrael.ru', ''),
            array('Все выпуски писем с анонсами новых обзоров, интересных мест и купонов со скидками', ''),
            array('Все выпуски писем с анонсами новых обзоров, интересных мест и купонов со скидками', ''));

        $this->template->content = $content;

    }
}