<?php

class userController {
    /**
     * @var Request;
     */
    private $request = null;
    /**
     * @var userModel;
     */
    private $model = null;
    /**
     * @var Session;
     */
    private $session = null;

    public function __construct($objects = null) {
        if (isset($objects['model'])) {
            $this->model = $objects['model'];
        }
        if (isset($objects['request'])) {
            $this->request = $objects['request'];
        }
        if (isset($objects['session'])) {
            $this->session = $objects['session'];
        }
    }
    public function index() {
        $user_id = $this->session->getVal('user_id', 0);
        if ($user_id == 0){
            template::render(__DIR__ . '/template/needlogin.php');
            return;
        }
        $user = $this->model->getUserById($user_id);
        template::render(__DIR__ . '/template/info.php', $user);
    }
    public function login() {
        $data = [];
        if (!empty($this->request->post)) {
            $username = $this->request->post['username'];
            $password = $this->request->post['password'];
            $user = $this->model->getUserByText($username);
            if ($user['password'] == md5($password)) {
                $this->session->setVal('user_id' , $user['user_id']);
                header('Location: index.php?component=user');
                return;
            } else {
                $data['error'] = 'Неверный логин или пароль. Попробуйте еще.';
            }
        }
        template::render(__DIR__ . '/template/login.php' , $data);
    }
    public function register() {
        $data = [];
        $errors = [];

        if (!empty($this->request->post)) {
            $data = [
                'user_id' => (isset($this->request->post['user_id']) and  (!empty($this->request->post['user_id'])))? $this->request->post['user_id'] : '',
                'email' => (isset($this->request->post['email']) and  (!empty($this->request->post['email'])))? $this->request->post['email'] : '',
                'username' => (isset($this->request->post['username']) and  (!empty($this->request->post['username']))) ? $this->request->post['username'] : '',
                'fio' => (isset($this->request->post['fio']) and  (!empty($this->request->post['fio']))) ? $this->request->post['fio'] : '',
                'password' => (isset($this->request->post['password']) and  (!empty($this->request->post['password']))) ? $this->request->post['password'] : '',
                'password2' => (isset($this->request->post['password2']) and  (!empty($this->request->post['password2']))) ? $this->request->post['password2'] : '',
            ];
            if (empty($errors = $this->validate($data))) {
                $data['password'] = md5($data['password']);
                unset($data['password2']);
                $this->model->save($data);
                header('Location:index.php?component=user');
                return true;
            }
        }
        $data['errors'] = $errors;
        template::render(__DIR__ . '/template/register.php', $data);
    }
    public function edit() {
        $errors = [];
        $data   = [];
        $user_id = $this->session->getVal('user_id', 0);
        if (!empty($this->request->post)) {
            // Сохраняем данные
            $data = [
                'user_id' => $user_id,
                'fio' => (isset($this->request->post['fio']) and  (!empty($this->request->post['fio']))) ? $this->request->post['fio'] : '',
                'password' => (isset($this->request->post['password']) and  (!empty($this->request->post['password']))) ? $this->request->post['password'] : '',
                'password2' => (isset($this->request->post['password2']) and  (!empty($this->request->post['password2']))) ? $this->request->post['password2'] : '',
            ];
            if (empty($errors = $this->validate($data))) {
                if (!empty($data['password'])) {
                    $data['password'] = md5($data['password']);
                } else {
                    unset($data['password']);
                }
                unset($data['password2']);
                $this->model->save($data);
                header('Location:index.php?component=user');
                return true;
            }
        }
        $user_id = $this->session->getVal('user_id', 0);
        if ($user_id != 0) {
            $user = $this->model->getUserById($user_id);
            $data['fio'] = $user['fio'];
        }
        $data['errors'] = $errors;
        template::render(__DIR__ . '/template/edit.php', $data);
    }
    public function logout() {
        $this->session->destroy();
        header('Location:index.php?component=user');
        return;
    }

    private function validate($data) {
        $errors = [];
        if (!empty($data['password']) and $data['password'] != $data['password2']) {
            $errors['passwords'] = "Пароли не совпадают";
        }
        //TODO: сделать проверку корректности входящих данных(уникальность логина, емеил, сравнение паролей)
        return $errors;
    }
}

/*
 * insert into `user` (`email`,`fio`,`password`,`username`)
select CONCAT(1+FLOOR(RAND()*9),'@rand.ru'),  CONCAT('Rand ', 1+FLOOR(RAND()*9)), `password`, CONCAT(`username`,FLOOR(RAND()*1000000)) from `user`;
 *
 *
 *
 * */