@extends('layouts.invoice')

@section('title', 'Invoice')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('scripts')
    <script src="{{url('app/moneyin/invoice/invoice.module.js')}}"></script>
    <script src="{{url('app/moneyin/invoice/invoice.useCredit.js')}}"></script>
    <script src="{{url('app/moneyin/invoice/invoice.excessPayment.js')}}"></script>
@endsection

@section('content')
    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <ul class="md-list md-list-outside">

                        <li class="heading_list">Recent Invoices</li>

                        @foreach($invoices as $invoice_data)
                        <li>
                            <a href="{{ url('/invoice/show'.'/'.$invoice_data->id) }}" class="md-list-content">
                                <span class="md-list-heading uk-text-truncate">{{ $invoice_data->customer->display_name }} <span class="uk-text-small uk-text-muted">({{ $invoice_data->created_at->format('d M Y') }})</span></span>
                                <span class="uk-text-small uk-text-muted">INV-{{ str_pad($invoice_data->invoice_number, 6, '0', STR_PAD_LEFT) }}</span>
                            </a>
                        </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ url('/invoice') }}">See All</a>
                        </li>

                    </ul>
                </div>
            </div>

            <?php
            $helper = new \App\Lib\Helpers;
            ?>

            <div class="uk-width-large-6-10">
                <div class="md-card md-card-single main-print">
                    <div id="invoice_preview">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions hidden-print">
                                <i class="md-icon material-icons" id="invoice_print"></i>
                                <div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}" aria-haspopup="true" aria-expanded="false">
                                    <i class="md-icon material-icons"></i>
                                    <div class="uk-dropdown" aria-hidden="true">
                                        <ul class="uk-nav">
                                            <li>
                                                <a href="{{ url('/invoice/edit'.'/'.$invoice->id) }}">Edit</a>
                                            </li>
                                            <li>
                                                <a data-uk-modal="{target:'#modal_header_footer'}" href="#">Use Credits</a>
                                            </li>
                                            <li>
                                                <a data-uk-modal="{target:'#modal_header_footer1'}" href="#">Use Excess Payment</a>
                                            </li>
                                            <li>
                                                <a class="uk-text-danger" href="#">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name">INV-{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}</h3>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="height: 301px;">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-margin-medium-bottom uk-width-2-5">
                                    <img style="margin-bottom: -20px;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
                                    <h1 style="text-align: left; width: 100%;" class="uk-text-success">{{ $OrganizationProfile->company_name }}</h1>
                                </div>
                                <div class="uk-width-medium-3-5">
                                    <div class="uk-grid uk-margin-large-top uk-margin-medium-bottom">
                                        <h1 style="text-align: right; width: 90%;" class="uk-text-success">INVOICE</h1>
                                        <p style="text-align: right; width: 90%;" class="uk-text-small uk-text-muted uk-margin-top-remove"># INV-{{ str_pad($invoice->invoice_number, 6, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-grid" style="margin-top: -10px;">
                                <div class="uk-width-small-1-2 uk-row-first">
                                </div>
                                <div class="uk-width-small-1-2">
                                    <p style="text-align: right; width: 99%; margin: 0; padding: 0;" class="uk-text-small uk-margin-right-remove">Balance Due</p>
                                    <h2 style="text-align: right; width: 99%;" class="uk-margin-top-remove">BDT {{ $helper->getDueBalance($invoice->id) }}</h2>
                                </div>
                            </div>

                            <input type="hidden" ng-init="invoice_id='asdfg'" value="{{$invoice->id}}" name="invoice_id" ng-model="invoice_id">

                            <div class="uk-grid">
                                <div class="uk-width-small-1-2 uk-row-first">
                                    <div class="uk-margin-bottom">
                                        <span class="uk-text-muted uk-text-small uk-text-italic">Bill To:</span>
                                        <address>
                                            <p><strong>{{ $invoice->customer->display_name }}</strong></p>
                                        </address>
                                    </div>
                                </div>
                                <div class="uk-width-small-1-2">
                                    <table class="uk-table inv_top_right_table">
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-right no-border-bottom">Invoice Date :</td>
                                            <td class="uk-text-right no-border-bottom">{{ $invoice->invoice_date }}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="uk-text-right no-border-bottom">Due Date :</td>
                                            <td class="uk-text-right no-border-bottom">{{ $invoice->payment_date }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>#</th>
                                            <th>Item</th>
                                            <th class="uk-text-right">Qty</th>
                                            <th class="uk-text-right">Rate</th>
                                            <th class="uk-text-right">Discount(%)</th>
                                            <th class="uk-text-right">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($invoice_entries as $invoice_entry)
                                        <tr class="uk-table-middle">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $invoice_entry->item->item_name }}</td>
                                            <td class="uk-text-right">{{ $invoice_entry->quantity }}</td>
                                            <td class="uk-text-right">{{ $invoice_entry->rate }}</td>
                                            <td class="uk-text-right">{{ $invoice_entry->discount }}%</td>
                                            <td class="uk-text-right">{{ $invoice_entry->amount }}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom">Sub Total</td>
                                            <td class="uk-text-right no-border-bottom">{{ $sub_total }}</td>
                                        </tr>

                                        @if($invoice->tax_total>0)
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom">Tax</td>
                                            <td class="uk-text-right no-border-bottom">{{ $invoice->tax_total }}</td>
                                        </tr>
                                        @endif

                                        @if($invoice->shipping_charge>0)
                                            <tr class="uk-table-middle">
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="uk-text-right no-border-bottom">Shipping Charge</td>
                                                <td class="uk-text-right no-border-bottom">{{ $invoice->shipping_charge }}</td>
                                            </tr>
                                        @endif

                                        @if($invoice->adjustment > 0 || $invoice->adjustment < 0)
                                            <tr class="uk-table-middle">
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="no-border-bottom"></td>
                                                <td class="uk-text-right no-border-bottom">Adjustment</td>
                                                <td class="uk-text-right no-border-bottom">{{ $invoice->adjustment }}</td>
                                            </tr>
                                        @endif

                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom">Total</td>
                                            <td class="uk-text-right no-border-bottom">{{ $invoice->total_amount }}</td>
                                        </tr>
                                        <tr class="uk-table-middle">
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="no-border-bottom"></td>
                                            <td class="uk-text-right no-border-bottom" style="background: #efefef">Balance Due</td>
                                            <td class="uk-text-right no-border-bottom" style="background: #efefef">BDT {{ $helper->getDueBalance($invoice->id) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="uk-grid">
                                <div class="uk-width-1-2">
                                    <span class="uk-text-muted uk-text-small uk-text-italic">Notes:</span>
                                    <p class="uk-text-small uk-margin-bottom">Looking forward for your business.</p>
                                    @if($invoice->file_name)
                                    <a href="{{ url('invoice/invoice-download'.'/'.$invoice->file_name) }}"><p class="uk-text-medium uk-margin-bottom">Download Attachment</p></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden-print">
                    <div class="uk-margin-large-top">
                        <h2 class="heading_b">Payments Received</h2>
                    </div>

                    <div class="ük-grid uk-margin-top" data-uk-grid-margin>
                        <div class="md-card md-card-single main-print">
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>#</th>
                                            <th>Date</th>
                                            <th class="uk-text-right">Payment#</th>
                                            <th class="uk-text-right">Reference#</th>
                                            <th class="uk-text-right">Payment Mode</th>
                                            <th class="uk-text-right">Amount</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1;?>
                                        @foreach($payment_receive_entries as $payment_receive_entry)
                                        <tr class="uk-table-middle">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $payment_receive_entry->paymentReceive->payment_date }}</td>
                                            <td class="uk-text-right">{{ $payment_receive_entry->payment_receives_id }}</td>
                                            <td class="uk-text-right">{{ $payment_receive_entry->paymentReceive->reference }}</td>
                                            <td class="uk-text-right">{{ $payment_receive_entry->paymentReceive->paymentMode->mode_name }}</td>
                                            <td class="uk-text-right">BDT {{ $payment_receive_entry->amount }}</td>
                                            <td class="uk-text-center">
                                                <a href="{{ url('/payment-received/edit'.'/'.$payment_receive_entry->payment_receives_id) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-margin-top">
                        <h2 class="heading_b">Credits Applied</h2>
                    </div>

                    <div class="ük-grid uk-margin-top" data-uk-grid-margin>
                        <div class="md-card md-card-single main-print">
                            <div class="uk-grid uk-margin-large-bottom">
                                <div class="uk-width-1-1">
                                    <table class="uk-table">
                                        <thead>
                                        <tr class="uk-text-upper">
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Credit Note</th>
                                            <th class="uk-text-right">Credits Applied</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1;?>
                                        @foreach($credit_receive_entries as $credit_receive_entry)
                                        <tr class="uk-table-middle">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $credit_receive_entry->creditNote->credit_note_date }}</td>
                                            <td>{{ $credit_receive_entry->credit_note_id }}</td>
                                            <td class="uk-text-right">BDT {{ $credit_receive_entry->amount }}</td>
                                            <td class="uk-text-center">
                                                <a href="{{ url('/invoice/delete-credit'.'/'.$credit_receive_entry->id) }}" class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <ul class="md-list md-list-outside invoices_list">

                        <li class="heading_list">Comments
                            <strong>
                                <button class="uk-button uk-margin-small-top" data-uk-modal="{target:'#comment_modal'}">+ add comment</button>
                            </strong>
                        </li>

                    </ul>
                    <div class="uk-modal" id="comment_modal">
                        <div class="uk-modal-dialog">
                            <a class="uk-modal-close uk-close"></a>
                            <div class="uk-modal-header">
                                <h3>Add Comment</h3>
                            </div>
                            <textarea class="md-input" placeholder="Write description here..." rows="5"></textarea>
                            <div class="uk-modal-footer">
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
        </div>

        {{--model--}}
        @include('invoice::invoice.use_credit')
        @include('invoice::invoice.use_excess_payments')

    </div>
@endsection
