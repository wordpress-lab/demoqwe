@extends('layouts.main')

@section('title', 'Credit Notes')

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
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Credit Note</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            {!! Form::open(['url' => route('credit_note_refund_store'), 'method' => 'POST', 'id' => 'my_profile']) !!}
                                <div class="uk-margin-top">

                                    <input type="hidden" name="credit_note_id" value="{{ $credit_note_id }}">

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="date">Credit Note Date</label>
                                        </div>
                                        <div class="uk-width-medium-2-5 parsley-row">
                                            <label for="sales_order_date">Select date</label>
                                            <input class="md-input" type="text" id="date" name="date"  value="{{ Carbon\Carbon::now()->format('d-m-Y') }}" data-uk-datepicker="{format:'DD.MM.YYYY'}" required>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="payment_mode">Payment Mode</label>
                                        </div>
                                        <div class="uk-width-medium-2-5 parsley-row">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Payment Mode" id="payment_mode" name="payment_mode_id" required>
                                                @foreach($payment_modes as $payment_mode)
                                                    <option value="{{ $payment_mode->id }}">{{ $payment_mode->mode_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="reference">Reference#</label>
                                        </div>
                                        <div class="uk-width-medium-2-5 parsley-row">
                                            <label for="reference">Enter Reference Number</label>
                                            <input class="md-input" type="text" id="reference" name="reference" required/>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="amount">Amount</label>
                                        </div>
                                        <div class="uk-width-medium-2-5 parsley-row">
                                            <label for="amount">Enter Amount</label>
                                            <?php $total_payment = 0; ?>
                                            <?php $refund = 0; ?>
                                            @foreach($credit_note->creditNotePayments as $payment)
                                               <?php $total_payment = $total_payment + (float)$payment->amount; ?>
                                            @endforeach
                                            @foreach($credit_note->creditNoteRefunds as $refunds)
                                                <?php $refund = $refund + (float)$refunds->amount ?>
                                            @endforeach
                                            <input class="md-input" type="text" id="amount" name="amount" value="{{ $credit_note->total_credit_note - $total_payment - $refund }}" required/>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="account">Account</label>
                                        </div>
                                        <div class="uk-width-medium-2-5 parsley-row">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Account" id="account" name="account_id" required>
                                                <optgroup label="Cash">
                                                    @foreach($accounts as $account)
                                                        <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
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
        var app = angular.module('app', []);
    </script>

    <script>
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>

@endsection