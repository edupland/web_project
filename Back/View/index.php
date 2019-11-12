<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 09/02/2018
 * Time: 14:58
 */

class ViewTools
{
    public static function send_error($error_code, $error_msg){

        if($error_code == 401){
            header('HTTP/1.0 401 Unauthorized');
        }

        if ($error_code == 404) {
            header('HTTP/1.0 404 Not Found');
        }
        if ($error_code == 500) {
            header('HTTP/1.0 500 Internal Server Error');
        }

        if ($error_code == 200){
            header('HTTP/1.0 200 OK');
        }
        echo json_encode(['message' => $error_msg]);

    }


}
require_once("UserView.php");
require_once("FaqView.php");
require_once ("ServicesView.php");
require_once ("AnnonceView.php");
require_once ("MessageView.php");