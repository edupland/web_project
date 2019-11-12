var signupController = require("./signup.controller");
var signupService=require("./signup.service");
module.exports = angular.module('projet.signup', [])
        .controller("signupController", signupController)
		.service("signupService", signupService);