<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 09/02/2018
 * Time: 14:18
 */

class FormModel
{


    public static function generate_and_add_token(){

        $token = ModelTools::token();
        $bdd = ModelTools::bdd();
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('INSERT INTO token(token) VALUES(:token)');
        $req->execute(array(':token' => $token));

        return $token;

    }


    public static function is_in_db($token)
    {

        $bdd = ModelTools::bdd();
        $req = $bdd->prepare('SELECT token FROM token  WHERE token = :token');
        $req->execute(array('token' => $token));
        $tk = $req->fetch();
        if ($tk != null) {
            $req = $bdd->prepare('DELETE FROM token WHERE token = :token');
            $req->execute(array('token' => $token));
            return true;
        }

        return false;
    }


}