var addFAQAdminController = function ($rootScope,$uibModalInstance,faqAdminServiceAdd,$sessionStorage,growl){
	var inception = this;
	inception.cancel = function(){
        $uibModalInstance.dismiss('cancel');
    };
		inception.init = function(){
		if($rootScope.admin!=1){
	   growl.error("Vous n'êtes pas admin",{});
      $state.transitionTo("app.home");	
	}
	}
	inception.init();
	inception.submit = function () {
		var test=  angular.merge(inception.faq,{token:$sessionStorage.auth});
		faqAdminServiceAdd.save(test).$promise
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
addFAQAdminController.$inject = ["$rootScope","$uibModalInstance","faqAdminServiceAdd","$sessionStorage","growl"];
module.exports = addFAQAdminController;