var listUserAdminController = require("./listUserAdmin.controller");
var listUserAdminService = require("./listUserAdmin.service");
var userAdminServiceUpdate = require("./userAdminServiceUpdate.service");
var catUserService = require("./catUser.service");
module.exports = angular.module('projet.listUserAdmin', [])
        .controller("listUserAdminController", listUserAdminController)
		.service("listUserAdminService", listUserAdminService)
		.service("catUserService", catUserService)
		.service("userAdminServiceUpdate", userAdminServiceUpdate);
		