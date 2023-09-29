<?php

namespace app\controllers;

class UserController
{
    public function index()
    {
        $users = all('users');
        return [
            'view' => 'user/index',
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
            'view' => 'user/create',
            'data' => ['title' => 'Cadastro de Usuário']
        ];
    }

    public function store()
    {
        $validate = validate([
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|maxlen:10',
        ]);

        if(!$validate){
            return redirect('/user/create');
        }

        $validate['password'] = password_hash($validate['password'],PASSWORD_DEFAULT);

        $userCreated = create('users', $validate);

        if(!$userCreated){
            setFlash('message','Opsss... Ocorreu um erro ao cadastrar, tente novamente em alguns segundos.');
            return redirect('/user/create');
        }

        setFlash('message','Usuário cadastrado com sucesso.','success');
        return redirect('/user');
    }
}
