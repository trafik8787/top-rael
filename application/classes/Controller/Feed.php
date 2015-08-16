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
            $items[] = array(
                'title' => $rows['name'],
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

    }

    public function action_lotarey(){

    }

}