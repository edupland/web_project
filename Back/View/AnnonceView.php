<?php

class AnnonceView
{


    public static function addAnnounce(){
        ViewTools::send_error("200","Annonce Ajoute");
    }

    public static function validateAnnounce(){
        ViewTools::send_error("200","Annonce Validée");
    }

    public static function modifAnnounceAdmin(){
        ViewTools::send_error("200", "Annonce Modifiée");
    }


    public static function showAllAnnounces($announces){
        $json = json_encode(['message' => ($announces)]);
        echo $json;
    }

    public static function showannounceadmin($announces){
        $json = json_encode(['message' => ($announces)]);
        echo $json;
    }


    public static function showAnnounce($announce){

        $json = json_encode(['message' => ($announce)]);
        echo $json;
    }

    public static function showListAnnonce($data){
        $json=json_encode(['message' => $data]);
        echo $json;
    }


}