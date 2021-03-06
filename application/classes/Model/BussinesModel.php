<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.07.2015
 * Time: 17:48
 */

class Model_BussinesModel extends Model_BaseModel {


    /**
     * @param null $url_category
     * @return mixed
     * todo получаем бизнеси по URL категории
     */
    public function getBussinesCategoryUrl($url_category = null, $limit = null, $num_page = null, $id_city = null){

        $ofset = 0;
        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        }


        //только по категории получаем количество
        $query_count = DB::select('business.*',
            array('category.title', 'CatTitle'),
            array('category.keywords', 'CatKeywords'),
            array('category.description', 'CatDesc'));

        $query_count->from('category');
        $query_count->join('businesscategory');
        $query_count->on('category.id', '=', 'businesscategory.category_id');
        $query_count->join('business');
        $query_count->on('businesscategory.business_id', '=', 'business.id');
        $query_count->join('city', 'LEFT');
        $query_count->on('business.city', '=', 'city.id');
        $query_count->where('category.url', '=', $url_category);
        ////получаем количество записей для пагинации сортировка по городу и категории
        if ($id_city != null) {
            $query_count->and_where('city.id', '=', $id_city);
        }

        $query_count->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'));
        $query_count->and_where('business.status', '=', 1);
        $query_count->order_by('business.date_create', 'DESC');
        $query_count->cached();

        $result1 = $query_count->execute()->as_array();



        //получаем данные
        $query_data = DB::select('business.*',
            array('city.name', 'CityName'),
            array('category.title', 'CatTitle'),
            array('category.keywords', 'CatKeywords'),
            array('category.description', 'CatDesc'));

        $query_data->from('category');
        $query_data->join('businesscategory');
        $query_data->on('category.id', '=', 'businesscategory.category_id');
        $query_data->join('business');
        $query_data->on('businesscategory.business_id', '=', 'business.id');
        $query_data->join('city', 'LEFT');
        $query_data->on('business.city', '=', 'city.id');
        $query_data->where('category.url', '=', $url_category);

        if ($id_city != null) {
            $query_data->and_where('city.id', '=', $id_city);
        }

        $query_data->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'));
        $query_data->and_where('business.status', '=', 1);
        $query_data->limit($limit);
        $query_data->offset($ofset);
        //$query_data->order_by('business.client_status', 'DESC');
        $query_data->order_by('business.date_create', 'DESC');
        $query_data->cached();

        $result = $query_data->execute()->as_array();

        //сортировка по полю тип рекламы
        $result = HTML::multisort($result, 'client_status', 2);

        $city_arr = $this->getCityInCategory($url_category);

