var appConfig = require("./app.config");
var appRun = require("./app.run");
var appController = require("./app.controller");
var homeModule = require("./home/home.module");
var faqModule = require("./faq/faq.module");
var offersModule = require("./offers/offers.module");
var servicesModule = require("./services/services.module");
var loginModule = require("./login/login.module");
var signupModule = require("./signup/signup.module");
var updateuserModule = require("./user/updateuser/updateuser.module");
var userService=require("./user/user.service");
var validcompteModule=require("./user/validcompte/validcompte.module");
var mailtkModule=require("./user/validcompte/renvoimail/mailtk.module");
var mailmdpModule=require("./login/mailmdp/mailmdp.module");
var privatemessageModule=require("./user/privatemessage/privatemessage.module");
var adminuserModule=require("./admin/user/listUserAdmin.module");
var adminfaqModule=require("./admin/faq/listFAQAdmin.module");
var adminoffersModule=require("./admin/annonces/listAnnoncesAdmin.module");
var adminservicesModule=require("./admin/services/listServiceAdmin.module");
angular.module("projet",
	["ui.router", "ngStorage","http-auth-interceptor", "xeditable", "ngPassword",
		"hateoas", "ui.bootstrap", "ui.bootstrap.tpls", "ngImgCrop", "infinite-scroll","angular-growl","ui-leaflet",
		homeModule.name,servicesModule.name,loginModule.name,signupModule.name,updateuserModule.name,validcompteModule.name,mailtkModule.name,mailmdpModule.name,privatemessageModule.name,faqModule.name,
		adminfaqModule.name,adminuserModule.name,adminservicesModule.name,offersModule.name,adminoffersModule.name])
	.config(appConfig)
	.run(appRun)
	.controller("appController", appController)
	.service("userService",userService)
	.config(['growlProvider', function(growlProvider) {
		growlProvider.globalPosition('top-center');
		growlProvider.globalTimeToLive(3000);
	}]);
