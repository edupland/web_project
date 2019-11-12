<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 11/02/2018
 * Time: 17:18
 */

class Controller
{
   public static function Mail($mail,$sujet,$contenu)
    {
		$headers  = 'MIME-Version: 1.0' . "\n"; 
		$headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n"; 
        $headers .= "From: contact@projetcom.com\n";
        $headers .= "Reply-To: contact@projetcom.com";

        mail($mail, $sujet, $contenu, $headers);
    }

    public static function Mailsignup($token)
    {
        return('    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="mt-5">Mail de confirmation</h1>
          <p class="lead">Veuillez confirmez votre inscription à Vieux 3000 à <a href="http://'.$_SERVER["SERVER_NAME"].'/perso/#/valid?tk='.$token.'">cette adresse</a> .</p>
        </div>
      </div>
    </div>');
    }

    public static function Mailpass($token)
    {
        return('    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="mt-5">Mail de confirmation</h1>
          <p class="lead">Vous venez de changer votre mot de passe sur Vieux 3000 ,si vous êtes bien à l\'origine de cette action, cliquez sur  <a href="http://'.$_SERVER["SERVER_NAME"].'/perso/#/valid?pass=1&tk='.$token.'">ce lien </a> .</p>
        </div>
      </div>
    </div>');
    }
}
require_once("UserController.php");
require_once("FaqController.php");
require_once("AccessRightController.php");
require_once ("ServicesController.php");
require_once("AnnonceController.php");
require_once ("MessageController.php");
