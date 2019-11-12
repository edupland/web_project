<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 09/02/2018
 * Time: 14:18
 */

class AccessRightController
{

    public static function getAccessRight($user)
    {
        $data = AccessRightModel::getAccessRight($user);

        if($data!=-1){
            return $data;
        }
        else{
            ViewTools::send_error(500,"Droit non valide");
        }
    }


    public static function RightFromToken($token)
    {

        $data = AccessRightModel::RightFromToken($token);
        if($data!=-1){
            return $data;
        }
        else{
            ViewTools::send_error(500,"Droit non valide");
        }
    }
}