var mailmdpController = function ($uibModalInstance,mailmdpService,growl, $state){
	var inception=this;
	inception.cancel = function(){
        $uibModalInstance.dismiss('cancel');
    };
	inception.send = function(){
		mailmdpService.save(inception.mdpForm).$promise
		.then(function (result) {
			growl.success("Un mail de confirmation vient de vous être envoyé.",{});
            if ($uibModalInstance) {
                 $uibModalInstance.close();
            }
        },function (data) {
            inception.mdpForm = {};
            inception.mdpForm.error = data.data.message;
        });
	};
};
mailmdpController.$inject = ["$uibModalInstance", "mailmdpService","growl", "$sessionStorage", "$state"];
module.exports = mailmdpController;