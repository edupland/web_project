var validcompteController = require("./validcompte.controller");
var userService=require("../user.service");
module.exports = angular.module('projet.validcompte', [])
        .service("userService",userService)
		.controller("validcompteController", validcompteController);
		