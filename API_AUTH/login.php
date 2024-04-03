<?php
session_start();
require('../api_method/functions.php');
require('../func/functions_auth.php');
$popo = new functions_auth();

$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method){
 case "POST" :
    $postedData = file_get_contents('php://input');
    $data = json_decode($postedData,true);
    if ($popo->isValidUser($data['login'], $data['mdp'])) {
        $login=$data['login']; 
        $role = $popo->getRoleUser($data['login'], $data['mdp']);
        $headers=array('alg'=>'HS256','typ'=>'JWT');
        $payload=array('login'=>$login, 'role'=>$role,'exp'=>(time()+3600));
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
    
    if(is_valid($jwt)){
        $token_parts = explode('.', $jwt);
        $payload_base64 = $token_parts[1];
        $payload_json = base64_decode($payload_base64);
        $payload_data = json_decode($payload_json);
        $role = $payload_data->role;
        deliver_response(200, 'Votre jeton est bon',$role);
    }else{
        deliver_response(498, 'Votre jeton n\'est pas bon');
    }
    break;


default:
    deliver_response(405, 'Method Not Allowed');
}

