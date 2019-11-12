var privatemessageController = function ($scope,growl ,privatemessagesearchService,privatemessageService,privatemessagelistService,privatemessagesendService,$interval, $sessionStorage, $state){
	var inception = this;
	if($sessionStorage.auth){
		inception.message={};
		inception.get=function (user){
			inception.message.user=user;
			privatemessageService.get({id:user.id, token:$sessionStorage.auth}).$promise
			.then(function (result) {
				inception.message.content=result.messages;
			},function (data) {
				growl.error(data.data.message,{});
			});
		};
		inception.send = function(){
			privatemessagesendService.save({id:inception.message.user.id,token:$sessionStorage.auth, message:inception.message.send}).$promise
			.then(function(result){
				growl.success(result.message,{});
				inception.message.send="";
				inception.get(inception.message.user);
			},function(data){
				growl.error(data.data.message,{});
			})
		}
		inception.userssearch=function(tk){
			privatemessagesearchService.save({username:tk,token:$sessionStorage.auth}).$promise
			.then(function(result){
				inception.users=result.messages;
			},function(data){
				growl.error(data.data.messages,{});
			});
			
		}
		inception.list = function(){
			privatemessagelistService.get({token:$sessionStorage.auth}).$promise
			.then(function(result){
				inception.users=result.messages;
				console.log(result.messages);
			},function(data){
				growl.error(data.data.message,{});
			});
		}
				inception.list();
	}
	else{
		growl.error("Vous n'êtes pas connecté",{});
		$state.transitionTo("app.home");
	}
};
privatemessageController.$inject = ["$scope","growl","privatemessagesearchService","privatemessageService", "privatemessagelistService","privatemessagesendService", "$interval", "$sessionStorage", "$state"];
module.exports = privatemessageController;
