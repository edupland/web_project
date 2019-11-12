var addTypeServiceAdminService = function listServiceAdminService($resource) {
 return $resource("../Back/index.php?type=addservicetype");
};
addTypeServiceAdminService.$inject = ["$resource"];
module.exports = addTypeServiceAdminService;
