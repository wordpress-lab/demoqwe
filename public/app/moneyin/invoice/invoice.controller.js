// blank controller
invoice.controller('InvoiceController', InvoiceController);

function InvoiceController($scope, $http) {


    $( document.body ).click(function() {
        $scope.calculateInvoice();
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

            $('#tax_id_0').kendoDropDownList({
                dataTextField: "text",
                dataValueField: "value",
                dataSource: tax,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            $('#account_id_0').kendoDropDownList({
                //optionLabel   : "Select Tax",
                dataTextField: "text",
                dataValueField: "value",
                dataSource: account,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            var dropdownlist = $("#account_id_0").data("kendoDropDownList");
            dropdownlist.value(16);
           
        });


    $scope.invoices = [];

    $scope.Append = function () {
        $scope.invoices.push($scope.invoices.length);

        var i = $scope.invoices.length;

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

                 $scope.getItemRate(i);

            });
    }


    $scope.Remove = function (index) {
        $scope.invoices.splice(index, 1);
    }


    $scope.truefalse = [];
    $scope.getItemRate = function (index) {
        // alert(index);
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
                   // $scope.quantity[index] = 1;
                    console.log(item_type);
                }
                else
                {
                    $scope.truefalse[index] = false;
                }
                console.log(item_rate);
                $scope.rate[index] = item_rate;

            })
            .finally(function () {
                $scope.calculateInvoice();
            });

    }

    //Customer details

    $scope.truefalse = true;
    $scope.getCustomerInvoice = function () {

        var customer_id = $("#customer_id").val();


        $http
            .get(window.location.origin + "/api/payment-receive/get-customer-invoice/" + customer_id, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
            .then(function(response){
                $scope.customer = response.data.customer;
            });
        if(customer_id)
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

    $scope.calculateInvoice = function () {
        $scope.tax_total = 0.00;
        var total_amount1 = 0.00;
        var tax1 = 0.00;
        var sub_total1 = 0.00;
        var quantity,rate,discount,adjustment,shipping_charge;
        var discount_type=0;
        for(var i = 0; i <= $scope.invoices.length; i++)
        {
            var tax = $("#tax_id_" + i + " option:selected").text();
            var tax = tax.replace('%-tax', '');

            if(!tax)
            {
                tax = 0.00;
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
                discount_type = $("#discount_type_" + i + " option:selected").val();
                // alert(discount_type);

                discount = $scope.discount[i];

            }

            var price = parseFloat(quantity)*parseFloat(rate);
            // $scope.amount[i]=0;
            if (discount_type==0) {
                
                var discount1 = (parseFloat(discount)*parseFloat(price))/100;
                $scope.amount[i] =  parseFloat(price) - parseFloat(discount1);

            }
            else{

                var discount1 =  discount;
                $scope.amount[i] =  parseFloat(price) - parseFloat(discount1);
            }
            sub_total1 = sub_total1 + $scope.amount[i];
            tax1 = tax1 + ((parseFloat(tax)*parseFloat($scope.amount[i]))/100);
            
            //total_amount1 = parseFloat(total_amount1) + parseFloat($scope.amount[i]) + ((parseFloat(tax)*parseFloat($scope.amount[i]))/100);

        }

        $scope.sub_total = parseFloat(sub_total1);
        $scope.vat_show =((parseFloat($scope.vat)*parseFloat(sub_total1))/100);
        $scope.tax_total = parseFloat(tax1);
        $scope.tax_total = $scope.vat_show;

        $scope.getAdjustment($scope.adjustment);

        $scope.total_amount =parseFloat(sub_total1) + parseFloat($scope.shipping_charge)+ parseFloat($scope.vat_show) + parseFloat($scope.adjustment) + parseFloat(tax1);
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