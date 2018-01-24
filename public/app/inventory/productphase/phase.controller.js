phase.controller('PhaseController', PhaseController);

function PhaseController($scope, $http) {

    $scope.Complete = function (phase_id) {
        console.log(phase_id);
        $http
            .get(window.location.origin + "/api/product-track/item/phase/" + phase_id, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
            .then(function(response){
                console.log(response.data);

                var checkboxvar = document.getElementById('first_phase_' + phase_id);
                var labelvar = document.getElementById('first_phase_level_' + phase_id);
                if (!checkboxvar.checked) {
                    labelvar.innerHTML = "Uncomplete";
                }
                else {
                    labelvar.innerHTML = "Complete";
                }

            });
    }
}