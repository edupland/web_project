var listServiceAdminController = require("./listServiceAdmin.controller");
var addServiceAdminController = require("./addServiceAdmin.controller");
var listTypeServiceAdminController = require("./typeService/listTypeServiceAdmin.controller");
var addTypeAdminController = require("./typeService/addTypeServiceAdmin.controller");
var descServiceAdminController = require("./descServiceAdmin.controller");
var addTypeServiceAdminService = require("./typeService/addTypeServiceAdmin.service");
var delTypeServiceAdminService = require("./typeService/delTypeServiceAdmin.service");
var addServiceAdminService = require("./addServiceAdmin.service");
var modifyServiceAdminService = require("./modifyServiceAdmin.service");
var updateTypeServiceAdminService = require("./typeService/updateTypeServiceAdmin.service");
var servicesServiceDel = require("./delServiceAdmin.service");
var servicesService = require("../../services/services.service");
var serviceService = require("../../services/service.service");
var typesservicesService = require("../../services/typesservices.service");
module.exports = angular.module('projet.listServiceAdmin', [])
        .controller("listServiceAdminController", listServiceAdminController)
		.controller("listTypeServiceAdminController", listTypeServiceAdminController)
		.controller("addServiceAdminController", addServiceAdminController)
		.controller("addTypeAdminController", addTypeAdminController)
		.controller("descServiceAdminController", descServiceAdminController)
		.service("servicesService", servicesService)
		.service("serviceService", serviceService)
		.service("modifyServiceAdminService", modifyServiceAdminService)
		.service("servicesServiceDel", servicesServiceDel)
		.service("updateTypeServiceAdminService", updateTypeServiceAdminService)
		.service("addServiceAdminService", addServiceAdminService)
		.service("delTypeServiceAdminService", delTypeServiceAdminService)
		.service("addTypeServiceAdminService", addTypeServiceAdminService)
		.service("typesservicesService", typesservicesService);
		 