var updateuserController = function ($scope,growl ,$uibModal,userService,mailmdpService,$rootScope, updateuserService, $sessionStorage, $state){
	var inception=this;
	inception.savemdp=function (datauser){
		console.log(datauser);
		if(datauser.password==datauser.password_confirm){
			mailmdpService.save(datauser).$promise
				.then(function (result) {
					growl.success(result.message,{});
				},function (data) {
					growl.error(data.data.message,{});
				});
		}
		else{
			growl.error("Les mots de passe ne sont pas identique",{});
		}
	};
	var handleFileSelect = function (evt) {
        var file = evt.currentTarget.files[0];
        var reader = new FileReader();
        reader.onload = function (evt) {
            $scope.$apply(function () {
                inception.photoTemp = evt.target.result;
            });
        };
        reader.readAsDataURL(file);
    };
    angular.element(document.querySelector('#photoProfil')).on('change', handleFileSelect);
	inception.getuser=function(){
			userService.get({type:"getuser",token:$sessionStorage.auth}).$promise
			.then(function (result) {
				inception.currentuser=result;
			},function (data) {
				delete $sessionStorage.auth;
				delete inception.currentuser;
				growl.error("Merci de vous connecter",{});
				$state.transitionTo("app.home");
			});
		};
	inception.save=function (tmp){
	var test=  angular.merge(tmp,{token:$sessionStorage.auth});
	updateuserService.save(test).$promise
		.then(function (result) {
			growl.success(result.message,{});
			$rootScope.user_pseudo=tmp.user_pseudo;
			$rootScope.image=tmp.image;
        },function (data) {
			growl.error(data.data.message,{});
			inception.getuser();
        });
	};
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
	if(!$sessionStorage.auth){
		growl.error("Merci de vous connecter",{});
		$state.transitionTo("app.home");
	}
	if($sessionStorage.auth){
		inception.login();
	}
	else{
		delete $sessionStorage.auth;
		delete inception.currentuser;
		growl.error("Merci de vous connecter",{});
		$state.transitionTo("app.home");
	}
};
updateuserController.$inject = ["$scope","growl", "$uibModal","userService","mailmdpService","$rootScope","updateuserService", "$sessionStorage", "$state"];
module.exports = updateuserController;
