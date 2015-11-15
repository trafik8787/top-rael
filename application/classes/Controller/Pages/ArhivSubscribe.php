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



        $this->template->content = $content;

    }
}