<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 13.08.2015
 * Time: 0:26
 */

class Controller_Feed extends Controller {

    public function action_index(){

    }

    public function action_articles(){

        $info = array(
            'title' => 'Обзоры',
            'link' => 'http://'.$_SERVER['SERVER_NAME'].'/articles',
            'language' => 'ru'
        );

        $data = Model::factory('ArticlesModel')->getArticlesAfter(10);

        $items = array();
        foreach ($data as $rows) {
            $infort = Text::limit_chars(strip_tags($rows['short_previev']), 200, null, true);
            $infort = htmlspecialchars($infort);
            $items[] = array(
                'title' => htmlspecialchars($rows['name']),
                'link' => 'http://'.$_SERVER['SERVER_NAME'].'/article/'.$rows['url'],
                'description' => '<img src="http://'.$_SERVER['SERVER_NAME'].'/uploads/img_articles/thumbs/'.basename($rows['images_article']).'"><p>'.$infort.'</p>',
                'pubDate' => $rows['datecreate'],
            );
        }

        $this->response->headers("Content-Type", "text/xml");

        echo Feed::create($info, $items);
    }


    public function action_business(){

        $info = array(
            'title' => 'Бизнесы',
            'link' => 'http://'.$_SERVER['SERVER_NAME'],
            'language' => 'ru'
        );

        $data = Model::factory('BussinesModel')->getBusinessAfter(20);
        //die(HTML::x($data));
        $items = array();

        foreach ($data as $rows) {

            $infort = Text::limit_chars(strip_tags($rows['info']), 200, null, true);
            $infort = htmlspecialchars($infort);

            $items[] = array(
                'title' => htmlspecialchars($rows['name']),
                'link' => 'http://'.$_SERVER['SERVER_NAME'].'/business/'.$rows['url'],
                'description' => '<img src="http://'.$_SERVER['SERVER_NAME'].'/uploads/img_business/thumbs/'.basename($rows['home_busines_foto']).'"><p>'.$infort.'</p>',
                'pubDate' => $rows['date_create']
            );


        }

        $this->response->headers("Content-Type", "text/xml");
       // die(HTML::x($items));
        echo Feed::create($info, $items);
    }


    public function action_coupons(){
        $info = array(
            'title' => 'Купоны',
            'link' => 'http://'.$_SERVER['SERVER_NAME'].'/coupons',
            'language' => 'ru'
        );

        $data = Model::factory('CouponsModel')->getCouponsAfter(10);
        //HTML::x($data, true);
        $items = array();

        foreach ($data as $rows) {

            $infort = Text::limit_chars(strip_tags($rows['CoupSecond']), 200, null, true);
            $infort = htmlspecialchars($infort);

            $bus_info = Text::limit_chars(strip_tags($rows['BusInfo']), 100, null, true);
            $bus_info = htmlspecialchars($bus_info);

            $items[] = array(
                'title' => htmlspecialchars($rows['CoupName']).' '.$infort,
                'link' => 'http://'.$_SERVER['SERVER_NAME'].'/coupon/'.$rows['CoupUrl'],
                'description' => '<img src="'.$rows['CoupImg'].'"><p>'.htmlspecialchars($rows['BusName']).'</p><p>'.$bus_info.'</p>',
                'pubDate' => $rows['CoupDatcreate']
            );

        }

        $this->response->headers("Content-Type", "text/xml");
        echo Feed::create($info, $items);

    }

    public function action_lotarey(){

    }

}