<?php
/**
 * Created by PhpStorm.
 * User: oknax
 * Date: 09/02/2018
 * Time: 14:24
 */


class UserController
{
    public function LoginUser($pseudo,$password){

        $tk = UserModel::LoginUser($pseudo,$password);
        if($tk == "passwordincorrect"){
            ViewTools::send_error(404,"Mot de passe Incorrect");
        }
        else if($tk == "usernotexist"){
            ViewTools::send_error(404,"Login Inconnu");
        }
		else if($tk == "notvalid"){
            ViewTools::send_error(404,"Compte non validé,vérifiez vos mail");
        }
        else if($tk == "userban"){
            ViewTools::send_error(500,"Utilisateur Banni");
        }
        else{
            UserView::LoginUser($tk);
        }
    }
    public function ModifyUser($token,$pseudo,$lastname,$firstname,$email,$image){
        if(isset($pseudo) and isset($firstname)and isset($lastname)) {
           if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$tk = UserModel::ModifyUser($token,$pseudo,$lastname,$firstname,$email,$image);
				if($tk == "erpseudo"){
					ViewTools::send_error(500,"Ce pseudo existe déjà");
				}
				else if($tk == "ertk"){
					ViewTools::send_error(500,"Erreur token");
				}
				else if($tk == "ermail"){
					ViewTools::send_error(500,"Cet email existe déjà");
				}
				else{
					UserView::ModifyUser();
				}
			}
			else {
                        ViewTools::send_error(500,"probléme de format du mail");
                    }
        }
        else{
            ViewTools::send_error(500,"Tous les champs ne sont pas remplis");
        }
    }


	public function TestAccesUser($token){
		$data=UserModel::getUser($token);
		if($data!= -1){
			UserView::TestAccesUser();
		}
		else{
			 ViewTools::send_error(404,"Login Inconnu");
		}
	}
	public function getAccess($token){

	}
	public function getUser($token){
		$data=UserModel::getUser($token);
		if($data!= -1){
			UserView::getUser($data);
		}
		else{
			 ViewTools::send_error(404,"Login Inconnu");
		}
	}
    public function AddUser($pseudo,$lastname,$firstname,$email,$password,$password_confirm){
        if($password!="" ){
            if( $password==$password_confirm ){
                if(isset($pseudo) and isset($firstname)and isset($lastname)) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$tk = UserModel::AddUser($pseudo,$lastname,$firstname,$email,$password);
						if($tk!=-1) {
							if($tk!=-2){
								Controller::Mail($email, "Inscription au site Vieux3000", Controller::Mailsignup($tk));
								UserView::AddUser();
							}
						 else {
							ViewTools::send_error(500,"Mail déja existant");
						}
						}
						 else {
							ViewTools::send_error(500,"Compte déja existant");
						}
                    } else {
                        ViewTools::send_error(500,"probléme de format du mail");
                    }
                }
                else{
                    ViewTools::send_error(500,"Tous les champs ne sont pas remplis");
                }
            }
            else{
                ViewTools::send_error(500,"Les mot de passes ne coresspondent pas");
            }
        }
        else{
            ViewTools::send_error(500,"mot de passe inexistant");
        }
    }

    public function ValidationMail($tk){
        $confirm = UserModel::ValidationMail($tk);
        if($confirm == 'ok'){
            UserView::MailConfirm();
        }
        else{
            ViewTools::send_error(500,"Token Invalide");

        }

    }
public function ModifyPassword($pseudo,$password,$new_password){
		if($password==$new_password){
			$modification = UserModel::ModifyPassword($new_password,$pseudo);

			if($modification == "novalid"){
				ViewTools::send_error(500,"Le compte n'as pas été validé");
			}
			if($modification == "nouser"){
				ViewTools::send_error(404,"Le compte n'existe pas");
			}
			else{

				 ViewTools::send_error(200,"Modification du mot de passe");
				 Controller::Mail($modification[0], "Modification de votre mot de passe vieux3000", Controller::Mailpass($modification[1]));
			}
		}
		else{
				ViewTools::send_error(500,"Les mots de passe ne sont pas identiques");
			}
    }

    public function ConfirmPassChange($token){
        $modification = UserModel::ConfirmPassChange($token);
        if($modification == "ok"){
            ViewTools::send_error(200,"Modification du mot de passe réaliser avec succés");

        }
        else{
            ViewTools::send_error(500,"Token invalide");
        }

    }

    public function ResendMail($pseudo){
        $resend = UserModel::ResendMail($pseudo);
        if($resend == "dejavalid"){
            ViewTools::send_error(500,"Votre compte a déjà été validé ");
        }
		else if($resend == "nouser"){
            ViewTools::send_error(500,"Votre compte  n'existe pas");
        }
        else{
			 Controller::Mail($resend[0], "Inscription au site projet", Controller::Mailsignup($resend[1]));
        }
    }


    public function ListAllUsers($token){

        $data = UserModel::ListAllUsers();
        
        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }

        else if($data=="aucunuser"){
            ViewTools::send_error(404,"Aucun Utilisateur");
        }
        else{
            UserView::ListAllUsers($data);
        }

    }

    public function UpdateListUsers($token,$id,$pseudo,$lastname,$firstname,$email,$image,$valid,$category){
        //Catégorie est ultra obscure donc je laisse en attendant d'avoir des explications

        if((AccessRightModel::RightFromToken($token) != "Admin")){
            ViewTools::send_error(500,"Pas autorisé");
        }

        if(isset($pseudo) and isset($firstname)and isset($lastname)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $tk = UserModel::UpdateListUsers($id,$pseudo,$lastname,$firstname,$email,$image,$valid,$category);
                if($tk == "erpseudo"){
                    ViewTools::send_error(500,"Ce pseudo existe déjà");
                }
                else if($tk == "ertk"){
                    ViewTools::send_error(500,"Erreur token");
                }
                else if($tk == "ermail"){
                    ViewTools::send_error(500,"Cet email existe déjà");
                }
                else{
                    UserView::UpdateListUsers();
                }
            }
            else {
                ViewTools::send_error(500,"probléme de format du mail");
            }
        }
        else{
            ViewTools::send_error(500,"Tous les champs ne sont pas remplis");
        }


    }




    public static function ListUserCategories(){

        $data = UserModel::ListUserCategories();
        if($data==-1){
            ViewTools::send_error(404,"Aucune categorie d'utilisateurs");
        }
        else{
            UserView::ListUserCategories($data);
        }


    }















}
