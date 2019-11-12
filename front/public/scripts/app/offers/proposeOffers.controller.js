var proposeOffersController = function ($uibModalInstance,$rootScope,offersService,proposeOffersService,growl,$sessionStorage){
	var inception=this;
	inception.cancel = function(){
    $uibModalInstance.dismiss('cancel');
  };
  inception.submit = function(){
    var test=  angular.merge(inception.offers,{token:$sessionStorage.auth});
    proposeOffersService.save(test).$promise
    .then(function (result){
      if($uibModalInstance){
        $uibModalInstance.close();
      }
      growl.success(result.message,{});
    },function (data){
      inception.propose = {};
      inception.error = data.data.message;
    });
  };
};



proposeOffersController.$inject = ["$uibModalInstance","$rootScope","offersService","proposeOffersService","growl","$sessionStorage"];
module.exports = proposeOffersController;
