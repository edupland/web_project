<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 09/02/2018
 * Time: 14:18
 */

class UserModel
{
    public static function LoginUser($pseudo,$password){
		$bdd = ModelTools::bdd();
        $req = $bdd->prepare('SELECT user_pseudo FROM user WHERE user_pseudo = :pseudo');
        $req->execute(array(':pseudo' =>$pseudo));
        $user = $req->fetch();
        if($user == null){
            return 'usernotexist';
        }

        $req = $bdd->prepare('SELECT valid FROM user WHERE user_pseudo = :pseudo');
        $req->execute(array(':pseudo' =>$pseudo));
        $user = $req->fetch();
        if($user['valid'] == -1){
            return 'userban';
        }

        $req = $bdd->prepare('SELECT * FROM user WHERE user_password = :password AND user_pseudo = :pseudo');
        $req->execute(array(':password' => sha1($password."lo5d4fvKH<d4cv15"),':pseudo' => $pseudo));
        $pass = $req->fetch();
        if($pass == null){
            return 'passwordincorrect';
        }
        else if ($pass['valid']==1){
            return ModelTools::UpdateToken($pass['id']);
        }
		else{
			return 'notvalid';
		}
    }
	public static function GetUser ($token){
		$bdd = ModelTools::bdd();
        $req = $bdd->prepare('SELECT id,user_pseudo,email,firstname,lastname,image FROM user WHERE token = :token');
        $req->execute(array(':token' =>$token));
        $user = $req->fetch();
        if($user == null){
            return -1;
        }
		else{
			$user['email']=ModelTools::decryptData($user['email'],$user['id'],2);
			$user['firstname']=ModelTools::decryptData($user['firstname'],$user['id'],3);
			$user['lastname']=ModelTools::decryptData($user['lastname'],$user['id'],4);
			$user['image']=ModelTools::decryptData($user['image'],$user['id'],5);
			$user = array_map("utf8_encode", $user);
			return($user);
		}
	}

    public static function AddUser($pseudo,$lastname,$firstname,$email,$password){
        $bdd=ModelTools::bdd();
        $req = $bdd->query('SELECT * FROM user');
        $numid=1;
        while ($donnees = $req->fetch()) {
            if (ModelTools::decryptData($donnees['email'],$donnees['id'],2) == $email) {
                return -2;
            }
			if ($donnees['user_pseudo'] == $pseudo) {
                return -1;
            }
            $numid++;
        }
        $tk=ModelTools::token();
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('INSERT INTO user(user_pseudo, user_password,email,token,firstname,lastname,image) VALUES(:pseudo, :password,:mail,:token,:firstname,:lastname,"")');
        $req->execute(array(
            'pseudo' => $pseudo,
            'mail' => ModelTools::encryptData($email,$numid,2),
            'firstname' => ModelTools::encryptData($firstname,$numid,3),
            'lastname' => ModelTools::encryptData($lastname,$numid,4),
            'password'=>sha1($password."lo5d4fvKH<d4cv15"),
            'token'=>$tk
        ));


        $selectLast = $bdd->query('SELECT id FROM user ORDER BY id DESC LIMIT 0, 1');
        $lastId = $selectLast->fetch();
        $id = $lastId['id'];

        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('INSERT INTO accesright(user_id, category_id) VALUES (:id, 2)');
        $req->execute(array(
            ':id' => $id
        ));




        return $tk;

    }

