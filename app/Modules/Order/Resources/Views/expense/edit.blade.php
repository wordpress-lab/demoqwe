@extends('layouts.main')

@section('title', 'Recruit Expense ')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection
@section('top_bar')
<div id="top_bar">
    <div class="md-top-bar">
        <ul id="menu_top" class="uk-clearfix">


            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Sector</span></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('order_expense_sector_create') }}">Create Sector</a></li>
                        <li><a href="{{ route('order_expense_sector') }}">All Sector </a></li>
                    </ul>
                </div>
            </li>
            @inject('Categories', 'App\Lib\Category')
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Search By Sector</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('order_expense_sector') }}">All Sector</a></li>
                        @foreach($Categories->ExpenseSector() as $recruitCategory)
                            <li><a href="{{ route('document_category_search', ['id' => $recruitCategory->id]) }}">{{ $recruitCategory->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            {!! Form::open(['url' => array('order/recruit/expense/update',$recruit->id), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form', 'files' => 'true']) !!}
               <input type="hidden" name="recruite_expense_type" value="{{ $type }}">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">

                                
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Edit Recruit Expense </span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                   <div class="uk-grid">
                                       <div class="uk-width-medium-1-5 uk-vertical-align">
                                           <label for="category_id" class="uk-vertical-align-middle">Agent</label>
                                       </div>
                                       <div class="uk-width-medium-2-5">
                                           @php
                                           $display= null;
                                           if(isset($recruit->salesCommission)){
                                           $display = $recruit->salesCommission["Agents"]["display_name"];
                                           }
                                           if(isset($expense->customer)){
                                           $display = $expense->customer["display_name"];
                                           }

                                           @endphp
                                         <h3 style="color:black;font-size: 20px;">
                                          {{ $display }}
                                         </h3>
                                       </div>

                                   </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="category_id" class="uk-vertical-align-middle">Sector</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select name="sector_id" id="sector_id" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Item" required>
                                                <option value="">Select Sector</option>
                                                @foreach($sector as $contact_category)

                                                    <option value="{{ $contact_category->id }}" {{ $recruit->expenseSectorid == $contact_category->id ? 'selected="selected"' : '' }}>{{ $contact_category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="contact_category_id" class="uk-vertical-align-middle">Pax Id</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            @php
                                            $k=1;
                                            $selected_pax = $recruit->paxId->pluck('id');
                                            $selected_pax = $selected_pax->all();
                                           @endphp
                                            <select required id="selec_adv_100" name="pax_id[]" multiple>
                                                {{--@foreach($pax_all as $value)--}}
                                                  {{--@if(in_array($value->id,$selected_pax))--}}
                                                    {{--<option  value="{{ $value->id }}">{{ $value->paxid }}</option>--}}
                                                  {{--@endif--}}
                                                {{--@endforeach--}}
                                                {{--@foreach($pax as $value)--}}
                                                    {{--<option  value="{{ $value->id }}">{{ $value->paxid }}</option>--}}
                                                {{--@endforeach--}}
                                            </select>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="uk-width-medium-1-2 uk-vertical-align" style="text-align: center;">
                                        @if($recruit->img_url)
                                        <img src="{!! asset('all_image/') !!}/{!! $recruit->img_url !!}" alt="...." height="60" width="150"/>
                                        @endif
                                    </div>
                                    <br>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="contact_category_id" class="uk-vertical-align-middle">File</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <input type="file" name="img_url" class="btn btn-success">
                                        </div>
                                    </div>
                                    

                                    <br/>
                                    <br/>


                                    @if($errors->first('date'))
                                        <div class="uk-text-danger uk-margin-top">Date is required.</div>
                                    @endif
                                    @if($errors->first('paid_through_id'))
                                        <div class="uk-text-danger uk-margin-top">Paid Account is required.</div>
                                    @endif
                                    @if($errors->first('account_id'))
                                        <div class="uk-text-danger uk-margin-top">Account is required.</div>
                                    @endif
                                    @if($errors->first('amount'))
                                        <div class="uk-text-danger uk-margin-top">Amount is required.</div>
                                    @endif
                                    @if($type=="expense")
                                    <div class="uk-grid" >
                                        <div class="uk-width-1-2" >
                                            <div style=" padding:10px;color: white; background-color: #2D2D2D ">
                                                Record Expense
                                            </div>

                                        </div>
                                        <div class="uk-width-1-2" style="padding: 10px; height: 40px; position:relative;background: #2D2D2D ">
                                            <div id="inv" style="position: absolute; right: 10px; height: 40px; ">
                                                <input {{ old('check_bill')?"checked":'' }} type="checkbox" name="check_bill" id="checkbox_bill" style=" margin-top: -1px; height: 25px; width: 20px;" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="uk-grid" style="display: none;" id="bill_details">

                                        <div class="uk-width-1-1" >
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Quantity">Expense Date</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="Quantity">Expense Date</label>
                                                    <input data-uk-datepicker="{format:'DD-MM-YYYY'}" class="md-input" type="text" id="Quantity" name="date" value="{{ $expense["date"] }}"/>
                                                </div>
                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="documentNumber">Expense Account</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <select name="account_id" id="account_id" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Item">

                                                        @foreach($expence_account as $value)

                                                            <option value="{{ $value->id }}" {{  $value->id==$expense->account_id?"selected":''}}>{{ $value->account_name }}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="documentNumber">Paid Through</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <select name="paid_through_id" id="invoice_item" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Item">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        @foreach($paid_through as $value)

                                                            <option value="{{ $value->id }}" {{ $value->id==$expense->paid_through_id?"selected":'' }} >{{ $value->account_name }}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="documentNumber">Vendor Name</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <select  id="invoice_item" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select Item">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        @foreach($vendor as $value)

                                                            <option value="{{ $value->id }}" {{ $value->id==$expense->vendor_id?"selected":'' }}>{{ $value->display_name }}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Quantity">Amount</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="Quantity">Amount</label>
                                                    <input class="md-input" type="text" id="Quantity" value="{{ $expense["amount"] }}" name="amount"/>
                                                </div>
                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="Quantity">Reference</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">

                                                    <label for="Quantity">Reference</label>
                                                    <input class="md-input" type="text" id="Quantity" value="{{ $expense["reference"] }}" name="reference"/>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    @endif
                                    @if($type=="salescommission")
                                        <div class="uk-grid" id="sales_commission">
                                            <div class="uk-width-1-2" >
                                                <div style=" padding:10px;color: white; background-color: #5C001F ">
                                                    Sales Commission
                                                </div>

                                            </div>
                                            <div class="uk-width-1-2" style="padding: 10px; height: 40px; position:relative;background: #5C001F ">
                                                <div id="" style="position: absolute; right: 10px; height: 40px; ">
                                                    <input {{ old('check_bill')?"checked":'' }} type="checkbox" name="check_commission" id="sales_commission_checkbox" style=" margin-top: -1px; height: 25px; width: 20px;" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="uk-grid" style="display: none;" id="sales_commission_details">
                                            <div class="uk-width-1-1" >
                                                <div class="uk-grid">
                                                    <div class="uk-width-medium-1-2 ">



                                                        <div class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-1-3 uk-vertical-align">
                                                                <label class="uk-vertical-align-middle" for="item_name">Agent Name</label>
                                                            </div>
                                                            <div class="uk-width-medium-1-2">

                                                                <input class="md-input" type="text" id="item_name" value="{{ $recruit->salesCommission["Agents"]["display_name"] }}" readonly/>
                                                                <input style="display: none;" name="agent_name_id" class="md-input" type="text" id="agent_name_id" value="{{ $recruit->salesCommission["agents_id"] }}" readonly/>

                                                            </div>
                                                        </div>
                                                        <div class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-1-3 uk-vertical-align">
                                                                <label class="uk-vertical-align-middle" for="date">Date<i class="material-icons" style="color:orangered">stars</i></label>
                                                            </div>
                                                            <div class="uk-width-medium-1-2">

                                                                <input value="{{ date("Y-m-d") }}" class="md-input" type="text" name="com_date" id="date"  value="{{ $recruit->salesCommission["date"] }}">

                                                                @if($errors->first('com_date'))
                                                                    <div class="uk-text-danger uk-margin-top">Date is required.</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-1-3 uk-vertical-align">
                                                                <label class="uk-vertical-align-middle" for="scommission">Sales Commission</label>
                                                            </div>
                                                            <div class="uk-width-medium-1-2">

                                                                <input class="md-input" value="" type="text" id="scommission" name="scommission" readonly>

                                                                @if($errors->first('salescommission'))
                                                                    <div class="uk-text-danger uk-margin-top">Sales Commission is required.</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-1-3 uk-vertical-align">
                                                                <label class="uk-vertical-align-middle" for="payable">Total Payable</label>
                                                            </div>
                                                            <div class="uk-width-medium-1-2">

                                                                <input class="md-input" value="" name="payable" type="number" id="payable" readonly>

                                                            </div>
                                                        </div>

                                                        <div class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-1-3 uk-vertical-align">
                                                                <label class="uk-vertical-align-middle" for="balance">Balance</label>
                                                            </div>
                                                            <div class="uk-width-medium-1-2">

                                                                <input class="md-input" type="number"  name="balance" id="balance" readonly>

                                                            </div>
                                                        </div>

                                                        <div class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-1-3 uk-vertical-align">
                                                                <label class="uk-vertical-align-middle" for="amount">Amount <i class="material-icons" style="color:orangered">stars</i></label>
                                                            </div>
                                                            <div class="uk-width-medium-1-2">

                                                                <input  oninput="afterbalance(this.value)" value="{{ $recruit->salesCommission["amount"] }}" class="md-input" type="number" id="amount" name="com_amount" >

                                                            </div>
                                                        </div>


                                                        <div class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-1-3 uk-vertical-align">
                                                                <label class="uk-vertical-align-middle" for="account">Paid Through <i class="material-icons" style="color: red">stars</i> </label>
                                                            </div>
                                                            <div class="uk-width-medium-1-2">
                                                                <script>
                                                                    function afterbalance(amount)
                                                                    {
                                                                        var pay=  document.getElementById('payable').value;
                                                                        var am =pay-amount;
                                                                        if(Math.sign(am) ===1)
                                                                        {
                                                                            document.getElementById('balance').value =  pay-amount;
                                                                        }
                                                                        else if(Math.sign(am) === -1)
                                                                        {
                                                                            document.getElementById('balance').value =  0;
                                                                            document.getElementById('amount').value = 0;
                                                                        }

                                                                        if(amount==pay)
                                                                        {
                                                                            document.getElementById('balance').value =0;


                                                                        }



                                                                    }
                                                                    function showInput(id)
                                                                    {

                                                                        if(id.value!=3)
                                                                        {
                                                                            document.getElementById("bank").style.display = "block";
                                                                        }
                                                                        else
                                                                        {
                                                                            document.getElementById("bank").style.display = "none";
                                                                        }
                                                                    }

                                                                </script>
                                                                <select onchange="showInput(this)" id="account" name="account" class="md-input" data-md-selectize data-uk-tooltip="{pos:'top'}" title="Select with Account" >
                                                                    <option value="" disabled selected hidden>Select Paid Through</option>
                                                                    @foreach($account as $value)
                                                                        <option {{ $recruit->salesCommission["paid_through_id"]==$value->id?"selected":'' }} value="{{ $value->id }}">{{ $value->account_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div id="bank" style="display: none;">
                                                            <div  class="uk-grid" data-uk-grid-margin>
                                                                <div class="uk-width-medium-1-3 uk-vertical-align">
                                                                    <label class="uk-vertical-align-middle" for="bankinfo">Bank Info</label>
                                                                </div>
                                                                <div class="uk-width-medium-1-2">

                                                                    <textarea maxlength="150" id="bankinfo" class="md-input"  name="bankinfo"> {{ $recruit->salesCommission["bank_info"] }}</textarea>

                                                                </div>
                                                            </div>

                                                            <div class="uk-grid" data-uk-grid-margin>
                                                                <div class="uk-width-medium-1-3 uk-vertical-align">
                                                                    <label class="uk-vertical-align-middle" for="item_about"></label>
                                                                </div>
                                                                <div class="uk-width-medium-1-2">

                                                                    <p>
                                                                        <input type="checkbox" name="show" id="status" data-md-icheck />
                                                                        <label for="status" class="inline-label">Show in Sales Commission</label>
                                                                    </p>



                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div  class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-1-3 uk-vertical-align">
                                                                <label class="uk-vertical-align-middle" for="CustomerNote">Customer Note</label>
                                                            </div>
                                                            <div class="uk-width-medium-1-2">

                                                                <textarea maxlength="200" id="CustomerNote" class="md-input"  name="CustomerNote">
                                                                    {{ $recruit->salesCommission["CustomerNote"] }}
                                                                </textarea>

                                                            </div>
                                                        </div>

                                                        <div  class="uk-grid" data-uk-grid-margin>
                                                            <div class="uk-width-medium-1-3 uk-vertical-align">
                                                                <label class="uk-vertical-align-middle" for="PersonalNote">Personal Note </label>
                                                            </div>
                                                            <div class="uk-width-medium-1-2">

                                                                <textarea maxlength="200" id="PersonalNote" class="md-input"  name="PersonalNote">
                                                                    {{ $recruit->salesCommission["PersonalNote"] }}
                                                                </textarea>

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="uk-width-medium-1-2">
                                                        <a id="pax_calc" data-id="@if(isset($recruit->salesCommission)){{$recruit->salesCommission["agents_id"] }}@endif" class="md-btn md-btn-primary">Calculate</a>
                                                        <table class="uk-table">
                                                            <caption style="text-align: center">Calculation</caption>
                                                            <thead>
                                                            <tr>
                                                                <th>Paxid</th>
                                                                <th>Payable</th>
                                                                <th>Paid</th>
                                                                <th>Balance</th>
                                                            </tr>
                                                            <tbody id="agent_expense_calc">

                                                            </tbody>
                                                            </thead>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="display_name">Created At</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            {{ $recruit->created_at }}
                                        </div>
                                    </div>

                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="display_name">Updated At</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            {{ $recruit->updated_at }}
                                        </div>
                                    </div>


                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-right">
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
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">

        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_order_expense_accounts').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })
    </script>

    <script>
        var selector_sector = null;
        var options=[];
        var editsales_commission = "{{ $recruit->salesCommission["amount"]}}";
        var subcomm = [];
        var single_row =[];
        var agent_id= null;
        var alldata = [];
        var alldata_expense = [];
        var allpaxid = [];
        var t_amount = 0;
        var apiAgent ="{{ route("order_from_expense_apiAgent") }}";
        var apjournalurl ="{{ route("order_from_expense_journal_entry") }}";
        var appayable ="{{ route("order_from_expense_apiPayable") }}";
        var accordion = UIkit.accordion(document.getElementById('accor'), {
            showfirst:false

        });
        var accordion = UIkit.accordion(document.getElementById('passangerdetailsaccord'), {
            showfirst:false

        });
        var accordion = UIkit.accordion(document.getElementById('hotel_accord'), {
            showfirst:false

        });
        var accordion = UIkit.accordion(document.getElementById('IATA_accor'), {
            showfirst:false

        });

        $("#checkbox_invoice").on("click",function () {

            $("#invoice_details").toggle(800);

        });
        $("#checkbox_bill").on("click",function () {

            $("#bill_details").toggle(800);
            var select = $('select[name="sector_id"] :selected').attr('class');
          //  $('#account_id').val(select);

        });
        $("#sales_commission_checkbox").on("click",function () {

            $("#sales_commission_details").toggle(800);

        });


        $(window).load(function(){
            $("#tiktok2").trigger('click');
            var sec_id = $("#sector_id").val();
            var rec_id = "{{ $recruit["id"] }}";
            var selecteditems = {!! json_encode($selected_pax) !!};


            selector_sector = $('#selec_adv_100').selectize({
                plugins: {
                    'remove_button': {
                        label: ''
                    }
                },
                maxItems: null,
                valueField: 'id',
                labelField: 'title',
                searchField: 'title',
                options: options,
                create: false,
                render: {
                    option: function(data, escape) {
                        return  '<div class="option">' +
                                '<span class="title">' + escape(data.title) + '</span>' +
                                '</div>';
                    },
                    item: function(data, escape) {
                        return '<div class="item"><a href="' + escape(data.url) + '" target="_blank">' + escape(data.title) + '</a></div>';
                    }

                },
                onDropdownOpen: function($dropdown) {
                    $dropdown
                            .hide()
                            .velocity('slideDown', {
                                begin: function() {
                                    $dropdown.css({'margin-top':'0'})
                                },
                                duration: 200,
                                easing: easing_swiftOut
                            })
                },
                onDropdownClose: function($dropdown) {
                    $dropdown
                            .show()
                            .velocity('slideUp', {
                                complete: function() {
                                    $dropdown.css({'margin-top':''})
                                },
                                duration: 200,
                                easing: easing_swiftOut
                            })
                }
            }).data('selectize');

            $.ajax({
                url: '{{ route("order_from_expense_api_expens_SectorPax") }}',
                dataType: 'json',
                async: false,
                data:{id:sec_id},
                complete: function () {
                    $('html').removeClass("wait");
                },
                success: function( resp ) {
                    options = resp;
                    //remove
                    if(selector_sector != undefined || selector_sector != null)
                    {
                        selector_sector.clearOptions();
                    }
                    //add
                    selector_sector.addOption(options);
                },
                error: function( req, status, err ) {
                    console.log( 'something went wrong', status, err );
                }
            });
            $.ajax({
                url: '{{ route("order_from_expense_edit_api_recruitExpenseApi") }}',
                dataType: 'json',
                async: false,
                data:{id:rec_id},
                complete: function () {
                    $('html').removeClass("wait");
                },
                success: function( resp ) {
                    options = resp;
                    //remove
                    if(selector_sector != undefined || selector_sector != null)
                    {
                      //  selector_sector.clearOptions();
                    }
                    //add
                    selector_sector.addOption(options);
                },
                error: function( req, status, err ) {
                    console.log( 'something went wrong', status, err );
                }
            });
            selector_sector.addItems(selecteditems);

        })

        $("#sector_id").on("change",function () {
            sec_id = $("#sector_id").val();
            $('html').addClass("wait");
            $.ajax({
                url: '{{ route("order_from_expense_api_expens_SectorPax") }}',
                dataType: 'json',
                async: false,
                data:{id:sec_id},
                complete: function () {
                    $('html').removeClass("wait");
                },
                success: function( resp ) {
                    options = resp;
                    //remove
                    if(selector_sector != undefined || selector_sector != null)
                    {
                        selector_sector.clearOptions();
                    }
                    //add
                    selector_sector.addOption(options);



                },
                error: function( req, status, err ) {
                    console.log( 'something went wrong', status, err );
                }
            });
        });
        altair_forms.parsley_validation_config();
    </script>
    <script src="{{ url('app/recruit/recruitexpenseedit.js')}}"></script>
@endsection