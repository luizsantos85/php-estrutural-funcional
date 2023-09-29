<?php

namespace app\controllers;

class AuthController
{
    public function login()
    {
        if($_SESSION[LOGGED]){
            return redirect('/');
        }

        return [
            'view' => 'auth/login',
            'data' => ['title' => 'Login']
        ];
    }

    public function login_store()
    {
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(empty($email) || empty($password)){
            return setMessageAndRedirect('message', 'Preencha todos os campos.', '/login');
        }
        
        $user = findBy('users','email',$email);
        
        if(!$user){
            return setMessageAndRedirect('message', 'E-mail e/ou senha inválidos!', '/login');
            // setFlash('message', 'E-mail e/ou senha inválidos!');
            // return redirect('/login');
        }
        
        if(!password_verify($password, $user->password)){
            return setMessageAndRedirect('message', 'E-mail e/ou senha inválidos!', '/login');
        }

        $_SESSION[LOGGED] = $user;

        return redirect('/');
    }

    public function logout()
    {
        unset($_SESSION[LOGGED]);
        return redirect('/');
    }

    public function register()
    {
        
    }
}