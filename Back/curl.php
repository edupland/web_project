<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 02/04/2018
 * Time: 16:00
 */


 
        
            $timeout = 10;

			$url="https://maps.googleapis.com/maps/api/place/autocomplete/json?key=AIzaSyCPlOsj-81NHGWeYlWtWdC7MAjOE7pKVhU&input=".urlencode($_GET['url']);
			
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

            if (preg_match('`^https://`i', $url))
            {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            }

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Récupération du contenu retourné par la requête
            $page_content = curl_exec($ch);

            curl_close($ch);
            echo $page_content;
        
    




?>