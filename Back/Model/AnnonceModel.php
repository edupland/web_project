<?php

class AnnonceModel
{


    public static function addAnnounce($token,$title,$description,$price,$tph,$email){
        $bdd= ModelTools::bdd();
        $user = UserModel::IdFromToken($token);
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('INSERT INTO annonce_user SET owner = :user, title = :title, description = :description, price = :price,tph = :tph, email = :email');
        $req->execute(array(
            ':user' => $user,
            ':title' => $title,
            ':description' => $description,
            ':price' => $price,
            ':tph' => $tph,
            ':email' => $email
        ));
        return 1;

    }

    public static function validateAnnounce($id){
        $bdd= ModelTools::bdd();
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('UPDATE annonce_user SET valid = 1 WHERE :id = id');
        $req->execute(array(':id' => $id));
        return "valid";

    }





    public static function modifAnnounceAdmin($id,$valid){
        $bdd=ModelTools::bdd();
        $req = $bdd->prepare('UPDATE annonce_user SET valid = :valid WHERE id = :id');
        $req->execute(array(':valid' => $valid,
            ':id' => $id));
        return "deleted";

    }

    public static function showannounceadmin(){
        $bdd=ModelTools::bdd();
        $req = $bdd->query('SELECT * FROM annonce_user WHERE valid != -1');

        $announces = [];
        while($announce = $req->fetch()) {
            $announce = array_map("utf8_encode",$announce);
            $id = $announce['owner'];
            $announce['user'] = UserModel::PseudoFromId($id);
            $announces[] = $announce;

        }
        return $announces;

    }


    public static function showAllAnnounces(){
        $bdd=ModelTools::bdd();
        $req = $bdd->query('SELECT * FROM annonce_user WHERE valid = 1');

        $announces = [];
        while($announce = $req->fetch()) {
            $announce = array_map("utf8_encode",$announce);
            $id = $announce['owner'];
            $announce['user'] = UserModel::PseudoFromId($id);
            $announces[] = $announce;

        }
        return $announces;


    }

    public static function showAnnounce($id){
        $bdd=ModelTools::bdd();
        $req = $bdd->prepare('SELECT * FROM annonce_user WHERE id = :id');

        $req->execute(array(':id' => $id));
        $announce = $req->fetch();
        $id_user = $announce['owner'];
        $announce['user'] = UserModel::PseudoFromId($id_user);


        if($announce == null){
            return -1;
        } else {
            $announce = array_map("utf8_encode",$announce);
            return ($announce);
        }
    }



}