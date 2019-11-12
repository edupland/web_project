var faqController = function ($scope, growl, faqService,$state){
  var inception = this;
  inception.listFAQ=[];
  inception.getfaq=function(tmp){
    faqService.get().$promise
    .then(function(result){
      inception.listFAQ=result.message;
	  console.log(inception.listFAQ);
    },function (data) {
      growl.error(data.data.message,{});
      $state.transitionTo("app.home");
    });
  }
  inception.getfaq();

};
faqController.$inject = ["$scope", "growl", "faqService","$state"];
module.exports = faqController;
