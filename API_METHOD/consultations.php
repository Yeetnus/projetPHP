<?php
require('jwt_utils.php');
require('../FUNC/functions_rdv.php');
$popo = new functions_rdv();

$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method){
case "POST" :
    $postedData = file_get_contents('php://input');
    $data = json_decode($postedData,true);
    if(!isset($data['id_medecin'])){
        deliver_response(400, '[R401 API REST] : paramètre id manquant');
    }else if(!isset($data['id_usager'])){
        deliver_response(400, '[R401 API REST] : paramètre id_usager manquant');
    }else if(!isset($data['date_consult'])){
        deliver_response(400, '[R401 API REST] : paramètre date_consult manquant');
    }elseif(!isset($data['heure_consult'])){
        deliver_response(400, '[R401 API REST] : paramètre heure_consult manquant');
    }elseif(!isset($data['duree_consult'])){
        deliver_response(400, '[R401 API REST] : paramètre duree_consult manquant');
    }else{
        $matchingData=$popo->insertRDV($data['id_medecin'],$data['id_usager'],$data['date_consult'],$data['duree_consult'],$data['heure_consult']);
        deliver_response(200,"La consultation s'est bien ajoutée",$matchingData);
    }
    break;
case "GET" :
    #$jwt=get_bearer_token();
    #if(is_jwt_valid($jwt,'948SgdrS2G3Xnmr8U3bKwrvGZN294aF5')){
        if(!isset($_GET['id']))
        {
            $matchingData=$popo->selectAllRDV();
            deliver_response(200,"tout s'est bien passé",$matchingData);
        }else{
            $id=htmlspecialchars($_GET['id']);
            if($popo->getCountId($id)){
                deliver_response(404, 'Not found');
            }
            $matchingData=$popo->selectRDVById($id);
            deliver_response(200,"La consultation a bien été selectionnée",$matchingData);
        }
    #}else{
        #deliver_response(400, 'Votre token n\'est pas bon');
    #}
    break;
    case 'PATCH': 
        if(isset($_GET['id']))
        {
            $postedData = file_get_contents('php://input');
            $data = json_decode($postedData,true);
            $phrase = $popo->selectRDVById($data['id']);
            if (empty($phrase)) {
                deliver_response(404, 'Not found');
            }
            else {
            foreach ($phrase as $key => $value) {
                if (isset($data[$key])) {
                $phrase[$key] = $data[$key];
                }
            }
            update($phrase);
            deliver_response(200,'OK',$phrase);
            }
        }
        else {
            deliver_response(400, '[R401 API REST] : paramètre id manquant');
        }
        break;
    
    case "PUT":
        $postedData = file_get_contents('php://input');
        $data = json_decode($postedData,true);
        if(!isset($data['id']) && !isset($data['date_consult']) && !isset($data['heure_consult']) && !isset($data['duree_consult']) && !isset($data['id_medecin']) && !isset($data['id_usager'])){
            deliver_response(400, '[R401 API REST] : il manque des paramètres');
        }
        $matchingData=$popo->updateRDV($data['id'],$data['date_consult'],$data['heure_consult'],$data['duree_consult'],$data['id_medecin'],$data['id_usager']);
        deliver_response(200,"La phrase s'est bien modifiée",$matchingData);
        break;
    
    case "DELETE":
        $id=htmlspecialchars($_GET['id']);
        if($popo->getCountId($id)){
            deliver_response(404, 'Not found');
        }else if($id<44 || $id>0){
            deliver_response(400, '[R401 API REST] : vous ne pouvez pas supprimer ces phrases');
        }
        $matchingData=$popo->deleteRDV($id);
        deliver_response(200,"La phrase s'est bien supprimée",$matchingData);
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