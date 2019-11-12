var userService = function userService($resource) {
 return $resource("../Back/index.php");
};
userService.$inject = ["$resource"];
module.exports = userService;