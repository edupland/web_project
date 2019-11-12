var listTypeServiceAdminController = function ($rootScope,typesservicesService,updateTypeServiceAdminService,delTypeServiceAdminService,$uibModal,$uibModalInstance,$scope, growl,$state,$sessionStorage){
var inception = this;
	inception.cancel = function(){
        $uibModalInstance.dismiss('cancel');
    };
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
	  	if($rootScope.admin!=1){
	   growl.error("Vous n'êtes pas admin",{});
      $state.transitionTo("app.home");
	}
	else{
		typesservicesService.get().$promise
		.then(function(result){
		  inception.listServiceType=result.message.slice(0+inception.page.pageable.nbElt*(inception.page.pageable.numPage-1),inception.page.pageable.nbElt*inception.page.pageable.numPage);
		  inception.page.pageable.totalElements=result.message.length;
		  
		},function (data) {
		  growl.error(data.data.message,{});
		  $state.transitionTo("app.home");
		});
	}
  }
    inception.addtype = function () {
    var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/admin/services/typeServices/add.html",
            controller: "addTypeAdminController",
            controllerAs: "addTypeAdminCtrl",
            limit: "md",
            backdrop: 'static'
        });
		 modalInstance.result.then(function () {
           inception.getservice();
        });
	};
		inception.delete = function (id) {
		var test=  angular.merge(id,{token:$sessionStorage.auth});
		delTypeServiceAdminService.save(test).$promise
		.then(function (result) {
			growl.success(result.message,{});
			inception.getservice();
        },function (data) {
            growl.error(data.data.message,{});
        });
	};
	    inception.saveParameter = function (id) {
		var test=  angular.merge(id,{token:$sessionStorage.auth});
		updateTypeServiceAdminService.save(test).$promise
		.then(function (result) {
			growl.success(result.message,{});
			inception.getservice();
        },function (data) {
            growl.error(data.data.message,{});
        });
			
	};
  inception.getservice();
};
listTypeServiceAdminController.$inject = ["$rootScope","typesservicesService","updateTypeServiceAdminService","delTypeServiceAdminService","$uibModal","$uibModalInstance","$scope", "growl","$state","$sessionStorage"];
module.exports = listTypeServiceAdminController;