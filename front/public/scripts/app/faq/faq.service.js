var faqService = function faqService($resource) {
 return $resource("../Back/index.php?type=getfaq");
};
faqService.$inject = ["$resource"];
module.exports = faqService;
