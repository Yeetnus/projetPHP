<?php
require('../API_AUTH/jwt_utils.php');
require_once('../FUNC/functions_medecin.php');
require('../FUNC/BDD.php');
$func_med = new functions_medecin();

$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method)
{
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
            if(!isset($data['nom']))
            {
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant, veuillez précisez le nom du médecin.');
            }else if(!isset($data['prenom']))
            {
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant, veuillez précisez le prénom du médecin.');
            }elseif(!isset($data['civilite']))
            {
                deliver_response(400, '[R401 API REST] : paramètre phrase manquant, veuillez précisez la civilité du médecin.');
            }else
            {
                $matchingData=$func_med->insert_medecin($data['nom'],$data['prenom'],$data['civilite']);
                deliver_response(200,"Le médecin s'est bien ajouté",$matchingData);
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
            if(!isset($_GET['id_medecin']))
            {
                $matchingData=$func_med->select_all_medecin();
                deliver_response(200,"Tout s'est bien passé",$matchingData);
            }else
            {
                $id=htmlspecialchars($_GET['id_medecin']);
                if($func_med->getCountId($id)!=1)
                {
                    deliver_response(404, 'Not found');
                } else 
                {
                    $matchingData=$func_med->select_medecin_By_Id($id);
                    deliver_response(200,"Le médecin a bien été selectionné",$matchingData);
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
                if(isset($_GET['id_medecin']))
                {
                    $postedData = file_get_contents('php://input');
                    $data = json_decode($postedData,true);
                    $id=htmlspecialchars($_GET['id_medecin']);
                    $medecin = $func_med->select_medecin_By_Id($id);
                    if (empty($medecin)) 
                    {
                        deliver_response(404, 'Not found');
                    }
                    else 
                    {
                        $func_med->update_medecin($id, $data);
                        deliver_response(200,'OK',$medecin);
                    }
                }
                else 
                {
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
                $id=htmlspecialchars($_GET['id_medecin']);
                if(!isset($id) && !isset($data['nom']) && !isset($data['prenom']) && !isset($data['civilite']))
                {
                    deliver_response(400, '[R401 API REST] : il manque des paramètres');
                }
                $matchingData=$func_med->update_medecin($id,$data);
                deliver_response(200,"Le médecin s'est bien modifié",$matchingData);
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
            $id=htmlspecialchars($_GET['id_medecin']);
            if($func_med->getCountId($id)!=1)
            {
                deliver_response(404, 'Not found');
            } else 
            {
                $matchingData=$func_med->delete_medecin($id);
                deliver_response(200,"Le médecin s'est bien supprimé",$matchingData);
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