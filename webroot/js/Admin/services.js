angular.module('mcen_services',['ngFileUpload'])
.factory('profileService',['$http','$q', function($http, $q){
		return{
			get: function(){
				return $http.get('/profiles/get').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			all: function(){
				return $http.get('/profiles/all').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			load: function(){
				return $http.get('/profiles/all').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			}
		}
	}]).factory('AccountService',['$http','$q', function($http, $q){
		return{
			get: function(id){
				return $http.get('/accounts/get',{params:{'id':id}}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			unlock: function(user_account_id){
				return $http.post('/accounts/unlock',{'id':user_account_id}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			renew_password: function(user_account_id){
				return $http.post('/accounts/renew',{'id':user_account_id}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});	
			}
		}
	}]).factory('roleAccountService',['$http','$q', function($http, $q){
		return{
			all: function(){
				return $http.get('/roles/all').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject();
				});
			}
		}
	}]).factory('userService',['$http','$q', function($http, $q){
		return{
			all: function(){
				return $http.get('/users/all').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			}
		}
	}]).factory('trainingService',['$http', '$q', function($http, $q){
		return{
			create: function(training){
				return $http.post('/trainings/create', training).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			all: function(){
				return $http.get('/trainings/all',{params:{gaining:'gaining'}}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			get_all_types: function(){
				return $http.get('/training-asset-types/all').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			}
		}
	}])