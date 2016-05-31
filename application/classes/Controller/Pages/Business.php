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

        if (!empty($data['NewsArr'])) {
            $data['ArticArr'] = array_merge($data['ArticArr'], $data['NewsArr']);

            if (!empty($data['ArticArr'])) {
                //подготовка к сортировке
                foreach ($data['ArticArr'] as $key => $row) {
                    $volume[$key] = $row['ArticDatecreate'];
                    $edition[$key] = $row;
                }

                //сортировка по датам новостей и статей
                array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $data['ArticArr']);
            }
        }

        //«Тип рекламы» - Бесплатно. Такому не посылать никаких писем-уведомлений и на странице выводить справа баннер Google.
        $bloc_reclam = null;
        if ($data['BusClientStatus'] == 4) {
            $this->getBanersGoogle();
            $bloc_reclam = parent::$right_baners;
        }

        $content->bloc_right = parent::RightBloc(array(
            'lotery' => $this->lotarey($data['BusId']),
            $this->showBlocBussinesSubscribe($data['BusId']),
            View::factory('blocks_includ/coupon_business_page', array('content' => $data['CoupArr'], 'BusName' => $data['BusName'])),
            View::factory('blocks_includ/business_uslugi', array('data' => $data['BusServicesArr'],
                'bussines_name' => $data['BusName'],
                'bussines_url' => $data['BusUrl'],
                'section_id' => $data['CatArr'][0]['CatParentId'])),
            View::factory('blocks_includ/business_meny', array('data' => $data['BusFileMeny'])),
            $bloc_reclam
        ));


        //SEO
        $this->SeoShowPage(array($data['BusTitle'], $data['BusName']),
            array($data['BusKeywords'], ''),
            array($data['BusDescription'], $data['BusInfo']));

        $related = Model::factory('BussinesModel')->getBusinessRelated($data['CatArr'][0]['CatUrl2'], $data['BusId']);

        $content->related = $related;
        $content->data = $data;

        //todo Rediset
        Rediset::getInstance()->set_business($data['BusId']);

        $this->template->content = $content;
	}

}
