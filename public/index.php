<?php

require_once "./bootstrap.php";


try {
    router();
} catch (\Exception $e) {
    echo '<pre>';
    print_r($e->getMessage());
    echo '</pre>';
}
