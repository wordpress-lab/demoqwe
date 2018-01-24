@extends('layouts.main')

@section('title', 'Contact Category')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <form action="" class="uk-form-stacked" id="user_edit_form">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create New Item</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="recipient_name">Recipient Name</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Recipient" id="recipient_name" name="recipient_name">
                                                <option value="">Select Recipient</option>
                                                <option value="a">Recipient 1</option>
                                                <option value="b">Recipient 2</option>
                                                <option value="c">Recipient 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="issued_by">Issued By</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Recipient" id="issued_by" name="issued_by">
                                                <option value="">Select User</option>
                                                <option value="a">User 1</option>
                                                <option value="b">User 2</option>
                                                <option value="c">User 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="issued_number">Issued Number</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="issued_number">Enter issued number</label>
                                            <input class="md-input" type="text" id="issued_number" name="issued_number" />
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="date">Date</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="date">Enter date</label>
                                            <input class="md-input" type="text" id="date" name="date" />
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="start_on">Start On</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="start_on">Select date</label>
                                            <input class="md-input" type="text" id="start_on" name="start_on" data-uk-datepicker="{format:'DD.MM.YYYY'}">
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="phase">Phase</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Recipient" id="phase" name="phase">
                                                <option value="">Select Phase</option>
                                                <option value="a">Phase 1</option>
                                                <option value="b">Phase 2</option>
                                                <option value="c">Phase 3</option>
                                            </select>
                                        </div>
                                    </div>

                                   
                                    <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <table class="uk-table">
                                                <thead>
                                                    <tr>
                                                        <th class="uk-text-nowrap">Item Details</th>
                                                        <th class="uk-text-nowrap">Quantity</th>
                                                        <th class="uk-text-nowrap">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="form_section" id="data_clone">
                                                        <td>
                                                            <textarea class="md-input" placeholder="Write description here..."></textarea>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="md-input" placeholder="Enter quantity" />
                                                        </td>
                                                        <td class="uk-text-right uk-text-middle">
                                                            <a class="uk-width-medium-1-2" style="margin-left: -15px;" href="#account_modal" data-uk-modal>
                                                                <i class="material-icons">&#xE88F;</i>
                                                            </a>
                                                            <a href="#" class="btnSectionClone uk-width-medium-1-2" data-section-clone="#data_clone">
                                                                <i class="material-icons md-24">&#xE145;</i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <div id="account_modal" class="uk-modal">
                                                        <div class="uk-modal-dialog">
                                                            <a class="uk-modal-close uk-close"></a>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                        </div>
                                                    </div>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-1">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-2">
                                                    <label for="customer_note">Customer note</label>
                                                    <textarea class="md-input" id="customer_note" name="customer_note"></textarea>
                                                </div>
                                                <div class="uk-width-medium-1-2">
                                                    <label for="personal_note">Personal note</label>
                                                    <textarea class="md-input" id="personal_note" name="personal_note"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-medium-1-1">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-1">
                                                    <label for="terms_and_condition">Terms and conditions here</label>
                                                    <textarea class="md-input" id="terms_and_condition" name="terms_and_condition"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <!-- <div id="preference_modal" class="uk-modal">
                                        <div class="uk-modal-dialog">
                                            <a class="uk-modal-close uk-close"></a>
                                            <div class="uk-modal-header">
                                                <h2>Recurring Invoices</h2>
                                            </div>

                                            <p>
                                                <input type="radio" id="customer_note" name="customer_note" data-md-icheck=""/>
                                                <label for="customer_note"> Create Invoices as drafts <br> Invoices are saved as drafts. You can review and send them to your customers for payment.</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="personal_note" name="personal_note" data-md-icheck=""/>
                                                <label for="personal_note"> Create and Send Invoices <br> Invoices are directly sent to your customers for payment.</label>
                                            </p>
                                            <p>
                                                <input type="radio" id="terms_and_condition" name="terms_and_condition" data-md-icheck=""/>
                                                <label for="terms_and_condition"> Create, Charge and Send Invoices <br> Your customer's credit card associated with the recurring invoice is charged automatically and invoices are sent for their reference.</label>
                                            </p>

                                            <div class="uk-modal-footer uk-text-right">
                                                <button type="button" class="uk-button">Cancel</button>
                                                <button type="button" class="uk-button uk-button-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>  -->

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

            </form>
        </div>
    </div>
@endsection
