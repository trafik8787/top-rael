<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Ajax extends Controller {

	public function action_index()
	{
        if (Request::initial()->is_ajax()) {

        }
//		$this->response->body('hello, world!');
//        $this->template->content = $this->request->param('url_city');

	}

    public function action_city () {

//        if (Request::initial()->is_ajax()) {
//            ///echo $this->request->post('category');
//            $business_list = View::factory('pages/bussines_section_list');
//            //echo $this->request->post('section');
//            if ($this->request->post('section') != '') {
//
//               // $data = Model::factory('BussinesModel')->getBussinesSectionUrl($this->request->post('section'), 10 ,'', $this->request->post('id_city'));
//                $articles = Model::factory('ArticlesModel')->getArticlesSectionUrl($this->request->post('section'), 6);
//                //$data_articles = $articles['data'];
//
//            } else {
//                //по урлу категории получаем бизнесы
//                $data = Model::factory('BussinesModel')->getBussinesCategoryUrl($this->request->post('category'), 10 ,'', $this->request->post('id_city'));
//                //по урлу категории получаем анонсы статей
//                $data_articles = Model::factory('ArticlesModel')->getArticlesCategoryUrl($this->request->post('category'));
//                //echo $data;
//            }
//
//            $business_list->pagination = Pagination::factory(array('total_items' => $data['count']));
//            //подключаем правый блок
//
//            $business_list->bloc_right = Controller_BaseController::RightBloc(array(
//                View::factory('blocks_includ/articles_category_bloc', array('content' => $data_articles))
//            ));
//
//            $business_list->data = $data['data'];
//            echo $business_list;
//       }
    }

}
