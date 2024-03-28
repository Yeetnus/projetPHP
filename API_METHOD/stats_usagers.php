<?php
require('../API_AUTH/jwt_utils.php');
require('../FUNC/functions_stats.php');
$popo = new functions_stats();

$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method){
case "GET" :
    $jwt=get_bearer_token();
    if(is_jwt_valid($jwt,'secret')){
        $matchingData=$popo->getStatsUsager();
        deliver_response(200,"tout s'est bien passé",$matchingData);
    }else{
        deliver_response(400, 'Votre token n\'est pas bon');
    }
    break;
default:
    deliver_response(405, 'Method Not Allowed');
    break;
}
function deliver_response($status_code, $status_message, $data=null){
    http_response_code($status_code); //Utilise un message standardisé en fonction du code HTTP
    //header("HTTP/1.1 $status_code $status_message"); //Permet de personnaliser le message associé au code HTTP
    header("Content-Type:application/json; charset=utf-8");//Indique au client le format de la réponse
    $response['status_code'] = $status_code;
    $response['status_message'] = $status_message;
    $response['data'] = $data;
    /// Mapping de la réponse au format JSON
    $json_response = json_encode($response);
    if($json_response===false)
     die('json encode ERROR : '.json_last_error_msg());
    /// Affichage de la réponse (Retourné au client)
    echo $json_response;
}