var descriptionOffersController = function ($uibModalInstance,$rootScope,offerService, growl){
	var inception=this;
	inception.cancel = function(){
        $uibModalInstance.dismiss('cancel');
    };
	inception.getoffer=function(tmp){
	offerService.get({id:$rootScope.description}).$promise
    .then(function(result){
      inception.offer=result.message;
	  console.log(inception.offer);
    },function (data) {
      growl.error(data.data.message,{});
      $state.transitionTo("app.offers");
    });
  }
  inception.getoffer();

};
descriptionOffersController.$inject = ["$uibModalInstance","$rootScope","offerService","growl"];
module.exports = descriptionOffersController;
