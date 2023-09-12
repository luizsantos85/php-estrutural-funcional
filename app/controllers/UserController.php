<?php

namespace app\controllers;

class UserController
{
    public function index()
    {
        $users = all('users');
        return [
            'view' => 'user/index.php',
            'data' => ['title' => 'USUÁRIOS', 'users' => $users]
        ];
    }


    public function show($params)
    {
        if(!isset($params['user'])){
            redirect('/');
        }

        $user = findBy('users','id', $params['user']);

        echo '<pre>';
        print_r($user);
        echo '</pre>';exit;

    }


    public function edit($params)
    {
    }
}
