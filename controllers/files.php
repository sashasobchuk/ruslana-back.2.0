<?php


class Files
{
    public static function getAllfiles()
    {
        $files = [];
        $items = [];
        $fileType = $_GET['fileType'];
        $start =(int) $_GET['start'];
        $limit =(int) $_GET['limit'];

        $sortType = takeSortType();

        $allFile = FilesModels::get_filesAll($fileType,$sortType,$start,$limit);
        $totalCount = FilesModels::get_totalCoutn($fileType);
        foreach ($allFile as $item) {
            if (!file_exists('./files/files/' . $item['name'] . '.' . $item['extension'])) {
//                die('./files/fotos/'.$item['name'] .'.'.$item['extension']);
                /** видаляєм якшо з якоїсь причини вилалилось фізично але не з бази видаляєм з бази
                 * бо на хероку періодично видаляється
                 */
                self::delete_file_private((int)$item['id_file']);
            }
        }
        foreach ($allFile as $item) {
            $file['name'] = $item['name'] . '.' . $item['extension'];
            $file['_id'] = $item['id_file'];
            $file['tittle'] = $item['tittle'];
            $file['likes'] = $item['likes'];
            $file['fileType'] = $item['fileType'];
            $file['image_Url_Name'] = HOST . 'files/files/' . $item['name'] . '.' . $item['extension'];
            $comments = [];
            $dbComments = FilesModels::get_fileComments($item['id_file']);
            foreach ($dbComments as $dbComment) {
                $comment['_id'] = $dbComment['id_comment'];
                $comment['value'] = $dbComment['text'];
                $comment['addDate'] = $dbComment['addDate'];
                $comment['likes'] = (int)0;
                $comment['user_storage_id'] = $dbComment['user_storage_id'];
                $comment['status'] = !!$dbComment['status'];
                $comments[] = $comment;
            }
            $file['fileComments'] = $comments ?? [];

            $files[] = $file;
        }
        $page = ['items'=>$files,'totalCount'=>$totalCount];
        http_response_code(200);
        header('Content-Type: application/json; charset=utf-8');

        die(json_encode($page));
    }
    public static function setOneFile()
    {

        $error = null;
        $isAdmin = Helps::checkOnAdmin();
        if($isAdmin ==false) {die('not admin');}else



            $file = $_FILES['file'];
        $tittle = $_POST['tittle'];
        $type = explode('/', $file['type'])[0];
        $extension = explode('/', $file['type'])[1];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($file['size'] === 0) {
                $error = 'проблема з розміром ';
            } elseif ($file['name'] === '') {
                $error = 'назва погана';
            } elseif (!($type === 'image' || $type === 'video')) {
                http_response_code(400);
                $error = 'bad type zzzzzvm';
            }
            if ($error !== null) {
                http_response_code(400);
                die('a4gd2' . $error);
            } else {


                $fileType =getFileType($extension);
//                die($fileType);

                $name = time() . mt_rand(0, 10000);
                copy($file['tmp_name'], 'files/files/' . $name . '.' . $extension);
                set_oneFile($name, $extension, $tittle,$fileType);
                die('sussses');
            }
        } else {
            die(' REQUEST_METHOD !!!= f0329ohke3fef bad method');
        }
        die('bad http rest ');
    }

    public static function changeCommentStatus()
    {
        $isAdmin = checkOnAdmin();
        if($isAdmin ==false) {die('not admin');}

        $id_comment =  $_POST['id_comment'];
        $status =  $_POST['status']==='true'? true : false;
//        var_dump($status);
//        die();
        FilesModels:: updade_fileComentStatus($id_comment,$status);
        die('updated successful');
    }



    public static function addComment()
    {
        $text = trim(htmlspecialchars($_POST['text']));
        $user_storage_id = $_POST['userId'];
        $id_file = trim(htmlspecialchars($_POST['id_file']));

        $user_storage_id === '' ?? die('empty userId') ;

        $response = add_fileComment($id_file, $text, $user_storage_id);
        if ($response) {
            http_response_code(200);
        } else {
            http_response_code(400);
            die(json_encode(['success' => 'dont added',]));
        }
        die(json_encode(['id_comment' => $response, 'dt_add' => date("Y-m-d H:i:s")]));
    }
    public static function deleteFile()
    {
        $isAdmin = checkOnAdmin();
        if($isAdmin ==false) {die('not admin');}
        $id_foto = trim(htmlspecialchars($_GET['id_file']));

        if (get_oneFileItem($id_foto) === false) {
            /** перевірка чи вже існує*/
            http_response_code(400);
            die('не існує такого');
        }

        /** unlink real file*/
        $name = self::getFileItem($id_foto);
        $realDelete = unlink('./files/files/' . $name['name'] . '.' . $name['extension']);

        $response = deleteFileItem($id_foto);
        if ($response) {
            /** перевірка на помилку*/
            http_response_code(200);
        } else {
            http_response_code(400);
            die(json_encode(['success' => false,]));
        }
        die(json_encode(['success' => true]));
    }

    public static function deleteComment()
    {
        $isAdmin = checkOnAdmin();
        if($isAdmin ==false) {die('not admin');}
        $id_comment = trim(htmlspecialchars($_GET['id_comment']));
        $existing = get_oneFileComment($id_comment);
        $user_storage_id = trim(htmlspecialchars($_GET['user_storage_id']));
//        die($user_storage_id);

        if ( $isAdmin || $user_storage_id != '') {
                $response = deleteFileComment($id_comment);
                if ($response) {
                    /** перевірка на помилку*/
                    http_response_code(200);
                } else {
                    http_response_code(401);
                    die(json_encode(['success' => false]));
                }
                die(json_encode(['success' => true]));

        } else
//            http_response_code(401);
            die(json_encode(['err' => true, 'errors' => [0 => 'storageId isNot true of isNotAdmin 1123x']]));

    }


    private static function delete_file_private($id_file)
    {
        deleteFileItem($id_file);
    }

    private static function getFileItem($idFoto)
    {
        return get_oneFileItem($idFoto);
    }


}







