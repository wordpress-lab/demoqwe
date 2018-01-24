product.controller('ProductController', ProductController);

function ProductController($scope, $http) {

    $scope.phases = [];

    $scope.Append = function() {
        $scope.phases.push('');
    }

    $scope.Remove = function(index) {
        $scope.phases.splice(index, 1);
    }

    
}