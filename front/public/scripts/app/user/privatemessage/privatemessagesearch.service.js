var privatemessagesearchService = function privatemessagesearchService($resource) {
 return $resource("../Back/index.php?type=finduser");
};
privatemessagesearchService.$inject = ["$resource"];
module.exports = privatemessagesearchService;