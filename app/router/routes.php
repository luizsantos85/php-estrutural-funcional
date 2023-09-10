<?php

return [
    '/' => 'HomeController@index',
    '/user' => 'UserController@index',
    '/user/create' => 'UserController@create',
    '/user/[0-9]+' => 'UserController@show',
    '/user/edit/[0-9]+' => 'UserController@edit',
    // '/user/[0-9]+/edit/[a-z]+' => 'UserController@update',
];