<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 31.07.2015
 * Time: 13:59
 */

class Controller_Pages_Account extends Controller_BaseController {




    /**
     * @throws Kohana_Exception
     * просмотр профиля или авторизация через соц.сеть
     */
    public function action_index() {


        $data = View::factory('auth/account'); // в эту переменную я зыписываю все, что нужно передать виду
        //блок управления подпиской в кабинете пользователя
        $bloc_sndmail = View::factory('blocks_includ/bloc_sendmail_profile');
        $ulogin = Ulogin::factory(); // создаем экземпляр класса юлогин


        if ($this->request->post('profil')) {

            if (!empty($_FILES['avatar']['name'])) {
                $filename = $this->_save_image($_FILES['avatar']);
            }


            $profin_user = ORM::factory('user', Auth::instance()->get_user()->id);
//                ->values(array('username' => $this->request->post('username'),
//                    'secondname' => $this->request->post('secondname'),
//                    'city' => $this->request->post('city'),
//                    'tel' => $this->request->post('tel'),
//                    'age' => $this->request->post('age'),
//                    'photo' => $filename
//                ))->save();
            $profin_user->username = $this->request->post('username');
            $profin_user->secondname = $this->request->post('secondname');
            $profin_user->city = $this->request->post('city');
            $profin_user->tel = $this->request->post('tel');
            $profin_user->age = $this->request->post('age');
            if (!empty($_FILES['avatar']['name'])) {
                $profin_user->photo = $filename;
            }
            $profin_user->save();
            $this->redirect('/account');
        }



        if (!$ulogin->mode()) { // если ранее юлогин не вызывался
            $this->template->login = $ulogin->render(); // рисуем значки соц.сетей
        } else {

            try {

                $user = $ulogin->login(); // залогиниться

                //синхронизируем купоны добвленные в избранное анонима и авторизированого пользователя
                $data = self::FavoritsCouponMetod('users_relation_favorites_coup', 'coupon_id', 'coupon', 'favoritcoup', $data);


                //синхронизируем бизнесы добвленные в избранное анонима и авторизированого пользователя
                $data = self::FavoritsBusinessMetod('users_relation_favorites_bus', 'business_id', 'business', 'favoritbus', $data);


                //синхронизируем статьи добвленные в избранное анонима и авторизированого пользователя
                $data = self::FavoritsArticlesMetod('users_relation_favorites_article', 'article_id', 'articles', 'favoritartic', $data);


                $session = Session::instance(); // стартуем сессии
                if ($session->get('redirectAfterLogin')!='') // если пользователь хотел куда-то перейти
                {
                    $redirect = $session->get('redirectAfterLogin');
                    $session->delete('redirectAfterLogin'); // удаляем запись об этом
                    $this->redirect($redirect); // и редиректим
                }
                $this->header->user = Auth::instance()->get_user();


            } catch (ORM_Validation_Exception $e) {

                $this->template->login = $e->errors(''); // если возникли ошибки - выводим в переменную login
            }
        }




        if ($data->user = Auth::instance()->get_user()) // если пользователь авторизован
        {

            $data->photo = Auth::instance()->get_user()->photo;
            $bloc_sndmail->user = Auth::instance()->get_user();
            $bloc_sndmail->generall_menu = parent::$general_meny;
        }


        $data->panel_subscribe = $bloc_sndmail;

        //получаем избранные купоны
        if (parent::$favorits_coupon != null) {
            $data->favorit_coupon = Model::factory('CouponsModel')->getCouponsId(parent::$favorits_coupon);
            $data->favorit_coupon = parent::convertArrayTagsBusiness($data->favorit_coupon, 3);
        }
        //получаем избранные бизнесы
        if (parent::$favorits_bussines != null) {
            $data->favorits_bussines = Model::factory('BussinesModel')->getBussinesId(self::$favorits_bussines);
            $data->favorits_bussines = parent::convertArrayTagsBusiness($data->favorits_bussines, 4);
        }

        //получаем избранные статьи
        if (parent::$favorits_articles != null) {
            $data->favorits_articles = Model::factory('ArticlesModel')->getArticlesId(parent::$favorits_articles);
        }

        $data->ulogin = $ulogin->render(); // стартуем сессии


        $this->template->content = $data;
    }


