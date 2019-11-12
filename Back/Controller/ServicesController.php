<?php

class ServicesController
{


    public static function addService($type, $message, $address, $tph, $description, $photo, $author, $lat, $lng, $mail,$lmo,$lmf,$lamo,$lamf,$mmo,$mmf, $mamo,$mamf,$memo,$memf,$meamo,$meamf, $jmo,
                                      $jmf,$jamo,$jamf,$vmo,$vmf,$vamo,$vamf,$smo,$smf,$samo,$samf,$dmo, $dmf,$damo,$damf){

        $add = ServicesModel::addService($type, $message, $address, $tph, $description, $photo, $author, $lat, $lng, $mail,$lmo,$lmf,$lamo,$lamf,$mmo,$mmf, $mamo,$mamf,$memo,$memf,$meamo,$meamf, $jmo,
            $jmf,$jamo,$jamf,$vmo,$vmf,$vamo,$vamf,$smo,$smf,$samo,$samf,$dmo, $dmf,$damo,$damf);
        if($add != - 1){
            ServicesView::addService();

        }
        else{
            ViewTools::send_error(500,"Pas autorisé");
        }
    }


    public static function modifyService($id,$type, $message, $address, $tph, $description, $photo, $author, $lat, $lng, $mail, $lmo,$lmf,$lamo,$lamf,$mmo,$mmf, $mamo,$mamf,$memo,$memf,$meamo,$meamf, $jmo,
                                         $jmf,$jamo,$jamf,$vmo,$vmf,$vamo,$vamf,$smo,$smf,$samo,$samf,$dmo, $dmf,$damo,$damf){

        $modify = ServicesModel::modifyService($id,$type, $message, $address, $tph, $description, $photo, $author, $lat, $lng, $mail, $lmo,$lmf,$lamo,$lamf,$mmo,$mmf, $mamo,$mamf,$memo,$memf,$meamo,$meamf, $jmo,
            $jmf,$jamo,$jamf,$vmo,$vmf,$vamo,$vamf,$smo,$smf,$samo,$samf,$dmo, $dmf,$damo,$damf);
        if($modify == 1){
            ServicesView::modifyService();
        }
        else {
            ViewTools::send_error(500, "Pas autorisé");
        }


    }

    public static function hideService($id){

        $hide = ServicesModel::hideService($id);

        if($hide == 1){
            ServicesView::hideService();
        }
        else {
            ViewTools::send_error(500, "Pas autorisé");
        }

    }

    public static function revealService($id){

        $show = ServicesModel::revealService($id);

        if($show == 1){
            ServicesView::revealService();
        }
        else {
            ViewTools::send_error(500, "Pas autorisé");
        }

    }



    public static function showAllServices($type){

        $data = ServicesModel::showAllServices($type);

        if($data == -1){
            ViewTools::send_error(404,"Pas de services");
        }
        else{
            ServicesView::showAllServices($data);
        }

    }


    public static function showService($id){
        $service = ServicesModel::showService($id);
        if($service == -1){
            ViewTools::send_error("404", "Service inexistant");
        }
        else{
            ServicesView::showService($service);
        }

    }

    public static function showServiceTypes(){
        $types = ServicesModel::showServiceTypes();
        if($types == -1){
            ViewTools::send_error("404","Pas de types de services");
        }
        else {
            ServicesView::showServiceTypes($types);
        }

    }

    
    public static function addServiceType($name,$icon,$marker, $token){
        $add = ServicesModel::addServiceType($name,$icon,$marker, $token);

        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }


        if($add == 1){
            ServicesView::addServiceType();

        }
        else{
            ViewTools::send_error(500,"Pas autorisé");
        }

    }

    public static function modifyServiceType($id, $name, $icon, $marker,$token){
        $mod = ServicesModel::modifyServiceType($id, $name, $icon, $marker);

        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }

        if($mod == 1){
            ServicesView::modifyServiceType();

        }
        else{
            ViewTools::send_error(500,"Pas autorisé");
        }

    }


    public static function delServiceType($type_id,$token){
        $del = ServicesModel::delServiceType($type_id, $token);

        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }

        if($del == 1){
            ServicesView::delServiceType();

        }
        else{
            ViewTools::send_error(500,"Pas autorisé");
        }


    }

}
