<?php


switch ($query_routes[1]) {
    /** $query_routes[1] назва функції контролера*/

    case "getLinks":
        $response = Youtube::getLinks();
        break;
    case "deleteItem":
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $response = Youtube::deleteItem();
        }
    case "postItem":
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $response = Youtube::postItem();
        }


    default:
        die('nothing is here 0fdwi3fs');
        $response = 'error';
}






