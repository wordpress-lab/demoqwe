// blank controller
manualJournal.controller('ManualJournalController', ManualJournalController);

function ManualJournalController($scope, $http) {

    $http
        .get(window.location.origin + "/api/manual-journal/contact-account-tax-name", {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){
            account = response.data.account;
            contact = response.data.contact;
            tax = response.data.tax;

            $('#account_0').kendoDropDownList({
                optionLabel   : "Select Account",
                dataTextField: "text",
                dataValueField: "value",
                dataSource: account,
                dataType: "jsonp",
                filter: "contains",
                index: 0
            });

            $('#contact_id_0').kendoDropDownList({
                optionLabel   : "Select Contact",
                dataTextField: "text",
                dataValueField: "value",
                dataSource: contact,
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
           
        });

    

    $scope.mydisabled=true;
    
    $scope.journals = [];

    $scope.Append = function () {
        $scope.journals.push($scope.journals.length);
        $scope.debitCreditSum();

        var i = $scope.journals.length;

        $http
            .get(window.location.origin + "/api/manual-journal/contact-account-tax-name", {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            })
            .then(function(response){
                account = response.data.account;
                contact = response.data.contact;
                tax = response.data.tax;
                

                $('#account_' +i).kendoDropDownList({
                    optionLabel   : "Select Account",
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: account,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

                $('#contact_id_' + i).kendoDropDownList({
                    optionLabel   : "Select Contact",
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: contact,
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

            });
    }

    $scope.Remove = function (index) {
        $scope.journals.splice(index, 1);
        $scope.debitCreditSum();
    }

    $scope.sum = parseFloat("0");

    $scope.debit = function (index) {

        var value = document.getElementById("debit_" + index).value.length;

        var tax_debit = 0;
        $scope.tax_debit_total = 0;

        $scope.sum = parseFloat("0");
        var debit;
        for(var i = 0; i <= $scope.journals.length; i++)
        {
            if(isNaN($scope.debit[i]) || isNaN(parseFloat($scope.debit[i])))
            {
                var a = parseFloat("0");
                $scope.sum = $scope.sum + a;

                var tax = $("#tax_id_" + i + " option:selected").text();
                if(tax == "Select Tax")
                {
                    tax = 0;
                }
                else
                {
                    var tax = tax.replace('%-tax', '');
                }

                debit = parseFloat($scope.debit[i]);
            }
            else
            {

                $scope.sum = $scope.sum + parseFloat($scope.debit[i]);

                var tax = $("#tax_id_" + i + " option:selected").text();
                if(tax == "Select Tax")
                {
                    tax = 0;
                }
                else
                {
                    var tax = tax.replace('%-tax', '');
                }
                debit = parseFloat($scope.debit[i]);
            }

            if(isNaN(debit))
            {
                debit = 0;
            }

            tax_debit = tax_debit + ((tax/100) * debit);

        }

        $scope.tax_debit_total = tax_debit;
        $scope.sub_debit = $scope.sum;
        $scope.total_debit = $scope.sum + $scope.tax_debit_total;

        if(value > 0)
        {
            $scope.credit[index] = null;
            document.getElementById("credit_" + index).disabled = true;
        }
        else
        {
            document.getElementById("credit_" + index).disabled = false;
        }

        if($scope.total_debit == $scope.total_credit)
        {
            $scope.mydisabled=false;
        }
        else
        {
            $scope.mydisabled=true;
        }

    }

    $scope.credit = function (index) {

        var value = document.getElementById("credit_" + index).value.length;

        var tax_credit = 0;
        $scope.tax_credit_total = 0;

        $scope.sum = parseFloat("0");
        for(var i = 0; i <= $scope.journals.length; i++)
        {
            if(isNaN($scope.credit[i]) || isNaN(parseFloat($scope.credit[i])))
            {
                var a = parseFloat("0");
                $scope.sum = $scope.sum + a;

                var tax = $("#tax_id_" + i + " option:selected").text();
                if(tax == "Select Tax")
                {
                    tax = 0;
                }
                else
                {
                    var tax = tax.replace('%-tax', '');
                }

                credit = parseFloat($scope.credit[i]);
            }
            else
            {

                $scope.sum = $scope.sum + parseFloat($scope.credit[i]);

                var tax = $("#tax_id_" + i + " option:selected").text();
                if(tax == "Select Tax")
                {
                    tax = 0;
                }
                else
                {
                    var tax = tax.replace('%-tax', '');
                }
                credit = parseFloat($scope.credit[i]);

            }

            if(isNaN(credit))
            {
                credit = 0;
            }

            tax_credit = tax_credit + ((tax/100) * credit);

        }

        $scope.tax_credit_total = tax_credit;
        $scope.sub_credit = $scope.sum;
        $scope.total_credit = $scope.sum + $scope.tax_credit_total;

        if(value > 0)
        {
            $scope.debit[index] = null;
            document.getElementById("debit_" + index).disabled = true;
        }
        else
        {
            document.getElementById("debit_" + index).disabled = false;
        }

        if($scope.total_debit == $scope.total_credit)
        {
            $scope.mydisabled=false;
        }
        else
        {
            $scope.mydisabled=true;
        }
    }


    $scope.debitCreditSum = function()
    {
        $scope.sum_debit = parseFloat("0");
        $scope.sum_credit = parseFloat("0");

        //debit
        var tax_debit = 0;
        $scope.tax_debit_total = 0;
        $scope.total_debit = 0;

        //credit
        var tax_credit = 0;
        $scope.tax_credit_total = 0;
        $scope.total_credit = 0;

        for(var i = 0; i <= $scope.journals.length; i++)
        {

            //for debit
            if(isNaN($scope.debit[i]) || isNaN(parseFloat($scope.debit[i])))
            {
                var a = parseFloat("0");
                $scope.sum_debit = $scope.sum_debit + a;

                var tax = $("#tax_id_" + i + " option:selected").text();
                if(tax == "Select Tax")
                {
                    tax = 0;
                }
                else
                {
                    var tax = tax.replace('%-tax', '');
                }

                debit = parseFloat($scope.debit[i]);

            }
            else
            {
                $scope.sum_debit = $scope.sum_debit + parseFloat($scope.debit[i]);

                var tax = $("#tax_id_" + i + " option:selected").text();
                if(tax == "Select Tax")
                {
                    tax = 0;
                }
                else
                {
                    var tax = tax.replace('%-tax', '');
                }
                debit = parseFloat($scope.debit[i]);

            }
            if(isNaN(debit))
            {
                debit = 0;
            }

            tax_debit = tax_debit + ((tax/100) * debit);
            //end debit



            //for credit
            if(isNaN($scope.credit[i]) || isNaN(parseFloat($scope.credit[i])))
            {
                var a = parseFloat("0");
                $scope.sum_credit = $scope.sum_credit + a;

                var tax = $("#tax_id_" + i + " option:selected").text();
                if(tax == "Select Tax")
                {
                    tax = 0;
                }
                else
                {
                    var tax = tax.replace('%-tax', '');
                }

                credit = parseFloat($scope.credit[i]);
            }
            else
            {
                $scope.sum_credit = $scope.sum_credit + parseFloat($scope.credit[i]);

                var tax = $("#tax_id_" + i + " option:selected").text();
                if(tax == "Select Tax")
                {
                    tax = 0;
                }
                else
                {
                    var tax = tax.replace('%-tax', '');
                }
                credit = parseFloat($scope.credit[i]);

            }
            if(isNaN(credit))
            {
                credit = 0;
            }
            tax_credit = tax_credit + ((tax/100) * credit);
            //end credit

        }

        //debit
        $scope.tax_debit_total = tax_debit;
        $scope.sub_debit = $scope.sum_debit;
        $scope.total_debit = $scope.sub_debit + $scope.tax_debit_total;

        //credit
        $scope.tax_credit_total = tax_credit;
        $scope.sub_credit = $scope.sum_credit;
        $scope.total_credit = $scope.sub_credit + $scope.tax_credit_total;

        // $scope.sub_debit = $scope.sum_debit;
        // $scope.sub_credit = $scope.sum_credit;

        if($scope.total_debit == $scope.total_credit)
        {
            $scope.mydisabled=false;
        }
        else
        {
            $scope.mydisabled=true;
        }
    }


    $scope.getTax = function (index) {

        if($scope.debit[index] > 0 && !$scope.credit[index])
        {

            var value = document.getElementById("debit_" + index).value.length;

            var tax_debit = 0;
            $scope.tax_debit_total = 0;

            $scope.sum = parseFloat("0");

            for(var i = 0; i <= $scope.journals.length; i++)
            {
                if(isNaN($scope.debit[i]) || isNaN(parseFloat($scope.debit[i])))
                {
                    var a = parseFloat("0");
                    $scope.sum = $scope.sum + a;

                    var tax = $("#tax_id_" + i + " option:selected").text();
                    if(tax == "Select Tax")
                    {
                        tax = 0;
                    }
                    else
                    {
                        var tax = tax.replace('%-tax', '');
                    }

                    debit = parseFloat($scope.debit[i]);
                }
                else
                {

                    $scope.sum = $scope.sum + parseFloat($scope.debit[i]);

                    var tax = $("#tax_id_" + i + " option:selected").text();
                    if(tax == "Select Tax")
                    {
                        tax = 0;
                    }
                    else
                    {
                        var tax = tax.replace('%-tax', '');
                    }
                    debit = parseFloat($scope.debit[i]);
                }

                if(isNaN(debit))
                {
                    debit = 0;
                }

                tax_debit = tax_debit + ((tax/100) * debit);

            }

            $scope.tax_debit_total = tax_debit;
            $scope.sub_debit = $scope.sum;
            $scope.total_debit = $scope.sum + $scope.tax_debit_total;

            if(value > 0)
            {
                $scope.credit[index] = null;
                document.getElementById("credit_" + index).disabled = true;
            }
            else
            {
                document.getElementById("credit_" + index).disabled = false;
            }

            if($scope.total_debit == $scope.total_credit)
            {
                $scope.mydisabled=false;
            }
            else
            {
                $scope.mydisabled=true;
            }
        }
        else if($scope.credit[index] > 0 && !$scope.debit[index])
        {
            var value = document.getElementById("credit_" + index).value.length;

            var tax_credit = 0;
            $scope.tax_credit_total = 0;

            $scope.sum = parseFloat("0");
            for(var i = 0; i <= $scope.journals.length; i++)
            {
                if(isNaN($scope.credit[i]) || isNaN(parseFloat($scope.credit[i])))
                {
                    var a = parseFloat("0");
                    $scope.sum = $scope.sum + a;

                    var tax = $("#tax_id_" + i + " option:selected").text();
                    if(tax == "Select Tax")
                    {
                        tax = 0;
                    }
                    else
                    {
                        var tax = tax.replace('%-tax', '');
                    }

                    credit = parseFloat($scope.credit[i]);
                }
                else
                {

                    $scope.sum = $scope.sum + parseFloat($scope.credit[i]);

                    var tax = $("#tax_id_" + i + " option:selected").text();
                    if(tax == "Select Tax")
                    {
                        tax = 0;
                    }
                    else
                    {
                        var tax = tax.replace('%-tax', '');
                    }
                    credit = parseFloat($scope.credit[i]);

                }

                if(isNaN(credit))
                {
                    credit = 0;
                }

                tax_credit = tax_credit + ((tax/100) * credit);

            }

            $scope.tax_credit_total = tax_credit;
            $scope.taxx2 = tax_credit;

            $scope.sub_credit = $scope.sum;

            $scope.total_credit = $scope.sum + $scope.tax_credit_total;

            if(value > 0)
            {
                $scope.debit[index] = null;
                document.getElementById("debit_" + index).disabled = true;
            }
            else
            {
                document.getElementById("debit_" + index).disabled = false;
            }

            if($scope.total_debit == $scope.total_credit)
            {
                $scope.mydisabled=false;
            }
            else
            {
                $scope.mydisabled=true;
            }
        }
        else
        {
            console.log("wrong");
        }
    }
    
        
}