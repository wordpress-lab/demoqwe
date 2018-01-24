@extends('layouts.main')

@section('title', 'Sales Commission')

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
            {!! Form::open(['url' => route('sales_commission_store',$agent->id), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create Sales Commisions</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="item_name">Agent Name</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <input class="md-input" type="text" id="item_name" value="{{ $agent->display_name }}" readonly/>

                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="date">Date<i class="material-icons" style="color:orangered">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <input value="{{ date("Y-m-d") }}" class="md-input" type="text" name="date" id="date"  value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD-MM-YYYY'}">

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

                                            <input class="md-input" value="SC-{{ str_pad($scnumber,6,'0',STR_PAD_LEFT) }}" type="text" id="scommission" name="scommission" readonly>

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

                                            <input class="md-input" value="{{ $totalpayable-$com_amount }}" name="payable" type="number" id="payable" readonly>

                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="balance">Balance</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <input class="md-input" type="number"  name="balance" id="balance" readonly>

                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="amount">Amount <i class="material-icons" style="color:orangered">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <input oninput="afterbalance(this.value)"  class="md-input" type="number" id="amount" name="amount" required>

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
                                                    var pay=  document.getElementById('payable').value;
                                                    var am =pay-amount;
                                                    if(Math.sign(am) ===1)
                                                     {
                                                           document.getElementById('balance').value =  pay-amount;
                                                     }
                                                     else if(Math.sign(am) === -1)
                                                     {
                                                         document.getElementById('balance').value =  0;
                                                         document.getElementById('amount').value = 0;
                                                     }

                                                    if(amount==pay)
                                                    {
                                                        document.getElementById('balance').value =0;


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
                                                    <option value="{{ $value->id }}">{{ $value->account_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                 <div id="bank" style="display: none;">
                                    <div  class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="bankinfo">Bank Info</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <textarea maxlength="150" id="bankinfo" class="md-input"  name="bankinfo"></textarea>

                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="item_about"></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <p>
                                                <input type="checkbox" name="show" id="status" data-md-icheck />
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

                                            <textarea maxlength="200" id="CustomerNote" class="md-input"  name="CustomerNote"></textarea>

                                        </div>
                                    </div>

                                    <div  class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="PersonalNote">Personal Note </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">

                                            <textarea maxlength="200" id="PersonalNote" class="md-input"  name="PersonalNote"></textarea>

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