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

        //проверяем есть ли урл
        if ($this->request->param('url_tags') == null) {
            throw new HTTP_Exception_404;
        }

        $content = View::factory('pages/tags');

        $tags = Model::factory('TagsModel')->getTagsUrl($this->request->param('url_tags'));

        //выброс ошибки
        if ($tags === false) {
            throw new HTTP_Exception_404;
        }

        $section = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'));


        foreach ($section as $row_section) {

            $category = Model::factory('CategoryModel')->getCategoryInSectionUrl($row_section['url'], null, $this->request->param('url_tags'));

            //HTML::x($category);
            //сортировка категорий по количеству бизнесов в них
            $count = array();
            $rowArr = array();

            if (!empty($category[0]['childs'])) {
                foreach ($category[0]['childs'] as $key => $row) {
                    $count[] = $row['COUNT'];
                    $rowArr[] = $row;
                }

                array_multisort($count, SORT_DESC, $rowArr, SORT_ASC, $category[0]['childs']);
                //получаем первые 5 категорий раздела дальше "еще..."
            }

            $data = Model::factory('BussinesModel')->getBussinesSectionTagsUrl($row_section['url'], $this->request->param('url_tags'));
            $data['data'] = $this->convertArrayTagsBusiness($data['data']);
            $resultArr[] = array('category' => $category, 'data' => $data['data']);
        }

        //реклама в правом блоке
        $this->getBanersGoogle();

        //верхний банер
        $content->top_baners = parent::$top_baners;

        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
            $this->blocCity(),
            $this->blocTags(),
            $this->blocNews($this->request->param('url_tags'), 'tags'),
            parent::$right_baners
        ));

        //SEO
        $this->SeoShowPage(array($tags[0]['title'], $tags[0]['name_tags']),
            array($tags[0]['keywords'], $tags[0]['name_tags']),
            array($tags[0]['description'], $tags[0]['name_tags']));

        //статьи группы лакшери выборка по тегам
        $content->data_articles = Model::factory('ArticlesModel')->getArticlesSectionTagsUrl(null, $this->request->param('url_tags'));

        //купоны группы лакшери выборка по тегам
        $data_coupons = Model::factory('CouponsModel')->getCouponsSectionTagsUrl(null, $this->request->param('url_tags'));
        $data_coupons = parent::convertArrayVievData($data_coupons, 3);
        $content->data_coupon =  $data_coupons;
        //разделы для обзоров
        $content->section =  Model::factory('ArticlesModel')->getSectionArticlesTag($this->request->param('url_tags'));
        $content->section_coupons = Model::factory('CouponsModel')->CouponsSectionCountCouponTags($this->request->param('url_tags'));

        $content->data_tag = $tags[0];
        $content->data = $resultArr;
        $content->tags_url = $this->request->param('url_tags');
        $this->template->content = $content;
    }
}