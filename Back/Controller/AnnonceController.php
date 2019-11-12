<?php

class AnnonceController
{

    public static function addAnnounce($token,$title,$description,$price,$tph,$email){
        $add = AnnonceModel::addAnnounce($token,$title,$description,$price,$tph,$email);
        if($add == 1){
            AnnonceView::addAnnounce();
        }
        else{
            ViewTools::send_error(500,"Pas autorisé");
        }
    }

    public static function ListAllAnnonce($token){

        $data = AnnonceModel::showAllAnnounces();

        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }
        else{
            AnnonceView::showListAnnonce($data);
        }

    }

    public static function validateAnnounce($id,$token){

        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }
        $valid = AnnonceModel::validateAnnounce($id);

        if($valid == "valid"){
            AnnonceView::validateAnnounce();
        }


    }

    public static function modifAnnounceAdmin($id,$token,$valid){
        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }

        $deleted = AnnonceModel::modifAnnounceAdmin($id,$valid);

        if($deleted == "deleted"){
            AnnonceView::modifAnnounceAdmin();

        }
        else{
            ViewTools::send_error(404, "Erreur lors de la suppression");
        }


    }

    public static function showannounceadmin($token){
        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }

        $data = AnnonceModel::showannounceadmin();

        if($data == -1){
            ViewTools::send_error(404,"Pas d'annonces");
        }
        else{
            AnnonceView::showannounceadmin($data);
        }



    }


    public static function showAllAnnounces(){
        $data = AnnonceModel::showAllAnnounces();

        if($data == -1){
            ViewTools::send_error(404,"Pas d'annonces");
        }
        else{
            AnnonceView::showAllAnnounces($data);
        }

    }


    public static function showAnnounce($id){
        $annonce = AnnonceModel::showAnnounce($id);
        if($annonce == -1){
            ViewTools::send_error("404", "Annonce inexistante");
        }
        else{

            AnnonceView::showAnnounce($annonce);
        }

    }


}