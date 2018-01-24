//use credit modal
<div class="uk-modal" id="modal_header_footer1" ng-controller="ExcessPaymentController">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Use Excess Payment for BILL-{{ str_pad($bill->bill_number, 6, '0', STR_PAD_LEFT) }}</h3>Bill Balance: BDT {{ $helper->getBillDueBalance($bill->id) }}
        </div>
        {!! Form::open(['url' => route('post_bill_excess_payment'), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form', 'files' => 'true']) !!}
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
                        <tr ng-repeat="excess_payment in excess_payments track by $index" class="form_section" id="data_clone">
                            <td>
                                <label>Excess Payment</label>
                                <input type="hidden" ng-init="payment_made_id='asdfg'" value="@{{excess_payment.id}}" name="payment_made_id[]" ng-model="payment_made_id">
                            </td>
                            <td>
                                <label>@{{ excess_payment.payment_date }}</label>

                            </td>
                            <td>
                                <label>@{{ excess_payment.amount }}</label>

                            </td>
                            <td>
                                <label>@{{ excess_payment.excess_amount }}</label>
                            </td>
                            <td>
                                <input type="text" id="excess_payment_amount_@{{ $index }}" name="excess_payment_amount[]" ng-model="excess_payment_amount[$index]" ng-keyup="calculateExcessPayment()" class="md-input"/>
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
                                <label id="amount_to_excess_payment" name="amount_to_excess_payment" ng-model="amount_to_excess_payment">@{{ amount_to_excess_payment }}</label>
                            </td>
                        </tr>

                        <tr class="form_section">
                            <td>
                                Bill Balance Due:
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

            <input type="hidden" name="bill_id" value="{{ $bill->id }}">

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