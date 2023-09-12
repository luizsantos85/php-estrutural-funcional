<?php

function redirect($to)
{
    header("location: {$to}");
    exit;
}