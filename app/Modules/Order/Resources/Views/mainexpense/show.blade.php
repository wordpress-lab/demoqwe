@extends('layouts.invoice')

@section('title', 'Expense')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('scripts')
@endsection

@section('content')
    <div class="uk-width-medium-10-10 uk-container-center reset-print">
        <div class="uk-grid uk-grid-collapse" data-uk-grid-margin>
            <div class="uk-width-large-2-10 hidden-print uk-visible-large">
                <div class="md-list-outside-wrapper">
                    <ul class="md-list md-list-outside">

                        <li class="heading_list">Recent Expenses</li>

                        @foreach($expenses as $expense_data)
                            <li>
                                <a href="{{ route('expense_show', ['id' => $expense_data->id]) }}" class="md-list-content">
                                    <span class="md-list-heading uk-text-truncate">{{ $expense_data->customer->display_name }}</span>
                                    <span class="uk-text-small uk-text-muted">{{ $expense_data->date }}</span>
                                </a>
                            </li>
                        @endforeach

                        <li class="uk-text-center">
                            <a class="md-btn md-btn-primary md-btn-mini md-btn-wave-light waves-effect waves-button waves-light uk-margin-top" href="{{ route('expense') }}">See All</a>
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
                                                <a href="{{ route('expense_edit', ['id' => $expense->id]) }}">Edit</a>
                                            </li>
                                            <li>
                                                <a class="uk-text-danger" href="{{ route('expense_delete', ['id' => $expense->id]) }}">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <h3 class="md-card-toolbar-heading-text large" id="invoice_name">Expense</h3>
                        </div>
                        <div class="md-card-content invoice_content print_bg" style="height: 301px;">


                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-5  uk-vertical-align">

                                </div>
                                <div class="uk-width-medium-3-5  uk-vertical-align">
                                    <h2 class="uk-text-success">Cost of Goods Sold</h2>
                                </div>
                                <div class="uk-width-medium-1-5">

                                </div>
                            </div>

                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="reference">Expense Amount</label>
                                        </div>
                                        <div class="uk-width-medium-3-5">
                                            <h3>BDT {{ $expense->amount }} <small>on {{ $expense->date }}</small></h3>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="reference">Paid Through</label>
                                        </div>
                                        <div class="uk-width-medium-3-5">
                                            <label class="uk-vertical-align-middle" for="reference">{{ $expense->accountPaidThrough->account_name }}</label>
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="reference">Tax Amount</label>
                                        </div>
                                        <div class="uk-width-medium-3-5">
                                            <label class="uk-vertical-align-middle" for="reference">BDT {{ $expense->tax_total }} {{ $expense->tax_type == 1 ? '(Exclusive)' : '(Inclusive)' }}</label>
                                        </div>
                                    </div>

                                    @if($expense->reference)
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="reference">Ref #</label>
                                        </div>
                                        <div class="uk-width-medium-3-5">
                                            <label class="uk-vertical-align-middle" for="reference">{{ $expense->reference }}</label>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-2-5  uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="reference">Paid To</label>
                                        </div>
                                        <div class="uk-width-medium-3-5">
                                            <label class="uk-vertical-align-middle" for="reference">{{ $expense->customer->display_name }}</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-1-2">
                                    <span class="uk-text-muted uk-text-small uk-text-italic">Notes:</span>
                                    <p class="uk-text-small uk-margin-bottom">Looking forward for your business.</p>
                                    <a href=""><p class="uk-text-medium uk-margin-bottom">Download Attachment</p></a>
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

    </div>
@endsection
