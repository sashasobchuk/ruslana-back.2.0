<?php


function add_concertItem(string $text,string $status, string $citi, string $date)
{
    $sql = 'INSERT INTO `concerts` (`text`,`status`,`citi`,`dt_add`) VALUES(:text,:status,:citi,:dt_add) ';
    $resFromDb = setDbQuery($sql, ['text' => $text, 'status' => $status,'citi' => $citi,'dt_add'=>$date.' 00:00:00']);
    return $resFromDb;
}


function get_C_Items(): array
{
    $sql = 'SELECT * FROM `concerts` ORDER BY dt_add  DESC';
    $query = getDbQuery($sql);
    $response = $query->fetchAll();

    return $response;
}


function get_item_concert(int $id)
{
    $sql = 'SELECT * FROM `concerts` WHERE id_concert = :id_concert ';
    $query = getDbQuery($sql, ['id_concert' => $id]);
    return $query->fetchAll();
}

function delete_Concert(int $id)
{
    $sql = 'DELETE FROM `concerts` WHERE id_concert = :id_concert';
    return deleteDbQuery($sql, ['id_concert' => $id]);
}










