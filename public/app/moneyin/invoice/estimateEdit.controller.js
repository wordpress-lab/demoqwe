invoice.controller('InvoiceEditController', InvoiceEditController);

function InvoiceEditController($q, $scope, $http) {

    $( document.body ).click(function() {
        $scope.calculateInvoice();
    });

    var invoice_id = document.getElementsByName('invoice_id')[0].value;

    $scope.quantity = [];
    $scope.rate     = [];
    $scope.discount = [];
    $scope.amount   = [];
    var sub_total = 0;

    $http
        .get(window.location.origin + "/api/estimate/get-invoice-entry/" + invoice_id, {

            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){

            $scope.invoice_entries = response.data.invoice_entries;
            item = response.data.item;
            tax = response.data.tax;

        });



    $http
        .get(window.location.origin + "/api/estimate/get-invoice-entry/" + invoice_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){
            $scope.invoice_entries = response.data.invoice_entries;
            item = response.data.item;
            tax = response.data.tax;
            account = response.data.account;
            $scope.invoice = response.data.invoice;

            $scope.fullArr = [];

            var a = 0;
            var b = 0;
            var c = 0;
            var x = 0;
            var y = 0;
            var z = 0;
            i = 0;
            angular.forEach($scope.invoice_entries, function(invoice_entry) {

                $('#item_id_' + a++).kendoDropDownList({
                    optionLabel   : "Select Item",
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: item,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

                $('#tax_id_' + b++).kendoDropDownList({
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: tax,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

                $('#account_id_' + c++).kendoDropDownList({
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: account,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

                var dropdownlist = $("#item_id_" + x++).data("kendoDropDownList");
                dropdownlist.value(invoice_entry.item_id);

                var dropdownlist = $("#tax_id_" + y++).data("kendoDropDownList");
                dropdownlist.value(invoice_entry.tax_id);

                var dropdownlist = $("#account_id_" + z++).data("kendoDropDownList");
                dropdownlist.value(invoice_entry.account_id);

                $scope.quantity[i] = invoice_entry.quantity;
                $scope.rate[i] = invoice_entry.rate;
                $scope.discount[i] = invoice_entry.discount;
                $scope.amount[i] = invoice_entry.amount;

                sub_total = sub_total + invoice_entry.amount;
                i++;

                $scope.fullArr.push($http
                    .get(window.location.origin + "/api/estimate/get-item-rate/" + invoice_entry.item_id, {
                        transformRequest: angular.identity,
                        headers: {
                            'Content-Type': undefined,
                            'Process-Data': false
                        }
                    }));

            });

            sendReq()

            $scope.sub_total = sub_total;
            if($scope.invoice.shipping_charge>0)
            {
                $scope.shipping_charge = $scope.invoice.shipping_charge;
            }
            else
            {
                $scope.shipping_charge = 0.00;
            }

            if($scope.invoice.adjustment>0)
            {
                $scope.adjustment = $scope.invoice.adjustment;
            }
            else
            {
                $scope.adjustment = 0.00;
            }

            $scope.tax_total = $scope.invoice.tax_total;
            $scope.total_amount = $scope.invoice.total_amount;
            $scope.adjustment = $scope.invoice.adjustment;

        });

    function sendReq() {
        var i = 0;
        $scope.truefalse = [];
        $q.all($scope.fullArr).then(function(response) {
            angular.forEach(response, function(item) {

                console.log(item.data.item_type);
                if(item.data.item_type == 2)
                {
                    $scope.truefalse[i] = true;
                  //  $scope.quantity[i] = 1;
                    console.log(item.data.item_type);
                }
                else
                {
                    $scope.truefalse[i] = false;
                }
                i++;

            });
        });
    }


    $scope.Append = function () {
        $scope.invoice_entries.push($scope.invoice_entries.length);

        var i = $scope.invoice_entries.length-1;

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


                $('#item_id_' +i).kendoDropDownList({
                    optionLabel   : "Select Item",
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: item,
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

                $('#account_id_' + i).kendoDropDownList({
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: account,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

                var dropdownlist = $("#account_id_" + i).data("kendoDropDownList");
                dropdownlist.value(16);

            });

    }

    $scope.Remove = function (index) {
        $scope.invoice_entries.splice(index, 1);
        $scope.calculateInvoice();
    }


    $scope.getItemRate = function (index) {

        var item_id = $("#item_id_" + index).data("kendoDropDownList").value();
        var contact_id = $("#customer_id").val();
        if (!contact_id) {
            contact_id=0;
        }
        $http
            .get(window.location.origin + "/api/invoice/get-item-rate2/" + item_id+'/'+contact_id, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
            .then(function(response){
                item_rate = response.data.item_rate;

                item_type = response.data.item_type;
                if(response.data.item_type == 2)
                {
                    $scope.truefalse[index] = true;
                    $scope.quantity[index] = 1;
                    console.log(item_type);
                }
                else
                {
                    $scope.truefalse[index] = false;
                }

                $scope.rate[index] = item_rate;
            })
            .finally(function () {
                $scope.calculateInvoice();
            });
    }


    $scope.calculateInvoice = function () {
        $scope.tax_total = 0.00;
        var total_amount1 = 0.00;
        var tax1 = 0.00;
        var sub_total1 = 0.00;
        for(var i = 0; i < $scope.invoice_entries.length; i++)
        {
            var tax = $("#tax_id_" + i + " option:selected").text();
            if(tax == "Select Tax")
            {
                tax = 0;
            }
            else
            {
                var tax = tax.replace('%-tax', '');
            }

            if(isNaN($scope.quantity[i]))
            {
                quantity = 0.00;
            }
            else
            {
                quantity = $scope.quantity[i];
            }

            if(isNaN($scope.rate[i]))
            {
                rate = 0.00;
            }
            else
            {
                rate = $scope.rate[i];
            }

            if(!$scope.discount[i])
            {
                discount = 0.00;
            }
            else
            {
                discount = $scope.discount[i];
            }

            var price = parseFloat(quantity)*parseFloat(rate);
            var discount1 = (parseFloat(discount)*parseFloat(price))/100;
            $scope.amount[i] =  parseFloat(price) - parseFloat(discount1);
            sub_total1 = sub_total1 + $scope.amount[i];
            tax1 = tax1 + ((parseFloat(tax)*parseFloat($scope.amount[i]))/100);

            //total_amount1 = parseFloat(total_amount1) + parseFloat($scope.amount[i]) + ((parseFloat(tax)*parseFloat($scope.amount[i]))/100);

        }

        $scope.sub_total = parseFloat(sub_total1);
        $scope.tax_total = parseFloat(tax1);

        $scope.getAdjustment($scope.adjustment);

        $scope.total_amount = parseFloat(sub_total1) + parseFloat($scope.shipping_charge) + parseFloat($scope.adjustment) + parseFloat(tax1);
    }

    $scope.getAdjustment = function (adjustment) {
        var operation = adjustment[0];

        if(operation == '*')
        {
            $scope.adjustment = 0;
        }

        if(operation == '/')
        {
            $scope.adjustment = 0;
        }
    }


}