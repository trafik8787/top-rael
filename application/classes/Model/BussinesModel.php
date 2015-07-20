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
    public function getBussinesCategoryUrl($url_category = null, $limit = null, $num_page = null){


        if ($num_page != null) {
            $ofset = $limit * ($num_page - 1);
        } else {
            $ofset = 0;
        }



        $result1 = DB::select()
            ->from('category')
            ->join('businesscategory')
            ->on('category.id', '=', 'businesscategory.category_id')
            ->join('business')
            ->on('businesscategory.business_id', '=', 'business.id')
            ->where('category.url', '=', $url_category)
            ->cached()
            ->execute()->as_array();


        $result = DB::select()
            ->from('category')
            ->join('businesscategory')
            ->on('category.id', '=', 'businesscategory.category_id')
            ->join('business')
            ->on('businesscategory.business_id', '=', 'business.id')
            ->where('category.url', '=', $url_category)
            ->limit($limit)
            ->offset($ofset)
            ->cached()
            ->execute()->as_array();

         return array('data' => $result, 'count' => count($result1));
    }


    /**
     * @param null $url_section
     * @return mixed
     * получаем все бизнесы из раздела
     */
    public function getBussinesSectionUrl($url_section = null, $limit = null, $num_page = null){

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

        $column = 'bus.id';
        $result1 = DB::select(array('bus.id', 'total'))
            ->from(array('category', 'cat'))
            ->join(array('businesscategory', 'buscat'))
            ->on('cat.id', '=', 'buscat.category_id')
            ->join(array('business', 'bus'))
            ->on('buscat.business_id', '=', 'bus.id')
            ->where('buscat.category_id', 'IN', $arrChild)
            ->group_by('bus.id')
            ->order_by('bus.id','DESC')
            ->cached()
            ->execute()->as_array();


        $result = DB::select()
            ->from('category')
            ->join('businesscategory')
            ->on('category.id', '=', 'businesscategory.category_id')
            ->join('business')
            ->on('businesscategory.business_id', '=', 'business.id')
            ->where('businesscategory.category_id', 'IN', $arrChild)
            ->limit($limit)
            ->offset($ofset)
            ->group_by('business.id')
            ->order_by('business.id','DESC')
            ->cached()
            ->execute()->as_array();

        return array('data' => $result, 'count' => count($result1));
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
                array('bus.address', 'BusAddress'),
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
                //обзоры
                ->join(array('articles', 'artic'), 'LEFT')
                ->on('bus.id', '=', 'artic.bussines_id')

                ->where('bus.url', '=', $url_business)
                ->cached()
                ->execute()->as_array();

            //получаем преобразованый масив
            $end_result = $this->CreateArrayBussines($result);
            //кешируем
            Cache::instance()->set($url_business, $end_result);
        } else {
            $end_result = Cache::instance()->get($url_business);
        }
        //Cache::instance()->delete($url_business);
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

        //парсим адрес
        $adress  = explode("\n", $result[0]['BusAddress']);

        if (!empty($adress)) {

            foreach ($adress as $row_adres) {
                $cityArr[] = explode("|", trim($row_adres));
            }
            foreach ($cityArr as $row_city) {
                if (!empty($row_city[0]) and !empty($row_city[1])) {
                    $resultAdress[] = array('city' => trim($row_city[0]), 'address' => trim($row_city[1]));
                }
            }
        }

        if (!empty($resultAdress)) {
            $end_result['BusAddressArr'] = $resultAdress;
        } else {
            $end_result['BusAddressArr'] = array();
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
                        'CoupTags' => $row['CoupTags'],
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


}