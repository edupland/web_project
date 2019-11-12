var mailmdpService = function mailmdpService($resource) {
 return $resource("../Back/index.php?type=mailmdp");
};
mailmdpService.$inject = ["$resource"];
module.exports = mailmdpService;