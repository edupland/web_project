<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 09/03/2018
 * Time: 14:31
 */

class MessageModel
{
    //Expediteur = token
    //Destinataire = ID
    public static function sendMessage($destinataire,$message,$token){
        $bdd = ModelTools::bdd();
        $expediteur = UserModel::IdFromToken($token);


        // On vérifie que le destinataire existe bien dans la bdd.
        $req = $bdd->prepare("SELECT * FROM user WHERE id = :destinataire");
        $req->execute(array('destinataire' => $destinataire));
        $donnees = $req->fetch();

        if($donnees == null){
            return 'destinataireNotExist';
        }

        $date = date("Y-m-d H:i");

        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare("INSERT INTO messagerie SET messagerie_from = :expediteur, messagerie_to = :destinataire, messagerie_contenue = :message, messagerie_timestamp = :date");
        $req->execute(array(
                            'expediteur' => $expediteur,
                            'destinataire' => $destinataire,
                            'message' => ModelTools::encryptData(htmlspecialchars($message),$expediteur,1),
                            'date' => $date));

        return "messagesend";



    }

    public static function findUser($user){
        $bdd = ModelTools::bdd();

        $req = $bdd->prepare('SELECT id,user_pseudo,image FROM user WHERE user_pseudo LIKE :user ORDER BY user_pseudo');
        $req->execute(array(':user' => '%'.$user.'%'));
        $info_user = [];
        while($donnees = $req->fetch()){
            $donnees = array_map("utf8_encode", $donnees);
            $donnees['image']=ModelTools::decryptData($donnees['image'],$donnees['id'],5);
            $info_user[] = $donnees;
        }
        if(!empty($info_user)){
            return $info_user;

        }
        else{
            return $info_user;
        }


    }

    public static function ListUsers($token){
        $bdd=ModelTools::bdd();
        $currentuser = UserModel::IdFromToken($token);
        $req = $bdd->query('SELECT id,user_pseudo,image FROM user');
        $user = [];
        while ($donnees = $req->fetch()) {
            if($donnees['id'] != $currentuser){
                $donnees = array_map("utf8_encode", $donnees);
                $donnees['image']=ModelTools::decryptData($donnees['image'],$donnees['id'],5);
                $user[] = $donnees;
            }
        }
        if(!empty($user)){
            return $user;

        }
        else{
            return "aucunuser";
        }

    }

    public static function viewAllMessage($id,$token){
        $bdd = ModelTools::bdd();

        $expediteur = UserModel::IdFromToken($token);

        $req = $bdd->prepare('SELECT * FROM messagerie WHERE (messagerie_from = :expediteur AND messagerie_to = :id) OR (messagerie_to = :expediteur AND messagerie_from = :id) ORDER BY messagerie_timestamp');
        $req->execute(array('expediteur' => $expediteur,
                            'id' => $id));
        $messages = [];
        while($donnees = $req->fetch()){
            $donnees = array_map("utf8_encode",$donnees);
		$donnees['ex']=1;
		if($donnees['messagerie_from']==$id){
			$donnees['ex']=0;
		}
            $donnees['messagerie_contenue']=ModelTools::decryptData($donnees['messagerie_contenue'],$expediteur,1);
            $messages[] = $donnees;

        }
        if($messages == NULL){
            return "aucunmessage";
        }

        return $messages;


    }



    public static function delMessage($token, $id_message){
        $bdd = ModelTools::bdd();


        $req = $bdd->prepare("DELETE FROM messagerie WHERE messagerie_id = :id_message AND messagerie_from = :token");
        $req->execute(array('id_message' => $id_message,
                            'token' => $token));

        return "sup";



    }

}