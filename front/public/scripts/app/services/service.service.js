var servicesService = function servicesService($resource) {
 return $resource("../Back/index.php?type=showservice");
};
servicesService.$inject = ["$resource"];
module.exports = servicesService;
