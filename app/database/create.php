<?php

function create($table, $data)
{
    try {
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