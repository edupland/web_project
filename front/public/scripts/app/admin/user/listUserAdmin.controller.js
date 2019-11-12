var listUserAdminController = function ($rootScope,catUserService,listUserAdminService,userAdminServiceUpdate,$scope, growl,$state,$sessionStorage){
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
  inception.getuser=function(tmp){
	  		if($rootScope.admin!=1){
	   growl.error("Vous n'êtes pas admin",{});
      $state.transitionTo("app.home");	
	}
	else{
		catUserService.get().$promise
		.then(function(result){
		  inception.usercat=result.message;
		  
		},function (data) {
		  growl.error(data.data.message,{});
		  $state.transitionTo("app.home");
		});
		listUserAdminService.get({token:$sessionStorage.auth}).$promise
		.then(function(result){
		  inception.users=result.message.slice(0+inception.page.pageable.nbElt*(inception.page.pageable.numPage-1),inception.page.pageable.nbElt*inception.page.pageable.numPage);
		  inception.page.pageable.totalElements=result.message.length;
		  
		},function (data) {
		  growl.error(data.data.message,{});
		  $state.transitionTo("app.home");
		});
	}
  }
	inception.saveUser = function (user) {
		var test=  angular.merge(user,{token:$sessionStorage.auth});
		userAdminServiceUpdate.save(test).$promise
		.then(function (result) {
			growl.success(result.message,{});
			inception.getuser();
        },function (data) {
            growl.error(data.data.message,{});
        });
			
	};
  inception.getuser();
};
listUserAdminController.$inject = ["$rootScope","catUserService","listUserAdminService","userAdminServiceUpdate","$scope", "growl","$state","$sessionStorage"];
module.exports = listUserAdminController;