var descServiceAdminController = function (serviceService,modifyServiceAdminService,$uibModalInstance,$rootScope,$scope, growl,$state,$sessionStorage,$http){
var inception = this;
	inception.cancel = function(){
        $uibModalInstance.dismiss('cancel');
    };
		inception.getservice=function(tmp){
				if($rootScope.admin!=1){
	   growl.error("Vous n'êtes pas admin",{});
      $state.transitionTo("app.home");
	}
	else{
		serviceService.get({id:$rootScope.description}).$promise
		.then(function(result){
		  inception.service=result.message;
		},function (data) {
		  growl.error(data.data.message,{});
		  $state.transitionTo("app.home");
		});
	  }
	}

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
  inception.save= function(service){

		$http.get('https://maps.googleapis.com/maps/api/geocode/json?address=' + 
              inception.service.address+ '&key=AIzaSyCPlOsj-81NHGWeYlWtWdC7MAjOE7pKVhU')
      .then(function(coord_results){
		 service.lat=coord_results.data.results[0].geometry.location.lat;
		 service.lng=coord_results.data.results[0].geometry.location.lng;
			 var test=  angular.merge(service,{token:$sessionStorage.auth});
		modifyServiceAdminService.save(test).$promise
		.then(function (result) {
			growl.success(result.message,{});
        },function (data) {
            growl.error(data.data.message,{});
        });
		
       })
  }
  inception.getservice();
};
descServiceAdminController.$inject = ["serviceService","modifyServiceAdminService","$uibModalInstance","$rootScope","$scope", "growl","$state","$sessionStorage","$http"];
module.exports = descServiceAdminController;