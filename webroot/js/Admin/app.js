angular.module('mcen',['mcen_controllers','mcen_services','mcen_directives','ui.router','ui.tinymce','ngFileUpload','angular-loading-bar','colorbox','chart.js','ngFileSaver','cleave.js'])
	.run(['$rootScope','$templateCache','$transitions', function($rootScope, $templateCache,$transitions){
		$transitions.onStart({to:'admins.**'},function(trans){
			$rootScope.preloader = true;
			$rootScope.call_pageloader = 'is-active';
		});	
		$transitions.onSuccess({to:'admins.**'},function(trans){
			$rootScope.preloader = false;
			$rootScope.call_pageloader = '';
			$templateCache.removeAll();
		});	

	}])
	.config(['$httpProvider','$stateProvider','$urlRouterProvider','$locationProvider', function($httpProvider, $stateProvider, $urlRouterProvider, $locationProvider){
		$httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
		$httpProvider.defaults.headers.common['Authorization'] = 'bearer '+localStorage.getItem('token');

		// Activate Html5 Mode + hashPrefix
		$locationProvider.html5Mode(true);
		$locationProvider.hashPrefix('!');
		// Routing 
		$stateProvider.state('admins',{
			url:'/',
			templateUrl: '/admins/home',
			controller: 'AdminsController as adminscontroller',
			abstract:true,
			resolve:{
				profile:['profileService', function(profileService){
					return profileService.get().then(function(resp){
						return resp;
					}, function(err){
						toastr.error('Une erreur est survenue');
						$state.reload();
					}) 
				}]
			}
		}).state('admins.dashboard',{
			url:'dashboard',
			templateUrl:'/admins/dashboard',
			controller: 'DashController as dashctrl'
		}).state('admins.accounts',{
			url:'accounts',
			templateUrl: '/accounts',
			abstract: true
		}).state('admins.accounts.view',{
			url:'/view',
			templateUrl:'/accounts/view',
			controller:'AccountsViewController as accountsviewctrl'
		}).state('admins.accounts.create',{
			url:'/create',
			templateUrl:'/accounts/create',
			controller:'AccountsController as accountsctrl'
		}).state('admins.accounts.edit',{
			url:'/edit/:user_id',
			templateUrl:'/accounts/edit',
			controller:'AccountsEditController as accountseditctrl'
		}).state('admins.profile',{
			url: 'profiles',
			templateUrl:'/profiles',
			abstract:true
		}).state('admins.profile.edit',{
			url:'/edit',
			templateUrl:'/profiles/edit',
			controller:'ProfilesEditController as profileseditctrl'
		}).state('admins.trainings',{
			abstract: true,
			templateUrl:'/trainings',
			url:'trainings'
		}).state('admins.trainings.create',{
			url:'/create',
			templateUrl:'/trainings/create',
			controller:'TrainingsCreateController as trainingscreatectrl'
		}).state('admins.trainings.all',{
			url:'/all',
			templateUrl:'/trainings/all',
			controller:'TrainingsAllController as trainingsallctrl'
		}).state('admins.trainings.edit',{
			url:'/edit/:training_id',
			templateUrl:'/trainings/edit',
			controller:'TrainingsEditController as trainingseditctrl'
		})

		$urlRouterProvider.otherwise('/dashboard');
	}])