// blank controller
invoice.controller('ExcessPaymentController', ExcessPaymentController);

function ExcessPaymentController($scope, $http) {

    $( document.body ).click(function() {
        $scope.calculateExcessPayment();
    });

    var invoice_id = document.getElementsByName('invoice_id')[0].value;

    $scope.excess_payment_amount = [];

    $http
        .get(window.location.origin + "/api/invoice/get-due-balance/" + invoice_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){

            $scope.due_balance = response.data.due_balance;
            $scope.excess_payments = response.data.excess_payments;
        });

    $scope.calculateExcessPayment = function () {
        var total_balance = 0;
        var exceed_amount = 0;
        for(var i = 0; i < $scope.excess_payments.length; i++)
        {
            if(!parseFloat($scope.excess_payment_amount[i]))
                continue;

            if(parseFloat($scope.excess_payment_amount[i]) > $scope.excess_payments[i].excess_payment)
            {
                $scope.excess_payment_amount[i] = $scope.excess_payments[i].excess_payment;
            }

            total_balance = total_balance + parseFloat($scope.excess_payment_amount[i]);

            if(total_balance > $scope.due_balance)
            {
                exceed_amount = total_balance - $scope.due_balance;
                $scope.excess_payment_amount[i] = $scope.excess_payment_amount[i] - exceed_amount;
                total_balance = total_balance - exceed_amount;
            }

            $scope.amount_to_excess_payment = total_balance;
        }
    }
}