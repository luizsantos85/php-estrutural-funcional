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

        if (!$validate) {
            return redirect('/user/create');
        }

        $validate['password'] = password_hash($validate['password'], PASSWORD_DEFAULT);

        $userCreated = create('users', $validate);

        if (!$userCreated) {
            setFlash('message', 'Opsss... Ocorreu um erro ao cadastrar, tente novamente em alguns segundos.');
            return redirect('/user/create');
        }

        setFlash('message', 'Usuário cadastrado com sucesso.', 'success');
        return redirect('/user');
    }

    public function show($params)
    {
        if (!isset($params['user'])) {
            redirect('/');
        }

        $user = findBy('users', 'id', $params['user']);

        return [
            'view' => 'user/edit',
            'data' => ['title' => 'Edição de Usuário', 'user' => $user]
        ];
    }


    public function update()
    {
        $id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
        $validate = validate([
            'name' => 'required',
            'email' => 'email|required|uniqueUpdate',
        ]);

        if (!$validate) {
            return redirect("/user/{$id}");
        }

        $updated = update(
            'users',
            $validate,
            ['id' => $id]
        );

        if ($updated) {
            setFlash('message', 'Usuário atualizado com sucesso.', 'success');
            return redirect('/user');
        }

        setFlash('message', 'Opsss... Ocorreu um erro ao atualizar, tente novamente em alguns segundos.');
        return redirect("/user/{$id}");
    }

    public function destroy($params)
    {
        if (!isset($params['user'])) {
            redirect('/');
        }
        
        $user = findBy('users', 'id', $params['user']);

        if(!$user){
            setFlash('message', 'Usuário com id inválido.');
            return redirect('/user');
        }

        $deletedUser = delete('users',['id' => $user->id]);

        if (!$deletedUser) {
            setFlash('message', 'Opsss... Ocorreu um erro ao excluir, tente novamente em alguns segundos.');
            return redirect('/user');
        }

        setFlash('message', 'Usuário excluído com sucesso.', 'success');
        return redirect('/user');
    }
}
