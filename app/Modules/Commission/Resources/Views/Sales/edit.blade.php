@extends('layouts.main')

@section('title', 'Edit Sales Commission')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('top_bar')
    <div id="top_bar">


        <div class="uk-width-medium-1-6" style="margin-top:2px; ">
            <a class="md-btn md-btn-warning" href="{{ redirect()->getUrlGenerator()->previous() }}" data-uk-button> <i class="material-icons">skip_previous</i>   Back</a>
        </div>



    </div>
@endsection
@section('styles')
    <style>

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile" >
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('sales_commission_update',$salescommission->id), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Sales Commisions</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="item_name">Agent Name</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">

                                        <input class="md-input" type="text" id="item_name" value="{{ $salescommission->Agents->display_name }}" readonly/>

                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="date">Date<i class="material-icons" style="color:orangered">stars</i></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">

                                        <input value="{{ date("d-m-Y",strtotime($salescommission->date)) }}" class="md-input" type="text" name="date" id="date" data-uk-datepicker="{format:'DD-MM-YYYY'}">

                                        @if($errors->first('date'))
                                            <div class="uk-text-danger uk-margin-top">Date is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="scommission">Sales Commission</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">

                                        <input class="md-input" value="SC-{{ str_pad($salescommission->scNumber,6,'0',STR_PAD_LEFT) }}" type="text" id="scommission" name="scommission" readonly>

                                        @if($errors->first('salescommission'))
                                            <div class="uk-text-danger uk-margin-top">Sales Commision is required.</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="payable">Total Payable</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">

                                        <input class="md-input" value="{{ $totalpayable-$com_amount+$salescommission->amount }}" name="payable" type="number" id="payable" readonly>

                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="balance">Balance</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">

                                        <input class="md-input" type="number" value="{{ $balance }}"  name="balance" id="balance" readonly>

                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="amount">Amount <i class="material-icons" style="color:orangered">stars</i></label>
                                    </div>
                                    <div class="uk-width-medium-2-5">

                                        <input id="total_sales_amount" type="hidden" value="{{ $salescommission->amount }}">
                                        <input maxlength="{{ $salescommission->amount }}" onload="afterbalance(this.value)" oninput="afterbalance(this.value)" value="{{ $salescommission->amount }}" class="md-input" type="number" id="amount" name="amount" required>

                                    </div>
                                </div>


                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="account">Paid Through <i class="material-icons" style="color: red">stars</i> </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <script>

                                            function afterbalance(amount)
                                            {
                                                var pay=  parseFloat(document.getElementById('total_sales_amount').value);



                                                var payable=  parseInt(document.getElementById('payable').value);
                                                var am =payable-pay;

                                                if(parseFloat(amount)<pay)
                                                {
                                                    console.log("amount<=pay");
                                                    document.getElementById('balance').value =  payable-amount;
                                                    document.getElementById('amount').value = amount;

                                                    return false;

                                                }else if(parseFloat(amount)==pay){
                                                    console.log("amount>=pay");
                                                    document.getElementById('balance').value =  payable-pay;
                                                    document.getElementById('amount').value = pay;

                                                    return false
                                                }else if(parseFloat(amount)>pay){

                                                    document.getElementById('balance').value =  payable-pay;
                                                    document.getElementById('amount').value = pay;

                                                }

                                          }
                                            function showInput(id)
                                            {

                                                if(id.value!=3)
                                                {
                                                    document.getElementById("bank").style.display = "block";
                                                }
                                                else
                                                {
                                                    document.getElementById("bank").style.display = "none";
                                                }
                                            }

                                        </script>
                                        <select onchange="showInput(this)" id="account" name="account" class="md-input" data-md-selectize data-uk-tooltip="{pos:'top'}" title="Select with Account" required>
                                            <option value="" disabled selected hidden>Select Paid Through</option>
                                            @foreach($account as $value)
                                                @if($value->id==$salescommission->paid_through_id)
                                                <option selected value="{{ $value->id }}">{{ $value->account_name }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->account_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div id="bank" style="display: {{ ($salescommission->paid_through_id==4)?"block":"none"  }};">
                                    <div  class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="bankinfo">Bank Info </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <textarea maxlength="150" id="bankinfo" class="md-input"  name="bankinfo">{{ $salescommission->bank_info }}</textarea>

                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="item_about"></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <p>
                                                @if(is_null($salescommission->show))
                                                <input type="checkbox" name="show" id="status" data-md-icheck />
                                                @else
                                                    <input checked type="checkbox" name="show" id="status" data-md-icheck />
                                                 @endif
                                                <label for="status" class="inline-label">Show in Sales Commission</label>
                                            </p>



                                        </div>
                                    </div>
                                </div>

                                <div  class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="CustomerNote">Customer Note</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">

                                        <textarea maxlength="200" id="CustomerNote" class="md-input"   name="CustomerNote">{{ $salescommission->CustomerNote }}</textarea>

                                    </div>
                                </div>

                                <div  class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="PersonalNote">Personal Note </label>
                                    </div>
                                    <div class="uk-width-medium-2-5">

                                        <textarea maxlength="200" id="PersonalNote" class="md-input"   name="PersonalNote">{{ $salescommission->PersonalNote }}</textarea>

                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-right">
                                        <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_sales_commission').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });

    </script>
@endsection