<?php

function redirect($to)
{
    header("location: {$to}");
    exit;
}

function setMessageAndRedirect($index, $message , $redirectTo)
{
    setFlash($index, $message);
    return redirect($redirectTo);
}