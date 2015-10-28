<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Business extends Controller_BaseController {

	public function action_index()
	{

        $content = View::factory('pages/business_page');
       // $token = Profiler::start('Model', 'BussinesModel');
        $data = Model::factory('BussinesModel')->getBusinessUrl($this->request->param('url_business'));
        //Profiler::stop($token);

        //если бизнес отключен редиректим на главную
        if ($data === false) {
            $this->redirect('/');
        }

        //echo View::factory('profiler/stats');
        $content->bloc_right = parent::RightBloc(array(
            View::factory('blocks_includ/coupon_business_page', array('content' => $data['CoupArr'], 'BusName' => $data['BusName'])),
            View::factory('blocks_includ/business_uslugi', array('data' => $data['BusServicesArr'])),
            View::factory('blocks_includ/business_meny', array('data' => $data['BusFileMeny']))
        ));

        //SEO
        $this->SeoShowPage(array($data['BusTitle'], $data['BusName']),
            array($data['BusKeywords'], $data['BusInfo']),
            array($data['BusDescription'], $data['BusInfo']));

        $related = Model::factory('BussinesModel')->getBusinessRelated($data['CatArr'][0]['CatUrl2'], $data['BusId']);

        $content->related = $related;
        $content->data = $data;

        //todo Rediset
        //Rediset::getInstance()->set_business($data['BusId']);

        $this->template->content = $content;
	}

}
