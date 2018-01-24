var bill = angular.module('app', []);
bill.controller('ExpenseEditController', ExpenseEditController);

function ExpenseEditController($scope, $http) {


    // $( document.body ).click(function() {
    //     $scope.calculateBill();
    // });

    var expense_id = document.getElementsByName('expense_id')[0].value;

    $http
        .get(window.location.origin + "/api/expense/get-expense-contact-account-tax-name/" + expense_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){

            item = response.data.item;
            contact = response.data.contact;
            tax = response.data.tax;
            account = response.data.account;
            expense = response.data.expense;
            paid_throughs       = response.data.paid_throughs;
            account_id          = response.data.account_id;

            $scope.amount = expense.amount;

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

            $('#paid_through_id').kendoDropDownList({
                dataTextField: "text",
                dataValueField: "value",
                dataSource: paid_throughs,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            var dropdownlist = $("#tax_id").data("kendoDropDownList");
            dropdownlist.value(expense.tax_id);

            var dropdownlist = $("#amount_is").data("kendoDropDownList");
            dropdownlist.value(expense.tax_type);

            var dropdownlist = $("#paid_through_id").data("kendoDropDownList");
            dropdownlist.value(account_id);

            $scope.account_type = account_id;

        })
        .finally(function () {
            $scope.calculateTax();
        });

    $scope.getAccountType = function () {
        $scope.account_type = $("#paid_through_id").data("kendoDropDownList").value();
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