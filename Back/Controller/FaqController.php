<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 02/03/2018
 * Time: 10:53
 */

class FaqController
{

    public function viewFaQ(){
        $view = FaqModel::viewFaQ();
        if($view == -1){
            ViewTools::send_error(404,"FAQ inexistante");
        }
        else{
            FaqView::ViewFaq($view);
        }

    }


    public function addFaQ($token,$question,$response){
        $add = FaqModel::addFaQ($token,$question,$response);

        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }

        else if($add == "questionexist"){
            ViewTools::send_error(500,"Post déjà existant");
        }

        else if($add == "ok"){
            FaqView::AddFaq();
        }

    }

    public function deleteFaQ($token,$idpost){
        $del = FaqModel::deleteFaQ($idpost);

        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }

        else if($del== "noexist"){
            ViewTools::send_error(404,"Post inexistant");
        }

        else if($del == "hidden"){
            FaqView::DelFaq();

        }

    }

    public function modifyFaQ($token,$idpost,$question,$message){
        $mod = FaqModel::modifyFaQ($idpost,$question,$message);

        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }

        else if($mod == "noexist"){
            ViewTools::send_error(404,"Post inexistant");
        }

        else if($mod == "ok"){
            FaqView::ModifyFaq();

        }

    }

}