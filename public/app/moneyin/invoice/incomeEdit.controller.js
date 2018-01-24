var invoice = angular.module('app', []);
invoice.controller('IncomeEditController', IncomeEditController);

function IncomeEditController($scope, $http) {


    // $( document.body ).click(function() {
    //     $scope.calculateBill();
    // });

    var income_id = document.getElementsByName('income_id')[0].value;

    $http
        .get(window.location.origin + "/api/income/get-income-contact-account-tax-name/" + income_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){

            item = response.data.item;
            contact = response.data.contact;
            tax = response.data.tax;
            account = response.data.account;
            income = response.data.income;
            paid_throughs       = response.data.paid_throughs;
            account_id          = response.data.account_id;

            $scope.amount = income.amount;

            $('#tax_id').kendoDropDownList({
                dataTextField: "text",
                dataValueField: "value",
                dataSource: tax,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            $('#amount_is').kendoDropDownList({
                dataTextField: "text",
                dataValueField: "value",
                dataSource: [{"text":"Tax Exclusive","value":1},{"text":"Tax Inclusive","value":2}],
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            $('#receive_through_id').kendoDropDownList({
                dataTextField: "text",
                dataValueField: "value",
                dataSource: paid_throughs,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            var dropdownlist = $("#tax_id").data("kendoDropDownList");
            dropdownlist.value(income.tax_id);

            var dropdownlist = $("#amount_is").data("kendoDropDownList");
            dropdownlist.value(income.tax_type);

            var dropdownlist = $("#receive_through_id").data("kendoDropDownList");
            dropdownlist.value(account_id);

            $scope.account_type = account_id;

        })
        .finally(function () {
            $scope.calculateTax();
        });

    $scope.getAccountType = function () {
        $scope.account_type = $("#receive_through_id").data("kendoDropDownList").value();
    }

    $scope.calculateTax = function () {
        console.log("ok");
        var tax_amount = 0.00;
        var tax = $("#tax_id option:selected").text();
        var tax = tax.replace('%-tax', '');

        if(!tax)
        {
            tax = 0.00;
        }

        var amount_received = $scope.amount;
        if(!amount_received)
        {
            amount_received = 0.00;
        }

        var tax_type = $("#amount_is").data("kendoDropDownList").value();

        if(tax_type == 1)
        {
            tax_amount =((parseFloat(tax)*parseFloat(amount_received))/100);
        }
        else
        {
            tax_amount =((parseFloat(tax)*parseFloat(amount_received))/110);
        }

        $scope.total_tax = tax_amount;
    }
}