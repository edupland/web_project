var loginService = function loginService($resource) {
 return $resource("../Back/index.php?type=login");
};
loginService.$inject = ["$resource"];
module.exports = loginService;