@extends('layouts.main')

@section('title', 'Manual Journal')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection


@section('angular')
    <script src="{{url('app/accountant/manualJournal/manualJournal.module.js')}}"></script>
    <script src="{{url('app/accountant/manualJournal/manualJournalEdit.controller.js')}}"></script>
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile" ng-controller="ManualJournalEditController">
        <div class="uk-width-large-10-10">
            {{--<form action="" class="uk-form-stacked" id="user_edit_form">--}}
            {!! Form::open(['url' => array('manual-journal/update', $journal_id), 'method' => 'POST', 'class' => 'user_edit_form', 'id' => 'my_profile']) !!}
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">

                        <input type="hidden" ng-init="journal_id='asdfg'" value="{{$journal_id}}" name="journal_id" ng-model="journal_id">

                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Create New Journal</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                </div>
                            @endif
                            <div class="uk-margin-top">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5  uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="start_on">Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="date">Select date</label>
                                        <input class="md-input" type="text" id="date" name="date" value="{{ date("d-m-y", strtotime($journal->date)) }}" data-uk-datepicker="{format:'DD-MM-YYYY'}" required>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="reference">Reference</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <label for="reference">Enter Reference Number</label>
                                        <input class="md-input" type="text" id="reference" name="reference"  value="{{$journal->reference}}" required/>
                                    </div>
                                </div>
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label class="uk-vertical-align-middle" for="note">Note</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <textarea class="md-input" placeholder="Write description here..." name="note" id="note" required> {{$journal->note}}</textarea>
                                    </div>
                                </div>

                                <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-1">
                                        <table class="uk-table">
                                            <thead>
                                            <tr>
                                                <th class="uk-text-nowrap uk-width-medium-1-6">Account</th>
                                                <th class="uk-text-nowrap">Note</th>
                                                <th class="uk-text-nowrap uk-width-medium-1-6">Customer</th>
                                                <th class="uk-text-nowrap uk-width-medium-1-6">Tax</th>
                                                <th class="uk-text-nowrap">Debit</th>
                                                <th class="uk-text-nowrap">Credit</th>
                                                <th class="uk-text-nowrap">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="form_section" id="data_clone">
                                                <td>
                                                    <select id="account_0" name="account[0]" required>
                                                        
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea class="md-input" id="description_0" name="description[0]" placeholder="Enter note" required>@{{ journal.note }}</textarea>
                                                </td>
                                                <td>
                                                    <select id="contact_id_0" name="contact_id[0]" required>
                                                        <option value="">Select Any</option>
                                                        @foreach($contacts as $contact)
                                                            <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>
                                                    <select id="tax_id_0" name="tax_id[0]" ng-model="tax_id" ng-change="getTax(0)" required>
                                                        <option value="">Select Any</option>
                                                        @foreach($taxs as $tax)
                                                            <option value="{{$tax->id}}">{{$tax->tax_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="md-input" id="debit_0" name="debit[0]" ng-keyup="debit(0)" ng-model="debit[0]" placeholder="Enter debit" />
                                                </td>
                                                <td>
                                                    <input type="text" class="md-input" id="credit_0" name="credit[0]" ng-keyup="credit(0)" ng-model="credit[0]" ng-model="credit[0]" placeholder="Enter credit" />
                                                </td>
                                                <td class="uk-text-right uk-text-middle">
                                                    <a href="#" class="btnSectionClone"><i class="material-icons md-36" ng-click="Append()">&#xE146;</i></a>
                                                </td>
                                            </tr>

                                            <tr ng-repeat="journal in journals track by $index" class="form_section" id="data_clone">
                                                <td>
                                                    <select id="account_@{{ $index + 1 }}" name="account[]" required>
                                                        <option value="">Select Any</option>
                                                        @foreach($accounts as $account)
                                                            <option value="{{$account->id}}">{{$account->account_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea class="md-input" id="description_@{{ $index + 1 }}" name="description[@{{ $index + 1 }}]" placeholder="Enter note" required>@{{ journal.note }}</textarea>
                                                </td>
                                                <td>
                                                    <select id="contact_id_@{{ $index + 1 }}" name="contact_id[]" required>
                                                        <option value="">Select Any</option>
                                                        @foreach($contacts as $contact)
                                                            <option value="{{$contact->id}}">{{$contact->display_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>
                                                    <select id="tax_id_@{{ $index + 1 }}" name="tax_id[]" ng-model="tax_id" ng-change="getTax($index+1)" required>
                                                        <option value="">Select Any</option>
                                                        @foreach($taxs as $tax)
                                                            <option value="{{$tax->id}}">{{$tax->tax_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="md-input" id="debit_@{{ $index + 1 }}" name="debit[@{{ $index+1 }}]" ng-model="debit[$index+1]" ng-keyup="debit($index+1)" placeholder="Enter debit" />
                                                </td>
                                                <td>
                                                    <input type="text" class="md-input" id="credit_@{{ $index + 1 }}" name="credit[@{{ $index+1 }}]" ng-model="credit[$index+1]" ng-keyup="credit($index+1)" placeholder="Enter credit" />
                                                </td>
                                                <td class="uk-text-right uk-text-middle">
                                                    <a href="#" class="btnSectionClone"><i class="material-icons md-36" ng-click="Remove($index)">delete</i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-2 uk-margin-medium-top"></div>
                                    <div class="uk-width-medium-1-2">
                                        <table class="uk-table">
                                            <tbody>
                                            <tr class="form_section">
                                                <td>
                                                    Sub Total
                                                </td>
                                                <td>

                                                </td>
                                                <td ng-model="sub_debit">
                                                    @{{ sub_debit }}
                                                </td>
                                                <td ng-model="sub_credit">
                                                    @{{ sub_credit }}
                                                </td>
                                            </tr>


                                            <tr class="form_section">
                                                <td>
                                                    Tax
                                                </td>
                                                <td>

                                                </td>
                                                <td ng-model="tax_debit_total">
                                                    @{{ tax_debit_total }}
                                                </td>
                                                <td ng-model="tax_credit_total">
                                                    @{{ tax_credit_total }}
                                                </td>
                                            </tr>

                                            <tr class="form_section">
                                                <th>Total(BDT)</th>
                                                <th></th>
                                                <th ng-model="total_debit">
                                                    @{{ total_debit }}
                                                </th>
                                                <td ng-model="total_credit">
                                                    @{{ total_credit }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" ng-model="tax_debit_total" name="tax_debit_total" value="@{{ tax_debit_total }}">
                                        <input type="hidden" ng-model="tax_credit_total" name="tax_credit_total" value="@{{ tax_credit_total }}">
                                    </div>
                                </div>

                                <hr>

                                <div class="uk-grid uk-ma" data-uk-grid-margin>
                                    <div class="uk-width-1-1 uk-float-left">
                                        <button type="submit" class="md-btn md-btn-primary" ng-disabled="mydisabled">Submit</button>
                                        <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function debit(e){
            var elem = this;
            console.log(elem);
            console.log("ok");
        }
    </script>
     <script type="text/javascript">
         $('#sidebar_main_account').addClass('current_section');
         $('#sidebar_account_jurnal').addClass('act_item');
         $(window).load(function(){
             $("#tiktok_account").trigger('click');
         });
    </script>
@endsection