    /**
     * экшн для входа
     */
    public function action_login(){

        $data = View::factory('auth/login');
        if (HTTP_Request::POST == $this->request->method()){ // если переданы POST данные
            // проверяем - стоит ли флаг - запомнить меня
            $remember = array_key_exists('rememberme', $this->request->post()) ? (bool) $this->request->post('rememberme') : FALSE;
            // пробуем авторизовать пользователя
            $user = Auth::instance()->login($this->request->post('email'), $this->request->post('password'), $remember);

            if ($user) { // если авторизовали успешно

                //синхронизируем купоны добвленные в избранное анонима и авторизированого пользователя
                $data = self::FavoritsCouponMetod('users_relation_favorites_coup', 'coupon_id', 'coupon', 'favoritcoup', $data);


                //синхронизируем бизнесы добвленные в избранное анонима и авторизированого пользователя
                $data = self::FavoritsBusinessMetod('users_relation_favorites_bus', 'business_id', 'business', 'favoritbus', $data);


                //синхронизируем статьи добвленные в избранное анонима и авторизированого пользователя
                $data = self::FavoritsArticlesMetod('users_relation_favorites_article', 'article_id', 'articles', 'favoritartic', $data);



                $session = Session::instance();
                if ($session->get('redirectAfterLogin')!='')
                {
                    $redirect = $session->get('redirectAfterLogin');
                    $session->delete('redirectAfterLogin');
                    $this->redirect($redirect); // редиректим куда надо (см. выше)
                }
                $this->redirect('/account/');

                //когда пользователь залогинился то изменяем форму в шапке
                $this->header->user = Auth::instance()->get_user();


            } else {

                $data->message = Kohana::message('auth','wrongPass'); // если не удалось авторизоваться - выводим соответствующий мессадж
            }
            $data->email = $this->request->post('email');
        }

        if (!Auth::instance()->get_user()) {
            $ulogin = Ulogin::factory();
            $data->ulogin = $ulogin->render(); // рисуем значки соц.сетей
            $data->email = array_key_exists('email', $this->request->post()) ? htmlspecialchars($this->request->post('email')) : '';
            $data->username = array_key_exists('username', $this->request->post()) ? htmlspecialchars($this->request->post('username')) : ''; // вставляем данные в формы, если они были введены
            $this->template->content = $data;
        } else {
            $this->redirect('/');
        }
    }


    /**
     * @throws Kohana_Exception
     * регистрация
     */
    public function action_registration(){

        $data = View::factory('auth/registration');
        $post = $this->request->post();
        if (!empty($post))
        {
            try {

                if (Captcha::valid($this->request->post('captcha'))) {

                    // производим проверку всех полей
                    $object = Validation::factory($this->request->post());
                    $object
                        ->rule('username', 'not_empty')
                        ->rule('username', 'min_length', array(':value', '4'))
                        ->rule('password', 'not_empty')
                        ->rule('password', 'min_length', array(':value', '5'))
                        ->rule('email', 'email');

                    $user = ORM::factory('User')// если проверка пройдена - регистрируем
                    ->set('email', $this->request->post('email'))
                        ->set('username', $this->request->post('username'))
                        ->set('password', $this->request->post('password'))
                        ->set('id_role', 1)
                        ->save();

                    // даем новому пользователю роль для логина
                    $user->add('roles', ORM::factory('Role', array('name' => 'login')));

                    // очищаем массив с POST
                    $_POST = array();

                    //отправляем письмо про регистрацию
                    $this->SendMailRegistration($this->request->post('email'));

                    Auth::instance()->force_login($user); // сразу же авторизуем его, без ввода логина и пароля
                    HTTP::redirect('/account/');

                } else {
                    $this->redirect('/account/registration?err_cap='.base64_encode('Неверно введен код'));
                }

            } catch (ORM_Validation_Exception $e) {

                // если во время валидации возникли ошибки
                $data->messageReg = Kohana::message('account', 'errorReg');
                $data->errors = $e->errors('model');
                // берем значения ошибок из файла /application/messages/model/user.php
            }
        }
        $data->email = array_key_exists('email', $this->request->post()) ? htmlspecialchars($this->request->post('email')) : '';
        $data->username = array_key_exists('username', $this->request->post()) ? htmlspecialchars($this->request->post('username')) : '';     // вставляем данные в формы, если они были введены

        $data->captcha = Captcha::instance();

        $ulogin = Ulogin::factory();
        $data->ulogin = $ulogin->render();  // рисуем значки соц.сетей
        $this->template->content = $data;
    }