        if (!empty($result)) {
            
            $result = $this->SortArrayBusiness($result);

            //вызываем метод получения данных из куки
            Controller_BaseController::favorits_bussines();
            if (!empty(Controller_BaseController::$favorits_bussines)) {

                $new_result = array();
                foreach ($result as $result_row) {

                    if (in_array($result_row['id'], Controller_BaseController::$favorits_bussines)) {
                        $result_row['bussines_favorit'] = 1;
                    }

                    $new_result[] = $result_row;
                }
                $result = $new_result;
            }

            return array('data' => $result, 'count' => count($result1), 'city' => $city_arr);

        } else {
            return array('data' => false, 'count' => false, 'city' => $city_arr);
        }
    }


    /**
     * @param null $url_section
     * @return mixed
     * $adm - переключатель для фильтра по разделам в админке( только для админки ) отключает сортировку по статусу и дате
     * todo получаем все бизнесы из раздела
     */
    public function getBussinesSectionUrl($url_section = null, $limit = null, $num_page = null, $id_city = null, $adm = false, $home = false){

        $ofset = 0;
        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        }

        if ($url_section != null) {

            $category = Model::factory('CategoryModel')->getCategoryInSectionUrl($url_section);

            $arrChild = array();
            foreach ($category[0]['childs'] as $row_cat) {
                $arrChild[] = $row_cat['id'];
            }
        }

        ////получаем количество записей для пагинации сортировка по городу и категориям раздела
        $query_count = DB::select('business.*', array('city.name', 'CityName'));

        $query_count->from('category');
        $query_count->join('businesscategory');
        $query_count->on('category.id', '=', 'businesscategory.category_id');
        $query_count->join('business');
        $query_count->on('businesscategory.business_id', '=', 'business.id');
        $query_count->join('city', 'LEFT');
        $query_count->on('business.city', '=', 'city.id');
        if ($url_section != null) {
            $query_count->where('businesscategory.category_id', 'IN', $arrChild);
        }
        if ($id_city != null) {
            $query_count->and_where('city.id', '=', $id_city);
        }

        if ($adm === false) {
            $query_count->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'));
            $query_count->and_where('business.status', '=', 1);
        }
        $query_count->group_by('business.id');
        $query_count->order_by('business.date_create', 'DESC');
        $query_count->cached();

        $result1 = $query_count->execute()->as_array();


        /**
         * $query data
         */

        //выборка с лимитами тоько по категориям раздела
        $query_data = DB::select('business.*', array('city.name', 'CityName'));

        $query_data->from('category');
        $query_data->join('businesscategory');
        $query_data->on('category.id', '=', 'businesscategory.category_id');
        $query_data->join('business');
        $query_data->on('businesscategory.business_id', '=', 'business.id');
        $query_data->join('city', 'LEFT');
        $query_data->on('business.city', '=', 'city.id');
        if ($url_section != null) {
            $query_data->where('businesscategory.category_id', 'IN', $arrChild);
        }
        //выборка с лимитами по городу и всем категориям раздела
        if ($id_city != null) {
            $query_data->and_where('city.id', '=', $id_city);
        }
        if ($adm === false) {
            $query_data->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'));
            $query_data->and_where('business.status', '=', 1);
        }
        if ($limit != null) {
            $query_data->limit($limit);
        }

        if ($num_page != null) {
            $query_data->offset($ofset);
        }

        $query_data->group_by('business.id');


        $query_data->order_by('business.date_create', 'DESC');
        $query_data->cached();

        $result = $query_data->execute()->as_array();

        //сортировка по полю тип рекламы
        if ($home === false) {
            $result = HTML::multisort($result, 'client_status', 2);
        }

        $city_arr = array();
        if ($url_section != null) {
            $city_arr = $this->getCityInSection($arrChild);
        }

        $result = $this->SortArrayBusiness($result);

        //вызываем метод получения данных из куки
        Controller_BaseController::favorits_bussines();
        //добавляем элемент масива если добавлен в избранное
       // die(HTML::x(Controller_BaseController::$favorits_bussines));
        if (!empty(Controller_BaseController::$favorits_bussines)) {

            $new_result = array();

            foreach ($result as $result_row) {

                if (in_array($result_row['id'], Controller_BaseController::$favorits_bussines)) {
                    $result_row['bussines_favorit'] = 1;
                }

                $new_result[] = $result_row;
            }
            $result = $new_result;

        }

        return array('data' => $result, 'count' => count($result1), 'city' => $city_arr);
    }




    /**
     * @param $url_business
     * @return mixed
     * todo получить бизнес по URL
     */
    public function getBusinessUrl ($url_business){

        //если обьект в кеше то берем оттуда
        if (Cache::instance()->get($url_business) == null) {

            $result = DB::select(array('bus.id', 'BusId'),
                array('bus.name', 'BusName'),
                array('bus.title', 'BusTitle'),
                array('bus.description', 'BusDescription'),
                array('bus.keywords', 'BusKeywords'),
                array('bus.url', 'BusUrl'),

                array('cit.name', 'BusCity'),

                array('bus.address', 'BusAddress'),
                array('bus.tel', 'BusTel'),
                array('bus.schedule', 'BusSchedule'),
                array('bus.maps_cordinate_x', 'BusMapsX'),
                array('bus.maps_cordinate_y', 'BusMapsY'),
                array('bus.dop_address', 'BusDopAddress'),
                array('bus.services', 'BusServices'),
                array('bus.logo', 'BusLogo'),
                array('bus.website', 'BusWebsite'),
                array('bus.video', 'BusVideo'),
                array('bus.info', 'BusInfo'),
                array('bus.file_meny', 'BusFileMeny'),
                array('bus.status_subscribe', 'BusStatSubscribe'),
                array('bus.client_status', 'BusClientStatus'),
                array('bus.date_create', 'BusDateCreate'),
                array('bus.date_end', 'BusDateEnd'),

                array('artic.id', 'ArticId'),
                array('artic.name', 'ArticName'),
                array('artic.secondname', 'ArticSecondName'),
                array('artic.url', 'ArticUrl'),
                array('artic.images_article', 'ArticImage'),
                array('artic.content', 'ArticContent'),
                array('artic.datecreate', 'ArticDatecreate'),

                array('new.id', 'NewsId'),
                array('new.name', 'NewsName'),
                array('new.text', 'NewsText'),
                array('new.date', 'NewsDate'),
                array('new.img', 'NewsImg'),

                array('cat.name', 'CatName'),
                array('cat.id', 'CatId'),
                array('cat.url', 'CatUrl'),
                array('cat.parent_id', 'CatParentId'),

                array('coup.name', 'CoupName'),
                array('coup.id', 'CoupId'),
                array('coup.url', 'CoupUrl'),
                array('coup.info', 'CoupInfo'),
                array('coup.img_coupon', 'CoupImg'),
                array('coup.tags', 'CoupTags'),
                array('coup.secondname', 'CoupSecondname'),
                array('coup.dateoff', 'DateOff'),
                array('coup.datestart', 'DateStart'),

                array('topslider.id', 'TopsliderId'),
                array('topslider.img_path', 'TopsliderImg'),

                array('galry.id', 'GalryId'),
                array('galry.name', 'GalryName'),
                array('galry.galery_text', 'GalryDesk'),

                array('file.id', 'FileId'),
                array('file.filename', 'FileFilename'),
                array('file.title', 'FileTitle'),
                array('file.gallery', 'FileGaleryId'),

                array('tag.id', 'TagId'),
                array('tag.name_tags', 'TagName'),
                array('tag.url_tags', 'TagUrl')

            )

                ->from(array('business', 'bus'))
                //купоны
                ->join(array('coupon', 'coup') , 'LEFT')
                ->on('bus.id', '=', 'coup.business_id')
                //связаная таблица категорий
                ->join(array('businesscategory', 'buscat'), 'LEFT')
                ->on('bus.id', '=', 'buscat.business_id')
                //категории
                ->join(array('category', 'cat'), 'LEFT')
                ->on('buscat.category_id','=', 'cat.id')
                //верхний слайдер
                ->join(array('top_slider_bussines', 'topslider'), 'LEFT')
                ->on('bus.id', '=', 'topslider.bussines_id')
                //гадереи
                ->join(array('gallery', 'galry'), 'LEFT')
                ->on('bus.id', '=', 'galry.business_id')
                //картинки галерей
                ->join(array('files', 'file'), 'LEFT')
                ->on('galry.id', '=', 'file.gallery')
                //город
                ->join(array('city', 'cit'), 'LEFT')
                ->on('bus.city', '=', 'cit.id')
                //новости
                ->join(array('news', 'new'), 'LEFT')
                ->on('bus.id', '=', 'new.bussines_id')
                //теги
                ->join(array('tags_relation_business', 'tagrelbus'), 'LEFT')
                ->on('bus.id', '=', 'tagrelbus.id_business' )
                ->join(array('tags', 'tag'), 'LEFT')
                ->on('tag.id', '=', 'tagrelbus.id_tags')

                //связаная таблица обзоров и бизнесов для определения привязаных к бизнесу обзоров
                ->join(array('articles_relation_business', 'artrelbus'), 'LEFT')
                ->on('bus.id', '=', 'artrelbus.id_business')

                //обзоры
                ->join(array('articles', 'artic'), 'LEFT')
                ->on('artrelbus.id_articles', '=', 'artic.id')


                ->where('bus.url', '=', $url_business)

                ->and_where('bus.status', '=', 1)
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('bus.date_create AND bus.date_end'))
                ->order_by('artic.id', 'DESC')

                ->cached()
                ->execute()->as_array();

            //получаем преобразованый масив
            $end_result = $this->CreateArrayBussines($result);
            //кешируем
            Cache::instance()->set($url_business, $end_result);
        } else {
            $end_result = Cache::instance()->get($url_business);
        }

        //вызываем метод получения данных из куки
        Controller_BaseController::favorits_bussines();
        if (!empty(Controller_BaseController::$favorits_bussines)) {

            if (in_array($end_result['BusId'], Controller_BaseController::$favorits_bussines)) {
                $end_result['bussines_favorit'] = 1;
            }

        }

        Cache::instance()->delete($url_business);

        return $end_result;
    }






    /**
     * @param $result
     * @return array
     * todo формирование двумерного масива карточки бизнеса
     */
    private function CreateArrayBussines ($result){

        if (!empty($result)) {

            $FileArr = array();
            $end_result = array();
            $CatTmp = array();
            $CoupTmp = array();
            $TopsTmp = array();
            $GalryTmp = array();
            $FileTmp = array();
            $ArticTmp = array();
            $NewsTmp = array();
            $TagsTmp = array();

            $end_result['BusId'] = $result[0]['BusId'];
            $end_result['BusName'] = $result[0]['BusName'];
            $end_result['BusUrl'] = $result[0]['BusUrl'];
            $end_result['BusLogo'] = $result[0]['BusLogo'];
            $end_result['BusWebsite'] = $result[0]['BusWebsite'];
            $end_result['BusVideo'] = $result[0]['BusVideo'];
            $end_result['BusInfo'] = $result[0]['BusInfo'];
            $end_result['BusTitle'] = $result[0]['BusTitle'];
            $end_result['BusDescription'] = $result[0]['BusDescription'];
            $end_result['BusKeywords'] = $result[0]['BusKeywords'];
            $end_result['BusFileMeny'] = $result[0]['BusFileMeny'];
            $end_result['BusAddress'] = $result[0]['BusAddress'];
            $end_result['BusTel'] = $result[0]['BusTel'];
            $end_result['BusSchedule'] = $result[0]['BusSchedule'];
            $end_result['BusMapsX'] = $result[0]['BusMapsX'];
            $end_result['BusMapsY'] = $result[0]['BusMapsY'];
            $end_result['BusCity'] = $result[0]['BusCity'];
            $end_result['BusStatSubscribe'] = $result[0]['BusStatSubscribe'];
            $end_result['BusClientStatus'] = $result[0]['BusClientStatus'];
            $end_result['BusDateCreate'] = $result[0]['BusDateCreate'];
            $end_result['BusDateEnd'] = $result[0]['BusDateEnd'];


            $category = Model::factory('CategoryModel')->get_section('category');


            //парсим адрес
            try {
                $end_result['BusDopAddress'] = unserialize($result[0]['BusDopAddress']);
            } catch (Exception $x) {
                $end_result['BusDopAddress'] = array();
            }


            if (!empty($result[0]['BusServices'])) {
                $services = explode("\n", $result[0]['BusServices']);
                $end_result['BusServicesArr'] = $services;
            } else {
                $end_result['BusServicesArr'] = array();
            }


            foreach ($result as $name_key => $row) {


                //категории
                if (!array_key_exists($row['CatId'], $CatTmp)) {
                    $CatTmp[$row['CatId']] = $row['CatId'];
                    //ищем раздел к которому принадлежит категория и формируем ссылку для карточки бизнеса
                    foreach ($category as $row_category) {
                        if ($row_category['id'] == $row['CatParentId']) {
                            $row['CatUrl2'] = $row['CatUrl'];
                            $row['CatUrl'] = $row_category['url'] . '/' . $row['CatUrl'];
                        }
                    }

                    $end_result['CatArr'][] = array('CatId' => $row['CatId'], 'CatName' => $row['CatName'], 'CatUrl' => $row['CatUrl'], 'CatUrl2' => $row['CatUrl2'], 'CatParentId' => $row['CatParentId']);

                }

                //теги
                if (!empty($row['TagId'])) {
                    if (!array_key_exists($row['TagId'], $TagsTmp)) {
                        $TagsTmp[$row['TagId']] = $row['TagId'];
                        $end_result['TagArr'][] = array('TagId' => $row['TagId'], 'TagName' => $row['TagName'], 'TagUrl' => $row['TagUrl']);
                    }
                } else {
                    $end_result['TagArr'] = array();
                }

                //купоны

                if (!empty($row['CoupId'])) {

                    if (!array_key_exists($row['CoupId'], $CoupTmp)) {

                        if ($row['DateOff'] > date('Y-m-d') && $row['DateStart'] <= date('Y-m-d')) {

                            $CoupTmp[$row['CoupId']] = $row['CoupId'];
                            $end_result['CoupArr'][] = array('CoupId' => $row['CoupId'],
                                'CoupName' => $row['CoupName'],
                                'CoupSecondname' => $row['CoupSecondname'],
                                'CoupUrl' => $row['CoupUrl'],
                                'CoupInfo' => $row['CoupInfo'],
                                'CoupImg' => $row['CoupImg'],
                                'DateOff' => $row['DateOff'],
                                'CoupTags' => $row['CoupTags']
                            );

                        } else {

                            if (empty($end_result['CoupArr'])) {
                                $end_result['CoupArr'] = array();
                            }

                        }
                    }

                } else {
                    $end_result['CoupArr'] = array();
                }

                //верхний слайдер бизнеса
                if (!empty($row['TopsliderId'])) {
                    if (!array_key_exists($row['TopsliderId'], $TopsTmp)) {
                        $TopsTmp[$row['TopsliderId']] = $row['TopsliderId'];
                        $end_result['TopsArr'][] = array('TopsliderId' => $row['TopsliderId'], 'TopsliderImg' => $row['TopsliderImg']);
                    }
                } else {
                    $end_result['TopsArr'] = array();
                }

                //галереи
                if (!empty($row['GalryId'])) {
                    if (!array_key_exists($row['GalryId'], $GalryTmp)) {

                        foreach ($result as $row_file) {
                            if (!array_key_exists($row_file['FileId'], $FileTmp) && ($row['GalryId'] == $row_file['FileGaleryId'])) {
                                $FileTmp[$row_file['FileId']] = $row_file['FileId'];
                                $FileArr[] = array('FileFilename' => $row_file['FileFilename'], 'FileTitle' => $row_file['FileTitle'], 'FileId' => $row_file['FileId']);

                            }
                        }

                        $GalryTmp[$row['GalryId']] = $row['GalryId'];
                        $end_result['GalryArr'][] = array('GalryId' => $row['GalryId'], 'GalryName' => $row['GalryName'], 'GalryDesk' => $row['GalryDesk'],
                            'FileArr' => $FileArr);
                        $FileArr = array();
                    }
                } else {
                    $end_result['GalryArr'] = array();
                }

                //обзоры
                if (!empty($row['ArticId'])) {
                    if (!array_key_exists($row['ArticId'], $ArticTmp)) {
                        $ArticTmp[$row['ArticId']] = $row['ArticId'];
                        $end_result['ArticArr'][] = array('ArticId' => $row['ArticId'],
                            'ArticName' => $row['ArticName'],
                            'ArticSecondName' => $row['ArticSecondName'],
                            'ArticUrl' => $row['ArticUrl'],
                            'ArticImage' => $row['ArticImage'],
                            'ArticContent' => $row['ArticContent'],
                            'ArticDatecreate' => $row['ArticDatecreate']);

                    }
                } else {
                    $end_result['ArticArr'] = array();
                }


                //новости скрещиваем с статьями они будут отображатся в одном списке
                if (!empty($row['NewsId'])) {
                    if (!array_key_exists($row['NewsId'], $NewsTmp)) {
                        $NewsTmp[$row['NewsId']] = $row['NewsId'];
                        $end_result['NewsArr'][] = array('ArticId' => $row['NewsId'],
                            'ArticName' => $row['NewsName'],
                            'ArticContent' => $row['NewsText'],
                            'ArticUrl' => '',
                            'ArticSecondName' => '',
                            'ArticDatecreate' => $row['NewsDate'],
                            'ArticImage' => $row['NewsImg'],
                            'news' => 1);

                    }
                } else {
                    $end_result['NewsArr'] = array();
                }


            }

            //вызываем метод получения данных из куки
            Controller_BaseController::favorits_coupon();
            //добавляем элемент масива если добавлен в избранное
            if (!empty(Controller_BaseController::$favorits_coupon)) {
                // die(HTML::x(Controller_BaseController::$favorits_bussines));
                $new_result = array();
                foreach ($end_result['CoupArr'] as $result_row) {

                    if (in_array($result_row['CoupId'], Controller_BaseController::$favorits_coupon)) {
                        $result_row['coupon_favorit'] = 1;
                    }
                    $new_result[] = $result_row;
                }
                $end_result['CoupArr'] = $new_result;
            }

        } else {
            return false;
        }

        return $end_result;
    }


    /**
     * @param $arrChild
     * @param $id_city
     * @return array
     * todo метод получаем список городов во всех категориях раздела
     */
    public function getCityInSection ($arrChild = null, $adm = false){

        $query_data = DB::select('business.*', array('city.name', 'CityName'));
        $query_data->from('category');
        $query_data->join('businesscategory');
        $query_data->on('category.id', '=', 'businesscategory.category_id');
        $query_data->join('business');
        $query_data->on('businesscategory.business_id', '=', 'business.id');
        $query_data->join('city', 'LEFT');
        $query_data->on('business.city', '=', 'city.id');

        if ($arrChild != null) {
            $query_data->where('businesscategory.category_id', 'IN', $arrChild);
            $query_data->and_where('business.city', '<>', 0);
        }

        if ($adm === false) {
            $query_data->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'));
            $query_data->and_where('business.city', '<>', 0);
            $query_data->and_where('business.status', '=', 1);
        }

        $query_data->group_by('business.id');
        $query_data->order_by('business.id', 'DESC');
        $query_data->cached();


        $result1 = $query_data->execute()->as_array();

        $city_arr = array();
        foreach ($result1 as $row_city) {
            if ($row_city['city'] != '') {
                $city_arr[$row_city['city']] = $row_city['CityName'];
            }
        }

        return $city_arr;
    }

    /**
     * @param $url_category
     * @return array
     * todo получаем список городов по урлу категории
     */
    public function getCityInCategory ($url_category){

        $result1 = DB::select('business.*', array('city.name', 'CityName'))
            ->from('category')
            ->join('businesscategory')
            ->on('category.id', '=', 'businesscategory.category_id')
            ->join('business')
            ->on('businesscategory.business_id', '=', 'business.id')
            ->join('city', 'LEFT')
            ->on('business.city', '=', 'city.id')
            ->where_open()
                ->where('category.url', '=', $url_category)
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'))
                ->and_where('business.city', '<>', 0)
                ->and_where('business.status', '=', 1)
            ->where_close()
            ->cached()
            ->execute()->as_array();

        $city_arr = array();
        foreach ($result1 as $row_city) {
            if ($row_city['city'] != '') {
                $city_arr[$row_city['city']] = $row_city['CityName'];
            }
        }

        return $city_arr;
    }

    /**
     * @param int $limit
     * @return mixed
     * todo Получение последних добавленых бизнесов
     */
    public function getBusinessAfter($limit = 10){
        return DB::select()
            ->from('business')
            ->where('status', '=', 1)
            ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('date_create AND date_end'))
            ->order_by('id', 'DESC')
            ->limit($limit)
            ->cached()
            ->execute()->as_array();
    }


    /**
     * @return mixed
     * todo получить все включенные активные бизнесы
     */
    public function getBusinessAll(){
        return DB::select(
            array('business.id', 'BusId'),
            array('business.name', 'BusName'),
            array('business.url', 'BusUrl'),
            array('business.date_update_bussines', 'BusDateUpdate'),
            array('users.email', 'RedactorEmail')
        )
            ->from('business')
            ->join('users')
            ->on('business.redactor_user', '=', 'users.id')
            ->where('business.status', '=', 1)
            ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'))
            ->order_by('business.id', 'DESC')
            ->cached()
            ->execute()->as_array();
    }


    /*
     * todo обновление поля состояния бизнеса время последнего обновления
     */
    public function setUpdateBussinesChange($bussines_id){
        DB::update('business')->set(array('date_update_bussines' => date('Y-m-d')))
            ->where('id', 'IN', $bussines_id)
            ->execute();
    }


    /**
     * @param $id_bussines
     * @return mixed
     * todo получить бизнесы IN по id
     */
    public function getBussinesId($id_bussines){

        return DB::select()
            ->from('business')
            ->where_open()
                ->where('id', 'IN', $id_bussines)
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('date_create AND date_end'))
                ->and_where('status', '=', 1)
            ->where_close()
            ->execute()->as_array();
    }

    /**
     * @param $id_user
     * @param $id_bussines
     * @return string
     * @throws Kohana_Exception
     * todo сохраняем бизнес в избранное пользователя
     */
    public function saveBussinesFavoritesUser($id_user, $id_bussines){
        $query = DB::insert('users_relation_favorites_bus', array('user_id', 'business_id'))
            ->values(array($id_user, $id_bussines))->execute();
        return json_encode($query);
    }


    /**
     * @param $id_bussines
     * todo удалить бизнесы из избранного пользователя
     */
    public function deleteBussinesFavoritesUser ($id_bussines){
        $id_user = Auth::instance()->get_user()->id;
        DB::delete('users_relation_favorites_bus')
            ->where('user_id', '=', $id_user)
            ->and_where('business_id', '=', $id_bussines)
            ->execute();
    }


    /**
     * @param $user_id
     * @return mixed
     * todo получить избранные бизнесы по id пользователя
     */
    public function getBussinesFavoritesUserId ($user_id){

        $query = DB::select('business_id')
            ->from('users_relation_favorites_bus')
            ->where('user_id', '=', $user_id)
            ->execute()->as_array();

        if (!empty($query)) {
            $result = array();
            foreach ($query as $row) {
                $result[] = $row['business_id'];
            }

            return $result;
        } else {
            return false;
        }
    }



    /**
     * МЕТОДЫ ВЫБОРКИ ПО ТЕГАМ
     */


    /**
     * @param $url_category
     * @param null $url_tags
     * @param null $limit
     * @param null $num_page
     * @return array
     * todo ПОЛУЧАЕМ БИЗНЕСЫ ГРУППЫ ЛАКШЕРИ (СОРТИРОВКА ПО ТЕГАМ И КАТЕГОРИЯМ)
     */
    public function getBussinesCategoryTagsUrl ($url_category, $url_tags = null, $limit = null){

        //die(HTML::x($url_tags));

        $result = DB::select('bus.*',
            array('tag.name_tags', 'TagName'),
            array('city.name', 'CityName')
        )
            ->from(array('category', 'cat'))

            ->join(array('businesscategory', 'buscat'))
            ->on('cat.id', '=', 'buscat.category_id')

            ->join(array('business', 'bus'))
            ->on('buscat.business_id', '=', 'bus.id')

            ->join(array('tags_relation_business', 'tagrelbus'))
            ->on('tagrelbus.id_business', '=', 'bus.id')

            ->join(array('tags', 'tag'))
            ->on('tag.id', '=', 'tagrelbus.id_tags')

            ->join('city', 'LEFT')
            ->on('bus.city', '=', 'city.id')
            ->where_open()
                ->where('tag.url_tags', '=', $url_tags)
                ->and_where('cat.url', '=', $url_category)
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('bus.date_create AND bus.date_end'))
                ->and_where('bus.status', '=', 1)
            ->where_close()
            ->limit($limit)
            ->cached()
            ->execute()->as_array();

        //вызываем метод получения данных из куки
        Controller_BaseController::favorits_bussines();
        if (!empty(Controller_BaseController::$favorits_bussines)) {

            $new_result = array();
            foreach ($result as $result_row) {

                if (in_array($result_row['id'], Controller_BaseController::$favorits_bussines)) {
                    $result_row['bussines_favorit'] = 1;
                }
                $new_result[] = $result_row;
            }
            $result = $new_result;
        }

        return array('data' => $result);
    }


    /**
     * @param $url_section
     * @param $url_tags
     * @param null $limit
     * @return array
     * todo ПОЛУЧАЕМ БИЗНЕСЫ ГРУППЫ ЛАКШЕРИ (СОРТИРОВКА ПО ТЕГАМ И РАЗДЕЛАМ)
     */
    public function getBussinesSectionTagsUrl ($url_section, $url_tags){

        $category = Model::factory('CategoryModel')->getCategoryInSectionUrl($url_section);

        $arrChild = array();
        foreach ($category[0]['childs'] as $row_cat) {
            $arrChild[] = $row_cat['id'];
        }

        $result = DB::select('bus.*', array('city.name', 'CityName'))
            ->from(array('category', 'cat'))

            ->join(array('businesscategory', 'buscat'))
            ->on('cat.id', '=', 'buscat.category_id')

            ->join(array('business', 'bus'))
            ->on('buscat.business_id', '=', 'bus.id')

            ->join(array('tags_relation_business', 'tagrelbus'))
            ->on('tagrelbus.id_business', '=', 'bus.id')

            ->join(array('tags', 'tag'))
            ->on('tag.id', '=', 'tagrelbus.id_tags')

            ->join('city', 'LEFT')
            ->on('bus.city', '=', 'city.id')
            ->where_open()
                ->where('tag.url_tags', '=', $url_tags)
                ->and_where('buscat.category_id', 'IN', $arrChild)
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('bus.date_create AND bus.date_end'))
                ->and_where('bus.status', '=', 1)
            ->where_close()
            ->group_by('bus.id')
            ->order_by('bus.id', 'DESC')
            ->cached()
            ->execute()->as_array();

        //вызываем метод получения данных из куки
        Controller_BaseController::favorits_bussines();
        if (!empty(Controller_BaseController::$favorits_bussines)) {

            $new_result = array();
            foreach ($result as $result_row) {

                if (in_array($result_row['id'], Controller_BaseController::$favorits_bussines)) {
                    $result_row['bussines_favorit'] = 1;
                }

                $new_result[] = $result_row;
            }
            $result = $new_result;

        }

        return array('data' => $result);
    }

    /**
     * @return mixed
     * todo получить все бизнесы пользователей для рассылки
     */
    public function getBusinesUserAll(){

        $query = DB::select()
            ->from('users')
            ->join('business')
            ->on('users.business_id','=','business.id')
            ->where('business.status', '=', 1)
            ->and_where('client_status', '<>', 4)
            ->execute()->as_array();

        $query2 = DB::select()
            ->from('users')
            ->execute()->as_array();

        $result = array();
        foreach ($query as $rows) {
            foreach ($query2 as $rows2) {
                if ($rows2['id'] == $rows['redactor_user']) {
                    $rows['EmailRedactor'] =  $rows2['email'];

                }
                if ($rows['id'] == $rows2['business_id']) {
                    $rows['UsersEmailManager'] =  $rows2['email_manager'];
                    $rows['UsersEmailBugalter'] =  $rows2['email_bugalter'];
                    $rows['UsersName'] =  $rows2['name'];
                    $rows['UsersSecondname'] =  $rows2['secondname'];
                }
            }
            $result[] = $rows;
        }

        return $result;
    }

    /**
     * @return array
     * todo выборка всех бизнесов для карты по id бизнеса по url категории, url раздела
     */
    public function getBusinessAll_Maps($id = null, $url_category = null, $url_section = null){


        if ($url_section != null) {
            $category = Model::factory('CategoryModel')->getCategoryInSectionUrl($url_section);

            if ($category === false) {
                throw new HTTP_Exception_404;
            }

            $arrChild = array();
            foreach ($category[0]['childs'] as $row_cat) {
                $arrChild[] = $row_cat['id'];
            }
        }

        $query =  DB::select(
            array('bus.id', 'BusId'),
            array('bus.name', 'BusName'),
            array('bus.url', 'BusUrl'),
            array('bus.city', 'BusCity'),
            array('bus.schedule', 'BusSchedule'),
            array('bus.tel', 'BusTel'),
            array('bus.address', 'BusAddress'),
            array('bus.dop_address', 'BusDopAddress'),
            array('bus.maps_cordinate_x', 'BusMapsX'),
            array('bus.maps_cordinate_y', 'BusMapsY'),
            array('bus.dop_address', 'BusDopAddress'),
            array('bus.logo', 'BusLogo'),
            array('bus.website', 'BusWebsite'),
            array('bus.tags', 'BusTags'),

            array('tag.name_tags','TagsName'),
            array('tag.url_tags','TagsUrl'),

            array('cat.name', 'CatName'),
            array('cat.id', 'CatId'),
            array('cat.url', 'CatUrl'),
            array('cat.parent_id', 'CatParentId'),


            array('coup.name', 'CoupName'),
            array('coup.id', 'CoupId'),
            array('coup.url', 'CoupUrl'),
            array('coup.info', 'CoupInfo'),
            array('coup.img_coupon', 'CoupImg'),
            array('coup.secondname', 'CoupSecondname')

        );

        $query->from(array('business', 'bus'));

        $query->join(array('coupon', 'coup') , 'LEFT');
        $query->on('bus.id', '=', 'coup.business_id');
        //связаная таблица категорий
        $query->join(array('businesscategory', 'buscat'), 'LEFT');
        $query->on('bus.id', '=', 'buscat.business_id');
        //категории
        $query->join(array('category', 'cat'), 'LEFT');
        $query->on('buscat.category_id','=', 'cat.id');

        $query->join(array('tags_relation_business', 'tagrelbus'), 'LEFT');
        $query->on('bus.id', '=', 'tagrelbus.id_business');

        $query->join(array('tags', 'tag'), 'LEFT');
        $query->on('tag.id', '=', 'tagrelbus.id_tags');
        $query->where_open();
            $query->where('bus.maps_cordinate_x', '<>', '');
            if ($id != null) {
                $query->and_where('bus.id', '=', $id);
            }

            if ($url_category != null) {
                $query->and_where('cat.url', '=', $url_category);
            }

            if ($url_section != null) {
                $query->and_where('buscat.category_id', 'IN', $arrChild);
            }
            $query->and_where('bus.maps_cordinate_y', '<>', '');
            $query->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('bus.date_create AND bus.date_end'));
            $query->and_where('bus.status', '=', 1);
        $query->where_close();
        $result_query = $query->execute()->as_array();

        if (!empty($result_query)) {
            $result = $this->CreareArrayBusinessMaps($result_query);

            //die(HTML::x( $result));
            Controller_BaseController::favorits_bussines();
            if (!empty(Controller_BaseController::$favorits_bussines)) {

                $new_result = array();
                foreach ($result as $result_row) {

                    if (in_array($result_row['BusId'], Controller_BaseController::$favorits_bussines)) {
                        $result_row['bussines_favorit'] = 1;
                    }
                    $new_result[] = $result_row;
                }
                $result = $new_result;
            }

            return $result;

        } else {
            return array();
        }
    }

    /**
     * @param $result
     * @return array
     * todo формирование масива для вывода на карте бизнесов
     */
    public function CreareArrayBusinessMaps ($result){

        $end_result = array();
        $CatTmp = array();
        $CoupTmp = array();
        $end_result_new = array();
        $BusTmp = array();

        //если обьект в кеше то берем оттуда
        if (Cache::instance()->get('BusinesMaps') == null) {


            $category = Model::factory('CategoryModel')->get_section('category');

            foreach ($result as $name_key => $row) {

                if (!array_key_exists($row['BusId'], $BusTmp)) {

                    $BusTmp[$row['BusId']] = $row['BusId'];

                    $end_result['BusId'] = $row['BusId'];
                    $end_result['BusName'] = $row['BusName'];
                    $end_result['BusUrl'] = $row['BusUrl'];
                    $end_result['BusSchedule'] = $row['BusSchedule'];
                    $end_result['BusTel'] = $row['BusTel'];
                    $end_result['BusTags'] = $row['BusTags'];
                    $end_result['BusLogo'] = $row['BusLogo'];
                    $end_result['BusWebsite'] = $row['BusWebsite'];
                    $end_result['BusAddress'] = $row['BusAddress'];
                    $end_result['BusMapsX'] = $row['BusMapsX'];
                    $end_result['BusMapsY'] = $row['BusMapsY'];
                    $end_result['BusCity'] = $row['BusCity'];

                    $end_result['TagsName'] = $row['TagsName'];
                    $end_result['TagsUrl'] = $row['TagsUrl'];

                    //парсим адрес
                    try {
                        $end_result['BusDopAddress'] = unserialize($row['BusDopAddress']);
                    } catch (Exception $x) {
                        $end_result['BusDopAddress'] = array();
                    }

                    //категории
                    if (!array_key_exists($row['CatId'], $CatTmp)) {
                        $end_result['CatArr'] = array();
                        $CatTmp[$row['CatParentId']] = $row['CatParentId'];
                        //ищем раздел к которому принадлежит бизнес
                        foreach ($category as $row_category) {
                            if ($row_category['id'] == $row['CatParentId']) {
                                $row['CatUrl'] = $row_category['url'];
                                $row['CatName'] = $row_category['name'];
                                //$row['CatIcon'] = $row_category['icons_maps'];
                            }
                        }

                        $end_result['CatArr'][] = array('CatId' => $row['CatParentId'], 'CatName' => $row['CatName'], 'CatUrl' => $row['CatUrl']);
                    }


                    //купоны
                    if (!empty($row['CoupId'])) {
                        if (!array_key_exists($row['CoupId'], $CoupTmp)) {
                            $CoupTmp[$row['CoupId']] = $row['CoupId'];
                            $end_result['CoupArr'][] = array('CoupId' => $row['CoupId'], 'CoupSecondname' => $row['CoupSecondname'],
                                'CoupUrl' => $row['CoupUrl'],
                                'CoupInfo' => $row['CoupInfo'],
                                'CoupImg' => $row['CoupImg']
                            );
                        }
                    } else {
                        $end_result['CoupArr'] = array();
                    }

                    $end_result_new[] = $end_result;
                }

            }
            Cache::instance()->set('BusinesMaps', $end_result_new);

        } else {
            $end_result_new = Cache::instance()->get('BusinesMaps');
        }
        Cache::instance()->delete('BusinesMaps');
        return $end_result_new;
    }


    /**
     * @param $url_category
     * @return array
     * todo получаем похожие бизнесы для карточки бизнеса
     */
    public function getBusinessRelated($url_category, $bus_not_id) {

        $result = DB::select('business.*', array('city.name', 'CityName'))
            ->from('category')
            ->join('businesscategory')
            ->on('category.id', '=', 'businesscategory.category_id')
            ->join('business')
            ->on('businesscategory.business_id', '=', 'business.id')
            ->join('city', 'LEFT')
            ->on('business.city', '=', 'city.id')
            ->where_open()
                ->where('category.url', '=', $url_category)
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'))
                ->and_where('business.id', '<>', $bus_not_id)
                ->and_where('business.status', '=', 1)
            ->where_close()
            ->cached()
            ->execute()->as_array();

        if (!empty($result)) {
            //вызываем метод получения данных из куки
            Controller_BaseController::favorits_bussines();
            if (!empty(Controller_BaseController::$favorits_bussines)) {

                $new_result = array();
                foreach ($result as $result_row) {

                    if (in_array($result_row['id'], Controller_BaseController::$favorits_bussines)) {
                        $result_row['bussines_favorit'] = 1;
                    }

                    $new_result[] = $result_row;
                }
                $result = $new_result;
            }

            $resultNew = array();
            if (count($result) <= 4) {
                $resultNew = $result;
            } else {
                $key_rand = array_rand($result, 4);
                foreach ($key_rand as $row) {
                    $resultNew[] = $result[$row];
                }
            }


        } else {
            $resultNew = array();
        }

        return $resultNew;

    }

    /**
     * @param $id_business
     * todo отключить бизнес по id
     */
    public function disableBusines($id_business){

        if (is_array($id_business)) {
            DB::update('business')
                ->set(array('status' => 0))
                ->where('id', 'IN', $id_business)
                ->execute();
        } else {
            DB::update('business')
                ->set(array('status' => 0))
                ->where('id', '=', $id_business)
                ->execute();
        }
    }

    /**
     * @return mixed
     * todo получить бизнесы для отключения с прострочеными датами
     */
    public function getBusinesDateDisable (){
         return DB::select('id')
            ->from('business')
            ->where('status', '=', 1)
            ->and_where(DB::expr('DATE(NOW())'), '>=', DB::expr('business.date_end'))
            ->execute()->as_array();
    }

    /**
     * @param $data
     * @return array
     * todo сортировка масива бизнесов премиумов и стандарт
     */
    private function SortArrayBusiness($data){

        $premium_result = array();
        $result = array();
        foreach ($data as $row) {

            if ($row['client_status'] == 2) {
                $premium_result[] = $row;
            } else {
                $result[] = $row;
            }
        }

        shuffle($premium_result);

        $result = array_merge($premium_result, $result);
        return $result;

    }


    /**
     * @return array
     * todo получаем банеры для отправки писем о окончании или старте
     */
    public function getBannersUser (){

        $query = DB::select(array('users.email', 'UserEmail'),
            array('users.email_manager', 'UsersEmailManager'),
            array('users.email_bugalter', 'UsersEmailBugalter'),
            array('users.name', 'UsersName'),
            array('users.secondname', 'UsersSecondname'),
            array('banners.id', 'BanersId'),
            array('banners.date_start', 'BanersDateStart'),
            array('banners.date_end', 'BanersDateEnd'),
            array('business.redactor_user', 'BusIdRedactor'),
            array('business.name', 'BusName')

        )
            ->from('banners')

            ->join('business')
            ->on('banners.business_id','=','business.id')

            ->join('users')
            ->on('business.id','=','users.business_id')

            ->where('business.status', '=', 1)
            ->execute()->as_array();


        $query2 = DB::select()
            ->from('users')
            ->execute()->as_array();

        $banerId = array();
        $result = array();
        foreach ($query as $rows) {
            foreach ($query2 as $rows2) {
                if ($rows2['id'] == $rows['BusIdRedactor']) {
                    $banerId[] = $rows['BanersId'];
                    $rows['EmailRedactor'] =  $rows2['email'];
                }
            }
            $result[] = $rows;
        }

        //получаем урлы разделов в которых есть банеры
        $baner_section = DB::select('banners_relation_section.*', array('category.url', 'sectionUrl'))
            ->from('banners_relation_section')
            ->join('category')
            ->on('banners_relation_section.section_id', '=', 'category.id')
            ->where('banners_relation_section.banners_id', 'IN', $banerId)
            ->execute()->as_array();

        //получаем урли категорий в которых есть банеры
        $baner_category = DB::select('banners_relation.*', array('category.url', 'categoryUrl'))
            ->from('banners_relation')
            ->join('category')
            ->on('banners_relation.category_id', '=', 'category.id')
            ->where('banners_relation.banners_id', 'IN', $banerId)
            ->execute()->as_array();


        $recurs = Model::factory('CategoryModel')->recurs_catalog();

        $result_new = array();
        foreach ($result as $item) {

            $section_baner = array();
            $category_baner = array();

            if (!empty($baner_section)) {
                foreach ($baner_section as $item_section_baner) {
                    if ($item['BanersId'] == $item_section_baner['banners_id']) {
                        $section_baner[] = $item_section_baner;
                    }
                }
            }


            if (!empty($baner_category)) {
                foreach ($baner_category as $item_category_baner) {
                    if ($item['BanersId'] == $item_category_baner['banners_id']) {
                        $item_category_baner['categoryUrl'] = $this->SectionURLCategoryJoin($recurs, $item_category_baner['category_id']);
                        $category_baner[] = $item_category_baner;
                    }
                }
            }

            $item['CATEGORY'] = $category_baner;
            $item['SECTION'] = $section_baner;
            $result_new[] = $item;
        }


        return $result_new;
    }

    //метод создаем ссылку раздел категория по id категории
    private function SectionURLCategoryJoin($recurs, $category_id){

        foreach ($recurs as $rows) {

            if (!empty($rows['childs'])) {
                foreach ($rows['childs'] as $child) {
                    if ($child['id'] == $category_id) {
                        return $rows['url'].'/'.$child['url'];
                    }
                }
            }

        }

    }


    /**
     * @return array
     * todo получаем купоны для отправки писем о окончании или старте
     */
    public function getCouponsUser (){

        $query = DB::select(array('users.email', 'UserEmail'),
            array('users.email_manager', 'UsersEmailManager'),
            array('users.email_bugalter', 'UsersEmailBugalter'),
            array('users.name', 'UsersName'),
            array('users.secondname', 'UsersSecondname'),
            array('coupon.datestart', 'CouponsDateStart'),
            array('coupon.dateoff', 'CouponsDateEnd'),
            array('coupon.url', 'CouponsUrl'),
            array('business.redactor_user', 'BusIdRedactor'),
            array('business.id', 'BusId'),
            array('business.name', 'BusName')
        )
            ->from('coupon')

            ->join('business')
            ->on('coupon.business_id','=','business.id')

            ->join('users')
            ->on('business.id','=','users.business_id')

            ->where('business.status', '=', 1)
            ->execute()->as_array();



        $query2 = DB::select()
            ->from('users')
            ->execute()->as_array();

        $result = array();
        foreach ($query as $rows) {
            foreach ($query2 as $rows2) {
                if ($rows2['id'] == $rows['BusIdRedactor']) {
                    $rows['EmailRedactor'] =  $rows2['email'];
                }
            }
            $result[] = $rows;
        }

        return $result;
    }


    public function cityAcountBusines (array $city_array){

        return DB::select()
            ->from('city')
            ->where('name','IN', $city_array)
            ->and_where('parent_id','<>', '0')
            ->cached()
            ->execute()->as_array();
    }


    /**
     * @param int $limit
     * @return array
     * todo получаем список городов для блока с права по заполнености
     */
    public function getCityListBlocRight($limit = 9, $all_city = false){

        $query = DB::select(array(DB::expr('COUNT(city.id)'), 'total'),
            array('city.id', 'cityId'),
            array('city.name', 'cityName'),
            array('city.url', 'cityUrl')
        )
            ->from('city')
            ->join('business')
            ->on('city.id', '=', 'business.city')
            ->where('city.url', '<>', '')
            ->group_by('city.id')
            ->order_by('total', 'DESC')
            ->cached()
            ->execute()->as_array();

        if ($all_city === false) {
            $result = array();
            if (count($query) > $limit) {
                $general = array_slice($query, 0, $limit);
                $result = array_slice($query, $limit);

            } else {
                $general = $query;
            }

            return array('general' => $general, 'all' => $result);
        } else {
            return $query;
        }
    }


    /**
     * todo метод генерации json файла бизнесов для информера
     */
    public function getInformersBussinesId ()
    {

        $section = Model::factory('CategoryModel')->get_section('category', array('parent_id', '=', '0'));
        $result = array();
        foreach ($section as $row_section) {


            $query_bus = DB::select(
                array('business.id', 'BusId'),
                array('business.name', 'BusName'),
                array('business.url', 'BusUrl'),
                array('business.info', 'BusInfo'),
                array('business.address', 'BusAdress'),
                array('business.home_busines_foto', 'BusImage'),
                array('city.id', 'CityId'),
                array('city.name', 'CityName'),
                array('cat2.id', 'CatId'),
                array('cat2.name', 'CatName')

            )
                ->distinct(TRUE)
                ->from('business')

                ->join(array('businesscategory', 'buscat'))
                ->on('buscat.business_id', '=', 'business.id')

                ->join(array('category', 'cat'))
                ->on('buscat.category_id', '=', 'cat.id')

                ->join(array('category', 'cat2'))
                ->on('cat.parent_id', '=', 'cat2.id')

                ->join('city', 'LEFT')
                ->on('business.city','=','city.id')

                ->where('cat2.url','=', $row_section['url'])
                ->and_where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'))
                ->and_where('business.status', '=', 1)
                ->and_where('business.name', '<>', '')
                ->and_where('business.city', '<>', '')
                ->and_where('business.address', '<>', '')
                ->and_where('business.tel', '<>', '')
                ->and_where('business.home_busines_foto', '<>', '')
                ->and_where('business.logo', '<>', '')
                ->and_where('business.info', '<>', '')
                ->order_by('business.id', 'DESC')
                ->execute()->as_array();

            $result = array_merge($result, $query_bus);


        }



        $query_all = DB::select(
            array('business.id', 'BusId'),
            array('business.name', 'BusName'),
            array('business.url', 'BusUrl'),
            array('business.info', 'BusInfo'),
            array('business.address', 'BusAdress'),
            array('business.home_busines_foto', 'BusImage'),
            array('city.id', 'CityId'),
            array('city.name', 'CityName'),
            array('cat2.id', 'CatId'),
            array('cat2.name', 'CatName')

        )
            ->distinct(TRUE)
            ->from('business')

            ->join(array('businesscategory', 'buscat'))
            ->on('buscat.business_id', '=', 'business.id')

            ->join(array('category', 'cat'))
            ->on('buscat.category_id', '=', 'cat.id')

            ->join(array('category', 'cat2'))
            ->on('cat.parent_id', '=', 'cat2.id')

            ->join('city', 'LEFT')
            ->on('business.city','=','city.id')

            ->where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('business.date_create AND business.date_end'))
            ->and_where('business.status', '=', 1)
            ->and_where('business.name', '<>', '')
            ->and_where('business.city', '<>', '')
            ->and_where('business.address', '<>', '')
            ->and_where('business.tel', '<>', '')
            ->and_where('business.home_busines_foto', '<>', '')
            ->and_where('business.logo', '<>', '')
            ->and_where('business.info', '<>', '')
            ->order_by('business.id', 'DESC')
            ->execute()->as_array();





        $arr_in_json = array();


        if (!empty($query_all)) {
            foreach ($query_all as $item) {
                $arr_in_json[] = array('category' => array('value' => 0, 'label' => $item['CatName']),
                    'city' => array('value' => $item['CityId'], 'label' => $item['CityName']),
                    'url' => $item['BusUrl'],
                    'image' => array('url' => $item['BusImage']),
                    'title' => $item['BusName'],
                    'description' => Text::limit_chars(strip_tags($item['BusInfo']), 150, null, true),
                    'adress' => $item['CityName'] . ', ' . $item['BusAdress']

                );
            }
        }

        if (!empty($result)) {
            foreach ($result as $rows) {

                $arr_in_json[] = array('category' => array('value' => $rows['CatId'], 'label' => $rows['CatName']),
                    'city' => array('value' => $rows['CityId'], 'label' => $rows['CityName']),
                    'url' => $rows['BusUrl'],
                    'image' => array('url' => $rows['BusImage']),
                    'title' => $rows['BusName'],
                    'description' => Text::limit_chars(strip_tags($rows['BusInfo']), 150, null, true),
                    'adress' => $rows['CityName'] . ', ' . $rows['BusAdress']

                );
            }
        }


        $bus = View::factory('render_informer/bus');
        if (!empty($arr_in_json)) {
            $bus->json = json_encode($arr_in_json);
        }


        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/public/javascripts/data/business.js')) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/public/javascripts/data/business.js');
        }
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/public/javascripts/data/business.js', $bus->render());
    }

}