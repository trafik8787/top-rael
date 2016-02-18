<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Informers extends Controller_BaseController
{

    private $template_informer = null;

    public function before()
    {
        parent::before();
        $this->template_informer = View::factory('pages/informers');
        $this->template_informer->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
        ));
    }



    public function action_index()
    {
        $this->template_informer->data = View::factory('blocks_includ/informers_page_bussines');
        $this->template->content = $this->template_informer;
    }


    public function action_coupon ()
    {
        $this->template_informer->data = View::factory('blocks_includ/informers_page_coupon');
        $this->template->content = $this->template_informer;

    }

    public function action_article ()
    {
        $this->template_informer->data = View::factory('blocks_includ/informers_page_article');
        $this->template->content = $this->template_informer;
    }



}
