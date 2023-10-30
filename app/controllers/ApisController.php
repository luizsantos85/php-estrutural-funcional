<?php

namespace app\controllers;

class ApisController
{
    public function users()
    {
        $users = all('users','id,name');

        echo json_encode($users);
    }
}