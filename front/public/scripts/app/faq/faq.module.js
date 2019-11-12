var faqController = require("./faq.controller");
var faqService = require("./faq.service");
module.exports = angular.module('projet.faq', [])
      .service("faqService", faqService)
        .controller("faqController", faqController);
