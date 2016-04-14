<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 14.04.2016
 * Time: 0:29
 */
class Controller_Pages_News extends Controller_BaseController {

    public function action_index (){

        $number_page = $this->request->param('page');

        $content = View::factory('pages/news');

        $data = Model::factory('NewsModel')->getNews(30, $number_page);
        $content->data = $data['data'];
        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
        ));

        $content->pagination = Pagination::factory(array('total_items' => $data['count'], 'items_per_page' => 30)); //блок пагинации

        $this->SeoShowPage(array('News', ''),
            array('News', ''),
            array('News', ''));


        $this->template->content = $content;
    }

}