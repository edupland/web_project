var listUserAdminService = function listUserAdminService($resource) {
 return $resource("../Back/index.php?type=listuseradmin");
};
listUserAdminService.$inject = ["$resource"];
module.exports = listUserAdminService;
