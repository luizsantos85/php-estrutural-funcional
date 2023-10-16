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

function findBy($table, $field, $value, $fields = '*')
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

function create(string $table, array $data)
{
    try {
        if (!isArrayAssociative($data)) {
            throw new Exception("O array tem que ser associativo.", 1);
        }

        $pdo = connectDb();

        $sql = "insert into {$table}(";
        $sql .= implode(',', array_keys($data)) . ") values(";
        $sql .= ':' . implode(',:', array_keys($data)) . ")";

        $insert = $pdo->prepare($sql);
        return $insert->execute($data);
    } catch (PDOException $e) {
        echo '<pre>';
        print_r($e->getMessage());
        echo '</pre>';
        exit;
    }
}

function update(string $table, array $fields, array $where)
{
    try {
        if (!isArrayAssociative($fields) || !isArrayAssociative($where)) {
            throw new Exception("O array tem que ser associativo.", 1);
        }
        $pdo = connectDb();
        $sql = "update {$table} set ";
        foreach (array_keys($fields) as $field) {
            $sql .= "{$field} = :{$field},";
        }
        $sql = trim($sql, ', ');

        $whereFields = array_keys($where);
        $sql .= " where {$whereFields[0]} = :{$whereFields[0]}";
        $data = array_merge($fields, $where);

        $prepare = $pdo->prepare($sql);
        $prepare->execute($data);
        return $prepare->rowCount();

    } catch (PDOException $e) {
        echo '<pre>';
        print_r($e->getMessage());
        echo '</pre>';
        exit;
    }
}

function delete(string $table, array $where)
{
    try {
        if (!isArrayAssociative($where)) {
            throw new Exception("O array tem que ser associativo.", 1);
        }

        $pdo = connectDb();
        $whereFields = array_keys($where);

        $sql = "delete from {$table}";
        $sql .= " where {$whereFields[0]} = :{$whereFields[0]}";

        $prepare = $pdo->prepare($sql);
        $prepare->execute($where);
        return $prepare->rowCount();

    } catch (PDOException $e) {
        echo '<pre>';
        print_r($e->getMessage());
        echo '</pre>';
        exit;
    }
    
}