    public static function ModifyUser($token,$pseudo,$lastname,$firstname,$email,$image){
        $bdd=ModelTools::bdd();
		$testtk=0;
		$req = $bdd->query('SELECT * FROM user');
        while ($donnees = $req->fetch()) {
			if ($donnees['token'] == $token) {
                $testtk=1;
            }
			else{
				if ($donnees['user_pseudo'] == $pseudo) {
					return("erpseudo");
				}
				if ($donnees['email'] == $email) {
					return("ermail");
				}
			}
        }
		if($testtk==0){
			return("ertk");
		}
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('UPDATE user SET user_pseudo=:pseudo,email=:email,firstname=:firstname,lastname=:lastname,image=:image WHERE token = :tk AND valid=1');
        $req->execute(array('pseudo' => $pseudo,
            'email' => ModelTools::encryptData($email,self::IdFromPseudo($pseudo),2),
            'firstname' => ModelTools::encryptData($firstname,self::IdFromPseudo($pseudo),3),
            'lastname' => ModelTools::encryptData($lastname,self::IdFromPseudo($pseudo),4),
			'image' =>ModelTools::encryptData($image,self::IdFromPseudo($pseudo),5),
			'tk' =>$token));
        return 1;


    }

    public static function ValidationMail($token)
    {
        $bdd = ModelTools::bdd();
        $req = $bdd->prepare('SELECT * FROM user WHERE token = :tk');
        $req->execute(array('tk' => $token));
		$user = $req->fetch();
		if($user == null){
            return "token inexistant";
        }
        else{
            $bdd->exec('SET NAMES utf8');
            $req = $bdd->prepare('UPDATE user SET token = :newtk, valid=1 WHERE token = :tk');
            $req->execute(array('newtk' =>ModelTools::token(),
								'tk' => $token));
            return "ok";
        }
    }

    public static function ResendMail($pseudo){
        $bdd = ModelTools::bdd();
        $req = $bdd->prepare('SELECT * FROM user where user_pseudo = :pseudo ');
        $req->execute(array('pseudo' => $pseudo));
  		$user = $req->fetch();
		if($user != null){
			if($user['valid']==0)
			{
				return [ModelTools::decryptData($user['email'],$user['id'],2),$user['token']];
			}
			else{
				return "dejavalid";
			}
        }
		return "nouser";
 }


    public function getAccess($token){

    }

   public static function  PseudoFromToken($token){
        $bdd=ModelTools::bdd();
        $req = $bdd->prepare('SELECT * FROM user WHERE token=:tk');
        $req->execute(array(
            'tk'=>$token,
        ));
        while ($donnees = $req->fetch()) {

            if($token==$donnees['token'])
            {
                return ($donnees['user_pseudo']);}
        }
        return false;
    }

    public static function  PseudoFromId($id){
        $bdd=ModelTools::bdd();
        $req = $bdd->prepare('SELECT * FROM user WHERE id=:id');
        $req->execute(array(
            'id'=>$id,
        ));
        while ($donnees = $req->fetch()) {

            if($id==$donnees['id'])
            {
                return $donnees['user_pseudo'];
            }
        }
        return false;
    }

    public static function  IdFromToken($token){
        $bdd=ModelTools::bdd();
        $req = $bdd->prepare('SELECT * FROM user WHERE token=:tk');
        $req->execute(array(
            'tk'=>$token,
        ));
        while ($donnees = $req->fetch()) {

            if($token==$donnees['token'])
            {return $donnees['id'];}
        }
        return false;
    }

    public static function  IdFromPseudo($pseudo){
        $bdd=ModelTools::bdd();
        $req = $bdd->prepare('SELECT * FROM user WHERE pseudo=:pseudo');
        $req->execute(array(
            'pseudo'=>$pseudo,
        ));
        while ($donnees = $req->fetch()) {

            if($pseudo==$donnees['user_pseudo'])
            {
				return $donnees['id'];
			}
        }
        return false;
    }
  public static function ModifyPassword($new_password,$user){
        $bdd = ModelTools::bdd();
        $req = $bdd->prepare('SELECT * FROM user WHERE user_pseudo = :user');
        $req->execute(array(
            ':user' => $user));
        $pass = $req->fetch();
        if($pass == null){
            return 'nouser';
        }		
		else if($pass['valid']==0)
		{
				return 'novalid';
		}
        else{
			$tk=ModelTools::token();
            $bdd->exec('SET NAMES utf8');
            $req = $bdd->prepare('INSERT INTO user_temporary(id,new_password,token) VALUES(:id,:new_password,:token)');
            $req->execute(array(':id' => $pass['id'],
            ':new_password' => sha1($new_password."lo5d4fvKH<d4cv15"),
            ':token' => $tk));
            return [ModelTools::decryptData($pass['email'],$pass['id'],2),$tk];
        }

    }

