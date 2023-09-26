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

    public function create()
    {
        return [
            'view' => 'user/create.php',
            'data' => ['title' => 'Cadastro de Usuário']
        ];
    }

    public function store()
    {
        $validate = validate([
            'name' => 'required',
            'email' => 'email|unique:users',
            'password' => 'required|maxlen:10',
        ]);

        if(!$validate){
            return redirect('/user/create');
        }

        echo '<pre>';
        print_r($validate);
        echo '</pre>';exit;
    }
}
