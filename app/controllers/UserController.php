<?php

namespace app\controllers;

class UserController
{
    public function index($params)
    {
        var_dump($params);
        die();
    }


    public function show($params)
    {
        var_dump($params);
        die();
    }


    public function edit($params)
    {
        echo '<h1>EDIÇÃO</h1>';
        var_dump($params);
        die();
    }


}
