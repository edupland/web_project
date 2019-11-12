var signupController = function ($uibModalInstance,signupService,growl,$state){
	var inception=this;
	inception.cancel = function(){
        $uibModalInstance.dismiss('cancel');
    };
	inception.submit = function () {
		signupService.save(inception.signupForm).$promise
		.then(function (result) {
            if ($uibModalInstance) {
                 $uibModalInstance.close();
            }
			growl.success(result.message,{});
            $state.transitionTo("app.home");
        },function (data) {
            inception.signupForm = {};
            inception.signupForm.error = data.data.message;
        });
    };
};
signupController.$inject = ["$uibModalInstance","signupService","growl", "$state"];
module.exports = signupController;