<?php

return [
    "POST" =>[
        '/login' => 'AuthController@login_store',

    ],
    
    "GET" =>[
        '/' => 'HomeController@index',
        '/user' => 'UserController@index',
        '/user/create' => 'UserController@create',
        '/user/[0-9]+' => 'UserController@show',
        '/user/edit/[0-9]+' => 'UserController@edit',
        
        '/login' => 'AuthController@login',
        '/register' => 'AuthController@register',
    ],
];