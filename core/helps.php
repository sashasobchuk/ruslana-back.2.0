<?php


class Helps
{
    public static function checkOnAdmin()
    {
        if(USER['role']=="ADMIN"){
            var_dump(USER);
            die();
            return true;
        }else{
            /** преревірка на адміністратора*/
            return false;
     }
    }
    public  function checkOnAdmin2()
    {
        if(USER['role']=="ADMIN"){
//            var_dump(USER);
//            die();
            return true;
        }else{
            /** преревірка на адміністратора*/
            return false;
     }
    }

    public static function checkOnUser()
    {
        if(USER['role']=="ADMIN"){
            return true;
        }else{
            /** преревірка на адміністратора*/
            return false;
            die('here flase not admin');
            die(json_encode(['error'=> true,'errors'=>[0=>'are not administrator 2535']]));
        }
    }


    public static function changeCommentStatus($id_ticket, $id_comment, $status)
    {
        updade_comentStatsu($id_ticket, $id_comment, $status);
        die('updated successful');
    }
}

function checkOnAdmin():bool
{
    if(USER['role']=="ADMIN"){
//        var_dump(USER);
//        die(1);
        return true;
    }else{
//        var_dump(USER);
//        die(2);
        /** преревірка на адміністратора*/
        return false;
        /*            die('here flase not admin');
                    die(json_encode(['error'=> true,'errors'=>[0=>'are not administrator 2535']]));*/
    }
}


function getFileType($extension):string{
    if ($extension == 'jpg' xor
        $extension == 'jpeg'xor
        $extension == 'png' xor
        $extension =='tif' xor
        $extension =='tiff' xor
        $extension =='gif' xor
        $extension =='bmp'){
        $fileType = 'foto';
    }elseif ($extension == 'mp4'
        xor $extension =='flv'){
        $fileType = 'video';
    }else {
        die('bad file format');
    }
    return $fileType;
}


function takeSortType(){
    $sortType = null;
    if(isset($_GET['sortType'])) {
        $type = $_GET['sortType'];
        if ($type === 'DESC') {
            $sortType = 'DESC';
        } elseif ($type === 'ASC') {
            $sortType = 'ASC';
        } else {
            http_response_code(400);
            die('bad sortType');
    }}else{
        http_response_code(400);
        die('need sortType');
    }
    return $sortType;

}


