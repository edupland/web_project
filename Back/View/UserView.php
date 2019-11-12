<?php
/**
 * Created by PhpStorm.
 * User: fmartinea001
 * Date: 10/02/2018
 * Time: 11:51
 */

class UserView
{
  public static function LoginUser($token){

    $json = array('token' => $token);
    $json=json_encode($json);
    echo $json;
  }


 public static function AddUser(){
     header('HTTP/1.0 200 OK');
	 echo json_encode(['message' => "Inscription réalisé, regardez vos mail."]);
 }

 public static function MailConfirm(){
    header('HTTP/1.0 200 OK');
    echo json_encode(['message' => "Votre compte a bien été confirmé."]);
}

public static function ResendMail(){
        header('HTTP/1.0 200 OK');
        echo json_encode(['message' => "Un email vous a été envoyé."]);
}

 public static function ModifyUser(){
        header('HTTP/1.0 200 OK');
        echo json_encode(['message' => "Modification réalisé."]);
 }

  public static function GetUser($array){
    $json=json_encode($array);
    echo $json;
  }
 public static function TestAccesUser(){
        header('HTTP/1.0 200 OK');
        echo json_encode(['message' => "Ceci est un message pour les utilisateurs connéctés."]);
 }

    public static function ListAllUsers($data){
        $json=json_encode(['message' => $data]);
        echo $json;
    }

    public static function UpdateListUsers(){
        header('HTTP/1.0 200 OK');
        echo json_encode(['message' => "Modification réalisé."]);
    }

    public static function ListUserCategories($data){
        $json=json_encode(['message' => $data]);
        echo $json;
    }



}
