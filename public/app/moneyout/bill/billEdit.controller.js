var bill = angular.module('app', []);
bill.controller('BillEditController', BillEditController);

function BillEditController($q, $scope, $http) {

    $( document.body ).click(function() {
        $scope.calculateBill();
    });

    var bill_id = document.getElementsByName('bill_id')[0].value;

    $scope.quantity = [];
    $scope.rate     = [];
    $scope.amount   = [];
    $scope.description   = [];
    var sub_total = 0;

    $http
        .get(window.location.origin + "/api/bill/get-bill-entry/" + bill_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){

            $scope.bill_entries = response.data.bill_entries;
            item = response.data.item;
            tax = response.data.tax;

        });



    $http
        .get(window.location.origin + "/api/bill/get-bill-entry/" + bill_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){
            $scope.bill_entries = response.data.bill_entries;
            item = response.data.item;
            tax = response.data.tax;
            account = response.data.account;
            $scope.bill = response.data.bill;

            $scope.fullArr = [];

            var a = 0;
            var b = 0;
            var c = 0;
            var x = 0;
            var y = 0;
            var z = 0;
            i = 0;
            angular.forEach($scope.bill_entries, function(bill_entry) {

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
                dropdownlist.value(bill_entry.item_id);

                var dropdownlist = $("#tax_id_" + y++).data("kendoDropDownList");
                dropdownlist.value(bill_entry.tax_id);

                var dropdownlist = $("#account_id_" + z++).data("kendoDropDownList");
                dropdownlist.value(bill_entry.account_id);

                $scope.quantity[i] = bill_entry.quantity;
                $scope.rate[i] = bill_entry.rate;
                $scope.amount[i] = bill_entry.amount;
                $scope.description[i] = bill_entry.description;

                sub_total = sub_total + parseFloat(bill_entry.amount);
                i++;

                $scope.fullArr.push($http
                    .get(window.location.origin + "/api/bill/get-item-rate/" + bill_entry.item_id, {
                        transformRequest: angular.identity,
                        headers: {
                            'Content-Type': undefined,
                            'Process-Data': false
                        }
                    }));

            });

            sendReq()



            $('#item_rates').kendoDropDownList({
                dataTextField: "text",
                dataValueField: "value",
                dataSource: [{"text":"Tax Exclusive","value":1},{"text":"Tax Inclusive","value":2}],
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            var dropdownlist = $("#item_rates").data("kendoDropDownList");
            dropdownlist.value($scope.bill.item_rates);

            $scope.sub_total = sub_total;

            $scope.tax_total = $scope.bill.total_tax;
            $scope.total_amount = $scope.bill.amount;
            $scope.vat_show=$scope.total_amount-$scope.sub_total;
            $scope.vat=(($scope.vat_show*100)/($scope.sub_total)).toFixed(2);
            if ($scope.tax_total!=$scope.vat_show) {
                $scope.tax_total=$scope.tax_total+$scope.vat_show;
            }
            else{
                $scope.tax_total=$scope.vat_show
            }

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
                    $scope.quantity[i] = 1;
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
        $scope.bill_entries.push($scope.bill_entries.length);

        var i = $scope.bill_entries.length-1;

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
                dropdownlist.value(26);

            });

    }

    $scope.Remove = function (index) {
        $scope.bill_entries.splice(index, 1);
        $scope.calculateBill();
    }


    $scope.getItemRate = function (index) {

        var item_id = $("#item_id_" + index).data("kendoDropDownList").value();
        var contact_id = $("#customer_id").val();
        if (!contact_id) {
            contact_id=0;
        }
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
                $scope.calculateBill();
            });
    }


    $scope.calculateBill = function () {
        $scope.tax_total = 0.00;
        var total_amount1 = 0.00;
        var tax1 = 0.00;
        var sub_total1 = 0.00;
        for(var i = 0; i < $scope.bill_entries.length; i++)
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

            var price = parseFloat(quantity)*parseFloat(rate);
            $scope.amount[i] =  parseFloat(price);
            sub_total1 = sub_total1 + $scope.amount[i];

            var tax_type = $("#item_rates").data("kendoDropDownList").value();

            if(tax_type == 1)
            {
                tax1 = tax1 + ((parseFloat(tax)*parseFloat($scope.amount[i]))/100);
            }
            else
            {
                tax1 = tax1 + ((parseFloat(tax)*parseFloat($scope.amount[i]))/110);
            }
        }

        $scope.sub_total = parseFloat(sub_total1);
        $scope.vat_show =((parseFloat($scope.vat)*parseFloat($scope.sub_total))/100);
        $scope.tax_total = parseFloat(tax1);
        $scope.tax_total=$scope.vat_show;
        $scope.total_amount = parseFloat(sub_total1) + parseFloat(tax1)+ parseFloat($scope.vat_show);
    }

    $scope.itemRateAre = function () {
        $scope.calculateBill();
    }
}

bill.filter('NumFilter', function() {
    return function(num, NumDecimals) {
        return num.toFixed(NumDecimals)
    }
})