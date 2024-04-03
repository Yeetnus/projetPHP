<?php
require('functions.php');
require('../func/functions_stats.php');
$popo = new functions_stats();

$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method){
case "GET" :
    $jwt=get_bearer_token();
    if(is_valid($jwt)){
        $matchingData=$popo->getStatsMedecins();
        deliver_response(200,"Les stats de médecin ont bien étés renvoyées",$matchingData);
    }else{
        deliver_response(498, 'Votre token n\'est pas bon');
    }
    break;
default:
    deliver_response(405, 'Method Not Allowed');
    break;
}