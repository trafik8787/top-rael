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
                ->order_by('business.id', 'DESC')
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
                ->order_by('business.id', 'DESC')
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
                ->order_by('business.id', 'DESC')
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
                ->order_by('business.id', 'DESC')
                ->cached()
                ->execute()->as_array();
        }

        $city_arr = $this->getCityInCategory($url_category);

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

        //вызываем метод получения данных из куки
        Controller_BaseController::favorits_bussines();
        //добавляем элемент масива если добавлен в избранное
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
                array('bus.maps_cordinate_x', 'BusMapsX'),
                array('bus.maps_cordinate_y', 'BusMapsY'),
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
        $end_result['BusMapsX'] = $result[0]['BusMapsX'];
        $end_result['BusMapsY'] = $result[0]['BusMapsY'];
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

    /**
     * @param int $limit
     * @return mixed
     * Получение последних добавленых бизнесов
     */
    public function getBusinessAfter($limit = 10){
        return DB::select()
            ->from('business')
            ->where('status', '=', 1)
            ->order_by('id', 'DESC')
            ->limit($limit)
            ->cached()
            ->execute()->as_array();
    }




    /**
     * @param $id_bussines
     * @return mixed
     * получить бизнесы
     */
    public function getBussinesId($id_bussines){

        return DB::select()
            ->from('business')
            ->where('id', 'IN', $id_bussines)
            ->and_where('status', '=', 1)
            ->execute()->as_array();
    }

    /**
     * @param $id_user
     * @param $id_bussines
     * @return string
     * @throws Kohana_Exception
     * сохраняем бизнес в избранное пользователя
     */
    public function saveBussinesFavoritesUser($id_user, $id_bussines){
        $query = DB::insert('users_relation_favorites_bus', array('user_id', 'business_id'))
            ->values(array($id_user, $id_bussines))->execute();
        return json_encode($query);
    }


    /**
     * @param $id_bussines
     */
    public function deleteBussinesFavoritesUser ($id_bussines){
        $id_user = Auth::instance()->get_user()->id;
        $query = DB::delete('users_relation_favorites_bus')
            ->where('user_id', '=', $id_user)
            ->and_where('business_id', '=', $id_bussines)
            ->execute();
    }


    /**
     * @param $user_id
     * @return mixed
     * получить избранные бизнесы по id пользователя
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
     * ПОЛУЧАЕМ БИЗНЕСЫ ГРУППЫ ЛАКШЕРИ (СОРТИРОВКА ПО ТЕГАМ И КАТЕГОРИЯМ)
     */
    public function getBussinesCategoryTagsUrl ($url_category, $url_tags = null, $limit = null){


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

            ->where('tag.url_tags', '=', $url_tags)
            ->and_where('cat.url', '=', $url_category)
            ->and_where('bus.status', '=', 1)
            ->limit($limit)
            //->cached()
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
     * ПОЛУЧАЕМ БИЗНЕСЫ ГРУППЫ ЛАКШЕРИ (СОРТИРОВКА ПО ТЕГАМ И РАЗДЕЛАМ)
     */
    public function getBussinesSectionTagsUrl ($url_section, $url_tags, $limit = null){

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

            ->where('tag.url_tags', '=', $url_tags)
            ->and_where('buscat.category_id', 'IN', $arrChild)
            ->and_where('bus.status', '=', 1)
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














}