    /**
     * @throws Kohana_Exception
     * смена пароля
     */
    public function action_changepass() {

        $object = Validation::factory($this->request->post());  // проверяем новый пароль на корректность заполнения
        $object
            ->rule('newpassword', 'not_empty')
            ->rule('newpassword', 'min_length', array(':value', '5'));
        if ($object->check())  // если новый пароль удовлетворяет требованиям
        {
            $realoldpass = Auth::instance()->get_user()->password; // берем хэш текущего пароль пользователя
            $oldpass = Auth::instance()->hash($this->request->post('oldpassword')); // сравниваем с тем, что ввел пользователь
            if ($realoldpass===$oldpass)  // если они совпадают
            {
                DB::update('users')->set(array('password' => Auth::instance()->hash($this->request->post('newpassword'))))->where('id', '=', Auth::instance()->get_user()->id)->execute();
                HTTP::redirect('/account/?changeok');  // меняем пароль и редиректим на страницу с поздравлением
            }
            else
            {
                HTTP::redirect('/account/?changefalse');  // если нет - сообщаем об ошибке
            }
        }
        else
        {
            HTTP::redirect('/account/?changefalse'); // если нет - сообщаем об ошибке
        }
    }


    /**
     * сброс пароля
     */
    public function action_forgot() {

        $data = View::factory('auth/forgot');
        if (HTTP_Request::POST == $this->request->method())  // если были какие-то POST данные
        {
            $data->message = Kohana::message('account', 'passwordSended'); // в любом случае выводим сообщение о том, что пароль отправлен. Пусть думают что все почтовые аккаунты имеют своих владельцев
            $user = ORM::factory('User', array('email' => $this->request->post('email'))); // а теперь действительно ищем - есть ли пользователь со введенным адресом
            if ($user->loaded()) // если есть
            {
                $session = Session::instance();
                $hash = md5(time().$this->request->post('email')); // записываем в сессию хэш, который будем проверять
                $session->set('forgotpass', $hash);
                $session->set('forgotmail', $this->request->post('email')); // и почту записываем


                // отправляем ссылку с хэшем для сброса пароля
                $message = 'Для сброса пароля пройдите по ссылке - <a href="http://'.$_SERVER['SERVER_NAME'].'/account/forgot?change='.$hash.'">СБРОСИТЬ</a>';

                $m = Email::factory();
                $m->From("registr@top.com"); // от кого отправляется почта
                $m->To($this->request->post('email')); // кому адресованно
                $m->Subject(Kohana::message('account', 'email.themes.passworReset'));
                $m->Body($message, "html");
                $m->Priority(3);
                $m->Send();
            }
        }

        $restore = Arr::get($_GET, 'change');
        if ($restore) // если человек прошел по ссылке в письме
        {
            $session = Session::instance();
            if ($session->get('forgotpass') === $restore) // проверяем его сессию - действительно ли именно он запросил сброс?
            {
                $m = Email::factory();
                $m->From("registr@top.com");
                $m->Subject(Kohana::message('account', 'email.themes.newPassword'));

                // генерируем новый пароль
                $newpass = substr(md5(time().$session->get('forgotmail')),0,8);
                // кому адресованно
                $m->To($session->get('forgotmail'));

                // ставим новый пароль пользователю
                DB::update('users')->set(array('password' => Auth::instance()->hash($newpass)))->where('email', '=', $session->get('forgotmail'))->execute();

                // очищаем сессию
                $session->delete('forgotpass');
                $session->delete('forgotmail');


                // отправляем новый пароль пользователю
                $message = 'Ваш новый пароль - "'.$newpass.'" без кавычек. <a href="http://'.$_SERVER['SERVER_NAME'].'/account/">Войти</a>';

                $m->Body($message, "html");
                $m->Priority(3);
                $m->Send();

                // сообщаем об успехе процедуры
                $data->message = Kohana::message('account', 'newPassSended');
            }
        }
        $data->email = array_key_exists('email', $this->request->post()) ? htmlspecialchars($this->request->post('email')) : '';

        $this->template->content = $data;
    }

    /**
     *
     * выход
     */
    public function action_logout() {
        // выходим и перекитываем на страницу с авторизацией
        Auth::instance()->logout();
        $this->redirect('/');
    }




