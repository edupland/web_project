var offersService = function offersService($resource) {
 return $resource("../Back/index.php?type=showallannounces");
};
offersService.$inject = ["$resource"];
module.exports = offersService;
