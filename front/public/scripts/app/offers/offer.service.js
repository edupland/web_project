var offerService = function offerService($resource) {
    return $resource("../Back/index.php?type=showannounce");
};
offerService.$inject = ["$resource"];
module.exports = offerService;
