<?php
session_start();
require('jwt_utils.php');
require('../FUNC/functions_auth.php');
$popo = new functions_auth();

$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method){
 case "POST" :
    $postedData = file_get_contents('php://input');
    $data = json_decode($postedData,true);
    if ($popo->isValidUser($data['login'], $data['mdp'])) {
        $login=$data['login']; 
        $role = $popo->getRoleUser($data['login'], $data['mdp']);
        deliver_response(200, 'pute',$role);
        $headers=array('alg'=>'HS256','typ'=>'JWT');
        $payload=array('login'=>$login, 'role'=>"admin",'exp'=>(time()+3600));
        $secret='secret';
        $jwt=generate_jwt($headers,$payload,$secret);
        
        $_SESSION['session'] = 'aaaaa';
        
        deliver_response(200, 'Votre jeton s\'est bien généré',$jwt);        
    }else{
        deliver_response(403, 'Vos identifiants ne sont pas bons',$data);
    }
    break;
case "GET" :
    $jwt=get_bearer_token();
    if(is_jwt_valid($jwt,'secret')){
        deliver_response(200, 'Votre token est bon');
    }else{
        deliver_response(400, 'Votre token n\'est pas bon');
    }
    break;


default:
    deliver_response(400, '[R401 API REST] : cette méthode n\'est pas utilisable');
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