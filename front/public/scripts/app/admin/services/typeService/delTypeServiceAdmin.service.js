var delTypeServiceAdminService = function delTypeServiceAdminService($resource) {
 return $resource("../Back/index.php?type=delservicetype");
};
delTypeServiceAdminService.$inject = ["$resource"];
module.exports = delTypeServiceAdminService;
