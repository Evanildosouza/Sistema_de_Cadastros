
app.controller("DashboardCtrl", ['$scope', '$http', function($scope, $http) {

    // $scope.cadastros = [];

    // FUNCAO DE LISTAR DADOS

    $http.get("api/Cadastros").success(function(data) {
        $scope.cadastros = data;
    })
    .error(function(data) {
        console.log("aconteceu um problema. Data é: " + data);
    });

    $scope.ordenarPor = function (campo) {

        $scope.criterioDaOrdem = campo;
        $scope.direcaoDaOrdem = !$scope.direcaoDaOrdem;

    };


}]);