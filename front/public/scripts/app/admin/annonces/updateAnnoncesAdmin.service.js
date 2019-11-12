var updateAnnoncesAdminService = function updateAnnoncesAdminService($resource) {
    return $resource("../Back/index.php?type=modifannounce");
};
updateAnnoncesAdminService.$inject = ["$resource"];
module.exports = updateAnnoncesAdminService;
