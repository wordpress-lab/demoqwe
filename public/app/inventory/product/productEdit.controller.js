product.controller('ProductEditController', ProductEditController);

function ProductEditController($scope, $http) {

     var product_id = document.getElementsByName('product_id')[0].value;

     

    $http
        .get(window.location.origin + "/api/product-track/get-product/" + product_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){
            $scope.phases = response.data;

            $scope.phase = $scope.phases[0];
            $scope.phases.splice(0, 1);

        });
    

    $scope.Append = function() {
        $scope.phases.push('');
    }

    $scope.Remove = function(index) {
        $scope.phases.splice(index, 1);
    }
}