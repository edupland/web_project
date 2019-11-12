<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 09/03/2018
 * Time: 14:31
 */

class MessageController
{
    // id = destinataire, message, token
    public function sendMessage($destinataire,$message,$token){
        $send = MessageModel::sendMessage($destinataire,$message,$token);

        if($send == "destinataireNotExist"){
            ViewTools::send_error(404,"Le destinataire n'existe pas.");
        }
        else{
            MessageView::viewSend();
        }

    }

    public function findUser($user,$token){
        $found = MessageModel::findUser($user);

        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }

        else if(empty($found)){
            MessageView::findUser($found);
        }
        else{
            MessageView::findUser($found);
        }

    }

    public function Listusers($token){

        $list = MessageModel::ListUsers($token);

        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }

        else if($list == "aucunusers"){
            ViewTools::send_error(404,"Aucun utilisateur n'a été trouvé.");
        }
        else{
            MessageView::viewList($list);
        }
    }

    public function viewAllMessage($id,$token){
        $viewA = MessageModel::viewAllMessage($id,$token);

        if($viewA == "aucunmessage"){
            ViewTools::send_error(404,"Aucun message n'a été trouvé.");
        }
        else{
            MessageView::viewAll($viewA);

        }

    }


    public function delMessage($token,$id_message){
        $delete = MessageModel::delMessage($token,$id_message);

        if($delete == "sup"){
            MessageView::viewDel();

        }
        else{
            ViewTools::send_error(500,"Erreur lors de la suppression du message.");

        }

    }

}