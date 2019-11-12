var proposeOffersService = function proposeOffersService($resource) {
 return $resource("../Back/index.php?type=addannounce");
};
proposeOffersService.$inject = ["$resource"];
module.exports = proposeOffersService;