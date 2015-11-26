<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 18.08.2015
 * Time: 18:55
 */

class Model_LotareyModel extends Model_BaseModel {

    public function getLotareya (){

        return DB::select('lotarey.*', array('business.url', 'BusUrl'))
            ->from('lotarey')
            ->join('business')
            ->on('lotarey.business_id', '=', 'business.id')
            ->where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('lotarey.date_start AND lotarey.date_end'))
            ->limit(1)
            ->cached()->execute()->as_array();

    }


    /**
     * @return bool
     * метод выбирает случайного подпищика и присваевает ему поле победителя
     */
    public function getLoteryActual (){

        $lotery = DB::select()
            ->from('lotarey')
            ->where('date_end','=', DB::expr('curdate()'))
            ->and_where('status','=',2)
            ->limit(1)
            ->execute()->as_array();

        if (!empty($lotery)) {

            $subscription = DB::select()
                ->from('subscription')
                ->where('action','=', 1)
                ->and_where('lotery','=', 0)
                ->execute()->as_array();

            $lot = DB::update('lotarey')
                ->set(array('status' => 3))
                ->where('id', '=', $lotery[0]['id'])
                ->execute();

            if (!empty($subscription)) {

                $number = array_rand($subscription, 1);

                $sub_update = DB::update('subscription')
                    ->set(array('lotery' => $lotery[0]['id']))
                    ->where('id', '=', $subscription[$number]['id'])
                    ->execute();

                return $subscription[$number];
            } else {
                return false;
            }

        } else {
            return false;
        }
    }


    /**
     * @param $email
     * @return mixed
     * todo находим победителя по email
     */
    public function ChekedSusesLotarey($email){
        $query = DB::select()
            ->from('subscription')
            ->where('email','=', $email)
            ->and_where('lotery', '<>', '0')
            ->limit(1)
            ->execute()->as_array();
        return $query;
    }


}