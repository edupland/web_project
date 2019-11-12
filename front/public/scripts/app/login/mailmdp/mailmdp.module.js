var mailmdpController = require("./mailmdp.controller");
var mailmdpService = require("./mailmdp.service");
module.exports = angular.module('projet.mailmdp', [])
		.service("mailmdpService", mailmdpService)
        .controller("mailmdpController", mailmdpController);