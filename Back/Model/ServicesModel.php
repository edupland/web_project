<?php

class ServicesModel
{


    public static function addService($type, $message, $address, $tph, $description, $photo, $author, $lat, $lng, $mail,$lmo,$lmf,$lamo,$lamf,$mmo,$mmf, $mamo,$mamf,$memo,$memf,$meamo,$meamf, $jmo,
                                      $jmf,$jamo,$jamf,$vmo,$vmf,$vamo,$vamf,$smo,$smf,$samo,$samf,$dmo, $dmf,$damo,$damf){
        $bdd= ModelTools::bdd();


        if($lmo == null) {$lmo = "Fermé";}

        if($lamo == null){$lamo = "Fermé";}

        if($mmo == null){$mmo = "Fermé";}

        if($mamo == null){$mamo = "Fermé";}

        if($memo == null){$memo = "Fermé";}

        if($meamo == null){$meamo = "Fermé";}

        if($jmo == null){$jmo = "Fermé";}

        if($jamo == null){$jamo = "Fermé";}

        if($vmo == null){$vmo = "Fermé";}

        if($vamo == null){$vamo = "Fermé";}

        if($smo == null){$smo = "Fermé";}

        if($samo == null){$samo = "Fermé";}

        if($dmo == null){$dmo = "Fermé";}

        if($damo == null){$damo = "Fermé";}


        $req_get_user_id = $bdd->prepare('SELECT id FROM user WHERE token = :author');
        $req_get_user_id->execute(array(':author' => $author));

        $user_id = $req_get_user_id->fetch()['id'];

        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('INSERT INTO services SET service_type = :type, message = :message, service_address = :address,
                              service_tph = :tph, service_description = :description,service_photo = :photo,service_by = :user_id,lat = :lat,lng = :lng, service_mail = :mail,Lundi_am_o=:lmo,Lundi_pm_o=:lamo,Mardi_am_o=:mmo,Mardi_pm_o=:mamo,Mercredi_am_o=:memo,
                              Mercredi_pm_o=:meamo,Jeudi_am_o=:jmo,Jeudi_pm_o=:jamo,Vendredi_am_o=:vmo,Vendredi_pm_o=:vamo, Samedi_am_o=:smo,
                              Samedi_pm_o=:samo, Dimanche_am_o=:dmo, Dimanche_pm_o=:damo,Lundi_am_f=:lmf,Lundi_pm_f=:lamf,Mardi_am_f=:mmf,Mardi_pm_f=:mamf,Mercredi_am_f=:memf,
                              Mercredi_pm_f=:meamf,Jeudi_am_f=:jmf,Jeudi_pm_f=:jamf,Vendredi_am_f=:vmf,Vendredi_pm_f=:vamf, Samedi_am_f=:smf,
                              Samedi_pm_f=:samf, Dimanche_am_f=:dmf, Dimanche_pm_f=:damf');




        $req->execute(array(
            ':type' => $type,
            ':message' => $message,
            ':address' => $address,
            ':tph' => $tph,
            ':description'=> $description,
            ':photo' => $photo,
            ':user_id' => $user_id,
            ':lat' => $lat,
            ':lng' => $lng,
            ':mail' => $mail,
            ':lmo' => $lmo,':lamo' => $lamo,
            ':mmo' => $mmo,':mamo'=> $mamo,
            ':memo'=> $memo,':meamo' => $meamo,
            ':jmo' => $jmo,':jamo' => $jamo,
            ':vmo' => $vmo, ':vamo' => $vamo,
            ':smo' => $smo, ':samo' => $samo,
            ':dmo' => $dmo, ':damo' => $damo,
            ':lmf' => $lmf,':lamf' => $lamf,
            ':mmf' => $mmf,':mamf'=> $mamf,
            ':memf'=> $memf,':meamf' => $meamf,
            ':jmf' => $jmf,':jamf' => $jamf,
            ':vmf' => $vmf, ':vamf' => $vamf,
            ':smf' => $smf, ':samf' => $samf,
            ':dmf' => $dmf, ':damf' => $damf


        ));


        return 1;

    }




    public static function modifyService($id,$type, $message, $address, $tph, $description, $photo, $author, $lat, $lng, $mail,$lmo,$lmf,$lamo,$lamf,$mmo,$mmf, $mamo,$mamf,$memo,$memf,$meamo,$meamf, $jmo,
                                         $jmf,$jamo,$jamf,$vmo,$vmf,$vamo,$vamf,$smo,$smf,$samo,$samf,$dmo, $dmf,$damo,$damf){
        $bdd=ModelTools::bdd();
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('UPDATE services SET service_type=:type,message=:message,service_address=:address,service_tph=:tph,service_description=:description,service_photo=:photo,service_by=:author,lat=:lat,lng=:lng,service_mail=:mail,Lundi_am_o=:lmo,Lundi_pm_o=:lamo,Mardi_am_o=:mmo,Mardi_pm_o=:mamo,Mercredi_am_o=:memo,
                              Mercredi_pm_o=:meamo,Jeudi_am_o=:jmo,Jeudi_pm_o=:jamo,Vendredi_am_o=:vmo,Vendredi_pm_o=:vamo, Samedi_am_o=:smo,
                              Samedi_pm_o=:samo, Dimanche_am_o=:dmo, Dimanche_pm_o=:damo,Lundi_am_f=:lmf,Lundi_pm_f=:lamf,Mardi_am_f=:mmf,Mardi_pm_f=:mamf,Mercredi_am_f=:memf,
                              Mercredi_pm_f=:meamf,Jeudi_am_f=:jmf,Jeudi_pm_f=:jamf,Vendredi_am_f=:vmf,Vendredi_pm_f=:vamf, Samedi_am_f=:smf,
                              Samedi_pm_f=:samf, Dimanche_am_f=:dmf, Dimanche_pm_f=:damf WHERE service_id = :id');

        $req->execute(array(
            ':id' => $id,
            ':type' => $type,
            ':message' => $message,
            ':address' => $address,
            ':tph' => $tph,
            ':description'=> $description,
            ':photo' => $photo,
            ':author' => $author,
            ':lat' => $lat,
            ':lng' => $lng,
            ':mail' => $mail,
            ':lmo' => $lmo,':lamo' => $lamo,
            ':mmo' => $mmo,':mamo'=> $mamo,
            ':memo'=> $memo,':meamo' => $meamo,
            ':jmo' => $jmo,':jamo' => $jamo,
            ':vmo' => $vmo, ':vamo' => $vamo,
            ':smo' => $smo, ':samo' => $samo,
            ':dmo' => $dmo, ':damo' => $damo,
            ':lmf' => $lmf,':lamf' => $lamf,
            ':mmf' => $mmf,':mamf'=> $mamf,
            ':memf'=> $memf,':meamf' => $meamf,
            ':jmf' => $jmf,':jamf' => $jamf,
            ':vmf' => $vmf, ':vamf' => $vamf,
            ':smf' => $smf, ':samf' => $samf,
            ':dmf' => $dmf, ':damf' => $damf
        ));
        return 1;

    }


    public static function hideService($id){
        $bdd=ModelTools::bdd();
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('UPDATE services SET visible = 0 WHERE service_id = :id');
        $req->execute(array(':id' => $id));

        return 1;
    }

    public static function revealService($id){
        $bdd=ModelTools::bdd();
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('UPDATE services SET visible = 1 WHERE service_id = :id');
        $req->execute(array(':id' => $id));
        return 1;
    }




    public static function showAllServices($type){
        $bdd=ModelTools::bdd();
        if($type!="") {
            $req = $bdd->prepare('SELECT service_id,message,service_name_text,service_tph,service_address,lat,lng,service_mail,service_name_icon,service_name_markercolor 
            FROM services INNER JOIN service_name ON services.service_type = service_name.service_name_id WHERE service_name.service_name_text = :type AND visible=1');
            $req->execute(array(':type' => $type));
        }
        else{
		 $req = $bdd->query('SELECT service_id,message,service_name_text,service_tph,service_address,lat,lng,service_mail,service_name_icon,service_name_markercolor 
          FROM services INNER JOIN service_name ON services.service_type = service_name.service_name_id WHERE visible=1');
		}
        $services = [];




        while($service = $req->fetch()) {
            $service = array_map("utf8_encode",$service);
            $service['lat']=intval( $service['lat']);
			$service['lng']=intval( $service['lng']);
		    $tabicone['type']="awesomeMarker";
		    $tabicone['prefix']="glyphicon";
		    $tabicone['icon']=$service['service_name_icon'];
		    $tabicone['markerColor']=$service['service_name_markercolor'];

			$service['icon']= $tabicone;
			$services[] = $service;

        }
        return $services;


    }


    public static function showService($id){
        $bdd=ModelTools::bdd();
        $req = $bdd->prepare('SELECT * FROM services INNER JOIN service_name ON services.service_type = service_name.service_name_id WHERE service_id = :id');

        $req->execute(array(':id' => $id));
        $service = $req->fetch();
        if($service == null){
            return -1;
        } else {
            return ($service);
        }
    }


    public static function showServiceTypes(){
        $bdd=ModelTools::bdd();
        $req = $bdd->query('SELECT * FROM service_name');

		$typesdata = [];
       // $typesdata = $req->fetch();
        /*if($typesdata == null){
            return -1;
        }*/
		while($types = $req->fetch()) {
            $types = array_map("utf8_encode",$types);
			$typesdata[]=$types;
			}
        return ($typesdata);

    }


    public static function addServiceType($name, $icon, $marker, $token){
        $bdd=ModelTools::bdd();
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('INSERT INTO service_name SET service_name_text = :name,service_name_icon=:icon,service_name_markercolor=:marker');
        $req->execute(array(
            ':name' => $name,
            ':icon' => $icon,
            ':marker' => $marker
        ));
        return 1;
    }

    public static function modifyServiceType($id, $name, $icon, $marker, $token){
        $bdd=ModelTools::bdd();
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('UPDATE service_name SET service_name_text=:name,service_name_icon=:icon,service_name_markercolor=:marker WHERE service_name_id = :id');
        $req->execute(array(
            ':id' => $id,
            ':name' => $name,
            ':icon' => $icon,
            ':marker' => $marker
        ));
        return 1;
    }


    public static function delServiceType($type_id, $token){
        $bdd=ModelTools::bdd();
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('UPDATE service SET service_type= -1 WHERE service_type = :type_id');
        $req->execute(array(':type_id' => $type_id));
        $req = $bdd->prepare('DELETE FROM service_name WHERE service_name_id = :type_id');
        $req->execute(array(':type_id' => $type_id));
        return 1;
    }



}
