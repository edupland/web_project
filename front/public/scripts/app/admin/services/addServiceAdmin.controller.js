var addServiceAdminController = function ($rootScope,$http,$sce,typesservicesService,addServiceAdminService,$uibModalInstance,$scope, growl,$state,$sessionStorage){
var inception = this;
	inception.cancel = function(){
        $uibModalInstance.dismiss('cancel');
    };
	inception.loadtype = function(){
			if($rootScope.admin!=1){
	   growl.error("Vous n'êtes pas admin",{});
      $state.transitionTo("app.home");
	}
	else{
		typesservicesService.get().$promise
		.then(function(result){
		    inception.typeServices=result.message;
		},function (data) {
			growl.error(data.data.message,{});
			$state.transitionTo("app.home");
		});
	}
	};
	inception.loadadr = function(adr){
    return $http.get('//maps.googleapis.com/maps/api/geocode/json', {
      params: {
        address: adr,
        sensor: false
      }
    }).then(function(response){
      return response.data.results.map(function(item){
        return item.formatted_address;
      });
    });
	};
	inception.submit = function () {
		$http.get('https://maps.googleapis.com/maps/api/geocode/json?address=' + 
              inception.service.address+ '&key=AIzaSyCPlOsj-81NHGWeYlWtWdC7MAjOE7pKVhU')
      .then(function(coord_results){
		 inception.service.lat=coord_results.data.results[0].geometry.location.lat;
		 inception.service.lng=coord_results.data.results[0].geometry.location.lng;
		 var test=  angular.merge(inception.service,{token:$sessionStorage.auth});
		addServiceAdminService.save(test).$promise
		.then(function (result) {
            if ($uibModalInstance) {
                 $uibModalInstance.close();
            }
			growl.success(result.message,{});
        },function (data) {
            inception.faq = {};
            growl.error(data.data.message,{});
        }); 
       })
		
    };
	inception.loadtype();
};
addServiceAdminController.$inject = ["$rootScope","$http","$sce","typesservicesService","addServiceAdminService","$uibModalInstance","$scope", "growl","$state","$sessionStorage"];
module.exports = addServiceAdminController;