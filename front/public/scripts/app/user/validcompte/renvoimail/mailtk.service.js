var mailtkService = function mailtkService($resource) {
 return $resource("../Back/index.php?type=mailtk");
};
mailtkService.$inject = ["$resource"];
module.exports = mailtkService;