<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Sitemap extends Controller_BaseController {

	public function action_index(){

        $content = View::factory('pages/sitemap');

        $content->category = Sitemap::pageGeterateMap();

         $this->SeoShowPage(array('Карта сайта Topisrael', ''),
                array('Карта сайта Topisrael', ''),
                array('Карта сайта Topisrael', ''));


        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
        ));

        $this->template->content = $content;
	}



}
