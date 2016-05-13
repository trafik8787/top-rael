<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 27.08.2015
 * Time: 12:51
 */

class Controller_Pages_Subscribe extends Controller_BaseController {

    /**
     * подтверждение подписки
     */
    public function action_SussesSubscribe()
    {
        $content = View::factory('pages/subscribe');

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
        ));

        if (!empty($_GET['qid'])) {
            if (Model::factory('SubscribeModel')->getActiveSelect($_GET['email'], $_GET['qid'])) {


                //подтверждение подписки на бизнес
                if (!empty($_GET['bus'])) {
                    Model::factory('SubscribeModel')->addSubskribeBussines($_GET['email'], $_GET['bus'], 1, $_GET['qid']);
                } else {
                    Model::factory('SubscribeModel')->addSubskribeLodatey($_GET['email'], 1, $_GET['qid']);
                }

                $content->data = 'Спасибо что подписались на нашу рассылку!';

            } else {
                $content->data = 'Ошибка';
            }


        }

        $this->template->content = $content;
    }


    public function action_Unsubscribe(){
        $content = View::factory('pages/unsubscribe');

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
        ));

        if (!empty($this->request->post('email'))) {
            $query = Model::factory('SubscribeModel')->Unsubscribe($this->request->post('email'));

            if (!empty($query)) {
                $this->redirect('/unsubscribe?err_cap='.base64_encode('Вы отписались от рассылки'));
            }


        } else {

        }

        $this->template->content = $content;
    }
}
