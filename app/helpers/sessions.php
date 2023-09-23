<?php
function userLogged()
{
    if($_SESSION[LOGGED]){
        return $_SESSION[LOGGED];
    }
}

function logged()
{
    return isset($_SESSION[LOGGED]);
}