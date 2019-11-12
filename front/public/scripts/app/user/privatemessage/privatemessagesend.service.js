var privatemessagesendService = function privatemessagesendService($resource) {
 return $resource("../Back/index.php?type=sendmessage");
};
privatemessagesendService.$inject = ["$resource"];
module.exports = privatemessagesendService;