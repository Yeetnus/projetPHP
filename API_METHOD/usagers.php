<?php
require('functions.php');
require_once('../FUNC/functions_usager.php');
$func_usa = new functions_usager();

$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method){
case "POST" :
    $jwt=get_bearer_token();
    if(is_valid($jwt)){
        $token_parts = explode('.', $jwt);
        $payload_base64 = $token_parts[1];
        $payload_json = base64_decode($payload_base64);
        $payload_data = json_decode($payload_json);
        $role = $payload_data->role;
        if($role=="admin"){
            $postedData = file_get_contents('php://input');
            $data = json_decode($postedData,true);
            if(!isset($data['nom'])){
                deliver_response(400, 'Paramètre nom manquant');
            }else if(!isset($data['prenom'])){
                deliver_response(400, 'Paramètre prenom manquant');
            }elseif(!isset($data['civilite'])){
                deliver_response(400, 'Paramètre civilite manquant');
            }elseif(!isset($data['sexe'])){
                deliver_response(400, 'Paramètre sexe manquant');
            }elseif(!isset($data['adresse'])){
                deliver_response(400, 'Paramètre adresse manquant');
            }elseif(!isset($data['code_postal'])){
                deliver_response(400, 'Paramètre code_postal manquant');
            }elseif(!isset($data['ville'])){
                deliver_response(400, 'Paramètre ville manquant');
            }elseif(!isset($data['date_nais'])){
                deliver_response(400, 'Paramètre date_nais manquant');
            }elseif(!isset($data['lieu_nais'])){
                deliver_response(400, 'Paramètre lieu_nais manquant');
            }elseif(!isset($data['num_secu'])){
                deliver_response(400, 'Paramètre num_secu manquant');
            }elseif(!isset($data['id_medecin'])){
                deliver_response(400, 'Paramètre id_medecin manquant');
            }else{
                $matchingData=$func_usa->insert_usager($data);
                deliver_response(201,"L'usager s'est bien ajouté",$matchingData);
            }
        }else{
            deliver_response(403, 'Vous n\'avez pas les droits pour ajouter un usager');
        }
    }else{
        deliver_response(498, 'Votre token n\'est pas bon');
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
                deliver_response(200,"L'usager s'est bien selectionné",$matchingData);
                }
            }
        }else{
            deliver_response(403, 'Vous n\'avez pas les droits pour sélectionner un usager');
        }
    }else{
        deliver_response(498, 'Votre token n\'est pas bon');
    }
    break;
    case 'PATCH': 
        $jwt=get_bearer_token();
        if(is_valid($jwt)){
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
                        deliver_response(200,'L\'usager s\'est bien modifié',$usager);
                    }
                }
                else {
                    deliver_response(400, 'Paramètre id manquant');
                }
            }else{
                deliver_response(403, 'Vous n\'avez pas les droits pour modifier un usager');
            }
        }else{
            deliver_response(498, 'Votre token n\'est pas bon');
        }
        break;
    
    case "PUT":
        $jwt=get_bearer_token();
        if(is_valid($jwt)){
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
                    deliver_response(400, 'Il manque des paramètres');
                }
                $usager = $func_usa->select_usager_By_Id($id);
                if (empty($usager)) {
                    deliver_response(404, 'Not found');
                }
                else {
                    $matchingData=$func_usa->update_usager($id,$data);
                    deliver_response(200,"L\'usager s'est bien modifié",$matchingData);
                }
            }else{
                deliver_response(403, 'Vous n\'avez pas les droits pour modifier un usager');
            }
        }else{
            deliver_response(498, 'Votre token n\'est pas bon');
        }
        break;
    
    case "DELETE":
        $jwt=get_bearer_token();
        if(is_valid($jwt)){
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
                deliver_response(200,"L\'usager s'est bien supprimé",$matchingData);
            }else{
                deliver_response(403, 'Vous n\'avez pas les droits pour supprimer un usager');
            }
        }else{
            deliver_response(498, 'Votre token n\'est pas bon');
        }
        break;
    default:
        deliver_response(405, 'Method Not Allowed');
        break;
    }
