var servicesController = require("./services.controller");
var descriptionServicesController= require("./descriptionServices.controller");
var servicesService = require("./services.service");
var serviceService = require("./service.service");
var typesservicesService = require ("./typesservices.service");
module.exports = angular.module('projet.services', [])
        .controller("servicesController", servicesController)
		.controller("descriptionServicesController", descriptionServicesController)
		.service("serviceService", serviceService)
		.service("typesservicesService",typesservicesService)
		.service("servicesService", servicesService);