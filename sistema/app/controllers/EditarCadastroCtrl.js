
app.controller("EditarCadastroCtrl", ['$scope','$http','$location','$routeParams', function($scope, $http, $location, $routeParams) {

    var id = $routeParams.id;
    $scope.activePath = null;

    $http.get('api/Cadastros/'+id).success(function(data) {
       $scope.cadastroDetalhes = data;
    })    
    .error(function(data) {
        console.log("aconteceu um problema. Data é: " + data);
    });;

    $scope.atualizarCadastro = function(cadastro) {
        // console.log(cadastro);
        $http.put('api/Cadastros/'+id, cadastro).success(function(data) {
            $scope.cadastroDetalhes = data;
            $scope.reset();
            $scope.activePath = $location.path('/');
        });
    };

    $scope.apagarCadastro = function(cadastro) {
        // console.log(cadastro);
        var apagarCadastroAlert = confirm('Tem certeza que quer apagar o Cadastro de: '+ cadastro.nome + ' ' + cadastro.sobrenome + '?');
        if (apagarCadastroAlert) {
            $http.delete('api/Cadastros/'+cadastro.id);
            $scope.reset();
            $scope.activePath = $location.path('/');
        }        
     };

}]);