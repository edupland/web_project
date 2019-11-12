<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 09/03/2018
 * Time: 14:31
 */

class MessageView
{
    public static function viewSend(){
        ViewTools::send_error(200,"Message envoyé !");
    }

    public static function findUser($user){
        $json=json_encode(['messages' => $user]);
        echo $json;
    }

    public static function viewList($users){
        $json=json_encode(['messages' => $users]);
        echo $json;

    }

    public static function viewAll($data){
        $json=json_encode(['messages' => $data]);
        echo $json;

    }

    public static function viewOne($data){
        $json=json_encode(['message' => $data]);
        echo $json;

    }

    public static function viewDel(){
        ViewTools::send_error(200,"Message supprimé !");
    }

}