<?php

/** for jwt*/

use Firebase\JWT\JWT;


const BASE_URL = '/server_rusya/back/';
const DB_HOST = "localhost";
const USER_NAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'rusya';
const HOST = 'http://localhost/server_rusya/back/';
//const HOST = 'https://ruslana-server.herokuapp.com/';
$secretKey = '111';
const SECRET_KEY_FOR_JVT = 'fdksdfkfisадfldskfjQPWEOdkfjlsdfk3034fj34';

include_once 'core/corse.php';
include_once 'core/db.php';
include_once 'core/system.php';
include_once 'core/helps.php';

include_once 'models/files.php';
include_once 'models/youTube.php';
include_once 'models/concerts.php';
include_once 'models/auth.php';


include_once('./controllers/authorization.php');
include_once('./controllers/concerts.php');
include_once('./controllers/files.php');
include_once('./controllers/youtube.php');






include_once(__DIR__.'/vendor/autoload.php');

include_once ('./vendor/firebase/php-jwt/src/BeforeValidException.php');
include_once ('./vendor/firebase/php-jwt/src/ExpiredException.php');
include_once ('./vendor/firebase/php-jwt/src/SignatureInvalidException.php');
include_once ('./vendor/firebase/php-jwt/src/JWT.php');

/** initing JWT*/




