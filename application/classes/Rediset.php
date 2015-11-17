<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 14.09.2015
 * Time: 17:00
 */

final class Rediset {

    /**
     * @var self
     */
    private static $instance;
    private static $redis;



    /**
     * Возвращает экземпляр себя
     *
     * @return self
     */
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$redis = new Redis();
            self::$instance = new self();
            self::$redis->connect('127.0.0.1', 6379);
        }
        return self::$instance;
    }

    /**
     * Конструктор закрыт
     */
    private function __construct()
    {


    }

    /**
     * Клонирование запрещено
     */
    private function __clone()
    {
    }

    /**
     * Сериализация запрещена
     */
    private function __sleep()
    {
    }

    /**
     * Десериализация запрещена
     */
    private function __wakeup()
    {
    }


    public function incr ($key){
        $this->incr($key);
    }

    /**
     * @param $key
     * @param array $array_key
     * записать масив в базу
     */
    public function hmset ($key, array $array_key){
        self::$redis->hmset($key, $array_key);
    }

    public function hgetall ($key){

        return self::$redis->hgetall($key);
    }

    public function flushDB (){
        self::$redis->flushDB();
    }


    public function get_coupon ($id_coupon){
        return self::$redis->get('coupon-'.$id_coupon);
    }

    public function get_baner ($id_baner){
        return self::$redis->get('baner-'.$id_baner);
    }

    public function get_coupon_show($id_coupon) {
        return self::$redis->get('couponshow-'.$id_coupon);
    }

    /**
     * @param $id_business
     * @param null $data
     * @return mixed
     * todo просмотры бизнеса по дате если не указано то используется текущая
     */
    public function get_business_date ($id_business, $data = null){

        if ($data === null) {
            $data = date('Y-m-d');
        }

        return self::$redis->get('bus@'.$id_business.'@'.$data);
    }

    /**
     * @param $id_business
     * @return mixed
     * todo все просмотры бизнеса
     */
    public function get_business_all ($id_business){

        return self::$redis->get('bus-'.$id_business);
    }

    /**
     * @param $id_business
     * @return mixed
     * todo получить количество добавленых в избранное
     */
    public function get_business_favor ($id_business){
        return self::$redis->get('busfavor-'.$id_business);
    }

    /**
     * @param $id_articles
     * @return mixed
     * todo получить количество просмотров статьи
     */
    public function get_articles($id_articles){
        return self::$redis->get('article-'.$id_articles);
    }

    /**
     * @param $id_business
     * @param null $data
     * todo удалить статистику бизнеса
     */
    public function del_business($id_business, $data = null){
        if ($data === null)  {
            $data = date('Y-m-d');
        }
        self::$redis->del('bus@'.$id_business.'@'.$data);
        self::$redis->del('bus-'.$id_business);
    }
    /**
     * @param $id_coupon
     * todo количество добавление купона в избранное
     */
    public function set_coupon($id_coupon){

        if (!self::$redis->exists('coupon-'.$id_coupon)) {
            self::$redis->set("coupon-".$id_coupon, 0);
        }

        self::$redis->incr('coupon-'.$id_coupon);

    }


    /**
     * @param $id_coupon
     * todo количество просмотров купона
     */
    public static function set_coupon_show ($id_coupon){
        if (!self::$redis->exists('couponshow-'.$id_coupon)) {
            self::$redis->set("couponshow-".$id_coupon, 0);
        }

        self::$redis->incr('couponshow-'.$id_coupon);
    }


    /**
     * @param $id_business
     * todo добавить просотр к бизнесу
     */
    public function set_business ($id_business){

        if (!self::$redis->exists('bus@'.$id_business.'@'.date('Y-m-d'))) {
            self::$redis->set('bus@'.$id_business.'@'.date('Y-m-d'), 0);
            self::$redis->set('bus-'.$id_business, 0);
        }
        self::$redis->incr('bus-'.$id_business);
        self::$redis->incr('bus@'.$id_business.'@'.date('Y-m-d'));

    }


    /**
     * @param $id_business
     * todo количество добавления бизнеса в избранное
     */
    public function set_business_favor ($id_business){

        if (!self::$redis->exists('busfavor-'.$id_business)) {
            self::$redis->set('busfavor-'.$id_business, 0);
        }

        self::$redis->incr('busfavor-'.$id_business);
    }


    /**
     * @param $id_article
     * todo запись просмотров статей
     */
    public function set_articles ($id_article){

        if (!self::$redis->exists('article-'.$id_article)) {
            self::$redis->set('article-'.$id_article, 0);
        }

        self::$redis->incr('article-'.$id_article);
    }

    /**
     * @param $id_baner
     * todo запись кликов по банеру
     */
    public function set_baners($id_baner){
        if (!self::$redis->exists('baner-'.$id_baner)) {
            self::$redis->set('baner-'.$id_baner, 0);
        }

        self::$redis->incr('baner-'.$id_baner);
    }

    /**
     * todo сохранить в базу
     */
    public function save(){
        self::$redis->save();
    }
}