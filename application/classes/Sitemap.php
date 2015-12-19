<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 14.09.2015
 * Time: 17:00
 */

final class Sitemap {


    public static function FileGenerane ($static_page = null){

        //создаем основную структуру документа
        $base = '<?xml version="1.0" encoding="UTF-8"?>
            <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            </urlset>';
        //для легкой работы с XML DOM используем стандартный класс SimpleXMLElement и для основы
        //вставим подготовленный в переменной $base код
        $xmlbase = new SimpleXMLElement($base);
        //внутрь уже созданного документа добавляем дочерний элемент с тегом url
        $row  = $xmlbase->addChild("url");
        //добавляем в тег url тег ссылки, времени модификации, частоты модификации, приоритета
        //сперва для главной страницы
        $row->addChild("loc",HTML::HostSite());
        $row->addChild("lastmod",date("c"));
        $row->addChild("changefreq","daily");
        $row->addChild("priority","1");
        //бизнесы
        $bus = DB::select('id', 'url', 'date_create')->from('business')->execute()->as_array();
        foreach ($bus as $result) {
            $row  = $xmlbase->addChild("url");
            $row->addChild("loc",HTML::HostSite("/business/".$result['url']));
            $row->addChild("lastmod",date("c",strtotime($result['date_create'])));
            $row->addChild("changefreq","daily");
            $row->addChild("priority","0.9");
        }

        //получаем все статьи
        $article = DB::select('id', 'url', 'datecreate')->from('articles')->execute()->as_array();

        foreach ($article as $result_arr) {
            $row  = $xmlbase->addChild("url");
            $row->addChild("loc",HTML::HostSite("/article/".$result_arr['url']));
            $row->addChild("lastmod",date("c",strtotime($result_arr['datecreate'])));
            $row->addChild("changefreq","daily");
            $row->addChild("priority","0.8");
        }


        //ссылки с категориями и городами

        $cat_articles = Model::factory('ArticlesModel')->getSectionArticles();

        foreach ($cat_articles as $cat_art_row) {
            $data = Model::factory('ArticlesModel')->getArticlesSectionUrl($cat_art_row['url'], 1);


            foreach ($data['city'] as $key => $city) {
                $row  = $xmlbase->addChild("url");
                $row->addChild("loc",HTML::HostSite("/articles/".$cat_art_row['url'].'?city='.$key));
                $row->addChild("lastmod",date("c"));
                $row->addChild("changefreq","daily");
                $row->addChild("priority","0.8");
            }

            $row  = $xmlbase->addChild("url");
            $row->addChild("loc",HTML::HostSite("/articles/".$cat_art_row['url']));
            $row->addChild("lastmod",date("c"));
            $row->addChild("changefreq","daily");
            $row->addChild("priority","0.8");

        }


        $coupon = DB::select('id', 'url', 'datecreate')->from('coupon')->execute()->as_array();

        foreach ($coupon as $result_arr) {
            $row  = $xmlbase->addChild("url");
            $row->addChild("loc",HTML::HostSite("/coupon/".$result_arr['url']));
            $row->addChild("lastmod",date("c",strtotime($result_arr['datecreate'])));
            $row->addChild("changefreq","daily");
            $row->addChild("priority","0.8");
        }


        $category = Model::factory('CategoryModel')->recurs_catalog();


        foreach ($category as $result_arr) {

            $bus_section = Model::factory('BussinesModel')->getBussinesSectionUrl($result_arr['url'], 1);

            if (!empty($bus_section['city'])) {
                foreach ($bus_section['city'] as $key => $city) {
                    $row = $xmlbase->addChild("url");
                    $row->addChild("loc", HTML::HostSite("/section/" . $result_arr['url'] . '?city=' . $key));
                    $row->addChild("lastmod", date("c"));
                    $row->addChild("changefreq", "daily");
                    $row->addChild("priority", "0.7");
                }
            }




            $row  = $xmlbase->addChild("url");
            $row->addChild("loc",HTML::HostSite("/section/".$result_arr['url']));
            $row->addChild("lastmod",date("c"));
            $row->addChild("changefreq","daily");
            $row->addChild("priority","0.7");

            foreach ($result_arr['childs'] as $childs) {


                $bus_category = Model::factory('BussinesModel')->getBussinesCategoryUrl($childs['url'], 1);

                if (!empty($bus_category['city'])) {
                    foreach ($bus_category['city'] as $key2 =>  $city) {
                        $row = $xmlbase->addChild("url");
                        $row->addChild("loc", HTML::HostSite("/section/" . $result_arr['url'] . '/' . $childs['url'] . '?city=' . $key2));
                        $row->addChild("lastmod", date("c"));
                        $row->addChild("changefreq", "daily");
                        $row->addChild("priority", "0.7");
                    }
                }


                $row  = $xmlbase->addChild("url");
                $row->addChild("loc",HTML::HostSite("/section/".$result_arr['url'].'/'.$childs['url']));
                $row->addChild("lastmod",date("c"));
                $row->addChild("changefreq","daily");
                $row->addChild("priority","0.7");
            }

        }

        //ссылки на теги формируем
        $tags = Model::factory('TagsModel')->getAllTags();

        if (!empty($tags)) {
            foreach ($tags as $rows_tags) {

                $row  = $xmlbase->addChild("url");
                $row->addChild("loc", HTML::HostSite('/tags/'.$rows_tags['url_tags']));
                $row->addChild("lastmod",date("c"));
                $row->addChild("changefreq","daily");
                $row->addChild("priority","0.9");
            }
        }



        $subscription_arhiv = Model::factory('CategoryModel')->get_section('subscription_arhiv');

        if (!empty($subscription_arhiv)) {
            foreach ($subscription_arhiv as $rows_subs) {
                $row  = $xmlbase->addChild("url");
                $row->addChild("loc", HTML::HostSite('/newsletter/'.$rows_subs['id']));
                $row->addChild("lastmod",date("c"));
                $row->addChild("changefreq","monthly");
                $row->addChild("priority","0.6");
            }
        }


        if($static_page != null) {

            foreach ($static_page as $rows) {

                $row  = $xmlbase->addChild("url");
                $row->addChild("loc", HTML::HostSite($rows));
                $row->addChild("lastmod",date("c"));
                $row->addChild("changefreq","monthly");
                $row->addChild("priority","0.9");
            }

        }


        //сохраняем все это в файл
        $xmlbase->saveXML($_SERVER['DOCUMENT_ROOT']."/uploads/sitemap.xml");
    }

}