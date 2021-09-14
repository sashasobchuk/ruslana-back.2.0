<?php



switch ($query_routes[1]) {
    /** $query_routes[1] назва функції контролера*/

    case "setItem":
        $response = Concerts::setItem();
        break;
    case "getItems":
        $response = Concerts::getItems();
        break;
    case "deleteItem":
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $response = Concerts::deleteItem();
        }
        break;
    default:
        break;


}






