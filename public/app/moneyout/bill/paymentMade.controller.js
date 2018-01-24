var bill = angular.module('app', []);
bill.controller('PaymentMadeController', PaymentMadeController);

function PaymentMadeController($scope, $http) {


    // $( document.body ).click(function() {
    //     $scope.calculateBill();
    // });

    $scope.bill_amount = [];
    $scope.currentPage = 0;

    $http
        .get(window.location.origin + "/api/payment-made/get-vendor-list", {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){

            vendor = response.data.vendor;
            paid_throughs = response.data.paid_throughs;

            $('#vendor_id').kendoDropDownList({
                optionLabel   : "Select Vendor",
                dataTextField: "text",
                dataValueField: "value",
                dataSource: vendor,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            $('#account_id').kendoDropDownList({
                dataTextField: "text",
                dataValueField: "value",
                dataSource: paid_throughs,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

        });

    $scope.getAccountType = function () {
        $scope.account_type = $("#account_id").data("kendoDropDownList").value();
        $("#show").show();
        $("#show2").show();
    }

    $scope.truefalse = true;
    $scope.getVendorBill = function () {
        var vendor_id = $("#vendor_id").data("kendoDropDownList").value();

        $("#show").hide();
        $("#show2").hide();


        $http
            .get(window.location.origin + "/api/payment-made/get-vendor-bill/" + vendor_id, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
            .then(function(response){
                $scope.bills = response.data.bills;
            });
        if(vendor_id)
        {
            $scope.currentPage = 1;
            $scope.truefalse = false;
        }
        else
        {
            $scope.currentPage = 0;
            $scope.truefalse = true;
        }

    }

    $scope.amountReceived = function () {
        $scope.amount_received = $scope.amount;
        var received_amount = $scope.amount_received;
        for(var i = 0; i < $scope.bills.length; i++)
        {
            if(received_amount > $scope.bills[i].due_amount)
            {
                $scope.bill_amount[i] = $scope.bills[i].due_amount;
                received_amount = received_amount - $scope.bills[i].due_amount;
            }
            else
            {
                $scope.bill_amount[i] = received_amount;
                received_amount = 0;
            }
            $scope.calculateExcessPayment(i);
        }
    }


    $scope.calculateExcessPayment = function (index) {
        var total_balance = 0;
        var exceed_amount = 0;
        for(var i = 0; i < $scope.bills.length; i++)
        {
            if(!parseFloat($scope.bill_amount[i]))
                continue;

            if(!parseFloat($scope.amount))
            {
                $scope.bill_amount[i] = 0;
                alert("Please Enter Amount");
                continue;
            }

            if(parseFloat($scope.bill_amount[i]) > $scope.bills[i].due_amount)
            {
                $scope.bill_amount[i] = $scope.bills[i].due_amount;
            }

            total_balance = total_balance + parseFloat($scope.bill_amount[i]);
            if(total_balance > $scope.amount)
            {
                exceed_amount = total_balance - $scope.amount;
                total_balance = total_balance - parseFloat($scope.bill_amount[i]);
                $scope.bill_amount[index] = $scope.bill_amount[index] - exceed_amount;
                total_balance = total_balance + parseFloat($scope.bill_amount[i]);
            }
            
            $scope.used_amount = total_balance - exceed_amount;
            total_balance = total_balance - exceed_amount;
            $scope.excess_amount = $scope.amount - $scope.used_amount;
        }
    }
    
}