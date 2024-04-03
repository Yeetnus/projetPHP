<?php
require('functions.php');
require('../FUNC/functions_rdv.php');
$popo = new functions_rdv();

$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method){
case "POST" :
    $jwt=get_bearer_token();
    if(is_valid($jwt)){
        $token_parts = explode('.', $jwt);

        // Extract the payload part
        $payload_base64 = $token_parts[1];

        // Decode the payload from base64
        $payload_json = base64_decode($payload_base64);

        // Convert JSON to PHP object
        $payload_data = json_decode($payload_json);
        
        $role = $payload_data->role;
        if($role=="admin"){
            $postedData = file_get_contents('php://input');
            $data = json_decode($postedData,true);
            if(!isset($data['id_medecin'])){
                deliver_response(400, 'Paramètre id manquant');
            }else if(!isset($data['id_usager'])){
                deliver_response(400, 'Paramètre id_usager manquant');
            }else if(!isset($data['date_consult'])){
                deliver_response(400, 'Paramètre date_consult manquant');
            }elseif(!isset($data['heure_consult'])){
                deliver_response(400, 'Paramètre heure_consult manquant');
            }elseif(!isset($data['duree_consult'])){
                deliver_response(400, 'Paramètre duree_consult manquant');
            }else{
                $matchingData = $popo->insertRDV($data['date_consult'],$data['heure_consult'] ,$data['duree_consult'],$data['id_medecin'],$data['id_usager']);
                deliver_response(201,"La consultation s'est bien ajoutée",$matchingData);
            }
        }else{
            deliver_response(403, 'Vous n\'avez pas les droits pour ajouter une consultation');
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
                $matchingData=$popo->selectAllRDV();
                deliver_response(200,"Les consultations ont bien étés sélectionnées",$matchingData);
            }else{
                $id=htmlspecialchars($_GET['id']);
                $matchingData=$popo->selectRDVById($id);
                if (empty($$matchingData)) {
                    deliver_response(404, 'Not found');
                }
                else {
                    deliver_response(200,"La consultation s\'est bien sélectionnée",$matchingData);
                }
            }
        }else{
            deliver_response(403, 'Vous n\'avez pas les droits pour sélectionner une consultation');
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
                if(isset($_GET['id_consult']))
                {
                    $postedData = file_get_contents('php://input');
                    $data = json_decode($postedData,true);
                    $id=htmlspecialchars($_GET['id_consult']);
                    $rdv = $popo->selectRDVById($id);
                    if (empty($rdv)) {
                        deliver_response(404, 'Not found');
                    }
                    else {
                        $popo->updateRDV($id, $data);
                        deliver_response(201,'La consultation s\'est bien modifiée',$rdv);
                    }
                }
                else {
                    deliver_response(400, 'Paramètre id manquant');
                }
            }else{
                deliver_response(403, 'Vous n\'avez pas les droits pour modifier une consultation');
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
                $id=htmlspecialchars($_GET['id_medecin']);
                if(!isset($id) && !isset($data['nom']) && !isset($data['prenom']) && !isset($data['civilite'])){
                    deliver_response(400, 'Il manque des paramètres');
                }
                $rdv = $popo->selectRDVById($id);
                if (empty($rdv)) {
                    deliver_response(404, 'Not found');
                }
                else {
                    $matchingData=$func_med->update_medecin($id,$data);
                    deliver_response(200,"Votre consultation s'est bien modifiée",$matchingData);
                }
            }else{
                deliver_response(403, 'Vous n\'avez pas les droits pour modifier une consultation');
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
                if($popo->getCountId($id)){
                    $matchingData=$popo->deleteRDV($id);
                    deliver_response(200,"La consultation s'est bien supprimée",$matchingData);
                }else{
                    deliver_response(404, 'Not found');
                }
            }else{
                deliver_response(403, 'Vous n\'avez pas les droits pour supprimer une consultation');
            }
        }else{
            deliver_response(498, 'Votre token n\'est pas bon');
        }
        break;
    default:
        deliver_response(405, 'Method Not Allowed');
        break;
    }
