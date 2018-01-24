var bill = angular.module('app', []);
bill.controller('PaymentMadeEditController', PaymentMadeEditController);

function PaymentMadeEditController($scope, $http) {


    var payment_made_id = document.getElementsByName('payment_made_id')[0].value;

    $http
        .get(window.location.origin + "/api/payment-made/get-payment-made-entry/" + payment_made_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){
            $scope.payment_made_entry = response.data.payment_made_entry;
            vendor_id           = response.data.vendor_id;
            account_id          = response.data.account_id;
            vendor              = response.data.vendors;
            paid_throughs       = response.data.paid_throughs;
            payment_made_amount = response.data.payment_made_amount;

            $scope.amount = payment_made_amount;
            $scope.amount_received = payment_made_amount;

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

            var dropdownlist = $("#vendor_id").data("kendoDropDownList");
            dropdownlist.value(vendor_id);

            var dropdownlist = $("#account_id").data("kendoDropDownList");
            dropdownlist.value(account_id);

            $scope.account_type = account_id;

            $http
                .get(window.location.origin + "/api/payment-made/get-vendor-bill-edit/" + vendor_id, {
                    transformRequest: angular.identity,
                    headers: {'Content-Type': undefined, 'Process-Data': false}
                })
                .then(function(response){
                    var element = {};
                    var data = [];
                    var j = 0;
                    for(var i = 0; i < response.data.bills.length; i++)
                    {
                        element.id              = response.data.bills[i].id;
                        element.bill_date       = response.data.bills[i].bill_date;
                        element.bill_number     = response.data.bills[i].bill_number;
                        element.amount          = response.data.bills[i].amount;
                        element.due_amount      = response.data.bills[i].due_amount;

                        if(response.data.bills[i].id == $scope.payment_made_entry[j].bill_id)
                        {
                            element.payment = $scope.payment_made_entry[j].amount;
                            j++;
                            if(j == $scope.payment_made_entry.length)
                            {
                                j = 0;
                            }
                        }
                        else
                        {
                            element.payment = 0;
                        }

                        data.push(element);
                        element = {};
                    }
                    $scope.bills = data;

                })
                .finally(function () {
                    $scope.ShowAmount();
                    $scope.calculateExcessPayment(0);
                });
        });

    $scope.getAccountType = function () {
        $scope.account_type = $("#account_id").data("kendoDropDownList").value();
    }

    $scope.ShowAmount = function () {
        $scope.bill_amount = [];
        for(var i = 0; i < $scope.bills.length; i++)
        {
            $scope.bill_amount[i] = $scope.bills[i].payment;
        }
    }


    $scope.amountReceived = function () {
        $scope.amount_received = $scope.amount;
        $scope.calculateExcessPayment(0);
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

            if(parseFloat($scope.bill_amount[i]) > $scope.bills[i].due_amount + $scope.bills[i].payment)
            {
                $scope.bill_amount[index] = $scope.bills[i].due_amount + $scope.bills[i].payment;
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