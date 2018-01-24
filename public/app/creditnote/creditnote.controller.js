var credit_note = angular.module('app', []);

credit_note.controller('CreditNoteController', CreditNoteController);

function CreditNoteController($scope, $http) {

    $( document.body ).click(function() {
        $scope.calculateCreditNote();
    });

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

            $('#item_id_0').kendoDropDownList({
                optionLabel   : "Select Item",
                dataTextField: "text",
                dataValueField: "value",
                dataSource: item,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            $('#account_id_0').kendoDropDownList({
                dataTextField: "text",
                dataValueField: "value",
                dataSource: account,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            $('#tax_id_0').kendoDropDownList({
                dataTextField: "text",
                dataValueField: "value",
                dataSource: tax,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            var dropdownlist = $("#account_id_0").data("kendoDropDownList");
            dropdownlist.value(16);
        }) 
        .finally(function () {
            $scope.total = 0.00;
            $scope.sub_total = 0.00;
            $scope.tax_total = 0.00;
            $scope.amount[0] = 0.00;
            $scope.adjustment = 0.00;
            $scope.shipping_charge = 0.00;
        });

    $scope.credit_notes = [];

    $scope.Append = function () {
        $scope.credit_notes.push($scope.credit_notes.length);

        var i = $scope.credit_notes.length;

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

                $('#item_id_' + i).kendoDropDownList({
                    optionLabel   : "Select Item",
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: item,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

                $('#account_id_' + i).kendoDropDownList({
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: account,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

                $('#tax_id_' + i).kendoDropDownList({
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: tax,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

                var dropdownlist = $("#account_id_" + i).data("kendoDropDownList");
                dropdownlist.value(16);

            });
    };

    $scope.Remove = function (index) {
        $scope.credit_notes.splice(index, 1);
    };

    $scope.getItemRate = function (index) {

        var item_id = $("#item_id_" + index).data("kendoDropDownList").value();
        var contact_id = $("#customer_id").val();
        if (!contact_id) {
            contact_id=0;
        }

        $scope.quantity[index] = 1;

        $http
            .get(window.location.origin +  "/api/invoice/get-item-rate2/" + item_id+'/'+contact_id, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
            .then(function(response){
                item_rate = response.data.item_rate;
                $scope.rate[index] = item_rate;
            })
            .finally(function () {
                $scope.calculateCreditNote();
            });

    };

    $scope.calculateCreditNote = function () {

        console.log("submitted");

        var quantity_data;
        var rate_data;
        var discount_data;
        var tax_data;
        var amount_data;
        var shipping_charge_data;
        var adjustment_data;
        var sub_total_data = 0;
        var total_data = 0;
        var price_data;
        var total_tax_data = 0;

        for(var i = 0; i <= $scope.credit_notes.length; i++)
        {
            // Retrieving Quantity...
            if(isNaN($scope.quantity[i]))
            {
                quantity_data = 0.00;
            }
            else
            {
                quantity_data = $scope.quantity[i];
            }

            // Retrieving Rate...
            if(isNaN($scope.rate[i]))
            {
                rate_data = 0.00;
            }
            else
            {
                rate_data = $scope.rate[i];
            }

            // Retrieving Discount...
            if(isNaN($scope.discount[i]))
            {
                discount_data = 0.00;
            }
            else
            {
                discount_data = $scope.discount[i];
            }

            // Retrieving Tax...
            var tax_select_data = $("#tax_id_" + i + " option:selected").text();

            console.log(tax_select_data);

            if(tax_select_data == "Select Tax")
            {
                tax_data = 0;
            }
            else
            {
                tax_data = tax_select_data.replace('%-tax', '');
            }

            console.log(tax_data);

            // Calculation...
            price_data = parseFloat(quantity_data) * parseFloat(rate_data);
            discount_data = (parseFloat(price_data) * parseFloat(discount_data)) / 100;
            amount_data = parseFloat(price_data) - parseFloat(discount_data);
            $scope.amount[i] = amount_data;
            sub_total_data = sub_total_data + amount_data;
            total_tax_data = total_tax_data + ((parseFloat(tax_data) * parseFloat($scope.amount[i])) / 100);
        }

        $scope.sub_total = parseFloat(sub_total_data);
        $scope.vat_show =((parseFloat($scope.vat)*parseFloat($scope.sub_total))/100);
        $scope.tax_total = parseFloat(total_tax_data);
        shipping_charge_data = parseFloat($scope.shipping_charge);
        adjustment_data = parseFloat($scope.adjustment);
        total_data = parseFloat(sub_total_data) + parseFloat(total_tax_data)+ parseFloat($scope.vat_show) + parseFloat(shipping_charge_data) + adjustment_data;

        $scope.shipping_charge = parseFloat(shipping_charge_data);
        $scope.adjustment = parseFloat(adjustment_data);
        $scope.total = parseFloat(total_data);
    }

}