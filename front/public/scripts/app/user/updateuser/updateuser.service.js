var updateuserService = function updateuserService($resource) {
 return $resource("../Back/index.php?type=modif");
};
updateuserService.$inject = ["$resource"];
module.exports = updateuserService;