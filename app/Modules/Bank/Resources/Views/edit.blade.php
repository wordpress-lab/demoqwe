@extends('layouts.main')

@section('title', 'Bank Account')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" ng-controller="InvoiceController">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => route('bank_update',['id' => $bank->id]), 'method' => 'POST', 'class' => 'user_edit_form','files' => 'true', 'enctype' => "multipart/form-data"]) !!}
                <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Edit Bank Info</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                 <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Account Type<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Customer" id="type" name="type" required>
                                               @if($bank->type == 'Deposit')
                                               <option value="Deposit" selected>Deposit</option>
                                               @endif

                                               @if($bank->type == 'Withdrawal')
                                               <option value="Withdrawal" selected>Withdrawal</option>
                                               @endif
                                            </select>
                                        </div>
                                        @if($errors->first('type'))
                                            <div class="uk-text-danger">Type is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Payment Mode<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                        </div>
                                        <div class="uk-width-medium-1-5">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Bank Name" id="bank_name_id" name="payment_mode" required>
                                                <option value="">Select</option>
                                                @foreach($payment_mode as $payment_mode_data)
                                                    @if($payment_mode_data->id == $bank->payment_mode_id)
                                                    <option value="{{ $payment_mode_data->id}}" selected>{{ $payment_mode_data->account_name }}</option>
                                                    @else
                                                    <option value="{{ $payment_mode_data->id}}">{{ $payment_mode_data->account_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->first('payment_mode'))
                                            <div class="uk-text-danger">Payment Mode is required.</div>
                                        @endif

                                    </div>
                                    <div style="display: none;" class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Account<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Bank Name" id="bank_name_id" name="account" required>
                                                <option value="">Select Bank Name</option>
                                                @foreach($accounts as $account)
                                                @if($bank->account_id == $account->id)
                                                <option value="{{ $account->id}}" selected>{{ $account->account_name }}</option>
                                                @else
                                                    <option value="{{ $account->id}}">{{ $account->account_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                         @if($errors->first('account'))
                                                <div class="uk-text-danger">Account is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="customer_name">Bank Name<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Bank Name" id="bank_name_id" name="bank_name_id" required>
                                                <option value="">Select Bank Name</option>
                                                @foreach($bank_names as $bank_name)
                                                @if($bank->contact_id == $bank_name->id)
                                                <option value="{{ $bank_name->id}}/{{ $bank_name->account_id}}" selected>{{ $bank_name->display_name }}</option>
                                                @else
                                                <option value="{{ $bank_name->id}}/{{ $bank_name->account_id}}">{{ $bank_name->display_name }}</option>
                                                @endif
                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->first('account'))
                                                <div class="uk-text-danger">Account is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="particulars">Particulars<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="particulars"></label>
                                            <input class="md-input" type="text" id="particulars" name="particulars"   value="{{$bank->particulars}}" required/>
                                        </div>
                                        @if($errors->first('payment_mode'))
                                            <div class="uk-text-danger">Payment Mode is required.</div>
                                        @endif
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="date">Date<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="date">Select date</label>
                                            <input class="md-input" type="text" id="date" name="date" data-uk-datepicker="{format:'DD-MM-YYYY'}" required value="{{ date("d-m-Y",strtotime($bank->date)) }}">
                                        </div>
                                        @if($errors->first('payment_mode'))
                                            <div class="uk-text-danger">Field is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="cheque_number">Cheque Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="cheque_number"></label>
                                            <input class="md-input" type="text" id="cheque_number" name="cheque_number"  value="{{$bank->cheque_number}}" />
                                        </div>
                                        @if($errors->first('cheque_number'))
                                            <div class="uk-text-danger">Field is required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="total_amount">Total Amount<sup><i style="font-size: 12px; color:red; " class="material-icons">stars</i></sup> </label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="total_amount"></label>
                                            <input class="md-input" type="text" id="total_amount" name="total_amount"   value="{{$bank->total_amount}}" required/>
                                        </div>
                                        @if($errors->first('total_amount'))
                                            <div class="uk-text-danger">Field is Required.</div>
                                        @endif
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="notes">Notes</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="notes"></label>
                                            <input class="md-input" type="text" id="notes" name="notes"  value="{{$bank->notes}}"  />
                                        </div>
                                        @if($errors->first('notes'))
                                            <div class="uk-text-danger">Field is Required.</div>
                                        @endif
                                    </div>
                                     <div class="uk-grid" data-uk-grid-margin>
                                         <div class="uk-width-medium-1-5 uk-vertical-align">
                                             <label class="uk-vertical-align-middle" for="notes"> File</label>
                                         </div>
                                         <div class="uk-width-medium-2-5">

                                             <div class="uk-width-1-2">

                                                 <input id="form-file" name="file1" type="file">
                                             </div>

                                         </div>
                                         <div class="uk-width-medium-2-5">
                                             <div class="uk-width-1-2">

                                                 @if($bank->file_url)
                                                     <a download href="{{ url($bank->file_url) }}"><p class="uk-text-medium uk-margin-bottom">Download Attachment</p></a>
                                                 @endif
                                             </div>
                                          </div>
                                     </div>
                                    <hr>

                                    <div class="uk-grid uk-ma" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-left">
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

    <script>
        altair_forms.parsley_validation_config();
    </script>

    <script src="{{ url('admin/bower_components/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ url('admin/assets/js/pages/forms_validation.js') }}"></script>
    <script type="text/javascript">
);

        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_bank_bank').addClass('act_item');

        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        })
    </script>

@endsection
