<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Coupons extends Controller_BaseController {

	public function action_index()
	{
        $data = array();
        $number_page = $this->request->param('page');

        $city_id = null;
        if (!empty($_GET)) {
            $city_id = $_GET['city'];
            //если фильтр по городам обнуляем номер страницы если выбирается новый город
            if (Session::instance()->get('city_id') != $city_id) {
                $number_page = '';
            }

            Session::instance()->set('city_id', $city_id);
        } else {
            Session::instance()->set('city_id', '');
        }

        $content = View::factory('pages/coupon_all');
        $content->category =  self::$general_meny;

        if ($this->request->param('url_section') == '') {
            $data = Model::factory('CouponsModel')->getCouponsSectionUrl(null, 10, $number_page, $city_id);
        } else {
            $data = Model::factory('CouponsModel')->getCouponsSectionUrl($this->request->param('url_section'), 10, $number_page, $city_id);
        }

        $content->pagination = Pagination::factory(array('total_items' => $data['count'])); //блок пагинации
        $content->data = $data['data'];
        $content->city = $data['city'];

        //передаем параметр значения выбраного города для селекта
        $content->city_id = $city_id;

        if ($this->request->param('page') != '') {
            $content->pagesUrl = '/'.$this->request->param('page');
        } else {
            $content->pagesUrl = '';
        }

        $this->template->content = $content;
	}


}