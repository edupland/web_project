var config = function ($stateProvider, $httpProvider, HateoasInterceptorProvider) {

    $httpProvider.defaults.headers.common = {};
    $httpProvider.defaults.headers.post = {};
    $httpProvider.defaults.headers.put = {};
    $httpProvider.defaults.headers.patch = {};

    $stateProvider.state("app", {
        templateUrl: "layout-app.html",
        controller: "appController",
        controllerAs: "appCtrl",
        url: "/",
    });
	 $stateProvider.state("app.home", {
        templateUrl: "public/templates/home/home.html",
        controller: "homeController",
        controllerAs: "homeCtrl",
        url: "home"
    });
    $stateProvider.state("app.faq", {
         templateUrl: "public/templates/faq/faq.html",
         controller: "faqController",
         controllerAs: "faqCtrl",
         url: "faq"
     });
    $stateProvider.state("app.offers", {
        templateUrl: "public/templates/offers/offers.html",
        controller: "offersController",
        controllerAs: "offersCtrl",
        url: "offers"
    });
	$stateProvider.state("app.services", {
        templateUrl: "public/templates/services/services.html",
        controller: "servicesController",
        controllerAs: "servicesCtrl",
        url: "services"
    });
	$stateProvider.state("app.updateuser", {
        templateUrl: "public/templates/users/updateusers/updateusers.html",
        controller: "updateuserController",
        controllerAs: "updateuserCtrl",
        url: "updateuser"
    });
	$stateProvider.state("app.valid", {
        templateUrl: "public/templates/users/validcompte/validcompte.html",
        controller: "validcompteController",
        controllerAs: "validcompteCtrl",
        url: "valid"
    });
	$stateProvider.state("app.mp", {
        templateUrl: "public/templates/users/privatemessage/privatemessage.html",
        controller: "privatemessageController",
        controllerAs: "privatemessageCtrl",
        url: "mp"
    });
	$stateProvider.state("app.adminuser", {
        templateUrl: "public/templates/admin/user/list.html",
        controller: "listUserAdminController",
        controllerAs: "listUserAdminCtrl",
        url: "adminuser"
    });
		$stateProvider.state("app.adminfaq", {
        templateUrl: "public/templates/admin/faq/list.html",
        controller: "listFAQAdminController",
        controllerAs: "listFAQAdminCtrl",
        url: "adminfaq"
    });
			$stateProvider.state("app.adminservices", {
        templateUrl: "public/templates/admin/services/list.html",
        controller: "listServiceAdminController",
        controllerAs: "listServiceAdminCtrl",
        url: "adminservices"
    });
				$stateProvider.state("app.adminoffers", {
        templateUrl: "public/templates/admin/annonces/annonces.html",
        controller: "listAnnoncesAdminController",
        controllerAs: "listAnnoncesAdminCtrl",
        url: "adminoffers"
    });
    HateoasInterceptorProvider.transformAllResponses();
};
config.$inject = ["$stateProvider", "$httpProvider", "HateoasInterceptorProvider"];

module.exports = config;
