var privatemessageController = require("./privatemessage.controller");
var privatemessageService=require("./privatemessage.service");
var privatemessagesearchService=require("./privatemessagesearch.service");
var privatemessagesendService=require("./privatemessagesend.service");
var privatemessagelistService=require("./privatemessagelist.service");
module.exports = angular.module('projet.privatemessage', [])
		.service("privatemessageService",privatemessageService)
		.service("privatemessagesearchService",privatemessagesearchService)
		.service("privatemessagelistService",privatemessagelistService)
		.service("privatemessagesendService",privatemessagesendService)
        .controller("privatemessageController",privatemessageController);
