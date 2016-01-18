<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 13.09.2015
 * Time: 0:21
 */

class Controller_Pages_ArhivLotery extends Controller_BaseController {

    public function action_index()
    {
        $content = View::factory('pages/arhiv_lotery');
        $content->data_user = Model::factory('LotareyModel')->getUserLotarey();

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
        ));

        $this->template->content = $content;
    }



}