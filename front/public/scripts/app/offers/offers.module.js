var offersController = require("./offers.controller");
var descriptionOffersController = require("./descriptionOffers.controller");
var proposeOffersController = require("./proposeOffers.controller");
var offersService = require("./offers.service");
var offerService = require("./offer.service");
var proposeOffersService = require("./proposeOffers.service");
module.exports = angular.module('projet.offers', [])
        .controller("offersController", offersController)
		.controller("descriptionOffersController", descriptionOffersController)
		.controller("proposeOffersController", proposeOffersController)
		.service("proposeOffersService", proposeOffersService)
		.service("offerService", offerService)
		.service("offersService", offersService);