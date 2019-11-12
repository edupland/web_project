var servicesController = function ($scope,$uibModal,$rootScope,$http,servicesService,typesservicesService){
	var inception=this;
	    inception.page = {
        pageable: {
            numPage: 1,
            nbElt: 10,
            sort: "asc",
			totalPages: 5,
			totalElements: 1,
        }
    };
	inception.type="";
	//carto
	   inception.getservices=function(tmp){
		servicesService.get({typeservice:inception.type}).$promise
		.then(function(result){
		    inception.listServices=result.message.slice(0+inception.page.pageable.nbElt*(inception.page.pageable.numPage-1),inception.page.pageable.nbElt*inception.page.pageable.numPage);
		    inception.page.pageable.totalElements=result.message.length;
			angular.extend($scope, {        
			markers: inception.listServices,
			});  
		},function (data) {
			growl.error(data.data.message,{});
			$state.transitionTo("app.home");
		});
		typesservicesService.get().$promise
		.then(function(result){
		    inception.typeServices=result.message;
		},function (data) {
			growl.error(data.data.message,{});
			$state.transitionTo("app.home");
		});
  }
  inception.getservices();
	angular.extend($scope, {
        osloCenter: {
            lat: 44.80,
            lng: -0.59,
            zoom: 12
	}});
	//services
	inception.description = function (id) {
	$rootScope.description=id;
    var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/services/description.html",
            controller: "descriptionServicesController",
            controllerAs: "descriptionServicesCtrl",
            limit: "md",
            backdrop: 'static'
        });
	};
};
servicesController.$inject = ["$scope","$uibModal","$rootScope","$http","servicesService","typesservicesService"];
module.exports = servicesController;