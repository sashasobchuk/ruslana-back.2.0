<?php




function get_filesAll(string $fileType,string $sortType='DESC ',$start = 1,$limit =10): array
{
    $sql = 'SELECT * FROM  `file` WHERE fileType=:fileType ORDER BY addDate  ' . $sortType . ' LIMIT ' . $start .' , ' . $limit ;
    $query = getDbQuery($sql,['fileType'=>$fileType]);
    $response = $query->fetchAll();
    return $response;
}
function get_totalCoutn($fileType): int
{
    $sql = 'SELECT COUNT(*) FROM `file` WHERE fileType=:fileType '  ;
    $query = getDbQuery($sql,['fileType'=>$fileType]);
    $response = $query->fetch();
    return $response['COUNT(*)'];
}
function set_oneFile($name ,$extension,$tittle,$fileType)
{
    $sql = 'INSERT INTO `file` (`name`,`extension`,`tittle`,fileType) VALUES(:name,:extension ,:tittle,:fileType) ';
    $resFromDb = setDbQuery($sql, ['name' => $name, 'extension'=> $extension,'tittle'=>$tittle,'fileType'=>$fileType]);
    return $resFromDb;
}
function get_oneFileComment(int $id_comment)
{
    $sql = 'SELECT * FROM `file_comments` WHERE id_comment = :id_comment ';
    $query = getDbQuery($sql, ['id_comment' => $id_comment]);
    return $query->fetch();
}
function deleteFileComment(int $id_comment)
{
    $sql = 'DELETE FROM `file_comments` WHERE id_comment = :id_comment';
    return deleteDbQuery($sql, ['id_comment' => $id_comment]);
}
function get_fileComments(int $id_file): array
{
    $sql = 'SELECT * FROM `file_comments`WHERE id_file=:id_file ORDER BY addDate DESC';
    $query = getDbQuery($sql,['id_file'=>$id_file]);
    $response = $query->fetchAll();
    return $response;
}
function updade_comentStatsu(int $id_comment ,bool  $status)
{
    $sql = 'UPDATE `foto_comments` SET status=:status WHERE id_comment=:id_comment';
    $query = getDbQuery($sql, ['status' => $status, 'id_comment' => $id_comment]);
    return $query->fetchAll();
}

function deleteFileItem(int $id_file): bool
{
    $sql = 'DELETE  FROM `file` WHERE id_file = :id_file';
    deleteDbQuery($sql, ['id_file' => $id_file]);
    return true;
}
function add_fileComment(int $id_file, string $text,string $user_storage_id)
{
    $sql = 'INSERT INTO `file_comments` (`id_file`,`text`,`user_storage_id`) VALUES(:id_file,:text ,:user_storage_id) ';
    return setDbQuery($sql, ['id_file' => $id_file, 'text' => $text,'user_storage_id'=>$user_storage_id ]);
}
function updade_fileComentStatus(int $id_comment ,bool  $status)
{
    $sql = 'UPDATE `file_comments` SET status=:status WHERE id_comment=:id_comment';
    $query = getDbQuery($sql, ['status' => $status, 'id_comment' => $id_comment]);
    return $query->fetchAll();
}
function get_oneFileItem(int $id)
{
    $sql = 'SELECT * FROM `file` WHERE id_file = :id_file ';
    $query = getDbQuery($sql, ['id_file' => $id]);
    return $query->fetch();
}

class FilesModels{
    public static function get_oneFileItem(int $id)
    {
        $sql = 'SELECT * FROM `file` WHERE id_file = :id_file ';
        $query = getDbQuery($sql, ['id_file' => $id]);
        return $query->fetch();
    }
    public static function updade_fileComentStatus(int $id_comment ,bool  $status)
    {
        $sql = 'UPDATE `file_comments` SET status=:status WHERE id_comment=:id_comment';
        $query = getDbQuery($sql, ['status' => $status, 'id_comment' => $id_comment]);
        return $query->fetchAll();
    }
    public static function add_fileComment(int $id_file, string $text,string $user_storage_id)
    {
        $sql = 'INSERT INTO `file_comments` (`id_file`,`text`,`user_storage_id`) VALUES(:id_file,:text ,:user_storage_id) ';
        return setDbQuery($sql, ['id_file' => $id_file, 'text' => $text,'user_storage_id'=>$user_storage_id ]);
    }
    public static function deleteFileItem(int $id_file)
    {
        $sql = 'DELETE  FROM `file` WHERE id_file = :id_file';
        deleteDbQuery($sql, ['id_file' => $id_file]);
        return true;
    }
    public static function updade_comentStatsu(int $id_comment ,bool  $status)
    {
        $sql = 'UPDATE `foto_comments` SET status=:status WHERE id_comment=:id_comment';
        $query = getDbQuery($sql, ['status' => $status, 'id_comment' => $id_comment]);
        return $query->fetchAll();
    }
    public static function get_fileComments(int $id_file)
    {
        $sql = 'SELECT * FROM `file_comments`WHERE id_file=:id_file ORDER BY addDate DESC';
        $query = getDbQuery($sql,['id_file'=>$id_file]);
        $response = $query->fetchAll();
        return $response;
    }
    public static function deleteFileComment(int $id_comment)
    {
        $sql = 'DELETE FROM `file_comments` WHERE id_comment = :id_comment';
        return deleteDbQuery($sql, ['id_comment' => $id_comment]);
    }
    public static function get_oneFileComment(int $id_comment)
    {
        $sql = 'SELECT * FROM `file_comments` WHERE id_comment = :id_comment ';
        $query = getDbQuery($sql, ['id_comment' => $id_comment]);
        return $query->fetch();
    }
    public static function set_oneFile($name ,$extension,$tittle,$fileType)
    {
        $sql = 'INSERT INTO `file` (`name`,`extension`,`tittle`,fileType) VALUES(:name,:extension ,:tittle,:fileType) ';
        $resFromDb = setDbQuery($sql, ['name' => $name, 'extension'=> $extension,'tittle'=>$tittle,'fileType'=>$fileType]);
        return $resFromDb;
    }
    public static function get_totalCoutn($fileType)
    {
        $sql = 'SELECT COUNT(*) FROM `file` WHERE fileType=:fileType '  ;
        $query = getDbQuery($sql,['fileType'=>$fileType]);
        $response = $query->fetch();
        return $response['COUNT(*)'];
    }
    public static function get_filesAll(string $fileType,string $sortType='DESC ',$start = 1,$limit =10)
    {
        $sql = 'SELECT * FROM  `file` WHERE fileType=:fileType ORDER BY addDate  ' . $sortType . ' LIMIT ' . $start .' , ' . $limit ;
        $query = getDbQuery($sql,['fileType'=>$fileType]);
        $response = $query->fetchAll();
        return $response;
    }




    private function a ($idFoto)
    {
        return get_oneFileItem($idFoto);
    }


}

