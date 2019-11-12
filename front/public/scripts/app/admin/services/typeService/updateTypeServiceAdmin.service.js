var updateTypeServiceAdminService = function updateTypeServiceAdminService($resource) {
 return $resource("../Back/index.php?type=modifyservicetype");
};
updateTypeServiceAdminService.$inject = ["$resource"];
module.exports = updateTypeServiceAdminService;
