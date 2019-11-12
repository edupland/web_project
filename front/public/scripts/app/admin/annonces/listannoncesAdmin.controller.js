var listAnnoncesAdminController = function ($uibModal,$rootScope,updateAnnoncesAdminService,listAnnoncesAdminService,growl,$state,$sessionStorage){
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
			inception.init = function(){
		if($rootScope.admin!=1){
	   growl.error("Vous n'êtes pas admin",{});
      $state.transitionTo("app.home");	
	}
	else{
		listAnnoncesAdminService.get({token:$sessionStorage.auth}).$promise
		.then(function (result) {
			inception.listannonce=result.message.slice(0+inception.page.pageable.nbElt*(inception.page.pageable.numPage-1),inception.page.pageable.nbElt*inception.page.pageable.numPage);;
			inception.page.pageable.totalElements=result.message.length;
        },function (data) {
            growl.error(data.data.message,{});
        });
	}
	}
	inception.init();
	
	inception.modify=function(offre){
		var test=  angular.merge(offre,{token:$sessionStorage.auth});
		updateAnnoncesAdminService.get(test).$promise
		.then(function (result) {
			growl.success(result.message,{});
			inception.init();
        },function (data) {
            growl.error(data.data.message,{});
        });
	}
  	inception.description = function (id) {
	$rootScope.description=id;
	var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/offers/description.html",
            controller: "descriptionOffersController",
            controllerAs: "descriptionOffersCtrl",
            limit: "md",
            backdrop: 'static'
    });
	};
};
listAnnoncesAdminController.$inject = ["$uibModal","$rootScope","updateAnnoncesAdminService","listAnnoncesAdminService","growl","$state","$sessionStorage"];
module.exports = listAnnoncesAdminController ;