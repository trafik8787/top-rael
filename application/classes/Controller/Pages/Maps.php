<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 18:44
 */
class Controller_Pages_Maps extends Controller_BaseController {

	public function action_index()
	{
        $data = array();
        $id = null;
        $url_category = null;
        $url_section = null;
        $content = View::factory('pages/maps');
        $this->template->scripts_map = 'public/javascripts/google.js';
        $content->bloc_right = parent::RightBloc(array(
            $this->lotarey(),
            View::factory('blocks_includ/sicseti'),
        ));

        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (!empty($_GET['cat'])) {
            $url_category = $_GET['cat'];
        }

        if (!empty($_GET['section'])) {
            $url_section = $_GET['section'];
        }

        if (!empty($_GET['city'])) {

            switch ($_GET['city']) {
                case 59:
                    $content->cityName = 'Тель Авив';
                    break;
                case 23:
                    $content->cityName = 'Иерусалим';
                    break;
                case 2:
                    $content->cityName = 'Эйлат';
                    break;
                default:
                    throw new HTTP_Exception_404;
            }
            $content->cityName = json_encode($content->cityName);

        }

        $result = Model::factory('BussinesModel')->getBusinessAll_Maps($id, $url_category, $url_section);


        $content->section = parent::$general_meny;

        if ($id != null) {

            if (!empty($result[0]['BusMapsX']) and !empty($result[0]['BusMapsX'])) {
                $content->lat = $result[0]['BusMapsX'];
                $content->lng = $result[0]['BusMapsY'];
            }

        }


        HTML::x($result);

        foreach ($result as $row) {


            $data[] = array(
                'id' => $row['BusId'],
                'title' => $row['BusName'],
                'logo' => $row['BusLogo'],
                'section' => array(
                    'id' => $row['CatArr'][0]['CatId'],
                    'name' => $row['CatArr'][0]['CatName'],
                    'icon' => $row['CatArr'][0]['CatIcon'],
                    'visible' => true
                ),
                'list' => array(
                    array(
                        'key' => "",
                        'value' => $row['BusSchedule']
                    ),
                    array(
                        'key' => "Адрес",
                        'value' => $row['BusAddress']
                    ),
                    array(
                        'key' => "Тел",
                        'value' => $row['BusTel']
                    )
                ),
                'link' => "/business/".$row['BusUrl'],
                'linkCoupons' => "http://google.com",
                'favoritBus' => isset($row['bussines_favorit']) ? $row['bussines_favorit'] : 0,
                'linkLuxury' => array(
                    'name' => $row['TagsName'],
                    'link' => $row['TagsUrl']
                ),
                'location' => array(
                    'lat' => $row['BusMapsX'],
                    'lng' => $row['BusMapsY']
                ),
                'coupon' => !empty($row['CoupArr']) ? 1 : 0
            );

            if (!empty($row['BusDopAddress'])) {

                foreach ($row['BusDopAddress'] as $rows_dop) {

                    $data[] = array(
                        'id' => $row['BusId'],
                        'title' => $row['BusName'],
                        'logo' => $row['BusLogo'],
                        'section' => array(
                            'id' => $row['CatArr'][0]['CatId'],
                            'name' => $row['CatArr'][0]['CatName'],
                            'icon' => $row['CatArr'][0]['CatIcon'],
                            'visible' => true
                        ),
                        'list' => array(
                            array(
                                'key' => "",
                                'value' => isset($rows_dop['dop_sheduler']) ? $rows_dop['dop_sheduler'] : ''
                            ),
                            array(
                                'key' => "Адрес",
                                'value' => isset($rows_dop['address']) ? $rows_dop['address'] : ''
                            ),
                            array(
                                'key' => "Тел",
                                'value' => isset($rows_dop['tel_dop_adress']) ? $rows_dop['tel_dop_adress'] : ''
                            )
                        ),
                        'link' => "/business/".$row['BusUrl'],
                        'linkCoupons' => "http://google.com",
                        'favoritBus' => isset($row['bussines_favorit']) ? $row['bussines_favorit'] : 0,
                        'linkLuxury' => array(
                            'name' => $row['TagsName'],
                            'link' => $row['TagsUrl']
                        ),
                        'location' => array(
                            'lat' => $rows_dop['maps_x'],
                            'lng' => $rows_dop['maps_y']
                        ),
                        'coupon' => !empty($row['CoupArr']) ? 1 : 0
                    );

                }

            }


        }


        $content->json = json_encode($data);
        $this->template->content = $content;
	}


}
