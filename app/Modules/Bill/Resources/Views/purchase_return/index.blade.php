@extends('layouts.main')

@section('title', 'Purchase Return')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Purchase Return</span></h2>
                            </div>
                        </div>
                        {!! Form::open(['url' => route('purchase_return_update',$bill->id), 'method' => 'POST','files' => true,'onsubmit' => 'return varify();']) !!}

                        @php
                            $i=1; $j=0;
                        @endphp


                        <div class="user_content">
                            <h3>BILL-{{ $bill->bill_number }}</h3>
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Returned Quantity</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Returned Quantity</th>
                                    </tr>
                                    </tfoot>
                                    <tbody id="invoice_quantity">
                                        @foreach($bill_entries as $all)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $all->item['item_name'] }}</td>
                                            <td id="quantity">{{ $all->quantity }}</td>
                                            <td>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="returned_quantity">Quantity</label>
                                                    <input class="md-input" type="text" id="returned_quantity" name="returned_quantity[]" oninput="quantity(this,{{ $j++ }});">
                                                </div>
                                            </td>
                                            <td hidden><input id="detail" name="bill_entries_id[]" value="{{ $all->id }}" data-rate="{{ $all->rate }}"></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <h4>Invoice Amount : {{ $bill->amount }}</h4>
                            <h4>Payment Received :{{ $bill->amount-$bill->due_amount }}</h4>
                            <h4>Due Amount :{{ $bill->due_amount }}</h4>
                            <br>

                            <input type="text" id="invoice_detail" data-total_amount="{{ $bill->amount }}" data-tax_total="{{ $bill->total_tax }}" data-due_amount="{{ $bill->due_amount }}" hidden>

                            <div class="uk-grid uk-ma" data-uk-grid-margin>
                                <div class="uk-width-1-1 uk-float-left">
                                    <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                    <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <div style="text-align: center;">
                            <h3 style="color: red;" id="msg"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_bill').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });

        function varify(){
            var total_amount = 0;

            var invoice_total_amount = $('#invoice_detail').data('total_amount');
            var due_amount = $('#invoice_detail').data('due_amount');
            var tax_total = $('#invoice_detail').data('tax_total');

            if(tax_total == ""){
                tax_total = 0;
            }

            var tax_main = ((tax_total * 100)/(invoice_total_amount - tax_total));

            $('#invoice_quantity tr').each(function() {
                var amount = 0;
                var quantity_optional = $(this).find("#quantity").html();   
                var return_quantity = $(this).find("#returned_quantity").val();
                if(return_quantity == ""){
                    return_quantity = 0;
                }  

                var quantity = (quantity_optional - return_quantity);

                var rate = $(this).find("#detail").data('rate');

                amount = (rate * quantity);

                total_amount = (total_amount + amount);
                
            });

            var tax = ((total_amount * tax_main)/100);

            var final_total = (total_amount + tax);

            var payment_receive = (invoice_total_amount - due_amount);

            if(final_total<payment_receive){
                $('#msg').html('Final total is less than payment receive');
                return false;
            }else{
                return true;
            }

        }

        function quantity(data,x){
            var item_quantity = parseInt(document.getElementById('invoice_quantity').rows[x].cells[2].innerHTML);
            var return_quantity = parseInt($(data).val());

            if(return_quantity>item_quantity){
                $(data).val(item_quantity);
            }
            if(return_quantity<item_quantity){
                $(data).val(return_quantity);
            }
            
        }
    </script>
@endsection
