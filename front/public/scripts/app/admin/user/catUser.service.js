var catUserService = function catUserService($resource) {
 return $resource("../Back/index.php?type=listusercategories");
};
catUserService.$inject = ["$resource"];
module.exports = catUserService;
