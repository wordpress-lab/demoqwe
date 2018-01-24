{{--use credit modal--}}
<div class="uk-modal" id="modal_header_footer" ng-controller="UseCreditController">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Use credits for INV-{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}</h3>Invoice Balance: BDT {{ $helper->getDueBalance($invoice->id) }}
        </div>

        {!! Form::open(['url' => route('post_use_credit'), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form', 'files' => 'true']) !!}
            <div class="uk-width-large-10-10">
                <div class="uk-grid uk-margin-large-top uk-margin-large-bottom" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <table class="uk-table">
                            <thead>
                            <tr>
                                <th class="uk-text-nowrap">Credit Note#</th>
                                <th class="uk-text-nowrap">Credit Note Date</th>
                                <th class="uk-text-nowrap">Credit Amount</th>
                                <th class="uk-text-nowrap">Credits Available</th>
                                <th class="uk-text-nowrap uk-width-medium-1-6">Amount to Credit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="use_credit in use_credits track by $index" class="form_section" id="data_clone">
                                <td>
                                    <label>Credit Note</label>
                                    <input type="hidden" ng-init="credit_note_id='asdfg'" value="@{{use_credit.id}}" name="credit_note_id[]" ng-model="credit_note_id">
                                </td>
                                <td>
                                    <label>@{{ use_credit.credit_note_date }}</label>

                                </td>
                                <td>
                                    <label>@{{ use_credit.total_credit_note }}</label>

                                </td>
                                <td>
                                    <label>@{{ use_credit.available_credit }}</label>
                                </td>
                                <td>
                                    <input type="text" id="credit_amount_@{{ $index }}" name="credit_amount[]" ng-model="credit_amount[$index]" ng-keyup="calculateInvoice()" class="md-input"/>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-3 uk-margin-medium-top"></div>
                    <div class="uk-width-medium-2-3">
                        <table class="uk-table">
                            <tbody>
                            <tr class="form_section">
                                <td>
                                    Amount to Credit:
                                </td>
                                <td>

                                </td>
                                <td>
                                    <label id="amount_to_credit" name="amount_to_credit" ng-model="amount_to_credit">@{{ amount_to_credit }}</label>
                                </td>
                            </tr>

                            <tr class="form_section">
                                <td>
                                    Invoice Balance Due:
                                </td>
                                <td>

                                </td>
                                <td>
                                    <label id="due_balance" name="due_balance" ng-model="due_balance">@{{ due_balance }}</label>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">

            </div>
            <div class="uk-grid uk-ma" data-uk-grid-margin>
                <div class="uk-width-1-1 uk-float-left">
                    <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                    <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>