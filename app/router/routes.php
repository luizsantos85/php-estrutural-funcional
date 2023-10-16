<?php

return [
    "POST" =>[
        '/login' => 'AuthController@login_store',
        '/user/store' => 'UserController@store',
        '/user/update' => 'UserController@update',
    ],
    
    "GET" =>[
        '/' => 'HomeController@index',
        '/user' => 'UserController@index',
        '/user/create' => 'UserController@create',
        '/user/[0-9]+' => 'UserController@show',
        '/user/[0-9]+/excluir' => 'UserController@destroy',
        
        '/login' => 'AuthController@login',
        '/logout' => 'AuthController@logout',
        '/register' => 'AuthController@register',
    ],
];