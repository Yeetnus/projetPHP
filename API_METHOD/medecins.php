<?php
require('functions.php');
require_once('../func/functions_medecin.php');
$func_med = new functions_medecin();

$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method)
{
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
            if(!isset($data['nom']))
            {
                deliver_response(400, 'Paramètre nom manquant');
            }else if(!isset($data['prenom']))
            {
                deliver_response(400, 'Paramètre prenom manquant');
            }elseif(!isset($data['civilite']))
            {
                deliver_response(400, 'Paramètre civilite manquant');
            }else
            {
                $matchingData=$func_med->insert_medecin($data['nom'],$data['prenom'],$data['civilite']);
                deliver_response(201,"Le médecin s'est bien ajouté",$matchingData);
            }
        }else{
            deliver_response(403, 'Vous n\'avez pas les droits pour ajouter un médecin');
        }
    }else{
        deliver_response(498, 'Votre token n\'est pas bon',$jwt);
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
                $matchingData=$func_med->select_all_medecin();
                deliver_response(200,"Les médecin ont bien étés sélectionnés",$matchingData);
            }else
            {
                $id=htmlspecialchars($_GET['id']);
                if($func_med->getCountId($id)!=1)
                {
                    deliver_response(404, 'Not found');
                } else 
                {
                    $matchingData=$func_med->select_medecin_By_Id($id);
                    deliver_response(200,"Le médecin s\'est bien selectionné",$matchingData);
                }
            }
        }else{
            deliver_response(403, 'Vous n\'avez pas les droits pour sélectionner un médecin');
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
                    $medecin = $func_med->select_medecin_By_Id($id);
                    if (empty($medecin)) 
                    {
                        deliver_response(404, 'Not found');
                    }
                    else 
                    {
                        $func_med->update_medecin($id, $data);
                        deliver_response(200,'Le médecin s\'est bien modifié',$medecin);
                    }
                }
                else 
                {
                    deliver_response(400, 'Paramètre id manquant');
                }
            }else{
                deliver_response(403, 'Vous n\'avez pas les droits pour modifier un médecin');
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
                if(!isset($id) && !isset($data['nom']) && !isset($data['prenom']) && !isset($data['civilite']))
                {
                    deliver_response(400, 'Il manque des paramètres');
                }
                $matchingData=$func_med->update_medecin($id,$data);
                deliver_response(200,"Le médecin s'est bien modifié",$matchingData);
            }else{
                deliver_response(403, 'Vous n\'avez pas les droits pour modifier un médecin');
            }
        }else{
            deliver_response(498, 'Votre token n\'est pas bon');
        }
        break;
    
    case "DELETE":
        $jwt=get_bearer_token();
        if(is_valid($jwt)){
            if($role=="admin"){
                $id=htmlspecialchars($_GET['id']);
                if($func_med->getCountId($id)!=1)
                {
                    deliver_response(404, 'Not found');
                } else 
                {
                    $matchingData=$func_med->delete_medecin($id);
                    deliver_response(200,"Le médecin s'est bien supprimé",$matchingData);
                }
            }else{
                deliver_response(403, 'Vous n\'avez pas les droits pour supprimer un médecin');
            }
        }else{
            deliver_response(498, 'Votre token n\'est pas bon');
        }
        break;
    default:
        deliver_response(405, 'Method Not Allowed');
        break;
    }

   