    public static function ConfirmPassChange($token){
        $bdd = ModelTools::bdd();
        $req = $bdd->prepare('SELECT * FROM user_temporary WHERE token = :token');
        $req->execute(array(':token' => $token));
        $pass = $req->fetch();
        if($pass == null){
            return 'erreur';
        }
        else{
            $req = $bdd->prepare('UPDATE user SET user_password = :pass WHERE id = :id');
            $req->execute(array(':pass' => $pass['new_password'],
									':id'=>$pass['id']));
			$req = $bdd->prepare('DELETE  FROM user_temporary WHERE token = :tk');
            $req->execute(array(':tk' => $token));
			return "ok";
        }

    }


    public static function ListAllUsers(){
        $bdd=ModelTools::bdd();
        $req = $bdd->query('SELECT id,user_pseudo,user_password,email,token,firstname,lastname,image,valid,category_name,category.category_id
        FROM user INNER JOIN accesright ON user.id = accesright.user_id INNER JOIN category ON accesright.category_id = category.category_id');
        $user = [];
        while ($donnees = $req->fetch()) {
            $donnees['email']=ModelTools::decryptData($donnees['email'],$donnees['id'],2);
            $donnees['firstname']=ModelTools::decryptData($donnees['firstname'],$donnees['id'],3);
            $donnees['lastname']=ModelTools::decryptData($donnees['lastname'],$donnees['id'],4);
            $donnees['image']=ModelTools::decryptData($donnees['image'],$donnees['id'],5);
            $donnees = array_map("utf8_encode",$donnees);
            $user[] = $donnees;



        }
        if(!empty($user)){
            return $user;

        }
        else{
            return "aucunuser";
        }
    }

    public static function UpdateListUsers($id,$pseudo,$lastname,$firstname,$email,$image,$valid,$category){
        $bdd=ModelTools::bdd();
        $testtk=0;
        $req = $bdd->query('SELECT * FROM user');
        while ($donnees = $req->fetch()) {
            if ($donnees['id'] == $id) {
                $testtk=1;
            }
            else{
                if ($donnees['user_pseudo'] == $pseudo) {
                    return("erpseudo");
                }
                if ($donnees['email'] == $email) {
                    return("ermail");
                }
            }
        }
        if($testtk==0){
            return("ertk");
        }
        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('UPDATE user SET user_pseudo=:pseudo,email=:email,firstname=:firstname,lastname=:lastname,image=:image,valid=:valid WHERE id = :id');
        $req->execute(array('pseudo' => $pseudo,
            'email' => ModelTools::encryptData($email,self::IdFromPseudo($pseudo),2),
            'firstname' => ModelTools::encryptData($firstname,self::IdFromPseudo($pseudo),3),
            'lastname' => ModelTools::encryptData($lastname,self::IdFromPseudo($pseudo),4),
            'image' =>ModelTools::encryptData($image,self::IdFromPseudo($pseudo),5),
            'valid' => $valid,
            'id' =>$id));

        $bdd->exec('SET NAMES utf8');
        $req = $bdd->prepare('UPDATE accesright SET category_id= :cat_id WHERE user_id = :id');
        $req->execute(array(':id' => $id,
        ':cat_id' => $category

        ));

        return 1;



    }


    public static function ListUserCategories(){

        $bdd = ModelTools::bdd();

        $req = $bdd->query('SELECT * FROM category ');

        $list=[];

        while ($donnees = $req->fetch()) {
            $list[] = array_map("utf8_encode",$donnees);
        }

        if($list == null){
            return -1;
        } else {
            return ($list);
        }
    }



















}