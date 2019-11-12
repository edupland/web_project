var mailtkController = require("./mailtk.controller");
var mailtkService=require("./mailtk.service");
module.exports = angular.module('projet.mailtk', [])
        .service("mailtkService",mailtkService)
		.controller("mailtkController", mailtkController);
		