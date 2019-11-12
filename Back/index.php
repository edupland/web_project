<?php
require_once("./Model/index.php");
require_once("./View/index.php");
require_once("./Controller/index.php");

$usercontroller = new UserController;
$faqcontroller = new FaqController;
$servicecontroller = new ServicesController;
$messageriecontroller = new MessageController;
$annoncecontroller = new AnnonceController;


if(isset($_GET['type'])) {

    $data = json_decode(file_get_contents("php://input"));
    if ($_GET['type'] == "login") {
        $usercontroller->LoginUser(htmlspecialchars($data->{'username'}), htmlspecialchars($data->{'password'}));
    }
		if ($_GET['type'] == "access") {
        $json=json_encode(['message' => AccessRightModel::RightFromToken($_GET['token'])]);
		echo $json;
        
		}
    if ($_GET['type'] == "adduser") {
        $usercontroller->AddUser(htmlspecialchars($data->{'pseudo'}), htmlspecialchars($data->{'lastname'}), htmlspecialchars($data->{'firstname'}), htmlspecialchars($data->{'email'}), htmlspecialchars($data->{'password'}), htmlspecialchars($data->{'password_confirm'}));
    }
    if ($_GET['type'] == "getuser") {
        $usercontroller->GetUser(htmlspecialchars($_GET['token']));
    }
    if ($_GET['type'] == "modif") {
        $usercontroller->ModifyUser(htmlspecialchars($data->{'token'}), htmlspecialchars($data->{'user_pseudo'}), htmlspecialchars($data->{'lastname'}), htmlspecialchars($data->{'firstname'}), htmlspecialchars($data->{'email'}), htmlspecialchars($data->{'image'}));
    }
    if ($_GET['type'] == "testaccesuser") {
        $usercontroller->TestAccesUser(htmlspecialchars($_GET['token']));
    }
    if ($_GET['type'] == "validcompte") {
        $usercontroller->TestAccesUser(htmlspecialchars($_GET['token']));
    }
    if ($_GET['type'] == "listuseradmin") {
        $usercontroller->ListAllUsers(htmlspecialchars($_GET['token']));
    }
    if ($_GET['type'] == "listusercategories") {
        $usercontroller->ListUserCategories();
    }
    if ($_GET['type'] == "token") {
        $usercontroller->ValidationMail(htmlspecialchars($_GET['token']));
    }
    if ($_GET['type'] == "mailtk") {
        $usercontroller->ResendMail(htmlspecialchars($data->{'pseudo'}));
    }
    if ($_GET['type'] == "mailmdp") {
        $usercontroller->ModifyPassword(htmlspecialchars($data->{'user_pseudo'}), htmlspecialchars($data->{'password'}), htmlspecialchars($data->{'password_confirm'}));
    }
    if ($_GET['type'] == "confirmmdp") {
        $usercontroller->ConfirmPassChange(htmlspecialchars($_GET['token']));
    }
    if ($_GET['type'] == "adminuserupdate") {
        $usercontroller->UpdateListUsers(htmlspecialchars($data->{'token'}), htmlspecialchars($data->{'id'}), htmlspecialchars($data->{'user_pseudo'}), htmlspecialchars($data->{'lastname'}), htmlspecialchars($data->{'firstname'}), htmlspecialchars($data->{'email'}), htmlspecialchars($data->{'image'}), htmlspecialchars($data->{'valid'}),htmlspecialchars($data->{'category_id'}));
    }
    if ($_GET['type'] == "getfaq") {
        $faqcontroller->ViewFaQ();
    }
    if ($_GET['type'] == "addservice") {
        $servicecontroller->addService(htmlspecialchars($data->{'type'}), htmlspecialchars($data->{'name'}), htmlspecialchars($data->{'address'}), htmlspecialchars($data->{'tph'}), htmlspecialchars($data->{'description'}),"", htmlspecialchars($data->{'token'}), htmlspecialchars($data->{'lat'}), htmlspecialchars($data->{'lng'}), htmlspecialchars($data->{'mail'}),htmlspecialchars($data->{'lmo'}), htmlspecialchars($data->{'lmf'}), htmlspecialchars($data->{'lamo'}), htmlspecialchars($data->{'lamf'}),
            htmlspecialchars($data->{'mmo'}), htmlspecialchars($data->{'mmf'}), htmlspecialchars($data->{'mamo'}), htmlspecialchars($data->{'mamf'}), htmlspecialchars($data->{'memo'}), htmlspecialchars($data->{'memf'}),
            htmlspecialchars($data->{'meamo'}), htmlspecialchars($data->{'meamf'}), htmlspecialchars($data->{'jmo'}), htmlspecialchars($data->{'jmf'}), htmlspecialchars($data->{'jamo'}), htmlspecialchars($data->{'jamf'}),
            htmlspecialchars($data->{'vmo'}), htmlspecialchars($data->{'vmf'}), htmlspecialchars($data->{'vamo'}), htmlspecialchars($data->{'vamf'}), htmlspecialchars($data->{'smo'}), htmlspecialchars($data->{'smf'}),
            htmlspecialchars($data->{'samo'}), htmlspecialchars($data->{'samf'}), htmlspecialchars($data->{'dmo'}), htmlspecialchars($data->{'dmf'}), htmlspecialchars($data->{'damo'}), htmlspecialchars($data->{'damf'}));
    }
    if ($_GET['type'] == "modifyservice") {
        $servicecontroller->modifyService(htmlspecialchars($data->{'service_id'}), htmlspecialchars($data->{'service_type'}), htmlspecialchars($data->{'message'}), htmlspecialchars($data->{'service_address'}), htmlspecialchars($data->{'service_tph'}), htmlspecialchars($data->{'service_description'}), "", htmlspecialchars($data->{'service_by'}), htmlspecialchars($data->{'lat'}), htmlspecialchars($data->{'lng'}), htmlspecialchars($data->{'service_mail'}), htmlspecialchars($data->{'Lundi_am_o'}), htmlspecialchars($data->{'Lundi_am_f'}), htmlspecialchars($data->{'Lundi_pm_o'}), htmlspecialchars($data->{'Lundi_pm_f'}),
            htmlspecialchars($data->{'Mardi_am_o'}), htmlspecialchars($data->{'Mardi_am_f'}), htmlspecialchars($data->{'Mardi_pm_o'}), htmlspecialchars($data->{'Mardi_pm_f'}), htmlspecialchars($data->{'Mercredi_am_o'}), htmlspecialchars($data->{'Mercredi_am_f'}),
            htmlspecialchars($data->{'Mercredi_pm_o'}), htmlspecialchars($data->{'Mercredi_pm_f'}), htmlspecialchars($data->{'Jeudi_am_o'}), htmlspecialchars($data->{'Jeudi_am_f'}), htmlspecialchars($data->{'Jeudi_pm_o'}), htmlspecialchars($data->{'Jeudi_pm_f'}),
            htmlspecialchars($data->{'Vendredi_am_o'}), htmlspecialchars($data->{'Vendredi_am_f'}), htmlspecialchars($data->{'Vendredi_pm_o'}), htmlspecialchars($data->{'Vendredi_pm_f'}), htmlspecialchars($data->{'Samedi_am_o'}), htmlspecialchars($data->{'Samedi_am_f'}),
            htmlspecialchars($data->{'Samedi_pm_o'}), htmlspecialchars($data->{'Samedi_pm_f'}), htmlspecialchars($data->{'Dimanche_am_o'}), htmlspecialchars($data->{'Dimanche_am_f'}), htmlspecialchars($data->{'Dimanche_pm_o'}), htmlspecialchars($data->{'Dimanche_pm_f'}));
    }
    if ($_GET['type'] == "hideservice") {
        $servicecontroller->hideService(htmlspecialchars($_GET['id']));
    }
    if ($_GET['type'] == "revealservice") {
        $servicecontroller->revealService(htmlspecialchars($_GET['id']));
    }
    if ($_GET['type'] == "showallservices") {
        $servicecontroller->showAllServices(htmlspecialchars($_GET['typeservice']));
    }
    if ($_GET['type'] == "showservice") {
        $servicecontroller->showService(htmlspecialchars($_GET['id']));
    }
    if ($_GET['type'] == "showservicetypes") {
        $servicecontroller->showServiceTypes();
    }
    if ($_GET['type'] == "addservicetype") {
        $servicecontroller->addServiceType(htmlspecialchars($data->{'name'}), htmlspecialchars($data->{'icon'}), htmlspecialchars($data->{'color'}),htmlspecialchars($data->{'token'}));
    }
    if ($_GET['type'] == "modifyservicetype") {
        $servicecontroller->modifyServiceType(htmlspecialchars($data->{'service_name_id'}), htmlspecialchars($data->{'service_name_text'}), htmlspecialchars($data->{'service_name_icon'}), htmlspecialchars($data->{'service_name_markercolor'}),htmlspecialchars($data->{'token'}));
    }
    if ($_GET['type'] == "delservicetype") {
        $servicecontroller->delServiceType(htmlspecialchars($data->{'service_name_id'}),htmlspecialchars($data->{'token'}));
    }
    if ($_GET['type'] == "addfaq") {
        $faqcontroller->addFaQ(htmlspecialchars($data->{'token'}), htmlspecialchars($data->{'question'}), htmlspecialchars($data->{'reponse'}));
    }
    if ($_GET['type'] == "delfaq") {
        $faqcontroller->deleteFaQ(htmlspecialchars($data->{'token'}), htmlspecialchars($data->{'faq_id'}));
    }
    if ($_GET['type'] == "updatefaq") {
        $faqcontroller->modifyFaQ(htmlspecialchars($data->{'token'}), htmlspecialchars($data->{'faq_id'}), htmlspecialchars($data->{'faq_questions'}), htmlspecialchars($data->{'faq_answers'}));
    }
    if ($_GET['type'] == "allmessages") {
        $messageriecontroller->Listusers(htmlspecialchars($_GET['token']));
    }
    if ($_GET['type'] == "listmessages") {
        $messageriecontroller->viewAllMessage(htmlspecialchars($_GET['id']), htmlspecialchars($_GET['token']));
    }
    if ($_GET['type'] == "sendmessage") {
        $messageriecontroller->sendMessage(htmlspecialchars($data->{'id'}), htmlspecialchars($data->{'message'}), htmlspecialchars($data->{'token'}));
    }
    if ($_GET['type'] == "finduser") {
        $messageriecontroller->findUser(htmlspecialchars($data->{'username'}), htmlspecialchars($_GET['token']));
    }
    if ($_GET['type'] == "addannounce") {
        $annoncecontroller->addAnnounce(htmlspecialchars($data->{'token'}),htmlspecialchars($data->{'title'}), htmlspecialchars($data->{'description'}), htmlspecialchars($data->{'price'}), htmlspecialchars($data->{'tph'}), htmlspecialchars($data->{'email'}));
    }
    if ($_GET['type'] == "showallannounces") {
        $annoncecontroller->showAllAnnounces();
    }
    if ($_GET['type'] == "showannounce") {
        $annoncecontroller->showAnnounce(htmlspecialchars($_GET['id']));
    }
    if ($_GET['type'] == "modifannounce") {
        $annoncecontroller->modifAnnounceAdmin(htmlspecialchars($_GET['id']),htmlspecialchars($_GET['token']),htmlspecialchars($_GET['valid']));
    }
    if ($_GET['type'] == "validannounce") {
        $annoncecontroller->validateAnnounce(htmlspecialchars($_GET['id']),htmlspecialchars($_GET['token']));
    }
    if ($_GET['type'] == "showannounceadmin") {
        $annoncecontroller->showannounceadmin(htmlspecialchars($_GET['token']));
    }
}
?>