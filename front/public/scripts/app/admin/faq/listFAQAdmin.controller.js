var listFAQAdminController = function ($rootScope,$scope, growl, faqService,faqAdminServiceUpdate,faqAdminServiceDel,$state,$uibModal,$sessionStorage){
 var inception = this;
  inception.listFAQ=[];
    inception.page = {
        pageable: {
            numPage: 1,
            nbElt: 10,
            sort: "asc",
			totalPages: 5,
			totalElements: 1,
        }
    };
  inception.getfaq=function(tmp){
		if($rootScope.admin!=1){
	   growl.error("Vous n'êtes pas admin",{});
      $state.transitionTo("app.home");	
	}
	else{
		faqService.get().$promise
		.then(function(result){
		  inception.listFAQ=result.message.slice(0+inception.page.pageable.nbElt*(inception.page.pageable.numPage-1),inception.page.pageable.nbElt*inception.page.pageable.numPage);
		  inception.page.pageable.totalElements=result.message.length;
		  
		},function (data) {
		  growl.error(data.data.message,{});
		  $state.transitionTo("app.home");
		});
	}
  }
  inception.getfaq();
    inception.add = function () {
    var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/admin/faq/add.html",
            controller: "addFAQAdminController",
            controllerAs: "addFAQAdminCtrl",
            limit: "md",
            backdrop: 'static'
        });
		 modalInstance.result.then(function () {
           inception.getfaq();
        });
	};
	inception.delete = function (faq) {
		var test=  angular.merge(faq,{token:$sessionStorage.auth});
		faqAdminServiceDel.save(test).$promise
		.then(function (result) {
			growl.success(result.message,{});
			inception.getfaq();
        },function (data) {
            growl.error(data.data.message,{});
        });
	};
	    inception.saveParameter = function (faq) {
		var test=  angular.merge(faq,{token:$sessionStorage.auth});
		faqAdminServiceUpdate.save(test).$promise
		.then(function (result) {
			growl.success(result.message,{});
			inception.getfaq();
        },function (data) {
            growl.error(data.data.message,{});
        });
			
	};
};
listFAQAdminController.$inject = ["$rootScope","$scope","growl","faqService","faqAdminServiceUpdate","faqAdminServiceDel","$state","$uibModal","$sessionStorage"];
module.exports = listFAQAdminController;