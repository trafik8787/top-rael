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

            $count_bus_vievs = Rediset::getInstance()->get_business_all($row_bus['id']);
            $count_bus_favor = Rediset::getInstance()->get_business_favor($row_bus['id']);

            if (!empty($count_bus_vievs) OR !empty($count_bus_favor)) {
                $data[] = array('id' => $row_bus['id'], 'name' => $row_bus['name'], 'count_vievs' => $count_bus_vievs, 'count_favor' => $count_bus_favor);
            }
        }

        return $data;

    }


}
