
app.controller("NovoCadastroCtrl", ['$scope', '$http', '$location', function($scope, $http, $location) {

  $scope.master = {};
  $scope.activePath = null;

  $scope.adicionarCadastro = function(cadastrarNovo, NovoCadastroForm) {
    console.log(cadastrarNovo);
    $http.post('api/Novo_Cadastro', cadastrarNovo).success(function(){
      $scope.reset();
      $scope.activePath = $location.path('/');
    })
    .error(function(data) {
      console.log("aconteceu um problema. Data é: " + data);
    });;

    $scope.reset = function() {
      $scope.cadastrarNovo = angular.copy($scope.master);
    };
    $scope.reset();
  };
  
}]);