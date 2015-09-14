<?php defined('SYSPATH') OR die('No direct script access.');

class HTTP_Exception_404 extends Kohana_HTTP_Exception_404 {

    public function get_response()
    {

        $view = View::factory('pages/404');
        $view->style = array('bootstrap.min', 'style');
        $view->script = array('jquery-1.11.2.min', 'bootstrap.min', 'jquery.validate.min','app');
        // Remembering that `$this` is an instance of HTTP_Exception_404
        $view->message = $this->getMessage();

        $response = Response::factory()
            ->status(404)
            ->body($view->render());

        return $response;
    }

}
