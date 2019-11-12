var typesservicesService = function typesservicesService($resource) {
 return $resource("../Back/index.php?type=showservicetypes");
};
typesservicesService.$inject = ["$resource"];
module.exports = typesservicesService;
