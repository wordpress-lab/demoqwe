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
                                <h2 class="heading_b"><span class="uk-text-truncate">Edit Credit Note Refund</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            {!! Form::open(['url' => route('credit_note_refund_update', ['id' => $refund->id]), 'method' => 'POST', 'id' => 'form_validation']) !!}
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="date">Credit Note Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5 parsley-row">
                                        <label for="sales_order_date">Select date</label>
                                        <input class="md-input" type="text" id="date" name="date" value="{{ $refund->date }}"  data-uk-datepicker="{format:'DD.MM.YYYY'}" required>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="payment_mode">Payment Mode</label>
                                    </div>
                                    <div class="uk-width-medium-2-5 parsley-row">
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Payment Mode" id="payment_mode" name="payment_mode_id" required>
                                            <option value="">Select Payment Mode</option>
                                            @foreach($payment_modes as $payment_mode)
                                                @if($refund->payment_mode_id == $payment_mode->id)
                                                    <option value="{{ $payment_mode->id }}" selected>{{ $payment_mode->mode_name }}</option>
                                                @else
                                                    <option value="{{ $payment_mode->id }}">{{ $payment_mode->mode_name }}</option>
                                                @endif
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
                                        <input class="md-input" type="text" id="reference" name="reference" value="{{ $refund->reference }}" required/>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="amount">Amount</label>
                                    </div>
                                    <div class="uk-width-medium-2-5 parsley-row">
                                        <label for="amount">Enter Amount</label>
                                        <input class="md-input" type="text" id="amount" name="amount" value="{{ $refund->amount }}" required/>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="account">Account</label>
                                    </div>
                                    <div class="uk-width-medium-2-5 parsley-row">
                                        <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Account" id="account" name="account_id" required>
                                            <option value="">Select Account</option>
                                            <optgroup label="Cash">
                                                @foreach($accounts as $account)
                                                    @if($account->id == $refund->account_id)
                                                        <option value="{{ $account->id }}" selected>{{ $account->account_name }}</option>
                                                    @else
                                                        <option value="{{ $account->id }}">{{ $account->account_name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="credit_note_id" value="{{ $refund->credit_note_id }}">

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