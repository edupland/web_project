var userAdminServiceUpdate = function userAdminServiceUpdate($resource) {
 return $resource("../Back/index.php?type=adminuserupdate");
};
userAdminServiceUpdate.$inject = ["$resource"];
module.exports = userAdminServiceUpdate;
