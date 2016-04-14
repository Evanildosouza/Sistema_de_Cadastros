var app = angular.module('app', ['ngRoute']);
 
app.config(['$routeProvider', function($routeProvider) {
 
  $routeProvider
 
    .when('/', {
      templateUrl : 'app/views/dashboard.html',
      controller  : 'DashboardCtrl'
    })
 
    .when('/novo_cadastro', {
   		templateUrl : 'app/views/novo_cadastro.html',
   		controller  : 'NovoCadastroCtrl'
	  })

    .when('/editar_cadastro/:id', {
      templateUrl : 'app/views/editar_cadastro.html',
      controller  : 'EditarCadastroCtrl'
    })

  .otherwise ({ redirectTo: '/' });
}]);