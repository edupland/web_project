<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 02/03/2018
 * Time: 10:55
 */

class FaqModel
{


    public static function viewFaQ(){
        $bdd = ModelTools::bdd();

        $req = $bdd->prepare("SELECT faq_id,faq_questions,faq_answers FROM faq WHERE faq_hidden = 0");
        $req->execute(array('faq_hidden' => 0));
        $data=[];
        while ($faq = $req->fetch()) {
            $faq = array_map("utf8_encode",$faq);
            $data[]=$faq;
        }

        return $data;

    }


    public static function addFaQ($token,$question,$response){
        $id = UserModel::IdFromToken($token);
        $bdd = ModelTools::bdd();

        $req = $bdd->query('SELECT * FROM faq');
        while ($donnees = $req->fetch()) {
            if ($donnees['faq_questions'] == $question) {
                return "questionexist";
            }
        }
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare("INSERT INTO faq(faq_questions,faq_answers,faq_userpost) VALUES(:question,:response,:id)");
        $req->execute(array(':question' => $question,
                            ':response' => $response,
                            ':id' => $id,
        ));

        return "ok";

    }


    public static function deleteFaQ($idpost){

        $exist = false;
        $bdd = ModelTools::bdd();
        $req = $bdd->query('SELECT * FROM faq');
        while ($donnees = $req->fetch()) {
            if ($donnees['faq_id'] == $idpost) {
                $exist = true;
            }
        }
        if($exist == false) return "noexist";

        if($donnees['faq_hidden']==0){
            $bdd->exec('SET NAMES utf8');
            $delete = $bdd->prepare("UPDATE faq SET faq_hidden = 1 WHERE faq_id = :idpost");
            $delete->execute( array( ':idpost' => $idpost ));
        }
        else{
            $bdd->exec('SET NAMES utf8');
            $delete = $bdd->prepare("UPDATE faq SET faq_hidden = 0 WHERE faq_id = :idpost");
            $delete->execute( array( ':idpost' => $idpost ));
        }

        return 'hidden';



    }

    public static function modifyFaQ($idpost,$question,$reponse){

        $exist = false;
        $bdd = ModelTools::bdd();
        $req = $bdd->query('SELECT * FROM faq');
        while ($donnees = $req->fetch()) {
            if ($donnees['faq_id'] == $idpost) {
                $exist = true;
            }
        }
        if($exist == false) return "noexist";

        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('UPDATE faq SET faq_questions = :quest, faq_answers=:rep WHERE faq_id = :idpost');
        $req->execute(array(':quest' => $question,
							':rep' => $reponse,
							':idpost' => $idpost));


        return "ok";
    }

}