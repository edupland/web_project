var privatemessagelistService = function privatemessagelistService($resource) {
 return $resource("../Back/index.php?type=allmessages");
};
privatemessagelistService.$inject = ["$resource"];
module.exports = privatemessagelistService;