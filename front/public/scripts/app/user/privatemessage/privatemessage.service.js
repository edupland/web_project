var privatemessageService = function privatemessageService($resource) {
 return $resource("../Back/index.php?type=listmessages");
};
privatemessageService.$inject = ["$resource"];
module.exports = privatemessageService;