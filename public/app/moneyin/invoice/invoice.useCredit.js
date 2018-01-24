// blank controller
invoice.controller('UseCreditController', UseCreditController);

function UseCreditController($scope, $http) {

    $( document.body ).click(function() {
        $scope.calculateInvoice();
    });

    var invoice_id = document.getElementsByName('invoice_id')[0].value;

    $scope.credit_amount = [];

    $http
        .get(window.location.origin + "/api/invoice/get-due-balance/" + invoice_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){

            $scope.due_balance = response.data.due_balance;
            $scope.use_credits = response.data.use_credits;
        });

    $scope.calculateInvoice = function () {
        var total_balance = 0;
        var exceed_amount = 0;
        for(var i = 0; i < $scope.use_credits.length; i++)
        {
            if(!parseFloat($scope.credit_amount[i]))
                continue;

            if(parseFloat($scope.credit_amount[i]) > $scope.use_credits[i].available_credit)
            {
                $scope.credit_amount[i] = $scope.use_credits[i].available_credit;
            }

            total_balance = total_balance + parseFloat($scope.credit_amount[i]);
            console.log()
            
            if(total_balance > $scope.due_balance)
            {
                exceed_amount = total_balance - $scope.due_balance;
                $scope.credit_amount[i] = $scope.credit_amount[i] - exceed_amount;
                total_balance = total_balance - exceed_amount;
            }
            
            $scope.amount_to_credit = total_balance;
        }
    }
}