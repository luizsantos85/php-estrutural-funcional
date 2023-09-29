<?php

namespace app\controllers;

class HomeController
{
    public function index($params)
    {
        return [
            'view' => 'home/index',
            'data' => ['title' => 'HOME']
        ];
    }
}
