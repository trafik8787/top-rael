<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Ajax extends Controller {

    /**
     * добавляем подписчика
     */
	public function action_index()
	{
        if (Request::initial()->is_ajax()) {

            $query = Model::factory('SubscribeModel')->addSubskribeLodatey($this->request->post('email'));
            echo json_encode($query);
        }

	}

    /**
     * сортировка по категориям БИЗНЕСОВ группы лакшери (теги)
     */
    public function action_tagscatselest (){

        if (Request::initial()->is_ajax()) {

            if ($this->request->post('cat') != 'undefined') {
                $data = Model::factory('BussinesModel')->getBussinesCategoryTagsUrl($this->request->post('cat'),$this->request->post('tags_url'));
            } else {
                //die(HTML::x($_POST));
                $data = Model::factory('BussinesModel')->getBussinesSectionTagsUrl($this->request->post('section'),$this->request->post('tags_url'));
            }

            foreach ($data['data'] as $key => $rows) {

                //заглушка если файл картинки не обнаружен
                $busines_foto = '/public/uploade/thumbnail.jpg';
                if (file_exists($_SERVER['DOCUMENT_ROOT'].$rows['home_busines_foto'])) {
                    $busines_foto = '/uploads/img_business/thumbs/'.basename($rows['home_busines_foto']);
                }
                $data['data'][$key]['home_busines_foto'] = $busines_foto;
                $data['data'][$key]['info'] = Text::limit_chars(strip_tags($rows['info']), 150, null, true);
            }

            $data = Controller_BaseController::convertArrayTagsBusiness($data['data']);
            $content = View::factory('ajax_views/business_list_ajax');
            $content->data = $data;
            echo $content;
            //echo json_encode($data);
        }
    }

    /**
     * сортировка по разделам СТАТЬИ группы лакшери (теги)
     */
    public function action_tagsecartic(){

        if (Request::initial()->is_ajax()) {
            //die(HTML::x($this->request->post()));
            if ($this->request->post('section') != 'undefined') {
                $data = Model::factory('ArticlesModel')->getArticlesSectionTagsUrl($this->request->post('section'), $this->request->post('tags_url'));
            } else {
                $data = Model::factory('ArticlesModel')->getArticlesSectionTagsUrl(null, $this->request->post('tags_url'));
            }

            foreach ($data as $key => $rows) {
                $data[$key]['images_article'] = '/uploads/img_articles/thumbs/'.basename($rows['images_article']);
                $data[$key]['content'] = Text::limit_chars(strip_tags($rows['content']), 200, null, true);
            }

            echo json_encode($data);
        }

    }

    /**
     * сортировка по разделам КУПОНЫ группы лакшери (теги)
     */
    public function action_tagseccoupon (){
        if (Request::initial()->is_ajax()) {

            if ($this->request->post('section') != 'undefined') {
                $data = Model::factory('CouponsModel')->getCouponsSectionTagsUrl($this->request->post('section'), $this->request->post('tags_url'));
            } else {
                $data = Model::factory('CouponsModel')->getCouponsSectionTagsUrl(null, $this->request->post('tags_url'));
            }

            foreach ($data as $key => $rows) {
                //$data[$key]['img_coupon'] = '/uploads/img_coupons/thumbs/'.basename($rows['img_coupon']);
                $data[$key]['dateoff'] = Date::rusdate(strtotime($rows['dateoff']), 'j %MONTH% Y');
            }

            $data = Controller_BaseController::convertArrayVievData($data);

           // die(HTML::x($data));

            $content = View::factory('ajax_views/coupons_list_ajax');
            $content->data_coupon = $data;
            echo $content;
            //echo json_encode($data);
        }

    }

}
