<?php

use Firebase\JWT\JWT;

class Youtube
{
    public static function getLinks()
    {
        $links = get_links();


        die(json_encode($links));
    }



    public static function postItem()
    {
        $isAdmin = checkOnAdmin();
        if($isAdmin ==false) {http_response_code(401);die('not admin');} else

//        die('22222');
//        die( (bool)$isAdmin);

        $link = htmlspecialchars(trim($_POST['link']));
//                die($isAdmin);

        $safeLink = explode('v=',$link)[1];
        if(explode('&',$safeLink)>0){
            $safeLink = explode('&',$safeLink)[0];
        }
        die(json_encode(post_oneLink($safeLink)));
    }


    public static function deleteItem()
    {
        $id = trim(htmlspecialchars($_GET['id']));
        $isAdmin = checkOnAdmin();
        if($isAdmin ==false) {die('not admin');}

        $existing = get_oneItem_youtube($id);
        if ($existing === false) {
            /** перевірка чи вже існує*/
            http_response_code(400);
            exit('не існує такого 2ed233');
        }
        $response = deleteItem($id);
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







