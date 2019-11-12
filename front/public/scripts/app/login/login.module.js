var loginController = require("./login.controller");
var loginService = require("./login.service");
module.exports = angular.module('projet.login', [])
		.service("loginService", loginService)
        .controller("loginController", loginController);