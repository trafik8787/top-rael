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

    public function action_news(){

        $info = array(
            'title' => 'Комментарии нашего сайта'
        );

        $items = array(
            array('title' => 'Комментарий к статье 2', 'description' => 'А почему здесь так ?',
                'link'  => URL::site('/articles/article2'), 'pubDate' => date('r', time())),
            array('title' => 'Комментарий к статье 1', 'description' => 'Ничего не понял',
                'link'  => URL::site('/articles/article1'), 'pubDate' => date('r', time() - 2500))
        );

        $this->response->headers("Content-Type", "text/xml");

        echo Feed::create($info, $items);
    }

}