<?php

namespace app\controllers;

class HomeController
{
    public function index($params)
    {
        return [
            'view' => 'home/index.php',
            'data' => ['title' => 'HOME']
        ];
    }
}
