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
            if ($_GET['qid'] == Session::instance()->get('uniqid')) {
                Model::factory('SubscribeModel')->addSubskribeLodatey($_GET['email'], 1);
                Session::instance()->delete('uniqid');
                $content->data = 'Спасибо что подписались на нашу рассылку!';
            } else {
                $content->data = 'Ошибка';
            }
        }

        $this->template->content = $content;
    }

}
