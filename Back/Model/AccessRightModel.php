<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 09/02/2018
 * Time: 14:18
 */

class AccessRightModel
{

    public static function getAccessRight($user)
    {
        $bdd = ModelTools::bdd();
        $req = $bdd->prepare('SELECT accesright_id, category_id FROM accesright WHERE user_id = :user');
        $req->execute(array(':user' => $user));
        $right = $req->fetch();
        if ($right == null) {
            return -1;
        } else {
            return ($right);
        }
    }


    public static function RightFromToken($token)
    {
        $bdd = ModelTools::bdd();
        $req = $bdd->prepare('SELECT category_name FROM category INNER JOIN accesright ON category.category_id = accesright.category_id INNER JOIN user ON accesright.user_id = user.id WHERE user.token = :token');
        $req->execute(array(':token' => $token));
        $right = $req->fetch();

        if ($right == null) {
            return -1;
        } else {
            return ($right['category_name']);
        }
    }
}
