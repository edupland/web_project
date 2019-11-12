var addServiceAdminService = function addServiceAdminService($resource) {
 return $resource("../Back/index.php?type=addservice");
};
addServiceAdminService.$inject = ["$resource"];
module.exports = addServiceAdminService;
