var invoice = angular.module('app', []);
invoice.controller('IncomeController', IncomeController);

function IncomeController($scope, $http) {


    // $( document.body ).click(function() {
    //     $scope.calculateBill();
    // });

    $scope.bill_amount = [];
    $scope.total_tax = 0.00;

    $http
        .get(window.location.origin + "/api/manual-journal/contact-account-tax-name", {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){

            item = response.data.item;
            contact = response.data.contact;
            tax = response.data.tax;
            account = response.data.account;
            paid_throughs = response.data.paid_throughs;



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

        });

    $scope.getAccountType = function () {

       $scope.account_type = $("#receive_through_id").data("kendoDropDownList").value();

    }

    $scope.calculateTax = function () {
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