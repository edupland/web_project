var offersController = function ($scope,$uibModal,$rootScope,$http,offersService){
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
	inception.getoffers=function(tmp){
    offersService.get().$promise
    .then(function(result){
      inception.listOffers=result.message.slice(0+inception.page.pageable.nbElt*(inception.page.pageable.numPage-1),inception.page.pageable.nbElt*inception.page.pageable.numPage);;
      inception.page.pageable.totalElements=result.message.length;

    },function (data) {
      growl.error(data.data.message,{});
      $state.transitionTo("app.home");
    });
  }
  inception.getoffers();

	inception.description = function (id) {
	$rootScope.description=id;
    var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/offers/description.html",
            controller: "descriptionOffersController",
            controllerAs: "descriptionOffersCtrl",
            limit: "md",
            backdrop: 'static'
    });
	};
  inception.propose = function(){
    var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: "public/templates/offers/propose.html",
            controller: "proposeOffersController",
            controllerAs: "proposeOffersCtrl",
            limit: "md",
            backdrop: 'static'
    })
  }
};
offersController.$inject = ["$scope","$uibModal","$rootScope","$http","offersService"];
module.exports = offersController;
