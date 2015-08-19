<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.08.2015
 * Time: 14:45
 */

//ArhivLotarey

class Controller_Pages_ArhivLotarey extends Controller_BaseController {

    public function action_index (){
        $content = View::factory('pages/arhiv-lotarey');

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
        ));


        $this->template->content = $content;
    }

}