    public static function FavoritsCouponMetod($table, $field, $table_object, $cooki_name, $data_vievs){

        if (parent::$favorits_coupon === null) {

            $favoritcoup = Model::factory('CouponsModel')->getCouponsFavoritesUserId(Auth::instance()->get_user()->id);
            if ($favoritcoup !== false) {
                //пересоздаем купон на основе данных из таблицы
                Cookie::update_Arr_set_json('favoritcoup', $favoritcoup);
                //получаем избранные купоны
                $data_vievs->favorit_coupon = Model::factory('CouponsModel')->getCouponsId($favoritcoup);
                $data_vievs->favorit_coupon = parent::convertArrayTagsBusiness($data_vievs->favorit_coupon, 3);
                //передаем количество купонов в шапку
                parent::$count_coupon = count($favoritcoup);
            }

        } else {

            Model::factory('BaseModel')->UpdateFavoritCookie($table, Auth::instance()->get_user()->id, $field, parent::$favorits_coupon, $table_object, $cooki_name);
        }

        return $data_vievs;
    }


    public static function FavoritsBusinessMetod($table, $field, $table_object, $cooki_name, $data_vievs){

        if (parent::$favorits_bussines === null) {
            $favoritbus = Model::factory('BussinesModel')->getBussinesFavoritesUserId(Auth::instance()->get_user()->id);
            if ($favoritbus !== false) {
                //пересоздаем купон на основе данных из таблицы
                Cookie::update_Arr_set_json('favoritbus', $favoritbus);
                //получаем избранные купоны
                $data_vievs->favorits_bussines = Model::factory('BussinesModel')->getBussinesId($favoritbus);
                $data_vievs->favorits_bussines = parent::convertArrayTagsBusiness($data_vievs->favorits_bussines, 4);
                //передаем количество купонов в шапку
                parent::$count_bussines = count($favoritbus);
            }
        } else {
            Model::factory('BaseModel')->UpdateFavoritCookie($table, Auth::instance()->get_user()->id, $field, parent::$favorits_bussines, $table_object, $cooki_name);
        }
        return $data_vievs;
    }


    public static function FavoritsArticlesMetod($table, $field, $table_object, $cooki_name, $data_vievs){

        if (parent::$favorits_articles === null) {
            $favoritartic = Model::factory('ArticlesModel')->getArticlesFavoritesUserId(Auth::instance()->get_user()->id);
            if ($favoritartic !== false) {
                //пересоздаем статью на основе данных из таблицы
                Cookie::update_Arr_set_json('favoritartic', $favoritartic);
                //получаем избранные статьи
                $data_vievs->favorits_articles = Model::factory('ArticlesModel')->getArticlesId($favoritartic);
            }
        } else {
            Model::factory('BaseModel')->UpdateFavoritCookie($table, Auth::instance()->get_user()->id, $field, parent::$favorits_articles, $table_object, $cooki_name);
        }

        return $data_vievs;
    }


    /**
     * @param $email
     * отправка письма при успешной регистрации
     */
    private function SendMailRegistration($email){

        $html_mail = View::factory('email/mail_registration');

        $m = Email::factory();
        $m->From("TopIsraelSubscribe@top.com"); // от кого отправляется почта
        $m->To($email); // кому адресованно
        $m->Subject('Подтверждение подписки');
        $m->Body($html_mail, "html");
        $m->Priority(3);
        $m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/1.png", "", "image/png");
        $m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/2.png", "", "image/png");
        //$m->Attach( $_SERVER['DOCUMENT_ROOT']."/public/mail/images/3.jpg", "", "image/jpeg");
        $m->Send();
    }


    protected function _save_image($image)
    {
        if (
            ! Upload::valid($image) OR
            ! Upload::not_empty($image) OR
            ! Upload::type($image, array('jpg', 'jpeg', 'png', 'gif')))
        {
            return FALSE;
        }

        $directory = DOCROOT.'uploads/img_users/';

        if ($file = Upload::save($image, NULL, $directory))
        {
            $filename = strtolower(Text::random('alnum', 20)).'.jpg';

            Image::factory($file)
                ->resize(100, 100, Image::AUTO)
                ->save($directory.$filename);

            // Delete the temporary file
            unlink($file);

            return '/uploads/img_users/'.$filename;
        }

        return FALSE;
    }
    

}