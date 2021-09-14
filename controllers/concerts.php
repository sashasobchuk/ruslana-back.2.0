<?php


use Firebase\JWT\JWT;

class Concerts
{

    public static function setItem()
    {
        $isAdmin = checkOnAdmin();
        if($isAdmin ==false) {die('not admin');}else

        $text = trim(htmlspecialchars($_POST['text']));
        $status = trim(htmlspecialchars($_POST['status']));
        $date = trim(htmlspecialchars($_POST['date']));
        $citi = trim(htmlspecialchars($_POST['citi']));
        $response = add_concertItem($text, $status, $citi,$date);
        if ($response) {
            http_response_code(200);
        } else {
            http_response_code(400);
            die(json_encode(['success' => 'dont added',]));
        }
        die(json_encode(['id_item' => $response, 'dt_add' => date("Y-m-d H:i:s")]));
    }

    public static function getItems()
    {
        $itmes = get_C_Items();
        die(json_encode($itmes));
    }
    public static function deleteItem()
    {
        $isAdmin = checkOnAdmin();
        if($isAdmin ==false) {die('not admin');}else


        $id = trim(htmlspecialchars($_GET['id']));
        $existing = get_item_concert(2);
        if ($existing === false) {
            /** перевірка чи вже існує*/
            http_response_code(400);
            exit('не існує такого 2ed233');
        }
        $response = delete_Concert($id);
        if ($response) {
            /** перевірка на помилку*/
            http_response_code(200);
        } else {
            http_response_code(400);
            die(json_encode(['success' => false,]));
        }
        die(json_encode(['success' => true]));
    }


}







