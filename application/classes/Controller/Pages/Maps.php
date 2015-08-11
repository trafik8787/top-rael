<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Maps extends Controller_BaseController {

	public function action_index()
	{
        $content = View::factory('pages/maps');

        $content->bloc_right = parent::RightBloc(array(
            View::factory('blocks_includ/lotareya'),
            View::factory('blocks_includ/sicseti'),
        ));

        $this->template->content = $content;
	}


}
