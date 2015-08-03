<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 31.07.2015
 * Time: 13:59
 */

class Controller_Pages_Account extends Controller_BaseController {


    public function before (){
        parent::before();

        //die(HTML::x(Auth::instance()->get_user()));
    }

    /**
     * @throws Kohana_Exception
     * просмотр профиля или авторизация через соц.сеть
     */
    public function action_index() {


        $data = array(); // в эту переменную я зыписываю все, что нужно передать виду
        $ulogin = Ulogin::factory(); // создаем экземпляр класса юлогин

        if (!$ulogin->mode()) { // если ранее юлогин не вызывался
            $this->template->login = $ulogin->render(); // рисуем значки соц.сетей
        } else {

            try {

                $user = $ulogin->login(); // залогиниться
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

        if (!$data['user'] = Auth::instance()->get_user()) // если пользователь не авторизован
        {
            $this->redirect('/account/registration'); // редиректим на страницу с регистрацией
        }

        $data['ulogin'] = $ulogin->render(); // стартуем сессии
        $data['photo'] = Auth::instance()->get_user()->photo;

        $this->template->content = View::factory('auth/account', $data);
    }


    /**
     * экшн для входа
     */
    public function action_login(){

        $data = array();
        if (HTTP_Request::POST == $this->request->method()){ // если переданы POST данные
            // проверяем - стоит ли флаг - запомнить меня
            $remember = array_key_exists('rememberme', $this->request->post()) ? (bool) $this->request->post('rememberme') : FALSE;
            // пробуем авторизовать пользователя
            $user = Auth::instance()->login($this->request->post('email'), $this->request->post('password'), $remember);

            if ($user) { // если авторизовали успешно

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

                $data['message'] = Kohana::message('auth','wrongPass'); // если не удалось авторизоваться - выводим соответствующий мессадж
            }
            $data['email'] = $this->request->post('email');
        }

        if (!Auth::instance()->get_user()) {
            $ulogin = Ulogin::factory();
            $data['ulogin'] = $ulogin->render(); // рисуем значки соц.сетей
            $data['email'] = array_key_exists('email', $this->request->post()) ? htmlspecialchars($this->request->post('email')) : '';
            $data['username'] = array_key_exists('username', $this->request->post()) ? htmlspecialchars($this->request->post('username')) : ''; // вставляем данные в формы, если они были введены
            $this->template->content = View::factory('auth/login', $data);
        } else {
            $this->redirect('/');
        }
    }


    /**
     * @throws Kohana_Exception
     * регистрация
     */
    public function action_registration(){

        $data = array();
        $post = $this->request->post();
        if (!empty($post))
        {
            try {

                // производим проверку всех полей
                $object = Validation::factory($this->request->post());
                $object
                    ->rule('username', 'not_empty')
                    ->rule('username', 'min_length', array(':value', '4'))
                    ->rule('password', 'not_empty')
                    ->rule('password', 'min_length', array(':value', '5'))
                    ->rule('email', 'email');

                $user = ORM::factory('User') // если проверка пройдена - регистрируем
                ->set('email', $this->request->post('email'))
                    ->set('username', $this->request->post('username'))
                    ->set('password', $this->request->post('password'))
                    ->set('id_role', 1)
                    ->save();

                // даем новому пользователю роль для логина
                $user->add('roles', ORM::factory('Role', array('name' => 'login')));

                // очищаем массив с POST
                $_POST = array();


                $message = 'Вы успешно зарегистрировались с паролем - '.$this->request->post('password');

                $m = Email::factory();
                $m->From("registr@top.com"); // от кого отправляется почта
                $m->To($this->request->post('email')); // кому адресованно
                $m->Subject(Kohana::message('account', 'email.themes.registration'));
                $m->Body($message, "html");
                $m->Priority(3);
                $m->Send();

                Auth::instance()->force_login($user); // сразу же авторизуем его, без ввода логина и пароля
                HTTP::redirect('/account/');

            } catch (ORM_Validation_Exception $e) {

                // если во время валидации возникли ошибки
                $data['messageReg'] = Kohana::message('account', 'errorReg');
                $data['errors']= $e->errors('model');
                // берем значения ошибок из файла /application/messages/model/user.php
            }
        }
        $data['email'] = array_key_exists('email', $this->request->post()) ? htmlspecialchars($this->request->post('email')) : '';
        $data['username'] = array_key_exists('username', $this->request->post()) ? htmlspecialchars($this->request->post('username')) : '';     // вставляем данные в формы, если они были введены

        $ulogin = Ulogin::factory();
        $data['ulogin'] = $ulogin->render();  // рисуем значки соц.сетей
        $this->template->content = View::factory('auth/registration',$data);
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

        $data = array();
        if (HTTP_Request::POST == $this->request->method())  // если были какие-то POST данные
        {
            $data['message'] = Kohana::message('account', 'passwordSended'); // в любом случае выводим сообщение о том, что пароль отправлен. Пусть думают что все почтовые аккаунты имеют своих владельцев
            $user = ORM::factory('User', array('email' => $this->request->post('email'))); // а теперь действительно ищем - есть ли пользователь со введенным адресом
            if ($user->loaded()) // если есть
            {
                $session = Session::instance();
                $hash = md5(time().$this->request->post('email')); // записываем в сессию хэш, который будем проверять
                $session->set('forgotpass', $hash);
                $session->set('forgotmail', $this->request->post('email')); // и почту записываем


                // отправляем ссылку с хэшем для сброса пароля
                $message = 'Для сброса пароля пройдите по ссылке - <a href="http://ratefilm.ru/account/forgot?change='.$hash.'">СБРОСИТЬ</a>';

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
                $message = 'Ваш новый пароль - "'.$newpass.'" без кавычек. <a href="http://ratefilm.ru/account/">Войти</a>';

                $m->Body($message, "html");
                $m->Priority(3);
                $m->Send();

                // сообщаем об успехе процедуры
                $data['message'] = Kohana::message('account', 'newPassSended');
            }
        }
        $data['email'] = array_key_exists('email', $this->request->post()) ? htmlspecialchars($this->request->post('email')) : '';
        $this->template->content = View::factory('auth/forgot',$data);
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
}