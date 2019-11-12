var descriptionServicesController = function ($uibModalInstance,growl,$state,$rootScope,serviceService){
	var inception=this;
	inception.cancel = function(){
        $uibModalInstance.dismiss('cancel');
    };
	inception.getservice=function(tmp){
	serviceService.get({id:$rootScope.description}).$promise
    .then(function(result){
      inception.service=result.message;
    },function (data) {
      growl.error(data.data.message,{});
      $state.transitionTo("app.home");
    });
  }
  inception.getservice();

};
descriptionServicesController.$inject = ["$uibModalInstance","growl","$state","$rootScope","serviceService"];
module.exports = descriptionServicesController;