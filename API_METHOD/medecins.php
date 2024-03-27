<?php
//require('jwt_utils.php');
require_once('../FUNC/functions_medecin.php');
$func_med = new functions_medecin();

$http_method = $_SERVER['REQUEST_METHOD'];
switch ($http_method)
{
case "POST" :
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
    break;
case "GET" :
    #$jwt=get_bearer_token();
    #if(is_jwt_valid($jwt,'948SgdrS2G3Xnmr8U3bKwrvGZN294aF5')){
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
    #}else{
        #deliver_response(400, 'Votre token n\'est pas bon');
    #}
    break;
    case 'PATCH': 
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
        break;
    
    case "PUT":
        $postedData = file_get_contents('php://input');
        $data = json_decode($postedData,true);
        $id=htmlspecialchars($_GET['id_medecin']);
        if(!isset($id) && !isset($data['nom']) && !isset($data['prenom']) && !isset($data['civilite']))
        {
            deliver_response(400, '[R401 API REST] : il manque des paramètres');
        }
        $matchingData=$func_med->update_medecin($id,$data);
        deliver_response(200,"Le médecin s'est bien modifié",$matchingData);
        break;
    
    case "DELETE":
        $id=htmlspecialchars($_GET['id_medecin']);
        if($func_med->getCountId($id)!=1)
        {
            deliver_response(404, 'Not found');
        } else 
        {
            $matchingData=$func_med->delete_medecin($id);
            deliver_response(200,"Le médecin s'est bien supprimé",$matchingData);
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