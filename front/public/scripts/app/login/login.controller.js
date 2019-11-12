var loginController = function ($uibModalInstance,$uibModal,loginService,growl,$sessionStorage, $state){
	var inception=this;
	inception.cancel = function(){
		if($sessionStorage.auth){
			growl.error("Merci de vous reconnecter",{});	
		}
		delete $sessionStorage.auth;
		delete inception.currentuser;
		$state.transitionTo("app.home");
        $uibModalInstance.dismiss('cancel');
		
    };
	inception.resetpwd = function(){
		$uibModalInstance.dismiss('cancel');
		 var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/login/renvoimdp/renvoimdp.html",
            controller: "mailmdpController",
            controllerAs: "mailmdpCtrl",
            limit: "md",
            backdrop: 'static'
        });
	}
	inception.mail=function(){
		$state.transitionTo("app.valid");
        $uibModalInstance.dismiss('cancel');
	}
	inception.authenticate = function () {
		loginService.save(inception.loginForm).$promise
		.then(function (result) {
			growl.success("Bienvenue",{});
            $sessionStorage.auth = result.token;
            if ($uibModalInstance) {
                 $uibModalInstance.close();
            }
        },function (data) {
            inception.loginForm = {};
            inception.loginForm.error = data.data.message;
        });
    };
};
loginController.$inject = ["$uibModalInstance","$uibModal", "loginService","growl", "$sessionStorage", "$state"];
module.exports = loginController;