var appController = function ($uibModal,$rootScope,userService ,growl, $sessionStorage, $state) {
    var inception = this;
	inception.getuser=function(){
		userService.get({type:"getuser",token:$sessionStorage.auth}).$promise
		.then(function (result) {
			inception.currentuser=result;
			userService.get({type:"access",token:$sessionStorage.auth}).$promise
			.then(function (result) {
					if(result.message=="Admin"){
						inception.currentuser.admin=1;
						$rootScope.admin=inception.currentuser.admin;
					}
					else{
						inception.currentuser.admin=0;
						$rootScope.admin=inception.currentuser.admin;
					}
				}
				,function (data) {
					inception.currentuser.admin=0;
					$rootScope.admin=inception.currentuser.admin;
				}	);
			$rootScope.user_pseudo=result.user_pseudo;
			$rootScope.image=result.image;
		},function (data) {
			delete $sessionStorage.auth;
			delete inception.currentuser;
			growl.error("Merci de vous reconnecter",{});
        });
	}
	if($sessionStorage.auth){
		inception.getuser();
	}
    inception.login = function () {
    var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/login/login.html",
            controller: "loginController",
            controllerAs: "loginCtrl",
            limit: "md",
            backdrop: 'static'
        });
		 modalInstance.result.then(function (login) {
           inception.getuser();
        });
	};
	
    inception.signup = function () {
        var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/signup/signup.html",
            controller: "signupController",
            controllerAs: "signupCtrl",
            limit: "md",
            backdrop: 'static'
        });
    };
	
    inception.logout = function () {
        delete $sessionStorage.auth;
        delete inception.currentuser;
		growl.success("A bientôt",{});
        $state.transitionTo("app.home");
    };
};
appController.$inject = ["$uibModal","$rootScope", "userService",'growl',"$sessionStorage", "$state"];

module.exports = appController;
