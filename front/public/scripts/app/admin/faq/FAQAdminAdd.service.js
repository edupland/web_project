var faqAdminServiceAdd = function faqAdminServiceAdd($resource) {
 return $resource("../Back/index.php?type=addfaq");
};
faqAdminServiceAdd.$inject = ["$resource"];
module.exports = faqAdminServiceAdd;