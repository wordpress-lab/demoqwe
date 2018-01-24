manualJournal.controller('ManualJournalEditController', ManualJournalEditController);

function ManualJournalEditController($scope, $http) {
     

    var journal_id = document.getElementsByName('journal_id')[0].value;
    // console.log('journal id'+journal_id);


    $http
        .get(window.location.origin + "/api/manual-journal/contact-account-tax-list/" + journal_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){
            data = response.data.contact;
            $scope.journals = response.data.journalEntries
            
            $scope.journal = $scope.journals[0];
            $scope.journals.splice(0, 1);

        });



    $http
        .get(window.location.origin + "/api/manual-journal/contact-account-tax-list/" + journal_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){
            data = response.data.contact;
            var journalEntries = response.data.journalEntries;
            // console.log(journalEntries);
            var journalEntriesTax = response.data.journalEntriesTax;
            $scope.sum_debit = 0;
            $scope.sum_credit = 0;
            account = response.data.account;
            contact = response.data.contact;
            tax = response.data.tax;
            for(var i = 0; i<journalEntries.length; i++)
            {
                $('#account_' + i).kendoDropDownList({
                    optionLabel   : "Select Account",
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: account,
                    dataType: "jsonp",
                    filter: "contains",
                    index: 0
                });

                $('#contact_id_' + i).kendoDropDownList({

                });

                $('#tax_id_' + i).kendoDropDownList({

                });

                for(var j = 0; j < data.length; j++)
                {

                    if( journalEntries[i].contact_id == data[j].value)
                    {
                        var account_name_id = journalEntries[i].account_name_id;
                        // console.log(account_name_id);
                        var contact_id      = journalEntries[i].contact_id;
                        var tax_id          = journalEntries[i].tax_id;

                        var dropdownlist1 = $("#account_" + i).data("kendoDropDownList");
                        dropdownlist1.value(account_name_id);

                        var dropdownlist2 = $("#contact_id_" + i).data("kendoDropDownList");
                        dropdownlist2.value(contact_id);

                        var dropdownlist2 = $("#tax_id_" + i).data("kendoDropDownList");
                        dropdownlist2.value(tax_id);


                        if(journalEntries[i].debit_credit == 0)
                        {
                            $scope.debit[i] = journalEntries[i].amount;
                            document.getElementById("credit_" + i).disabled = true;
                            $scope.sum_debit = $scope.sum_debit + $scope.debit[i];
                        }
                        else
                        {
                            $scope.credit[i] = journalEntries[i].amount;
                            document.getElementById("debit_" + i).disabled = true;
                            $scope.sum_credit = $scope.sum_credit + $scope.credit[i];
                        }

                    }
                }

            }

            // $scope.sub_debit = $scope.sum_debit;
            // $scope.sub_credit = $scope.sum_credit;




            $scope.sub_debit = $scope.sum_debit;
            $scope.tax_debit_total = journalEntriesTax[0].amount;
            $scope.total_debit = $scope.sub_debit + $scope.tax_debit_total;

            $scope.sub_credit = $scope.sum_credit;
            $scope.tax_credit_total = journalEntriesTax[1].amount;
            $scope.total_credit = $scope.sub_credit + $scope.tax_credit_total;

            //button disable enable
            if($scope.total_debit == $scope.total_credit)
            {
                $scope.mydisabled=false;
            }
            else
            {
                $scope.mydisabled=true;
            }

        });


