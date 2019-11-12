var listFAQAdminController = require("./listFAQAdmin.controller");
var addFAQAdminController = require("./addFAQAdmin.controller");
var faqService = require("../../faq/faq.service");
var faqAdminServiceUpdate = require("./FAQAdminUpdate.service");
var faqAdminServiceAdd = require("./FAQAdminAdd.service");
var faqAdminServiceDel = require("./FAQAdminDel.service");
module.exports = angular.module('projet.listFAQAdmin', [])
        .service("faqService", faqService)
		.service("faqAdminServiceUpdate", faqAdminServiceUpdate)
		.service("faqAdminServiceAdd", faqAdminServiceAdd)
		.service("faqAdminServiceDel", faqAdminServiceDel)
		.controller("addFAQAdminController", addFAQAdminController)
		.controller("listFAQAdminController", listFAQAdminController);
		