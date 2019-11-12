var listServiceAdminController = function (servicesService,$rootScope,servicesServiceDel,$scope,$uibModal, growl,$state,$sessionStorage){
var inception = this;
    inception.page = {
        pageable: {
            numPage: 1,
            nbElt: 10,
            sort: "asc",
			totalPages: 5,
			totalElements: 1,
        }
    };
  inception.getservice=function(tmp){
	 console.log($rootScope.admin);
	if($rootScope.admin!=1){
	   growl.error("Vous n'êtes pas admin",{});
      $state.transitionTo("app.home");
	}
   servicesService.get({typeservice:""}).$promise
    .then(function(result){
      inception.listservices=result.message.slice(0+inception.page.pageable.nbElt*(inception.page.pageable.numPage-1),inception.page.pageable.nbElt*inception.page.pageable.numPage);
	  inception.page.pageable.totalElements=result.message.length;
	  
    },function (data) {
      growl.error(data.data.message,{});
      $state.transitionTo("app.home");
    });

  }
  inception.getservice();
  inception.admintype = function () {
    var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/admin/services/typeServices/list.html",
            controller: "listTypeServiceAdminController",
            controllerAs: "listTypeServiceAdminCtrl",
            limit: "md",
            backdrop: 'static'
        });
		 modalInstance.result.then(function () {
           inception.getservice();
        });
	};
	  inception.add = function () {
    var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/admin/services/add.html",
            controller: "addServiceAdminController",
            controllerAs: "addServiceAdminCtrl",
            limit: "md",
            backdrop: 'static'
        });
		 modalInstance.result.then(function () {
           inception.getservice();
        });
	};
	inception.modif = function (id) {
	 $rootScope.description=id;
    var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/admin/services/description.html",
            controller: "descServiceAdminController",
            controllerAs: "descServiceAdminCtrl",
            limit: "md",
            backdrop: 'static'
        });
		 modalInstance.result.then(function () {
           inception.getservice();
        });
	};
		inception.delete = function (id) {
		var test=  angular.merge({id:id,token:$sessionStorage.auth});
		servicesServiceDel.get(test).$promise
		.then(function (result) {
			growl.success(result.message,{});
			inception.getservice();
        },function (data) {
            growl.error(data.data.message,{});
        });
	};
};
listServiceAdminController.$inject = ["servicesService","$rootScope","servicesServiceDel","$scope", "$uibModal", "growl","$state","$sessionStorage"];
module.exports = listServiceAdminController;