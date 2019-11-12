var mailtkController = function (mailtkService,growl, $uibModalInstance){
	var inception = this;
	inception.cancel = function(){
        $uibModalInstance.dismiss('cancel');
    };
	inception.send = function(){
		mailtkService.save(inception.tkForm).$promise
		.then(function (result) {
			growl.success("Un mail de confirmation vient de vous être envoyé.",{});
            if ($uibModalInstance) {
                 $uibModalInstance.close();
            }
        },function (data) {
            inception.tkForm = {};
            inception.tkForm.error = data.data.message;
        });
	};
};
mailtkController.$inject = ["mailtkService","growl", "$uibModalInstance"];
module.exports = mailtkController;