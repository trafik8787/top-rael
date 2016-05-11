<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 05.05.2016
 * Time: 12:06
 */

/**
 * Class Model_StatisticModel
 * импорт из базы Redis в Mysql количества просмотром бизнесов купонов банеров
 */
class Model_StatisticModel extends Model_BaseModel {


    /**
     * todo импорт количества просмотров бизнесов из базы Redis
     */
    public function import_bussines (){

        $query = DB::select()
            ->from('business')
            ->execute()->as_array();

        foreach ($query as $row_bus) {

            $count_bus_vievs = 0;
            $count_bus_favor = 0;

            $count_bus_vievs = Rediset::getInstance()->get_business_all($row_bus['id']);
            $count_bus_favor = Rediset::getInstance()->get_business_favor($row_bus['id']);

            if (!empty($count_bus_vievs) OR !empty($count_bus_favor)) {
                DB::update('business')->set(array('show_bussines' => $count_bus_vievs, 'show_favorit' => $count_bus_favor))->where('id', '=', $row_bus['id'])->execute();
            }

        }

    }


    /**
     * @return array
     * todo получаем статистику просмотров и добавлений в избранное бизнесов
     */
    public function show_bussines ($date_start = null, $date_end = null){
        $data = array();

        $query = DB::select()
            ->from('business')
            ->cached()->execute()->as_array();

        foreach ($query as $row_bus) {

            $count_bus_vievs = 0;
            $count_bus_favor = 0;

            if ($date_start != null AND $date_end != null) {
                $count_bus_vievs = Rediset::getInstance()->get_business_date_diapazon_views($row_bus['id'], $date_start, $date_end);
                $count_bus_favor = Rediset::getInstance()->get_business_favor_date_diapazon($row_bus['id'], $date_start, $date_end);
            } else {
                $count_bus_vievs = Rediset::getInstance()->get_business_all($row_bus['id']);
                $count_bus_favor = Rediset::getInstance()->get_business_favor($row_bus['id']);
            }


            if (!empty($count_bus_vievs) OR !empty($count_bus_favor)) {
                $data[] = array('id' => $row_bus['id'], 'name' => $row_bus['name'], 'count_vievs' => $count_bus_vievs, 'count_favor' => $count_bus_favor);
            }
        }

        return $data;

    }


    public function show_articles ($date_start = null, $date_end = null){

        $data = array();

        $query = DB::select()
            ->from('articles')
            ->cached()->execute()->as_array();

        foreach ($query as $row_artic) {

            $count_articles_vievs = 0;
            $count_articles_favor = 0;

            if ($date_start != null AND $date_end != null) {
                $count_articles_vievs = Rediset::getInstance()->get_articles_date_diapazon_views($row_artic['id'], $date_start, $date_end);
                $count_articles_favor = Rediset::getInstance()->get_articles_favor_date_diapazon($row_artic['id'], $date_start, $date_end);
            } else {
                $count_articles_vievs = Rediset::getInstance()->get_articles($row_artic['id']);;
                $count_articles_favor = Rediset::getInstance()->get_articles_favor($row_artic['id']);
            }

            if (!empty($count_articles_vievs) OR !empty($count_articles_favor)) {
                $data[] = array('id' => $row_artic['id'], 'name' => $row_artic['name'], 'count_vievs' => $count_articles_vievs, 'count_favor' => $count_articles_favor);
            }

        }

        return $data;

    }


    public function show_coupons ($date_start = null, $date_end = null){
        $data = array();

        $query = DB::select()
            ->from('coupon')
            ->cached()->execute()->as_array();

        foreach ($query as $row_coup) {

            $count_coupons_vievs = 0;
            $count_coupons_favor = 0;

            if ($date_start != null AND $date_end != null) {
                $count_coupons_vievs = Rediset::getInstance()->get_coupon_date_diapazon_views($row_coup['id'], $date_start, $date_end);
                $count_coupons_favor = Rediset::getInstance()->get_coupon_favor_date_diapazon($row_coup['id'], $date_start, $date_end);
            } else {
                $count_coupons_vievs = Rediset::getInstance()->get_coupon_show($row_coup['id']);
                $count_coupons_favor = Rediset::getInstance()->get_coupon($row_coup['id']);
            }

            if (!empty($count_coupons_vievs) OR !empty($count_coupons_favor)) {
                $data[] = array('id' => $row_coup['id'], 'name' => $row_coup['name'], 'count_vievs' => $count_coupons_vievs, 'count_favor' => $count_coupons_favor);
            }

        }

        return $data;

    }


    public function show_baners ($date_start = null, $date_end = null){
        $data = array();

        $query = DB::select()
            ->from('banners')
            ->cached()->execute()->as_array();


        foreach ($query as $row_baner) {

            $count_baners_vievs = 0;

            if ($date_start != null AND $date_end != null) {
                $count_baners_vievs = Rediset::getInstance()->get_baner_date($row_baner['id'], $date_start, $date_end);
            } else {
                $count_baners_vievs = Rediset::getInstance()->get_baner($row_baner['id']);
            }

            if (!empty($count_baners_vievs)) {
                $data[] = array('id' => $row_baner['id'], 'name' => $row_baner['name'], 'count_vievs' => $count_baners_vievs);
            }

        }

        return $data;

    }


}
