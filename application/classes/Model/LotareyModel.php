<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 18.08.2015
 * Time: 18:55
 */

class Model_LotareyModel extends Model_BaseModel {

    public function getLotareya ($bussines_id = null){

        $query = DB::select('lotarey.*', array('business.url', 'BusUrl'),
            array('business.logo', 'BusLogo'),
            array('business.name', 'BusName')
        );

        $query->from('lotarey');
        $query->join('business');
        $query->on('lotarey.business_id', '=', 'business.id');

        $query->where(DB::expr('DATE(NOW())'), 'BETWEEN', DB::expr('lotarey.date_start AND lotarey.date_end'));

        if ($bussines_id != null) {

            $query->and_where('lotarey.business_id', '=', $bussines_id);
        }
        $query->limit(1);
        $result =  $query->cached()->execute()->as_array();
        return $result;

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

                return array('user' => $subscription[$number], 'lotery' => $lotery[0]);
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
        $query = DB::select('subscription.*', array('lotarey.name', 'loteryName'))
            ->from('subscription')
            ->join('lotarey')
            ->on('subscription.lotery', '=', 'lotarey.id')
            ->where('subscription.email','=', $email)
            ->and_where('subscription.lotery', '<>', '0')
            ->limit(1)
            ->execute()->as_array();
        return $query;
    }


    /**
     * @return mixed
     * todo получаем список победителей лотареи или победителя по id лотареи
     * $flag - если true то выводит всех побидителей лотарей зарегестрированых и не зарегестрированых
     */
    public function getUserLotarey($limit = null, $id = null, $flag = false){

        $query = DB::select(
            array('users.name', 'usersName'),
            array('users.secondname', 'usersSecondname'),
            array('lotarey.date_end', 'loteryDate'),
            array('lotarey.id', 'loteryId'),
            array('lotarey.name', 'loteryName'),
            array('lotarey.secondname', 'loterySecondname'),
            array('business.name', 'busName'),
            array('business.url', 'busUrl'),
            array('users.photo', 'usersPhoto'),
            array('users.email', 'usersEmail'),
            array('subscription.email', 'subscriptionEmail'),
            array('users.id', 'usersId')
        );
        $query->from('subscription');
        $query->join('lotarey');
        $query->on('subscription.lotery', '=', 'lotarey.id');
        $query->join('business');
        $query->on('lotarey.business_id', '=', 'business.id');

        if ($id === null) {
            if ($flag === false) {
                $query->join('users');
            } else {
                $query->join('users', 'LEFT');
            }
        } else {
            $query->join('users', 'LEFT');
        }

        $query->on('subscription.email', '=', 'users.email');

        if ($flag === false) {

            if ($id === null) {
                $query->where('users.suses_lotery', '<>', 0);
            } else {
                $query->where($id[0], $id[1], $id[2]);
            }
        }

        $query->order_by('lotarey.id', 'DESC');
        if ($limit != null) {
            $query->limit($limit);
        }
        return $query->cached()->execute()->as_array();

    }


}