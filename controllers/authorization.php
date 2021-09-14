<?php


use Firebase\JWT\JWT;

class Auth
{
    public static function registration()
    {
        $login = trim(htmlspecialchars($_POST['login']));

        $hashPassword = password_hash( (trim(htmlspecialchars($_POST['password']))),PASSWORD_BCRYPT);

        $response = makeAuthhorization($login, $hashPassword);
        if ($response) {
            http_response_code(200);
        } else {
            http_response_code(400);
        }
        $token = array(
            "data" => array(
                "login" => $login,
                "password" => $hashPassword,
            )
        );
        $jwt = JWT::encode($token, SECRET_KEY_FOR_JVT, 'HS256');

        die(json_encode(['success' => 'successfully added', 'token' => $jwt]));
    }

    public static function login()
    {
        $login = trim(htmlspecialchars($_POST['login']));
        $password = trim(htmlspecialchars($_POST['password']));

        $arr = self:: helpFunc($login,$password);
        $jwtToken=$arr['jwtToken'];
        $user=$arr['user'];

        die(json_encode([
            'success' => 'user exist',
            'token' => $jwtToken,
            'login' => $login,
            'role' => $user['role']]));
    }

    public static function authtentication()
    {
        $headers = getallheaders();
        if(!(array_key_exists('token',$headers ))) {
            return( ['success' => false,
            'token' => null,
            'id_user' => null,
            'login' => null,
            'role' => null]);
        }elseif ($headers['token']==='' ){
            return( ['success' => false,
                'token' => null,
                'id_user' => null,
                'login' => null,
                'role' => null]);
        }
        $token = $headers['token'];
        if ($token === null || $token === '' ) {
            http_response_code(400);
            die('empty token');
        }
        $data = JWT::decode($token, SECRET_KEY_FOR_JVT, array('HS256'))->data;
        $login = $data->login;
        $password = $data->password;
        $role = $data->role;

        $arr = self:: helpFunc($login,$password);
        $jwtToken=$arr['jwtToken'];
        $user=$arr['user'];


        return ([
            'success' => true,
            'token' => $jwtToken,
            'id_user' => $user['id_user'],
            'login' => $login,
            'role' => $role
        ]);
    }
//    public static function authorization()
//    {
//        $token = trim(htmlspecialchars($_POST['token']));
//
//        if ($token === '' && $token === null) {
//            http_response_code(400);
//            die('empty token');
//        }
//        $data = JWT::decode($token, SECRET_KEY_FOR_JVT, array('HS256'))->data;
//        $login = $data->login;
//        $password = $data->password;
//        $role = $data->role;
//
//        $arr = self:: helpFunc($login,$password);
//        $jwtToken=$arr['jwtToken'];
//        $user=$arr['user'];
//
//
//        die(json_encode([
//            'success' => true,
//            'token' => $jwtToken,
//            'login' => $login,
//            'role' => $role
//        ]));
//    }




    private  static function helpFunc($login,$password){
        /** hash +  + checkPassword maketoken = makeJWT */

        $bdHashPassword = takePassword($login)['password'];
        if(!(password_verify($password,$bdHashPassword))){
            /** перевірка чи пароль підходить*/
            die( json_encode(['err'=>true,'errors'=>[0=>'password and login isnt tru 3ffs0dm']]));
        }
        $user = auth($login);

        if ($user) {
            http_response_code(200);
        } else {
            http_response_code(400);
            die(json_encode(['success' => 'user is not found', 'user' => $user]));
        }
        $token = array(
            "data" => array(
                "login" => $login,
                "password" => $password,
                "role" => $user['role']
            )
        );
        $jwtToken = JWT::encode($token, SECRET_KEY_FOR_JVT, 'HS256');

        return ['jwtToken'=>$jwtToken,'user'=>$user];

    }


}










