<?php

function isArrayAssociative(array $arr)
{
    return array_keys($arr) !== range(0, count($arr) - 1);
}