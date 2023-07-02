<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Users extends Controller
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'phone' => trim((string)($_POST['phone'])),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'phone_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            if (empty($data['email'])) {
                $data['email_error'] = 'Пожалуйста, введите email';
            } else {
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['email_error'] = 'Email недействителен';
                }
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_error'] = 'Email уже занят';
                }
            }

            if (empty($data['phone'])) {
                $data['phone_error'] = 'Пожалуйста, введите телефон';
            } else {
                if (preg_match('/^[+][0-9]/', $data['phone'])) {
                    $count = 1;
                    $data['phone'] = str_replace(['+'], '', $data['phone'], $count);
                }
                $data['phone'] = str_replace([' ', '.', '-', '(', ')'], '', $data['phone']);
                if (!$this->isDigits($data['phone'])) {
                    $data['phone_error'] = 'Номер телефона невалидный';
                }
                if ($this->userModel->findUserByPhone($data['phone'])) {
                    $data['phone_error'] = 'Номер телефона уже занят';
                }
            }

            if (empty($data['name'])) {
                $data['name_error'] = 'Пожалуйста, введите имя';
            }

            if (empty($data['password'])) {
                $data['password_error'] = 'Пожалуйста, введите пароль';
            } elseif (strlen($data['password']) < 8) {
                $data['password_error'] = 'Пароль должен быть больше 8 символов';
            }

            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Пожалуйста, подтвердите пароль';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_error'] = 'Пароли не совпадают';
                }
            }

            if (
                empty($data['phone_error']) &&
                empty($data['email_error']) &&
                empty($data['name_error']) &&
                empty($data['password_error']) &&
                empty($data['confirm_password_error'])
            ) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {
                    flash($name = 'register_success', $message = 'Вы успешно зарегистрированы');
                    redirect('users/login');
                } else {
                    die('Что-то пошло не так');
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            $data = [
                'name' => '',
                'email' => '',
                'phone' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'phone_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'email_phone' => trim($_POST['email_phone']), 
                'password' => trim($_POST['password']),
                'email_phone_error' => '',
                'password_error' => '',
            ];

            if (empty($data['email_phone'])) {
                $data['email_phone_error'] = 'Пожалуйста, введите email или номер телефона';
            }

            if (empty($data['password'])) {
                $data['password_error'] = 'Пожалуйста, введите пароль';
            }

            if (!($this->userModel->findUserByEmail($data['email_phone']) || $this->userModel->findUserByPhone($data['email_phone']))) {
                $data['email_phone_error'] = 'Такого пользователя не существует';
            }

            if (
                empty($data['email_phone_error']) &&
                empty($data['password_error'])
            ) {
                $loggedIn = $this->userModel->login($data['email_phone'], $data['password']);

                if ($loggedIn) {
                    $this->createUserSession($loggedIn);
                } else {
                    $data['password_error'] = 'Неверный пароль';
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            $data = [
                'email_phone' => '',
                'password' => '',
                'email_phone_error' => '',
                'password_error' => '',
            ];

            $this->view('users/login', $data);
        }
    }

    public function logout()
    {
        setcookie("jwt", "", time() - (86400 * 30), '/');
        unset($_COOKIE['jwt']);
        redirect('users/login');
    }

    public function createUserSession($user)
    {

        $secret_Key  = SECRET_KEY;
        $date   = time();
        $expire_at     = $date + (86400 * 30);
        $domainName = "quadrip/";
        $request_data = [
            'iat'  => $date,
            'iss'  => $domainName,
            'nbf'  => $date,
            'exp'  => $expire_at,
            "data" => array(
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email
            )
        ];

        $jwt = JWT::encode(
            $request_data,
            $secret_Key,
            'HS512'
        );

        setcookie('jwt', $jwt, $expire_at, '/');

        redirect('posts');
    }

    public function isDigits(string $s, int $minDigits = 9, int $maxDigits = 14): bool
    {
        return preg_match('/^[0-9]{' . $minDigits . ',' . $maxDigits . '}\z/', $s);
    }
}
