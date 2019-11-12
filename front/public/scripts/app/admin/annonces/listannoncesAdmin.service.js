var listAnnoncesAdminService = function listAnnoncesAdminService($resource) {
    return $resource("../Back/index.php?type=showannounceadmin");
};
listAnnoncesAdminService.$inject = ["$resource"];
module.exports = listAnnoncesAdminService;