$http
        .get(window.location.origin + "/api/manual-journal/contact-account-tax-list2/" + journal_id, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Process-Data': false}
        })
        .then(function(response){
            data = response.data.contact;
            var journalEntries = response.data.journalEntries;
            // console.log(journalEntries);
            var journalEntriesTax = response.data.journalEntriesTax;
            console.log()

            // $scope.sub_debit = $scope.sum_debit;
            // $scope.sub_credit = $scope.sum_credit;




            $scope.sub_debit = $scope.sum_debit;
            $scope.tax_debit_total = journalEntries[0].amount;
            $scope.total_debit = $scope.sub_debit + $scope.tax_debit_total;

            $scope.sub_credit = $scope.sum_credit;
            $scope.tax_credit_total = journalEntries[1].amount;
            $scope.total_credit = $scope.sub_credit + $scope.tax_credit_total;

            //button disable enable
            if($scope.total_debit == $scope.total_credit)
            {
                $scope.mydisabled=false;
            }
            else
            {
                $scope.mydisabled=true;
            }

        });


    $scope.Append = function () {
        $scope.journals.push('');
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
                    optionLabel   : "Select Tax",
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

    // $scope.sum = parseFloat("0");
    //
    // $scope.debit = function (index) {
    //
    //     var value = document.getElementById("debit_" + index).value.length;
    //
    //     $scope.sum = parseFloat("0");
    //     for(var i = 0; i <= $scope.journals.length; i++)
    //     {
    //         if(isNaN($scope.debit[i]) || isNaN(parseFloat($scope.debit[i])))
    //         {
    //             var a = parseFloat("0");
    //             $scope.sum = $scope.sum + a;
    //         }
    //         else
    //         {
    //
    //             $scope.sum = $scope.sum + parseFloat($scope.debit[i]);
    //
    //         }
    //
    //     }
    //
    //     $scope.sub_debit = $scope.sum;
    //
    //     if(value > 0)
    //     {
    //         document.getElementById("credit_" + index).disabled = true;
    //     }
    //     else
    //     {
    //         document.getElementById("credit_" + index).disabled = false;
    //     }
    //
    //     //button disable enable
    //     if($scope.sub_debit == $scope.sub_credit)
    //     {
    //         $scope.mydisabled=false;
    //     }
    //     else
    //     {
    //         $scope.mydisabled=true;
    //     }
    //
    // }
    //
    // $scope.credit = function (index) {
    //
    //     var value = document.getElementById("credit_" + index).value.length;
    //
    //     $scope.sum = parseFloat("0");
    //     for(var i = 0; i <= $scope.journals.length; i++)
    //     {
    //         if(isNaN($scope.credit[i]) || isNaN(parseFloat($scope.credit[i])))
    //         {
    //             var a = parseFloat("0");
    //             $scope.sum = $scope.sum + a;
    //         }
    //         else
    //         {
    //             $scope.sum = $scope.sum + parseFloat($scope.credit[i]);
    //
    //         }
    //
    //     }
    //
    //     $scope.sub_credit = $scope.sum;
    //
    //     if(value > 0)
    //     {
    //         document.getElementById("debit_" + index).disabled = true;
    //     }
    //     else
    //     {
    //         document.getElementById("debit_" + index).disabled = false;
    //     }
    //
    //     //button disable enable
    //     if($scope.sub_debit == $scope.sub_credit)
    //     {
    //         $scope.mydisabled=false;
    //     }
    //     else
    //     {
    //         $scope.mydisabled=true;
    //     }
    // }
    //
    //
    // $scope.debitCreditSum = function()
    // {
    //     $scope.sum_debit = parseFloat("0");
    //     $scope.sum_credit = parseFloat("0");
    //     for(var i = 0; i <= $scope.journals.length; i++)
    //     {
    //         if(isNaN($scope.debit[i]) || isNaN(parseFloat($scope.debit[i])))
    //         {
    //             var a = parseFloat("0");
    //             $scope.sum_debit = $scope.sum_debit + a;
    //
    //         }
    //         else
    //         {
    //
    //             $scope.sum_debit = $scope.sum_debit + parseFloat($scope.debit[i]);
    //
    //         }
    //
    //         if(isNaN($scope.credit[i]) || isNaN(parseFloat($scope.credit[i])))
    //         {
    //             var a = parseFloat("0");
    //             $scope.sum_credit = $scope.sum_credit + a;
    //         }
    //         else
    //         {
    //             $scope.sum_credit = $scope.sum_credit + parseFloat($scope.credit[i]);
    //
    //         }
    //
    //     }
    //
    //     $scope.sub_debit = $scope.sum_debit;
    //     $scope.sub_credit = $scope.sum_credit;
    //
    //     if($scope.sub_debit == $scope.sub_credit)
    //     {
    //         $scope.mydisabled=false;
    //     }
    //     else
    //     {
    //         $scope.mydisabled=true;
    //     }
    // }


}