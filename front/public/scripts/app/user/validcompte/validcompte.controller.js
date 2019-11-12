var validcompteController = function (userService,growl,$location,$uibModal,$state,$sessionStorage){
	var inception = this;
	if($location.search().pass==1){
		if($location.search().tk){
		inception.valipass=function (){
			userService.get({type:"confirmmdp",token:$location.search().tk}).$promise
			.then(function (result) {
				growl.success(result.message,{});
				$state.transitionTo("app.home");
			},function (data) {
				growl.error(data.data.message,{});
				$state.transitionTo("app.home");
			});
		};
		inception.valipass();
	}
	}
	else if($location.search().tk){
		inception.valid=function (){
			userService.get({type:"token",token:$location.search().tk}).$promise
			.then(function (result) {
				growl.success(result.message,{});
				$state.transitionTo("app.home");
			},function (data) {
				growl.error(data.data.message,{});
			});
		};
	
		if($sessionStorage.auth){
			growl.error("Votre compte est déja activé",{});
			$state.transitionTo("app.home");
		}
		else{
			inception.valid();
		}
	}
	inception.mailtk = function () {
        var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/users/validcompte/renvoimail/renvoimail.html",
            controller: "mailtkController",
            controllerAs: "mailtkCtrl",
            limit: "md",
            backdrop: 'static'
        });
    };
	
};
validcompteController.$inject = ["userService","growl","$location","$uibModal","$state","$sessionStorage"];
module.exports = validcompteController;