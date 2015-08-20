<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 20.08.2015
 * Time: 16:38
 */

class Controller_Pages_Tags extends Controller_BaseController {

    public function action_index()
    {
        $content = View::factory('pages/tags');

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
        ));

        $this->template->content = $content;
    }
}