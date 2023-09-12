<?php

function all($table, $fields = '*')
{
    try {
        $connect = connectDb();

        $query = $connect->query("select {$fields} from {$table}");
        return $query->fetchAll();

    } catch (PDOException $e) {
        echo '<pre>';
        print_r($e->getMessage());
        echo '</pre>';
    }
}

function findBy($table,$field, $value, $fields = '*')
{
    try {
        $connect = connectDb();
        $prepare = $connect->prepare("select {$fields} from {$table} where {$field} = :{$field}");
        $prepare->execute([
            $field => $value
        ]);

        return $prepare->fetch();
        
    } catch (PDOException $e) {
        echo '<pre>';
        print_r($e->getMessage());
        echo '</pre>';
    }
}