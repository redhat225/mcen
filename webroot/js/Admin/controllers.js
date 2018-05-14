angular.module('mcen_controllers',[])
		.controller('AdminsController',['$scope','profile','userService','$state', function($scope,profile,userService,$state){
			$scope.profile = profile.data.user;
			userService.all().then(function(resp){	
				$scope.users =	resp.data.users;
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			});

		    $scope.openModalViewUsers = function(){
		    	$scope.activate_admins_users = 'is-active';
		    };

		    $scope.closeModalViewUsers = function(user_id = null){
		    	$scope.activate_admins_users = '';
		    	if(user_id!= null)
		    		$state.go('admins.accounts.edit',{"user_id":user_id},{reload:true});
		    };

		    $scope.search_actors_side_menu = '';

		}])
		.controller('DashController',['$scope', function($scope){
  			$scope.labels_radar =["SQLi", "DirTrav", "Xss", "Default Password", "Dns Poisoning", "Cookie Stealing", "Verbose System"];

			  $scope.data_radar = [
			    [65, 59, 90, 81, 56, 55, 40],
			    [28, 48, 40, 19, 96, 27, 100]
			  ];


			$scope.colors = ["#17224e","#098a33","#caebd5","#fff70c","#626984","#3D0100","#8A0C09","#023D15","#573A0E","#97305B","#1FBDAC"];
			 //graph
			 $scope.labels = ["January", "February", "March", "April", "May", "June", "July",];
			  $scope.series = ['Series A', 'Series B'];
			  $scope.data = [
			    [65, 59, 80, 81, 56, 55, 40],
			    [28, 48, 40, 19, 86, 27, 90]
			  ];
			  $scope.onClick = function (points, evt) {
			    console.log(points, evt);
			  };
			  $scope.datasetOverride = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2' }];
			  $scope.options = {
			    scales: {
			      yAxes: [
			        {
			          id: 'y-axis-1',
			          type: 'linear',
			          display: true,
			          position: 'left'
			        },
			        {
			          id: 'y-axis-2',
			          type: 'linear',
			          display: true,
			          position: 'right'
			        }
			      ]
			    }
			   };

			  //doughnout
			  $scope.labels_doughnout = [];
			  $scope.data_doughnout = [];

		}]).controller('AccountsController',['$scope','roleAccountService','Upload','$state', function($scope,roleAccountService,Upload,$state){
			roleAccountService.all().then(function(resp){
				$scope.roles = resp.data.roles;
			});

			$scope.upload = function(user){
				var r = confirm('Etes-vous sûre de vouloir créer un nouvel utilisateur');
				if(r == true)
				{
					$scope.is_loading = "is-loading";
					Upload.upload({
						url:'/users/create',
						data:{'user':user}
					}).then(function(resp){
						toastr.success('Compte créé avec succès');
						$state.go('admins.accounts.view',{reload:true});
					}, function(err){
						toastr.error('Une erreur est survenue, veuillez réessayer');
					}, function(evt){

					}).finally(function(){
						$scope.is_loading = '';
					});
				}

			};
		}]).controller('ProfilesEditController',['$scope','userService','profileService','roleAccountService','Upload', function($scope,userService,profileService,roleAccountService,Upload){
			
			var self  = this;
			self.is_changing_image = false;
			profileService.all().then(function(resp){
				$scope.profile = resp.data.profile;
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			});			

			roleAccountService.all().then(function(resp){
				$scope.roles = resp.data.roles;
			});

			$scope.delete_user_account_avatar_candidate = function(){
				self.is_changing_image = false;
				$scope.profile.user_account_avatar_candidate = null;
			};

			$scope.update = function(profile){
				var r = confirm('Etes-vous sûre de vouloir modifier vos informations de compte?');
				if(r == true){
					if($scope.profile.user_account_avatar_candidate == null)
						delete $scope.profile.user_account_avatar_candidate;

					$scope.isloading = true;
					Upload.upload({
						url:'/profiles/edit',
						data:{'profile':profile}
					}).then(function(resp){
						toastr.success('Modifications réussies');
						// $state.go('admins.dashboard');
					}, function(err){

					}, function(evt){

					}).finally(function(){
						$scope.isloading = false;
					});
				}
			};
		}]).controller('AccountsViewController',['$scope','userService','AccountService', function($scope,userService,AccountService){
  				userService.all().then(function(resp){
				  	$scope.users = resp.data.users;
				});
				$scope.openViewModal = function(user){
					$scope.openViewModalTrigger = 'is-active';
					$scope.info_user = user;
				};

				$scope.closeViewModalTrigger = function(){
					$scope.openViewModalTrigger = '';
				};

			$scope.lock_user_account_trigger = function(user_account_id,user_account){
				var r = confirm('Etes-vous sûre de verrouiller cet utilisateur ?');
				if(r === true){
					AccountService.unlock(user_account_id).then(function(resp){
						toastr.success('Modifications réalisées avec succès');
						console.log(user_account);
						if(user_account.user_account_is_active == true)
							user_account.user_account_is_active = false;
						else
							user_account.user_account_is_active = true;

					}, function(){
						toastr.error('Une erreur est survenue, veuillez réessayer');
					});
				}
			};

			$scope.reinit_passsword = function(user_account_id){
				var r = confirm('Etes-vous sûre de vouloir réinitialiser le mot de passe de cet utilisateur?');
				if(r == true){
					AccountService.renew_password(user_account_id).then(function(resp){
						toastr.success('Réinitialisation réalisée avec succès');
					}, function(err){
							toastr.error('Une erreur est survenue, veuillez réessayer');
					});
				}
			};
		}]).controller('AccountsEditController',['$scope','userService','roleAccountService','Upload','AccountService','$stateParams','$state', function($scope,userService,roleAccountService,Upload,AccountService,$stateParams,$state){
			
			var self  = this;
			self.is_changing_image = false;
			self.is_changing_image_avatar = false;
			$scope.user = {};
			// load account info
			AccountService.get($stateParams.user_id).then(function(resp){
				$scope.user = resp.data.user;
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			});

			roleAccountService.all().then(function(resp){
				$scope.roles = resp.data.roles;
			});

			$scope.delete_user_photo_candidate = function(){
				self.is_changing_image = false;
				$scope.user.user_photo_candidate = null;
			};

			$scope.delete_user_avatar_candidate = function(){
				self.is_changing_image_avatar = false;
				$scope.user.user_accounts[0].user_account_avatar_candidate = null;
			};

			

			$scope.update = function(profile){
				var r = confirm('Etes-vous sûre de vouloir modifier les informations de utilisateur?');
				if(r == true){
				$scope.is_loading = 'is-loading';

					if($scope.user.user_photo_candidate == null)
						delete $scope.user.user_photo_candidate;
					$scope.isloading = true;
					Upload.upload({
						url:'/accounts/edit',
						data:{'profile':profile}
					}).then(function(resp){
						toastr.success('modifications réalisées avec succès');
						$state.go('admins.accounts.view',{reload:true});
					}, function(err){
						toastr.error('Une erreur est survenue, veuillez réessayer');
					}, function(evt){

					}).finally(function(){
						$scope.is_loading = '';				
					});
				}
			};
		}]).controller('TrainingsCreateController', ['$scope','trainingService','$state', function($scope,trainingService,$state){
						var self = this;

			$scope.create = function(training){
				trainingService.create(training).then(function(resp){
					toastr.success('Formation créée avec succes');
					$state.go('admins.trainings.all',{reload:true});
				}, function(err){
					toastr.error('Une erreur est survenue');
				});
			};

		}]).controller('TrainingsAllController', ['$scope','trainingService','Upload', function($scope,trainingService,Upload){
			trainingService.all().then(function(resp){
				$scope.trainings = resp.data.trainings;
				$scope.trainings.forEach(function(element, index){
					if(Object.keys(element.training_assets).length>0){
						element.training_assets.forEach(function(element, index){
							element.asset_details = JSON.parse(element.asset_details);
						});
					}
				});
				console.log($scope.trainings);
			}, function(err){
				toastr.error("Une erreur est survenue lors de la récupération des modules");
			});
			trainingService.get_all_types().then(function(resp){
				$scope.training_asset_types = resp.data.training_asset_types;
			}, function(err){
				toastr.error("Une erreur est survenue lors de la récupération des types-modules");
			});
			

			$scope.workflow_tab = 'courseware';

			$scope.showContentTrainingModalTrigger = '';
			$scope.content_trainings = {};

			$scope.closeModalContent = function(){
			  $scope.showContentTrainingModalTrigger = '';
			  $scope.content_trainings = {};
			};

			$scope.showModalContent = function(training){
			  $scope.content_trainings = training;
			  $scope.showContentTrainingModalTrigger = 'is-active';
			};
			$scope.showInfoModalTrigger = '';
			$scope.addAssetModalTrigger = '';
			$scope.upload_asset_project = {};
			// Show asset modal
			$scope.openAssetModal = function(training){
				$scope.addAssetModalTrigger = 'is-active';
				$scope.upload_asset_project = {
					training_id : training.id
				};
			};

			$scope.closeAssetModal = function(){
				$scope.addAssetModalTrigger = '';
				$scope.upload_asset_project.assets.forEach(function(element, index){
					$scope.upload_asset_project.assets.splice(index);
				});
			};

			// info box 
			$scope.showInfoContentModal = function(){
				$scope.showInfoModalTrigger = 'is-active';
			};
			$scope.closeInfoContentModal = function(){
				$scope.showInfoModalTrigger = '';
			};

			$scope.remove_asset = function(asset, index){
				$scope.upload_asset_project.assets.splice(index,1);
			};

			$scope.upload_asset = function(upload_asset_project){
				upload_asset_project.asset_types = [];
				upload_asset_project.assets.forEach(function(element, index){
					upload_asset_project.asset_types.push(element.training_asset_type_id);
				});
				Upload.upload({	
					url:'/training-assets/add',
					data: upload_asset_project
				}).then(function(resp){
				   toastr.success("Enregistrement réussi");
				   $scope.closeAssetModal();
				}, function(err){
				   toastr.error("Une erreur est survenue veuillez réessayer");
				});
			};

			$scope.inspect_asset = function(files){
			};

		}]).controller('TrainingsEditController',['$scope','$stateParams', function($scope,$stateParams){
			var self = this;
			
		}])


