<?php

require_once "./bootstrap.php";


try {
    $data = router();

    if(!isset($data['view'])){
        throw new Exception("Indice de visualização não deifnida.", 1);
    }
    
    if(!file_exists(VIEWS.$data['view'])){
        throw new Exception("View '{$data['view']}' não existe.", 1);
    }
    
    if(!isset($data['data'])){
        throw new Exception("O indice data não existe.", 1);
    }
    
    extract($data['data']);
    $view = $data['view'];
    
    require_once VIEWS.'template.php';
} catch (\Exception $e) {
    echo '<pre>';
    print_r($e->getMessage());
    echo '</pre>';
}
