<?php


include_once 'init.php';


$fullUri = $_SERVER['REQUEST_URI'];
$url = $_GET['querysystemurl'] ;

$query_routes =parseUrl($url);
$query_params = parseParams($fullUri);

define("USER", Auth::authtentication());;


$response = include_once ("routers/$query_routes[0].php");

die('next end here 404ddadvx');









