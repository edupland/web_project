<?php


class ServicesView
{


    public static function addService(){
        ViewTools::send_error("200","Service Ajoute");
    }

    public static function modifyService(){
        ViewTools::send_error("200", "Service Modifié");
    }


    public static function hideService(){
        ViewTools::send_error("200", "Service caché");
    }

    public static function revealService(){
        ViewTools::send_error("200", "Service revele");
    }

    public static function showAllServices($services){
        $json = json_encode(['message' => $services]);
        echo $json;
    }


    public static function showService($service){
        $json = json_encode(['message' => (array_map("utf8_encode",$service))]);
        echo $json;
    }


    public static function showServiceTypes($types){
        $json = json_encode(['message' => $types]);
        echo $json;
    }

    public static function addServiceType(){
        ViewTools::send_error("200","Type de service ajoute");
    }

    public static function modifyServiceType(){
        ViewTools::send_error("200", "Type de service modifie");
    }

    public static function delServiceType(){
        ViewTools::send_error("200", "Service supprime");

    }


}