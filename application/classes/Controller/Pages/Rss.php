<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Rss extends Controller_BaseController {

	public function action_index()
	{
        $content = View::factory('pages/rss');

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
        ));

            $this->SeoShowPage(array('RSS TopIsrael.ru', ''),
                array('RSS TopIsrael.ru', ''),
                array('RSS TopIsrael.ru', ''));

        $this->template->content = $content;
	}



}
