var signupService = function signupService($resource) {
 return $resource("../Back/index.php?type=adduser");
};
signupService.$inject = ["$resource"];
module.exports = signupService;