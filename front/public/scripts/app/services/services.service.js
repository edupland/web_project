var servicesService = function servicesService($resource) {
 return $resource("../Back/index.php?type=showallservices");
};
servicesService.$inject = ["$resource"];
module.exports = servicesService;
