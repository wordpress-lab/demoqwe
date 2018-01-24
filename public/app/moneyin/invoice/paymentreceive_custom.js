
var invoice = angular.module('app', []);
invoice.controller('PaymentReceiveController', PaymentReceiveController);

function PaymentReceiveController($scope, $http) {


    $( document.body ).click(function() {
        //$scope.calculateExcessPayment();
    });

    $scope.invoice_amount = [];
    $scope.invoice_amount_temp = [];
    $scope.vat_adjust_des=[];
    $scope.tax_adjust_des=[];
    $scope.other_adjust_des=[];
    $scope.payment_receive_adjustment = [];
    $scope.currentPage = 0;

    $scope.vatadjustmentmsg ="Vat adjustment total is not correct";
    $scope.taxadjustmentmsg ="Tax adjustment total is not correct";
    $scope.otheradjustmentmsg ="Other adjustment total is not correct";
    $scope.successMessage ="OK!!";





    $scope.truefalse = true;


    $scope.amountReceived = function () {


        var received_amount = parseFloat($scope.amount)||0;

        for(var i = 0; i < $scope.invoices.length; i++)
        {
            var tem_due = parseFloat($('.uk-table > tbody > tr').eq(i).find('td').eq(3).text());

            var trow_due_amount= parseFloat($scope.invoices[i].due_amount);

            var trow_vat_amount= parseFloat($('.uk-table > tbody > tr').eq(i).find('.payment_vat_adjust_des').val())||0;
            var trow_tax_amount= parseFloat($('.uk-table > tbody > tr').eq(i).find('.payment_tax_adjust_des').val())||0;
            var trow_other_amount= parseFloat($('.uk-table > tbody > tr').eq(i).find('.payment_other_adjust_des').val())||0;

            var net_amount = trow_due_amount-(trow_vat_amount+trow_tax_amount+trow_other_amount);

            //  console.log("net_amount : "+net_amount+"trow_due_amount : "+trow_due_amount+"tem_due:"+tem_due+"trow_vat_amount: "+trow_vat_amount+"trow_tax_amount: "+trow_tax_amount+" trow_other_amount: "+trow_other_amount);

            if(received_amount<=net_amount)
            {
                //payment
                $scope.invoice_amount[i] =  received_amount;
                received_amount = received_amount-$scope.invoice_amount[i];
                //due amount
                $('.uk-table > tbody > tr').eq(i).find('td').eq(3).text(net_amount-$scope.invoice_amount[i]);
            }else{
                //payment
                $scope.invoice_amount[i] =  net_amount;
                received_amount = received_amount-$scope.invoice_amount[i];
                //due amount
                $('.uk-table > tbody > tr').eq(i).find('td').eq(3).text(net_amount- $scope.invoice_amount[i]);
            }

        }


        var pay_sum = 0;
        var excess_balance_pay = 0;
        var payment_adjustment = $("#amount").val();

        if(typeof payment_adjustment == "undefined" || payment_adjustment=='')
        {
            payment_adjustment =0;
        }
        else
        {
            payment_adjustment = parseFloat(payment_adjustment).toFixed(2);
        }

        $(".uk-table tbody").find('input.payment_original_adjust_des').each(function(i) {

            pay_sum = pay_sum+parseFloat($(this).val()||0);

        });

        payment_adjustment = parseFloat(payment_adjustment).toFixed(2);
        excess_balance_pay = payment_adjustment-parseFloat(pay_sum).toFixed(2);

        $scope.amount_received = parseFloat(payment_adjustment).toFixed(2)||0;
        $scope.used_amount = parseFloat(pay_sum).toFixed(2)||0;
        $scope.excess_amount = parseFloat(excess_balance_pay).toFixed(2)||0;


    }
    $scope.infinitycheck = function(value) {
        return Math.abs(value);
    }

    $scope.vat = function () {

        $scope.advanceAmount();

    }
    $scope.advanceAmount = function(){
        $(".uk-table tbody").find('tr').each(function(i) {
            $(this).find("td").eq(3).text($scope.invoices[i].due_amount);
        });

        var rowCount = $('.uk-table >tbody >tr').length;
        var amount = $("input#amount").val();

        var vat_adjustment = parseFloat($("input#vat_adjust").val())||0;
        var tax_adjust = parseFloat($("input#tax_adjust").val())||0;
        var other_adjust = parseFloat($("input#other_adjust").val())||0;

        var vat_adjustment_amount = (vat_adjustment/rowCount).toPrecision(4);
        var tax_adjustment_amount = (tax_adjust/rowCount).toPrecision(4);
        var other_adjustment_amount = (other_adjust/rowCount).toPrecision(4);


        $(".uk-table tbody").find('tr').each(function(i) {

            $(this).find("input.payment_vat_adjust_des").val(vat_adjustment_amount);
            var row_due_amount = parseFloat($(this).find("td").eq(3).text());
            var row_vat_adjustment = parseFloat($(this).find("input.payment_vat_adjust_des").val());

            // vat
            if((row_due_amount<row_vat_adjustment))
            {
                $(this).find("input.payment_vat_adjust_des").val(row_due_amount);
            }
            var vat_result= (parseFloat($scope.invoices[i].due_amount)-parseFloat($(this).find("input.payment_vat_adjust_des").val())).toFixed(2);
            $(this).find("td").eq(3).text(vat_result);
            vat_adjustment -= parseFloat($(this).find("input.payment_vat_adjust_des").val());

            //tax
            $(this).find("input.payment_tax_adjust_des").val(tax_adjustment_amount);
            row_due_amount = parseFloat($(this).find("td").eq(3).text());
            var row_tax_adjust_des = parseFloat($(this).find("input.payment_tax_adjust_des").val());


            if((row_due_amount<row_tax_adjust_des))
            {
                $(this).find("input.payment_tax_adjust_des").val(row_due_amount);
            }
            var tax_result = (row_due_amount-parseFloat($(this).find("input.payment_tax_adjust_des").val())).toFixed(2);
            $(this).find("td").eq(3).text(tax_result);
            tax_adjust -= parseFloat($(this).find("input.payment_tax_adjust_des").val());


            //other

            $(this).find("input.payment_other_adjust_des").val(other_adjustment_amount);
            row_due_amount = parseFloat($(this).find("td").eq(3).text());
            var row_other_adjust_des = parseFloat($(this).find("input.payment_other_adjust_des").val());

            if((row_due_amount<row_other_adjust_des))
            {
                $(this).find("input.payment_other_adjust_des").val(row_due_amount);


            }
            var other_result = (row_due_amount-parseFloat($(this).find("input.payment_other_adjust_des").val())).toFixed(2);
            $(this).find("td").eq(3).text(other_result);
            other_adjust -= parseFloat($(this).find("input.payment_other_adjust_des").val());




        });


        if(vat_adjustment!=0)
        {
            $scope.vatadjustbool = true;
        }else{
            $scope.vatadjustbool = false;
        }

        if(tax_adjust!=0)
        {
            $scope.taxadjustbool = true;
        }else{
            $scope.taxadjustbool = false;
        }

        if(other_adjust!=0)
        {
            $scope.otheradjustbool = true;
        }else{
            $scope.otheradjustbool = false;
        }
        $scope.successMessagebool = false;

        $scope.amountReceived();



    }
    $scope.tax = function () {
//                var len=$scope.invoices.length;
//                for(var i = 0; i < $scope.invoices.length; i++)
//                {
//                    $scope.tax_adjust_des[i]=$scope.tax_adjust/len;
//                }
        $scope.advanceAmount();
    }
    $scope.other = function () {
//                var len=$scope.invoices.length;
//                for(var i = 0; i < $scope.invoices.length; i++)
//                {
//                    $scope.other_adjust_des[i]=$scope.other_adjust/len;
//                }
        $scope.advanceAmount();
    }
    $scope.calculateExcessPaymentAmount  =  function () {
        var pay_sum = 0;
        var balance = 0;
        var payment_adjustment = $scope.amount;

        if(typeof payment_adjustment == "undefined" || payment_adjustment=='')
        {
            payment_adjustment =0;
        }
        else
        {
            payment_adjustment = parseFloat(payment_adjustment).toFixed(2);
        }

        $(".uk-table tbody").find('input.payment_original_adjust_des').each(function(i) {

            pay_sum = pay_sum+parseFloat($(this).val()||0);

        });
        payment_adjustment = parseFloat(payment_adjustment).toFixed(2);
        balance = payment_adjustment-parseFloat(pay_sum).toFixed(2);

        $scope.amount_received = payment_adjustment;
        $scope.used_amount = pay_sum;
        $scope.excess_amount = parseFloat(balance).toFixed(2);

    }

    $scope.calculateAdjustmentPayment =  function (index) {
        var payment_adjustment = $scope.amount||0;

        var tem_due = parseFloat($('.uk-table > tbody > tr').eq(index).find('td').eq(3).text());
        var trow_due_amount= parseFloat($scope.invoices[index].due_amount);
        var trow_vat_amount= parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_vat_adjust_des').val())||0;
        var trow_tax_amount= parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_tax_adjust_des').val())||0;
        var trow_other_amount= parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_other_adjust_des').val())||0;

        var par_amount = 0;
        par_amount= trow_vat_amount+(trow_tax_amount+trow_vat_amount+parseFloat($scope.invoice_amount[index]));
        var pay_sum = 0;
        $(".uk-table tbody").find('input.payment_original_adjust_des').each(function(i) {
            if(i!=index)
            {
                pay_sum = pay_sum+parseFloat($(this).val());
            }
        });

        var pay_left = payment_adjustment - pay_sum;
        var net_due_amo =trow_due_amount-(trow_vat_amount+trow_tax_amount+trow_other_amount);
        // console.log("net_due_amo:"+net_due_amo);
        if(pay_left>=parseFloat($scope.invoice_amount[index]) && parseFloat($scope.invoice_amount[index])<=net_due_amo)
        {

            $('.uk-table > tbody > tr').eq(index).find('.payment_original_adjust_des').val($scope.invoice_amount[index]);
            $('.uk-table > tbody > tr').eq(index).find('td').eq(3).text((net_due_amo-$scope.invoice_amount[index]).toFixed(2));


        }else if(pay_left<parseFloat($scope.invoice_amount[index])){

            $('.uk-table > tbody > tr').eq(index).find('.payment_original_adjust_des').val(parseFloat(pay_left).toFixed(2));
            $('.uk-table > tbody > tr').eq(index).find('td').eq(3).text((net_due_amo-pay_left).toFixed(2));
        }else if(parseFloat($scope.invoice_amount[index]>net_due_amo)){

            $('.uk-table > tbody > tr').eq(index).find('.payment_original_adjust_des').val(parseFloat(net_due_amo).toFixed(2));
            $('.uk-table > tbody > tr').eq(index).find('td').eq(3).text((net_due_amo-net_due_amo).toFixed(2));
        }


        var total_pay=0;
        $(".uk-table tbody").find('input.payment_original_adjust_des').each(function(i) {
            total_pay=total_pay+parseFloat($(this).val());
        });
        var con = (parseFloat(payment_adjustment).toPrecision(4)-parseFloat(total_pay).toFixed(2));
        if(Math.abs(con)<=0.1) {
            $scope.vatadjustbool = false;
        }else{
            $scope.vatadjustbool = true;
        }

        $scope.calculateExcessPaymentAmount();
    }
    $scope.calculateExcessPayment = function (index) {


        var total_balance = 0;
        var exceed_amount = 0;
        for(var i = 0; i < $scope.invoices.length; i++)
        {
            if(!parseFloat($scope.invoice_amount[i]))
                continue;

            if(!parseFloat($scope.amount))
            {
                $scope.invoice_amount[i] = 0;
                alert("Please Enter Amount");
                continue;
            }

            if(!parseFloat($scope.payment_receive_adjustment[i]))
                $scope.payment_receive_adjustment[i] = 0;


            if((parseFloat($scope.invoice_amount[i]) + parseFloat($scope.payment_receive_adjustment[i])) > $scope.invoices[i].due_amount)
            {
                $scope.invoice_amount[i] = parseFloat($scope.invoices[i].due_amount) - parseFloat($scope.payment_receive_adjustment[i]);
            }

            total_balance = total_balance + parseFloat($scope.invoice_amount[i]);
            if(total_balance > $scope.amount)
            {
                exceed_amount = total_balance - $scope.amount;
                total_balance = total_balance - parseFloat($scope.invoice_amount[i]);
                $scope.invoice_amount[index] = (parseFloat($scope.invoice_amount[index]) - exceed_amount - parseFloat($scope.payment_receive_adjustment[i]));
                total_balance = total_balance + parseFloat($scope.invoice_amount[i]);
            }

            $scope.used_amount = total_balance - exceed_amount;
            total_balance = total_balance - exceed_amount;
            $scope.excess_amount = (parseFloat($scope.amount) - parseFloat($scope.used_amount));
        }

        //adjustment
        //$scope.payment_receive_adjustment[index] = 0;
    }


    $scope.calculateAdjustment = function (index) {

        var vat_adjustment = parseFloat($("input#vat_adjust").val())||0;

        var tem_due = parseFloat($('.uk-table > tbody > tr').eq(index).find('td').eq(3).text());
        var trow_due_amount= parseFloat($scope.invoices[index].due_amount);
        var trow_vat_amount= parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_vat_adjust_des').val())||0;
        var trow_tax_amount= parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_tax_adjust_des').val())||0;
        var trow_other_amount= parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_other_adjust_des').val())||0;

        var par_amount = 0;
        par_amount= trow_vat_amount+(trow_tax_amount+trow_other_amount+parseFloat($scope.invoice_amount[index]));
        var vat_sum = 0;
        $(".uk-table tbody").find('input.payment_vat_adjust_des').each(function(i) {
            if(i!=index)
            {
                vat_sum = vat_sum+parseFloat($(this).val());
            }
        });
        var net_due_amo=0;
        var vat_left = vat_adjustment - vat_sum;
        net_due_amo =trow_due_amount-(trow_tax_amount+trow_other_amount+parseFloat($scope.invoice_amount[index]));
        // console.log("net_due_amo: "+net_due_amo+"vat_left "+vat_left+"vat_adjustment "+vat_adjustment+"trow_due_amount "+trow_due_amount+"trow_vat_amount "+trow_vat_amount+"trow_tax_amount "+trow_tax_amount+"trow_other_amount "+trow_other_amount+"payment "+$scope.invoice_amount[index]);
        if(vat_left>=trow_vat_amount && trow_vat_amount<=net_due_amo)
        {
            //  console.log("vat_left>=trow_vat_amount && trow_vat_amount<=net_due_amo");

            $('.uk-table > tbody > tr').eq(index).find('.payment_vat_adjust_des').val(trow_vat_amount);
            $('.uk-table > tbody > tr').eq(index).find('td').eq(3).text((net_due_amo-trow_vat_amount).toFixed(2));


        }else if(vat_left<trow_vat_amount){
            //  console.log("vat_left<trow_vat_amount");

            $('.uk-table > tbody > tr').eq(index).find('.payment_vat_adjust_des').val(parseFloat(vat_left).toFixed(2));
            $('.uk-table > tbody > tr').eq(index).find('td').eq(3).text((net_due_amo-vat_left).toFixed(2));
        }else if(trow_vat_amount>net_due_amo){
            //  console.log("trow_vat_amount>net_due_amo");

            $('.uk-table > tbody > tr').eq(index).find('.payment_vat_adjust_des').val(parseFloat(net_due_amo).toFixed(2));
            $('.uk-table > tbody > tr').eq(index).find('td').eq(3).text((net_due_amo-net_due_amo).toFixed(2));
        }

        net_due_amo = 0;
        var total_vat=0;
        $(".uk-table tbody").find('input.payment_vat_adjust_des').each(function(i) {
            total_vat=total_vat+parseFloat($(this).val());
        });
        var con = (parseFloat(vat_adjustment).toPrecision(4)-parseFloat(total_vat).toFixed(2));
        if(Math.abs(con)<=0.1) {
            $scope.vatadjustbool = false;
        }else{
            $scope.vatadjustbool = true;
        }

        // $scope.checkExcessvatAmount(index);

    }

    $scope.checkExcessvatAmount =function (index) {
        var vat_sum = 0;
        var vat_adjustment = parseFloat($("input#vat_adjust").val())||0;
        $(".uk-table tbody").find('input.payment_vat_adjust_des').each(function(i) {
            if(i!=index)
            {
                vat_sum = vat_sum+parseFloat($(this).val());
            }
        });
        //
        if((vat_adjustment-vat_sum)<parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_vat_adjust_des').val()))
        {
            $('.uk-table > tbody > tr').eq(index).find('.payment_vat_adjust_des').val(vat_adjustment-vat_sum);
        }



    }
    $scope.calculateAdjustmentTax = function (index) {


        var tax_adjustment = parseFloat($("input#tax_adjust").val())||0;

        var tem_due = parseFloat($('.uk-table > tbody > tr').eq(index).find('td').eq(3).text());
        var trow_due_amount= parseFloat($scope.invoices[index].due_amount);
        var trow_vat_amount= parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_vat_adjust_des').val())||0;
        var trow_tax_amount= parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_tax_adjust_des').val())||0;
        var trow_other_amount= parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_other_adjust_des').val())||0;

        var par_amount = 0;
        par_amount= trow_vat_amount+(trow_tax_amount+trow_other_amount+parseFloat($scope.invoice_amount[index]));
        var tax_sum = 0;
        $(".uk-table tbody").find('input.payment_tax_adjust_des').each(function(i) {
            if(i!=index)
            {
                tax_sum = tax_sum+parseFloat($(this).val());
            }
        });

        var tax_left = tax_adjustment - tax_sum;
        var net_due_amo =trow_due_amount-(trow_vat_amount+trow_other_amount+parseFloat($scope.invoice_amount[index]));
        // console.log("net_due_amo:"+net_due_amo);
        if(tax_left>=trow_tax_amount && trow_tax_amount<=net_due_amo)
        {

            $('.uk-table > tbody > tr').eq(index).find('.payment_tax_adjust_des').val(trow_tax_amount);
            $('.uk-table > tbody > tr').eq(index).find('td').eq(3).text((net_due_amo-trow_tax_amount).toFixed(2));


        }else if(tax_left<trow_tax_amount){

            $('.uk-table > tbody > tr').eq(index).find('.payment_tax_adjust_des').val(parseFloat(tax_left).toFixed(2));
            $('.uk-table > tbody > tr').eq(index).find('td').eq(3).text((net_due_amo-tax_left).toFixed(2));
        }else if(trow_tax_amount>net_due_amo){

            $('.uk-table > tbody > tr').eq(index).find('.payment_tax_adjust_des').val(parseFloat(net_due_amo).toFixed(2));
            $('.uk-table > tbody > tr').eq(index).find('td').eq(3).text((net_due_amo-net_due_amo).toFixed(2));
        }


        var total_tax=0;
        $(".uk-table tbody").find('input.payment_tax_adjust_des').each(function(i) {
            total_tax=total_tax+parseFloat($(this).val());
        });
        var con = (parseFloat(tax_adjustment).toPrecision(4)-parseFloat(total_tax).toFixed(2));
        if(Math.abs(con)<=0.1) {
            $scope.vatadjustbool = false;
        }else{
            $scope.vatadjustbool = true;
        }

    }

    $scope.calculateAdjustmentOther = function (index) {

        var other_adjustment = parseFloat($("input#other_adjust").val())||0;

        var tem_due = parseFloat($('.uk-table > tbody > tr').eq(index).find('td').eq(3).text());
        var trow_due_amount= parseFloat($scope.invoices[index].due_amount);
        var trow_vat_amount= parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_vat_adjust_des').val())||0;
        var trow_tax_amount= parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_tax_adjust_des').val())||0;
        var trow_other_amount= parseFloat($('.uk-table > tbody > tr').eq(index).find('.payment_other_adjust_des').val())||0;

        var par_amount = 0;
        par_amount= trow_due_amount+(trow_tax_amount+trow_vat_amount+parseFloat($scope.invoice_amount[index]));
        var other_sum = 0;
        $(".uk-table tbody").find('input.payment_other_adjust_des').each(function(i) {
            if(i!=index)
            {
                other_sum = other_sum+parseFloat($(this).val());
            }
        });

        var other_left = other_adjustment - other_sum;
        var net_due_amo =trow_due_amount-(trow_vat_amount+trow_tax_amount+parseFloat($scope.invoice_amount[index]));
        // console.log("net_due_amo:"+net_due_amo);
        if(other_left>=trow_other_amount && trow_other_amount<=net_due_amo)
        {

            $('.uk-table > tbody > tr').eq(index).find('.payment_other_adjust_des').val(trow_other_amount);
            $('.uk-table > tbody > tr').eq(index).find('td').eq(3).text((net_due_amo-trow_other_amount).toFixed(2));


        }else if(other_left<trow_other_amount){

            $('.uk-table > tbody > tr').eq(index).find('.payment_other_adjust_des').val(parseFloat(other_left).toFixed(2));
            $('.uk-table > tbody > tr').eq(index).find('td').eq(3).text((net_due_amo-other_left).toFixed(2));
        }else if(trow_other_amount>net_due_amo){

            $('.uk-table > tbody > tr').eq(index).find('.payment_other_adjust_des').val(parseFloat(net_due_amo).toFixed(2));
            $('.uk-table > tbody > tr').eq(index).find('td').eq(3).text((net_due_amo-net_due_amo).toFixed(2));
        }


        var total_other=0;
        $(".uk-table tbody").find('input.payment_other_adjust_des').each(function(i) {
            total_other=total_other+parseFloat($(this).val());
        });
        var con = (parseFloat(other_adjustment).toPrecision(4)-parseFloat(total_other).toFixed(2));
        if(Math.abs(con)<=0.1) {
            $scope.vatadjustbool = false;
        }else{
            $scope.vatadjustbool = true;
        }

    }

}
