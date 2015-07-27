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
     * получаем бизнеси по URL категории
     */
    public function getBussinesCategoryUrl($url_category = null, $limit = null, $num_page = null, $id_city = null){


        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }

        ////получаем количество записей для пагинации сортировка по городу и категории
        if ($id_city != null) {
            $result1 = DB::select()
                ->from('category')
                ->join('businesscategory')
                ->on('category.id', '=', 'businesscategory.category_id')
                ->join('business')
                ->on('businesscategory.business_id', '=', 'business.id')
                ->join('city', 'LEFT')
                ->on('business.city', '=', 'city.id')
                ->where_open()
                    ->where('category.url', '=', $url_category)
                    ->and_where('city.id', '=', $id_city)
                    ->and_where('business.status', '=', 1)
                ->where_close()
                ->cached()
                ->execute()->as_array();
        } else {
            //только по категории
            $result1 = DB::select()
                ->from('category')
                ->join('businesscategory')
                ->on('category.id', '=', 'businesscategory.category_id')
                ->join('business')
                ->on('businesscategory.business_id', '=', 'business.id')
                ->join('city', 'LEFT')
                ->on('business.city', '=', 'city.id')
                ->where('category.url', '=', $url_category)
                ->and_where('business.status', '=', 1)
                ->cached()
                ->execute()->as_array();
        }

        if ($id_city != null) {
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
                    ->and_where('city.id', '=', $id_city)
                    ->and_where('business.status', '=', 1)
                ->where_close()
                ->limit($limit)
                ->offset($ofset)
                ->cached()
                ->execute()->as_array();
        } else {
            $result = DB::select('business.*', array('city.name', 'CityName'))
                ->from('category')
                ->join('businesscategory')
                ->on('category.id', '=', 'businesscategory.category_id')
                ->join('business')
                ->on('businesscategory.business_id', '=', 'business.id')
                ->join('city', 'LEFT')
                ->on('business.city', '=', 'city.id')
                ->where('category.url', '=', $url_category)
                ->and_where('business.status', '=', 1)
                ->limit($limit)
                ->offset($ofset)
                ->cached()
                ->execute()->as_array();
        }

        $city_arr = $this->getCityInCategory($url_category);


         return array('data' => $result, 'count' => count($result1), 'city' => $city_arr);
    }


    /**
     * @param null $url_section
     * @return mixed
     * получаем все бизнесы из раздела
     */
    public function getBussinesSectionUrl($url_section = null, $limit = null, $num_page = null, $id_city = null){

        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }

        $category = Model::factory('CategoryModel')->getCategoryInSectionUrl($url_section);

        $arrChild = array();
        foreach ($category[0]['childs'] as $row_cat) {
            $arrChild[] = $row_cat['id'];
        }

        ////получаем количество записей для пагинации сортировка по городу и категориям раздела
        if ($id_city != null) {
            $result1 = DB::select('business.*', array('city.name', 'CityName'))
                ->from('category')
                ->join('businesscategory')
                ->on('category.id', '=', 'businesscategory.category_id')
                ->join('business')
                ->on('businesscategory.business_id', '=', 'business.id')
                ->join('city', 'LEFT')
                ->on('business.city', '=', 'city.id')
                ->where_open()
                    ->where('businesscategory.category_id', 'IN', $arrChild)
                    ->and_where('city.id', '=', $id_city)
                    ->and_where('business.status', '=', 1)
                ->where_close()
                ->group_by('business.id')
                ->order_by('business.id', 'DESC')
                ->cached()
                ->execute()->as_array();
        } else {
            //получаем количество записей для пагинации выборка по всем категориям раздела
            $result1 = DB::select('business.*', array('city.name', 'CityName'))
                ->from('category')
                ->join('businesscategory')
                ->on('category.id', '=', 'businesscategory.category_id')
                ->join('business')
                ->on('businesscategory.business_id', '=', 'business.id')
                ->join('city', 'LEFT')
                ->on('business.city', '=', 'city.id')
                ->where('businesscategory.category_id', 'IN', $arrChild)
                ->and_where('business.status', '=', 1)
                ->group_by('business.id')
                ->order_by('business.id', 'DESC')
                ->cached()
                ->execute()->as_array();
        }

        if ($id_city != null) {
            //выборка с лимитами по городу и всем категориям раздела
            $result = DB::select('business.*', array('city.name', 'CityName'))
                ->from('category')
                ->join('businesscategory')
                ->on('category.id', '=', 'businesscategory.category_id')
                ->join('business')
                ->on('businesscategory.business_id', '=', 'business.id')
                ->join('city', 'LEFT')
                ->on('business.city', '=', 'city.id')
                ->where_open()
                    ->where('businesscategory.category_id', 'IN', $arrChild)
                    ->and_where('city.id', '=', $id_city)
                    ->and_where('business.status', '=', 1)
                ->where_close()
                ->limit($limit)
                ->offset($ofset)
                ->group_by('business.id')
                ->order_by('business.id', 'DESC')
                ->cached()
                ->execute()->as_array();
        } else {
            //выборка с лимитами тоько по категориям раздела
            $result = DB::select('business.*', array('city.name', 'CityName'))
                ->from('category')
                ->join('businesscategory')
                ->on('category.id', '=', 'businesscategory.category_id')
                ->join('business')
                ->on('businesscategory.business_id', '=', 'business.id')
                ->join('city', 'LEFT')
                ->on('business.city', '=', 'city.id')
                ->where('businesscategory.category_id', 'IN', $arrChild)
                ->and_where('business.status', '=', 1)
                ->limit($limit)
                ->offset($ofset)
                ->group_by('business.id')
                ->order_by('business.id', 'DESC')
                ->cached()
                ->execute()->as_array();
        }

        $city_arr = $this->getCityInSection($arrChild);



        return array('data' => $result, 'count' => count($result1), 'city' => $city_arr);
    }


    public function getBusinessCityID ($id_city) {
//        $result = DB::select()
//            ->from('business')
    }



    /**
     * @param $url_business
     * @return mixed
     * получить бизнес по URL
     */
    public function getBusinessUrl ($url_business){

        //если обьект в кеше то берем оттуда
        if (Cache::instance()->get($url_business) == null) {

            $result = DB::select(array('bus.id', 'BusId'),
                array('bus.name', 'BusName'),
                array('bus.title', 'BusTitle'),
                array('bus.description', 'BusDescription'),
                array('bus.keywords', 'BusKeywords'),
                array('bus.city', 'BusCity'),
                array('bus.address', 'BusAddress'),
                array('bus.dop_address', 'BusDopAddress'),
                array('bus.services', 'BusServices'),
                array('bus.tags', 'BusTags'),
                array('bus.logo', 'BusLogo'),
                array('bus.website', 'BusWebsite'),
                array('bus.video', 'BusVideo'),
                array('bus.info', 'BusInfo'),
                array('bus.tags', 'BusTags'),
                array('bus.file_meny', 'BusFileMeny'),

                array('artic.id', 'ArticId'),
                array('artic.name', 'ArticName'),
                array('artic.url', 'ArticUrl'),
                array('artic.content', 'ArticContent'),

                array('cat.name', 'CatName'),
                array('cat.id', 'CatId'),
                array('cat.url', 'CatUrl'),

                array('coup.name', 'CoupName'),
                array('coup.id', 'CoupId'),
                array('coup.url', 'CoupUrl'),
                array('coup.info', 'CoupInfo'),
                array('coup.img_coupon', 'CoupImg'),
                array('coup.tags', 'CoupTags'),
                array('coup.secondname', 'CoupSecondname'),

                array('topslider.id', 'TopsliderId'),
                array('topslider.img_path', 'TopsliderImg'),

                array('galry.id', 'GalryId'),
                array('galry.name', 'GalryName'),

                array('file.id', 'FileId'),
                array('file.filename', 'FileFilename'),
                array('file.title', 'FileTitle'),
                array('file.gallery', 'FileGaleryId'))

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

                //связаная таблица обзоров и бизнесов для определения привязаных к бизнесу обзоров
                ->join(array('articles_relation_business', 'artrelbus'), 'LEFT')
                ->on('bus.id', '=', 'artrelbus.id_business')

                //обзоры
                ->join(array('articles', 'artic'), 'LEFT')
                ->on('artrelbus.id_articles', '=', 'artic.id')

                ->where('bus.url', '=', $url_business)
                ->and_where('bus.status', '=', 1)
                ->cached()
                ->execute()->as_array();

            //получаем преобразованый масив
            $end_result = $this->CreateArrayBussines($result);
            //кешируем
            Cache::instance()->set($url_business, $end_result);
        } else {
            $end_result = Cache::instance()->get($url_business);
        }
        Cache::instance()->delete($url_business);
        return $end_result;
    }












    /**
     * @param $table
     * @return mixed
     * Количество записей
     */
    public function table_count ($table, $column, $category_id = null) {

        if ($category_id == null) {

            $row = DB::select(array(DB::expr('COUNT(`'.$column.'`)'), 'total'))->from($table)
                ->execute()->as_array();

        } else {
            $row = DB::select(array(DB::expr('COUNT(`'.$column.'`)'), 'total'))->from($table)
                ->where('news_category', '=', $category_id)

                ->execute()->as_array();
        }
        return $row[0]['total'];
    }

    /**
     * @param $result
     * @return array
     * формирование двумерного масива карточки бизнеса
     */
    private function CreateArrayBussines ($result){

        $FileArr = array();
        $end_result = array();
        $CatTmp = array();
        $CoupTmp = array();
        $TopsTmp = array();
        $GalryTmp = array();
        $FileTmp = array();
        $ArticTmp = array();


        $end_result['BusId'] = $result[0]['BusId'];
        $end_result['BusName'] = $result[0]['BusName'];
        $end_result['BusTags'] = $result[0]['BusTags'];
        $end_result['BusLogo'] = $result[0]['BusLogo'];
        $end_result['BusWebsite'] = $result[0]['BusWebsite'];
        $end_result['BusVideo'] = $result[0]['BusVideo'];
        $end_result['BusInfo'] = $result[0]['BusInfo'];
        $end_result['BusTitle'] = $result[0]['BusTitle'];
        $end_result['BusDescription'] = $result[0]['BusDescription'];
        $end_result['BusKeywords'] = $result[0]['BusKeywords'];
        $end_result['BusFileMeny'] = $result[0]['BusFileMeny'];
        $end_result['BusAddress'] = $result[0]['BusAddress'];
        $end_result['BusCity'] = $result[0]['BusCity'];



        //парсим адрес
       try {
           $end_result['BusDopAddress'] =  unserialize($result[0]['BusDopAddress']);
       } catch (Exception $x) {
           $end_result['BusDopAddress'] = array();
       }



        if (!empty($result[0]['BusServices'])) {
            $services = explode("\n", $result[0]['BusServices']);
            $end_result['BusServicesArr'] =  $services;
        } else {
            $end_result['BusServicesArr'] = array();
        }


        foreach($result as $name_key => $row){



            //категории
            if (!array_key_exists($row['CatId'], $CatTmp)) {
                $CatTmp[$row['CatId']] = $row['CatId'];
                $end_result['CatArr'][] = array('CatId' => $row['CatId'], 'CatName' => $row['CatName'], 'CatUrl' => $row['CatUrl']);

            }
            //купоны
            if (!empty($row['CoupId'])) {
                if (!array_key_exists($row['CoupId'], $CoupTmp)) {
                    $CoupTmp[$row['CoupId']] = $row['CoupId'];
                    $end_result['CoupArr'][] = array('CoupId' => $row['CoupId'], 'CoupSecondname' => $row['CoupSecondname'],
                        'CoupUrl' => $row['CoupUrl'],
                        'CoupInfo' => $row['CoupInfo'],
                        'CoupImg' => $row['CoupImg'],
                        'CoupTags' => $row['CoupTags']
                    );
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
                        if (!array_key_exists($row_file['FileId'], $FileTmp) and ($row['GalryId'] == $row_file['FileGaleryId'])) {
                            $FileTmp[$row_file['FileId']] = $row_file['FileId'];
                            $FileArr[] = array('FileFilename' => $row_file['FileFilename'], 'FileTitle' => $row_file['FileTitle'], 'FileId' => $row_file['FileId']);

                        }
                    }

                    $GalryTmp[$row['GalryId']] = $row['GalryId'];
                    $end_result['GalryArr'][] = array('GalryId' => $row['GalryId'], 'GalryName' => $row['GalryName'],
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
                    $end_result['ArticArr'][] = array('ArticId' => $row['ArticId'], 'ArticName' => $row['ArticName'],
                        'ArticUrl' => $row['ArticUrl'],
                        'ArticContent' => $row['ArticContent']);

                }
            } else {
                $end_result['ArticArr'] = array();
            }


        }

        return $end_result;
    }


    /**
     * @param $arrChild
     * @param $id_city
     * @return array
     * метод получаем список городов во всех категориях раздела
     */
    public function getCityInSection ($arrChild){

        $result1 = DB::select('business.*', array('city.name', 'CityName'))
            ->from('category')
            ->join('businesscategory')
            ->on('category.id', '=', 'businesscategory.category_id')
            ->join('business')
            ->on('businesscategory.business_id', '=', 'business.id')
            ->join('city', 'LEFT')
            ->on('business.city', '=', 'city.id')
            ->where('businesscategory.category_id', 'IN', $arrChild)
            ->and_where('business.status', '=', 1)
            ->group_by('business.id')
            ->order_by('business.id', 'DESC')
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
     * @param $url_category
     * @return array
     * получаем список городов по урлу категории
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
            ->where('category.url', '=', $url_category)
            ->and_where('business.status', '=', 1)
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


}