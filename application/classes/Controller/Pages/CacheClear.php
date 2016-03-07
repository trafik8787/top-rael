<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 07.03.2016
 * Time: 10:40
 */

class Controller_Pages_CacheClear extends Controller  {

    public function action_index() {

        $data = array();
        if ($this->request->post('password') == '21Sxq6y09v6dj4S') {

            $data['syses'] = 'Success';

            $this->removeDirectory($_SERVER['DOCUMENT_ROOT'].'/application/cache');


        }

        $this->response->body(View::factory('pages/cache_clear', $data));
    }

    private function removeDirectory($dir) {
        if ($objs = glob($dir."/*")) {
            foreach($objs as $obj) {
                if (is_dir($obj)) {
                    $this->removeDirectory($obj);
                } else {
                    unlink($obj);

                }

            }
        }
        if ($dir != $_SERVER['DOCUMENT_ROOT'].'/application/cache') {
            rmdir($dir);
        }
    }
}