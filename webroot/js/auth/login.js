angular.module('login',['ngFileUpload'])
	.controller('MainCtrl', ['$scope', function($scope){
		var self = this;
	}])
	.config(['$httpProvider', function($httpProvider){
		$httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
	}]).controller('LoginController', ['$scope','LoginService', function($scope,LoginService){
		var self = this;
		self.isSubmitting = 'none';
		self.credentials = {
			remember_me: false
		};
		self.login = function(credentials){
			self.is_authenticating = true;
			self.isSubmitting = 'is-loading';
			$scope.loading_state = "is-active";
			LoginService.authenticate(credentials).then(function(response){
				if(response.data.jwt_generated)
				{
                   toastr.success('Authentification réussi');
				   localStorage.token = response.data.jwt_generated;
				   document.location.href="/admins/dashboard";
				}
			}, function(error){
                  toastr.error('Authentification échouée, veuillez réessayer');
			}).finally(function(){
				self.is_authenticating = false;
				self.isSubmitting = 'none';
				$scope.loading_state = "";
			});
		};
		self.forgotpassword = function(){
				document.location.href="/admins/forgot";
		};
	}]).controller('RegisterController',['$scope','Upload', function($scope,Upload){
			$scope.loading_state = '';
			$scope.upload = function(user){
				var r = confirm('Etes-vous sûre de vouloir créer un nouvel utilisateur');
				if(r == true)
				{
					$scope.loading_state = 'is-active';
					Upload.upload({
						url:'/admins/register',
						data:{'user':user}
					}).then(function(resp){
						toastr.success('Compte créé avec succès, veuillez vous reconnecter avec vos accès');
				   		setTimeout(function(){ document.location.href="/admins/login"; }, 3000);
					}, function(err){
						if(err.status == 409){
							switch(err.statusText){
								case 'error username':
						  			toastr.error("Ce nom d'utilisateur existe déjà");
								break;

								case 'error pro-email':
						  			toastr.error("Cette adresse professionnelle existe déjà");
								break;

								case 'error perso-email':
						  			toastr.error("Cette adresse personnelle existe déjà");		
						  		break;

								case 'error contact':
						  			toastr.error("Cet contact existe déjà");		
						  		break;

								default:
						  			toastr.error("Une erreur est survenue, veuillez réessayer");
								break;
							}
						}
					    else
						  toastr.error("Une erreur est survenue, veuillez réessayer");

					}, function(evt){

					}).finally(function(){
						$scope.loading_state = '';
					});
				}

			};

		}])
	.factory('LoginService', ['$http','$q', function($http,$q){
		return{
			authenticate: function(credentials){
				return $http.post('/admins/login', credentials).then(function(response){
					return response;
				}, function(error){
					return $q.reject(error);
				})	
			}
		}
	}])