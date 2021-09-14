<?php


switch ($query_routes[1]) {
    /** $query_routes[1] назва функції контролера*/

    case 'getFiles':
        $response = Files::getAllfiles();
        break;
    case "setFile":
        $response = Files::setOneFile();
        break;
    case "deleteFile":
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $response = Files::deleteFile();
        }
        break;



    case "addComment":
        $response = Files::addComment();
        break;
    case "deleteComment":
        $response = Files::deleteComment();
        break;

    case "changeCommentStatus":
        $response = Files::changeCommentStatus();
        break;



    default:
        die('nothing is here 21vdvfg');
        $response = 'error';
}






