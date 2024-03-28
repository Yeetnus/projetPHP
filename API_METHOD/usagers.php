<?php
require('../API_AUTH/jwt_utils.php');
require_once('../FUNC/functions_usager.php');
$func_usa = new functions_usager();

$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method){
case "POST" :
    $jwt=get_bearer_token();
    if(is_jwt_valid($jwt,'secret')){
        $token_parts = explode('.', $jwt);
        $payload_base64 = $token_parts[1];
        $payload_json = base64_decode($payload_base64);
        $payload_data = json_decode($payload_json);
        $role = $payload_data->role;
        if($role=="admin"){
            $postedData = file_get_contents('php://input');
            $data = json_decode($postedData,true);
            if(!isset($data['nom'])){
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant');
            }else if(!isset($data['prenom'])){
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant');
            }elseif(!isset($data['civilite'])){
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant');
            }elseif(!isset($data['sexe'])){
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant');
            }elseif(!isset($data['adresse'])){
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant');
            }elseif(!isset($data['code_postal'])){
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant');
            }elseif(!isset($data['ville'])){
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant');
            }elseif(!isset($data['date_nais'])){
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant');
            }elseif(!isset($data['lieu_nais'])){
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant');
            }elseif(!isset($data['num_secu'])){
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant');
            }elseif(!isset($data['id_medecin'])){
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant');
            }else{
                $matchingData=$func_usa->insert_usager($data);
                deliver_response(200,"La consultation s'est bien ajoutée",$matchingData);
            }
        }else{
            deliver_response(400, 'Vous n\'avez pas les droits pour ajouter une consultation');
        }
    }else{
        deliver_response(400, 'Votre token n\'est pas bon');
    }
    break;
case "GET" :
    $jwt=get_bearer_token();
    if(is_jwt_valid($jwt,'secret')){
        $token_parts = explode('.', $jwt);
        $payload_base64 = $token_parts[1];
        $payload_json = base64_decode($payload_base64);
        $payload_data = json_decode($payload_json);
        $role = $payload_data->role;
        if($role=="admin"){
            if(!isset($_GET['id']))
            {
                $matchingData=$func_usa->select_all_usager();
                deliver_response(200,"tout s'est bien passé",$matchingData);
            }else{
                $id=htmlspecialchars($_GET['id']);
                if($func_usa->getCountId($id)!=1){
                    deliver_response(404, 'Not found');
                } else {
                $matchingData=$func_usa->select_usager_By_Id($id);
                deliver_response(200,"La consultation a bien été selectionnée",$matchingData);
                }
            }
        }else{
            deliver_response(400, 'Vous n\'avez pas les droits pour ajouter une consultation');
        }
    }else{
        deliver_response(400, 'Votre token n\'est pas bon');
    }
    break;
    case 'PATCH': 
        $jwt=get_bearer_token();
        if(is_jwt_valid($jwt,'secret')){
            $token_parts = explode('.', $jwt);
            $payload_base64 = $token_parts[1];
            $payload_json = base64_decode($payload_base64);
            $payload_data = json_decode($payload_json);
            $role = $payload_data->role;
            if($role=="admin"){
                if(isset($_GET['id']))
                {
                    $postedData = file_get_contents('php://input');
                    $data = json_decode($postedData,true);
                    $id=htmlspecialchars($_GET['id']);
                    $usager = $func_usa->select_usager_By_Id($id);
                    if (empty($usager)) {
                        deliver_response(404, 'Not found');
                    }
                    else {
                        $func_usa->update_usager($id, $data);
                        deliver_response(200,'OK',$usager);
                    }
                }
                else {
                    deliver_response(400, '[R401 API REST] : paramètre id manquant');
                }
            }else{
                deliver_response(400, 'Vous n\'avez pas les droits pour ajouter une consultation');
            }
        }else{
            deliver_response(400, 'Votre token n\'est pas bon');
        }
        break;
    
    case "PUT":
        $jwt=get_bearer_token();
        if(is_jwt_valid($jwt,'secret')){
            $token_parts = explode('.', $jwt);
            $payload_base64 = $token_parts[1];
            $payload_json = base64_decode($payload_base64);
            $payload_data = json_decode($payload_json);
            $role = $payload_data->role;
            if($role=="admin"){
                $postedData = file_get_contents('php://input');
                $data = json_decode($postedData,true);
                $id=htmlspecialchars($_GET['id']);
                if(!isset($id) && !isset($data['date_consult']) && !isset($data['heure_']) && !isset($data['faute']) && !isset($data['signalement'])){
                    deliver_response(400, '[R401 API REST] : il manque des paramètres');
                }
                $matchingData=$func_usa->update_usager($id,$data);
                deliver_response(200,"La phrase s'est bien modifiée",$matchingData);
            }else{
                deliver_response(400, 'Vous n\'avez pas les droits pour ajouter une consultation');
            }
        }else{
            deliver_response(400, 'Votre token n\'est pas bon');
        }
        break;
    
    case "DELETE":
        $jwt=get_bearer_token();
        if(is_jwt_valid($jwt,'secret')){
            $token_parts = explode('.', $jwt);
            $payload_base64 = $token_parts[1];
            $payload_json = base64_decode($payload_base64);
            $payload_data = json_decode($payload_json);
            $role = $payload_data->role;
            if($role=="admin"){
                $id=htmlspecialchars($_GET['id']);
                if($func_usa->getCountId($id)!=1){
                    deliver_response(404, 'Not found');
                }
                $matchingData=$func_usa->delete_usager($id);
                deliver_response(200,"La phrase s'est bien supprimée",$matchingData);
            }else{
                deliver_response(400, 'Vous n\'avez pas les droits pour ajouter une consultation');
            }
        }else{
            deliver_response(400, 'Votre token n\'est pas bon');
        }
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