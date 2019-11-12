var listAnnoncesAdminController = require("./listannoncesAdmin.controller");
var listAnnoncesAdminService = require("./listAnnoncesAdmin.service");
var updateAnnoncesAdminService = require("./updateAnnoncesAdmin.service");
module.exports = angular.module('projet.listAdmin', [])
    .controller("listAnnoncesAdminController", listAnnoncesAdminController)
    .service("listAnnoncesAdminService", listAnnoncesAdminService)
    .service("updateAnnoncesAdminService", updateAnnoncesAdminService);
