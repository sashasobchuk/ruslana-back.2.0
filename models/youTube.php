<?php



function get_links(): array
{
    $sql = 'SELECT * FROM `youTube` ORDER BY dt_add  ';
    $query = getDbQuery($sql);
    $response = $query->fetchAll();
    return $response;
}
function post_oneLink($link)
{
    $sql = 'INSERT INTO `youTube` (link) VALUES (:link)';
    $response = setDbQuery($sql,['link'=>$link]);
    return $response;
}

function get_oneItem_youtube(int $id)
{
    $sql = 'SELECT * FROM `youTube` WHERE id = :id ';
    $query = getDbQuery($sql, ['id' => $id]);
    return $query->fetchAll();
}
function deleteItem(int $id)
{
    $sql = 'DELETE FROM `youTube` WHERE id = :id';
    return deleteDbQuery($sql, ['id' => $id]);
}











