<?php

namespace app\controllers;

class AuthController
{
    public function login()
    {
        return [
            'view' => 'auth/login.php',
            'data' => ['title' => 'Login']
        ];
    }

    public function login_store()
    {
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);

        echo '<pre>';
        print_r($email);
        echo '</pre>';exit;
    }
}