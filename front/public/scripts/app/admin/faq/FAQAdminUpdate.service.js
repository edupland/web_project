var faqAdminServiceUpdate = function faqAdminServiceUpdate($resource) {
 return $resource("../Back/index.php?type=updatefaq");
};
faqAdminServiceUpdate.$inject = ["$resource"];
module.exports = faqAdminServiceUpdate;