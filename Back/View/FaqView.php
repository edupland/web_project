<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 02/03/2018
 * Time: 11:38
 */

class FaqView
{

    public static function ViewFaq($faq){
        $json=json_encode(['message' => $faq]);
        echo $json;
    }

    public static function AddFaq(){
        ViewTools::send_error("200","Post ajouté");
    }

    public static function DelFaq(){
        ViewTools::send_error("200","Post supprimé");

    }

    public static function ModifyFaq(){
        ViewTools::send_error("200","Post modifié");

    }

}