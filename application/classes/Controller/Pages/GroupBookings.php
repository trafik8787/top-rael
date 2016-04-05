<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.01.2016
 * Time: 15:43
 */

/**
 * Class Controller_Pages_GroupBookings
 * Страница групповых заказов
 */
class Controller_Pages_GroupBookings extends Controller_BaseController {

    public function action_index(){

        $content = View::factory('pages/group_bookings');
        $content->captcha = Captcha::instance();



        $this->SeoShowPage(array('Групповые заказы на отдых, развлечения и покупки в Израиле', ''),
            array('Эксклюзивные скидки для группы, на отдых и развлечения в Израиле. Более 500 мест.',''),
            array('Эксклюзивные скидки для группы, на отдых и развлечения в Израиле. Более 500 мест.', ''));


        $this->template->content = $content;

    }

}