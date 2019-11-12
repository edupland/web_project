var faqAdminServiceDel = function faqAdminServiceDel($resource) {
 return $resource("../Back/index.php?type=delfaq");
};
faqAdminServiceDel.$inject = ["$resource"];
module.exports = faqAdminServiceDel;