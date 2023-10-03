<?php

function create(string $table, array $data)
{
    try {
        if(!isArrayAssociative($data)){
            throw new Exception("O array tem que ser associativo.", 1);
        }

        $pdo = connectDb();

        $sql = "insert into {$table}(";
        $sql .= implode(',',array_keys($data)).") values(";
        $sql .= ':'.implode(',:',array_keys($data)).")";

        $insert = $pdo->prepare($sql);
        return $insert->execute($data);

    } catch (PDOException $e) {
        echo '<pre>';
        print_r($e->getMessage());
        echo '</pre>';exit;
    }
}