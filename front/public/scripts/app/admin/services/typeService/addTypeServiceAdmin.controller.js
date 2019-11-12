var addTypeAdminController = function ($rootScope,addTypeServiceAdminService,$scope,$uibModalInstance, growl,$state,$sessionStorage){
var inception = this;
	inception.init = function(){
		if($rootScope.admin!=1){
	   growl.error("Vous n'êtes pas admin",{});
      $state.transitionTo("app.home");	
	}
	}
	inception.init();
	inception.cancel = function(){
        $uibModalInstance.dismiss('cancel');
    };
	inception.submit = function () {
		var test=  angular.merge(inception.type,{token:$sessionStorage.auth});
		addTypeServiceAdminService.save(test).$promise
		.then(function (result) {
            if ($uibModalInstance) {
                 $uibModalInstance.close();
            }
			growl.success(result.message,{});
        },function (data) {
            inception.faq = {};
            inception.error = data.data.message;
        });
    };
};
addTypeAdminController.$inject = ["$rootScope","addTypeServiceAdminService","$scope","$uibModalInstance", "growl","$state","$sessionStorage"];
module.exports = addTypeAdminController;