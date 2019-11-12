var updateuserController = require("./updateuser.controller");
var userService=require("../user.service");
var mailmdpService = require("../../login/mailmdp/mailmdp.service");
var updateuserService=require("./updateuser.service");
module.exports = angular.module('projet.updateuser', [])
		.service("userService",userService)
		.service("updateuserService",updateuserService)
		.service("mailmdpService", mailmdpService)
        .controller("updateuserController", updateuserController);
