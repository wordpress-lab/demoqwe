@extends('layouts.main')

@section('title', 'Pms Expense Payment')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Pms Expense Payment</span></h2>
                            </div>
                        </div>
                        <div class="md-card">
                            {!! Form::open(['url' => route('pms_expense_payment_update',$payment->id), 'method' => 'POST','files' => true]) !!}
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Date <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Select Date</label>
                                            <input class="md-input" type="text" id="date" name="date" data-uk-datepicker="{format:'YYYY-MM-DD'}" value="{{$payment->date}}"/>
                                            @if($errors->first('date'))
                                                <div class="uk-text-danger">Date is required.</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Amount <span style="color: red;">*</span></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Amount</label>
                                            <input class="md-input" type="number" id="amount" name="amount" value="{{$payment->amount}}" step="0.01"/>
                                        </div>
                                        @if($errors->first('amount'))
                                            <div class="uk-text-danger">Amount is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="nationality">Note </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="nationality">Note</label>
                                            <textarea class="md-input" type="text" id="note" name="note" step="0.01"/>{{ $payment->note }}</textarea>
                                        </div>
                                    </div>

                                    <input type="text" id="information" data-due_amount="{{$payment->expenseId['due'] + $payment->amount}}" hidden>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <a href="{{ URL::previous() }}" class="md-btn md-btn-flat uk-modal-close">Close</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>

        $('#sidebar_pms').addClass('current_section');
        $('#pms_payroll_payslip').addClass('act_item');
        $(window).load(function(){
            $("#pms_tiktok").trigger('click');
            $("#pms_payroll_tiktok").trigger('click');
            $("#pms_assign_tiktok").trigger('click');
        })

        $('#amount').on('input',function(){
            var amount = $('#amount').val();
            var due_amount = $('#information').data('due_amount');
console.log(due_amount);
            if(amount>due_amount){
                $('#amount').val(due_amount);
            }

        });
        
    </script>

@endsection