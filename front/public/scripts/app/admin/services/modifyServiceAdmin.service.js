var modifyServiceAdminService = function modifyServiceAdminService($resource) {
 return $resource("../Back/index.php?type=modifyservice");
};
modifyServiceAdminService.$inject = ["$resource"];
module.exports = modifyServiceAdminService;
