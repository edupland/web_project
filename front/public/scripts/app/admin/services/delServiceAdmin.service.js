var servicesServiceDel = function servicesServiceDel($resource) {
 return $resource("../Back/index.php?type=hideservice");
};
servicesServiceDel.$inject = ["$resource"];
module.exports = servicesServiceDel;
