@inject('option' , 'App\Lib\RouteOption')
<!-- main sidebar -->
<aside id="sidebar_main">
    <div style="background-color: #fff; text-align: center;" class="sidebar_main_header">
        <div class="sidebar_logo">
            <a style="margin-left: 0px;" href="{{url('dashboard')}}" class="sSidebar_hide sidebar_logo_large">
                <img class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="15" width="71"/>
            </a>
        </div>
    </div>
    <div class="menu_section">
        <ul>

            <li id="sidebar_master_dashboard" class="" title="Master Dashboard">
                <a href="{{ route('master_dashboard_index') }}">
                    <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                    <span class="menu_title">Master Dashboard</span>
                </a>
            </li>

            <li id="sidebar_main_account" class="" title="Account">
                <a id="tiktok_account" href="#">
                    <span class="menu_icon"><i class="material-icons">&#x2100;</i></span>
                    <span class="menu_title">Account</span>
                </a>
                <ul>
                    <li id="sidebar_dashboard" class="" title="Dashboard">
                        <a href="{{ route('dashboard') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                            <span class="menu_title">Dashboard</span>
                        </a>
                    </li>

                    <li id="sidebar_contact" class="" title="contacts">
                        <a href="{{ route('contact') }}">
                            <span class="menu_icon"><i class="material-icons">perm_contact_calendar</i></span>
                            <span class="menu_title">Contacts</span>
                        </a>
                    </li>

                    <li id="sidebar_inventory" class="" title="Inventory">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">add_shopping_cart</i></span>
                            <span class="menu_title">Inventory</span>
                        </a>
                        <ul>
                            <li id="sidebar_inventory_inventory" class=""><a href="{{ route('inventory') }}">Inventory</a></li>
                            <li id="sidebar_inventory_price_list" class=""><a href="{{ route('price_list') }}">Price List</a></li>
                            <li id="sidebar_inventory_product" class=""><a href="{{ route('track') }}">Product Track</a></li>
                        </ul>

                    </li>
                    <li id="sidebar_bank" class="" title="Account">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">account_balance_wallet</i></span>
                            <span class="menu_title">Bank</span>
                        </a>
                        <ul>
                            <li id="sidebar_bank_bank" class=""><a href="{!! route('bank_deposit') !!}">Deposit</a></li>
                            <li id="sidebar_bank_bank2" class=""><a href="{!! route('bank_withdraw') !!}">Withdraw</a></li>
                            <li id="sidebar_bank_report" class=""><a href="{{ url('bank/report') }}">Bank Report</a></li>
                        </ul>

                    </li>
                    <li id="sidebar_money_in" class="" title="Money In">
                        <a href="#" id="tiktok5">
                            <span class="menu_icon"><i class="material-icons">attach_money</i></span>
                            <span class="menu_title">Money In</span>
                        </a>
                        <ul>
                            <li id="sidebar_estimate" class=""><a href="{{ route('estimate') }}">Estimate</a></li>

                            <li id="sidebar_aif" class="" title="Account Information Form">
                                <a id="aif_tick" href="#">
                                    <span class="menu_title">AIF</span>
                                </a>

                                <ul>

                                    <li id="sidebar_aif_add" class="" title="AIF ADD">
                                        <a href="{{ route('aif_create') }}">
                                            <span class="menu_title">Add</span>
                                        </a>
                                    </li>

                                    <li id="sidebar_aif_view" class="" title="View All">
                                        <a href="{{ route('aif') }}">
                                            <span class="menu_title">View All</span>
                                        </a>
                                    </li>

                                    <li id="sidebar_my_aif" class="" title="My AIFs">
                                        <a href="{{ route('my_aif') }}">
                                            <span class="menu_title">My AIF's</span>
                                        </a>
                                    </li>
                                </ul>

                            </li>

                            <li id="sidebar_income" class=""><a href="{{ route('income') }}">Income</a></li>
                            <li id="sidebar_invoice" class=""><a href="{{ route('invoice') }}">Invoice</a></li>
                            <li id="sidebar_payment_recieve" class=""><a href="{{ route('payment_received') }}">Payment Received</a></li>
                            <li id="sidebar_credit_note" class=""><a href="{{ route('credit_note') }}">Credit Notes</a></li>

                        </ul>

                    </li>
                    <li id="sidebar_money_out" class="" title="Money Out">
                        <a href="#" id="tiktok6">
                            <span class="menu_icon"><i class="material-icons">money_off</i></span>
                            <span class="menu_title">Money Out</span>
                        </a>
                        <ul>
                            <li id="sidebar_expense" class=""><a href="{{ route('expense') }}">Expenses</a></li>
                            <li id="sidebar_bill" class=""><a href="{{ route('bill') }}">Bills</a></li>
                            <li id="sidebar_payment_made" class=""><a href="{{ route('payment_made') }}">Payments Made</a></li>
                            <li id="sidebar_sales_commission" class=""><a href="{{ route('sales_commission') }}">Sales Commission</a></li>

                            <li id="sidebar_cnb" class="" title="Conveyance Bill">
                                <a href="#">
                                    <span class="menu_title">Conveyance Bill</span>
                                </a>

                                <ul>
                                    <li id="sidebar_cnb_add" class="" title="Bill ADD">
                                        <a href="{{ route('cnb_create') }}">
                                            <span class="menu_title">Add</span>
                                        </a>
                                    </li>

                                    <li id="sidebar_cnb_view" class="" title="View All">
                                        <a href="{{ route('cnb') }}">
                                            <span class="menu_title">View All</span>
                                        </a>
                                    </li>
                                    <li id="sidebar_cnb__my_view" class="" title="My bills">
                                        <a href="{{ route('cnb_byuser') }}">
                                            <span class="menu_title">My Bills</span>
                                        </a>
                                    </li>

                                </ul>

                            </li>

                        </ul>

                    </li>
                    <li id="sidebar_account" class="" title="Accountant">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">account_balance_wallet</i></span>
                            <span class="menu_title">Accountant</span>
                        </a>
                        <ul>
                            <li id="sidebar_account_jurnal" class=""><a href="{{ route('journal') }}">Manual Journals</a></li>
                            <li id="sidebar_account_chart_of_accounts" class=""><a href="{{ route('account_chart') }}">Chart of Accounts</a></li>
                        </ul>

                    </li>
                    
                    <li id="sidebar_reports" class="" title="reports">
                        <a href="{{ url('report') }}">
                            <span class="menu_icon"><i class="material-icons">pie_chart</i></span>
                            <span class="menu_title">Reports</span>
                        </a>
                    </li>
                </ul>
            </li>

            

            




    @if($option->ticket() != Null)
        @if($option->ticket()->status == 1)

          <li id="sidebar_ticketing" class="" title="Ticketing">
                        <a id="tiktok" href="#">
                            <span class="menu_icon"><i class="material-icons">&#xE8F8;</i></span>
                            <span class="menu_title">Ticketing</span>
                        </a>
                        <ul>

                            <li id="sidebar_ticket_dashboard" class="" title="Ticket Dashboard">
                                <a href="{{ route('ticket_dashboard_index') }}">
                                    <span class="menu_icon"><i class="material-icons">Da</i></span>
                                    <span class="menu_title">Dashboard</span>
                                </a>
                            </li>

                            <li id="sidebar_ticket_setting" class="" title="Settings">
                                <a href="#">
                                    <span class="menu_icon"><i class="material-icons">settings</i></span>
                                    <span class="menu_title">Settings</span>

                                </a>

                                <ul>

                                    <li id="sidebar_ticket_commission" class="" title="ticket commission">
                                        <a href="{{ route('ticket_commission_edit',1) }}">
                                            <span class="menu_icon"><i class="material-icons">content_cut</i></span>
                                            <span class="menu_title">Commission</span>
                                        </a>
                                    </li>



                                    <li id="sidebar_ticket_hotel" class="" title="Hotel">
                                        <a href="{{ route('ticket_hotel_index') }}">
                                            <span class="menu_icon"><i class="material-icons" style="color: red">Hotel</i></span>
                                            <span class="menu_title">Ticket Hotel</span>
                                        </a>
                                    </li>
                                </ul>

                            </li>

                            <li id="sidebar_ticket_order" class="" title="Order">
                                <a href="#">
                                    <span class="menu_icon"><i class="material-icons">airline_seat_flat</i></span>
                                    <span class="menu_title">Order</span>

                                </a>
                                <ul>
                                    <li id="sidebar_ticket_order_new" class="" title="reports">
                                        <a href="{!! route('ticket_Order_create') !!}">
                                            <span class="menu_icon"><i class="material-icons">add_circle</i></span>
                                            <span class="menu_title">New</span>
                                        </a>
                                    </li>
                                    <li id="sidebar_ticket_order_pending" class="" title="reports">
                                        <a href="{{ route('ticket_Order_pending') }}">
                                            <span class="menu_icon"><i class="material-icons">remove_circle</i></span>
                                            <span class="menu_title">Pending Order</span>
                                        </a>
                                    </li>
                                    <li id="sidebar_ticket_order_confirm" class="" title="reports">
                                        <a href="{{ route('ticket_Order_confirmed') }}">
                                            <span class="menu_icon"><i class="material-icons">remove_circle</i></span>
                                            <span class="menu_title">Confirm Order</span>
                                        </a>
                                    </li>
                                    {{--<li id="sidebar_reports" class="" title="reports">--}}
                                        {{--<a href="{{ route('another_mail_send_show') }}">--}}
                                            {{--<span class="menu_icon"><i class="material-icons">E</i></span>--}}
                                            {{--<span class="menu_title">Show All Sending Email</span>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                </ul>

                            </li>

                            <li id="sidebar_ticket_refund" title="Refund">
                                <a href="#">
                                    <span class="menu_icon"><i class="material-icons">restore_page</i></span>
                                    <span class="menu_title">Refund</span>

                                </a>

                                <ul>

                                    <li id="sidebar_ticket_all_refund" title="ticket refund">
                                        <a href="{{ route('ticket_refund_index') }}">
                                            <span class="menu_icon"><i class="material-icons">store</i></span>
                                            <span class="menu_title">All Refunds</span>
                                        </a>
                                    </li>

                                    <li id="sidebar_ticket_refund_others" title="ticket refund">
                                        <a href="{{ route('ticket_refund_others_index') }}">
                                            <span class="menu_icon"><i class="material-icons">store</i></span>
                                            <span class="menu_title">Others</span>
                                        </a>
                                    </li>

                                </ul>

                            </li>

                       <li id="sidebar_ticket_order_docuemnt" class="" title="document">
                           <a href="{!! route('ticket_document_index') !!}">
                               <span class="menu_icon"><i class="material-icons">Ticket</i></span>
                               <span class="menu_title">Ticket Document</span>

                           </a>
                       </li>
                        <li id="sidebar_ticket_order_bill" class="" title="bill">
                            <a href="{!! route('ticket_bill_index') !!}">
                                <span class="menu_icon"><i class="material-icons">Bill</i></span>
                                <span class="menu_title">IATA Bill</span>

                            </a>
                        </li>

                  </ul>

        </li>
        @endif
    @endif
    
    @if($option->manPower() != Null)
        @if($option->manPower()->status == 1)
            <li id="manpower_service" class="" title="Manpower ">
                <a id="manpower_service_tok" href="#">
                    <span class="menu_icon"><i class="material-icons">&#xE03F;</i></span>
                    <span class="menu_title">Manpower Service</span>
                </a>
                <ul>

                    <li id="manpower_service_dashboard" class="" title="Manpower Dashboard">
                        <a href="{{ route('manpower_service_dashboard') }}">
                            <span class="menu_icon"><i class="material-icons">Da</i></span>
                            <span class="menu_title">Dashboard</span>
                        </a>
                    </li>

                    <li id="manpower_ticket_setting" class="" title="Settings">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">settings</i></span>
                            <span class="menu_title">Settings</span>
                        </a>

                        <ul>

                            <li id="manpower_ticket_hotel" class="" title="Hotel">
                                <a href="{{ route('manpower_service_hotel_index') }}">
                                    <span class="menu_icon"><i class="material-icons" style="color: red">Progress</i></span>
                                    <span class="menu_title">Progress Status</span>
                                </a>
                            </li>
                        </ul>

                    </li>

                    <li id="manpower_ticket_order" class="" title="Order">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">airline_seat_flat</i></span>
                            <span class="menu_title">Order</span>

                        </a>
                        <ul>
                            <li id="manpower_ticket_order_new" class="" title="reports">
                                <a href="{!! route('manpower_service_create') !!}">
                                    <span class="menu_icon"><i class="material-icons">add_circle</i></span>
                                    <span class="menu_title">New</span>
                                </a>
                            </li>
                            <li id="manpower_ticket_order_pending" class="" title="reports">
                                <a href="{{ route('manpower_service_pending') }}">
                                    <span class="menu_icon"><i class="material-icons">remove_circle</i></span>
                                    <span class="menu_title">Pending Order</span>
                                </a>
                            </li>
                            <li id="manpower_ticket_order_confirm" class="" title="reports">
                                <a href="{{ route('manpower_service_confirmed') }}">
                                    <span class="menu_icon"><i class="material-icons">remove_circle</i></span>
                                    <span class="menu_title">Confirm Order</span>
                                </a>
                            </li>

                        </ul>

                    </li>
                    <li id="manpower_ticket_order_docuemnt" class="" title="document">
                        <a href="{!! route('manpower_service_document_index') !!}">
                            <span class="menu_icon"><i class="material-icons"></i>Document</span>
                            <span class="menu_title"></span>

                        </a>
                    </li>

                </ul>

            </li>
        @endif
    @endif

    @if($option->recruit() != Null)
        @if($option->recruit()->status == 1)
            <li id="sidebar_recruit" class="" title="Recruit">

                <a id="tiktok2" href="#">
                    <span class="menu_icon"><i class="material-icons">&#xE89C;</i></span>
                    <span class="menu_title">Recruit</span>

                </a>

                <ul>
                    <li id="sidebar_recruit_dashboard" class="" title="reports">
                    <a href="{!! route('recruitdashboard') !!}">
                        <span class="menu_icon"><i class="material-icons">&#xE89C;</i></span>
                        <span class="menu_title">Dashboard</span>

                    </a>
                    </li>

                    <li id="sidebar_recruit_order" class="" title="reports">
                        <a href="{{ route('order') }}">
                            <span class="menu_icon"><i class="material-icons">perm_contact_calendar</i></span>
                            <span class="menu_title">All Customers </span>
                        </a>
                    </li>
                    {{--<li id="sidebar_customer" class="" title="reports">--}}
                        {{--<a href="{{ route('customer') }}">--}}
                            {{--<span class="menu_icon"><i class="material-icons">perm_contact_calendar</i></span>--}}
                            {{--<span class="menu_title">Customers </span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li id="sidebar_okala_index" class="" title="reports">--}}
                        {{--<a href="{{ route('okala_index') }}">--}}
                            {{--<span class="menu_icon"><i class="material-icons">insert_chart</i></span>--}}
                            {{--<span class="menu_title">Okala</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    <li id="sidebar_hrmbb" class="" title="Medical">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">&#xE147;</i></span>
                            <span class="menu_title">Medical</span>
                        </a>

                        <ul>
                            <li id="medical_slip_form_indexsss" class="" title="Medical Sip">
                                <a href="{{ route('medical_slip_form_index') }}">
                                    <span class="menu_icon"></span>
                                    <span class="menu_title">Medical Slip</span>
                                </a>
                            </li>

                            <li id="sidebar_medical_report" class="" title="Report">
                                <a href="{!! route('medicalslip') !!}">
                                    <span class="menu_title">Report</span>
                                </a>
                            </li>
                            <li id="sidebar_mofa" class="" title="Mofa">
                                <a href="{!! route('mofa') !!}">
                                    <span class="menu_title">Mofa</span>
                                </a>
                            </li>
                            <li id="sidebar_fitcard" class="" title="Fit Card">
                                <a href="{!! route('fit_card') !!}">
                                    <span class="menu_title">Fit Card</span>
                                </a>
                            </li>

                        </ul>

                    </li>

                    <li id="sidebar_police_clearance" class="" title="Police Clearance">
                        <a href="{!! route('police_clearance_index') !!}">
                            <span class="menu_icon"><i class="material-icons">security</i></span>
                            <span class="menu_title">Police Clearance</span>
                        </a>
                    </li>

                    {{--<li id="sidebar_company_index" class="" title="reports">--}}
                        {{--<a href="{{ route('company_index') }}">--}}
                            {{--<span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>--}}
                            {{--<span class="menu_title">Company</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    <li id="sidebar_recrut_visa" class="" title="reports">

                        <a href="{{ route('visa') }}">
                            <span class="menu_icon"><i class="material-icons">description</i></span>
                            <span class="menu_title">Visa Creation</span>
                        </a>
                    </li>
                    {{--<li id="sidebar_musaned" class="" title="Musaned">--}}
                        {{--<a href="{{ route('musaned') }}">--}}
                            {{--<span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>--}}
                            {{--<span class="menu_title">Musaned</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    <li id="visa_stamp_approval" class="" title="reports">
                        <a href="{{ route('stamp_approval_index') }}">
                            <span class="menu_icon"><i class="material-icons">verified_user</i></span>
                            <span class="menu_title">Stamp Approval</span>
                        </a>
                    </li>

                    <li id="visa_stamp_to" class="" title="reports">
                        <a id="visa_stamping_to" href="{{ route('visastamp') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>
                            <span class="menu_title">Visa Stamping</span>
                        </a>
                    </li>


                    <li id="sidebar_hrmbb" class="" title="Manpower">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">person</i></span>
                            <span class="menu_title">Manpower</span>
                        </a>

                        <ul>

                            <li id="sidebar_finger_2" class="" title="Finger">
                                <a href="{!! route('fingerprint_index') !!}">
                                    <span class="menu_title">Finger</span>
                                </a>
                            </li>
                            <li id="sidebar_training" class="" title="Training">
                                <a href="{!! route('training_index') !!}">
                                    <span class="menu_title">Training</span>
                                </a>
                            </li>
                            @if($option->manPower()->status == 1)
                            <li id="sidebar_manpower_index" class="" title="Manpower">

                                <a href="{{ route('manpower_index') }}">

                                    <span class="menu_title">Manpower</span>
                                </a>
                            </li>
                            @endif
                            <li id="sidebar_completion" class="" title="Completion">
                                <a href="{!! route('completion_index') !!}">
                                    <span class="menu_title">Completion</span>
                                </a>
                            </li>

                        </ul>

                    </li>


                    <li id="sidebar_hrmbb" class="" title="Flight">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">flight_land</i></span>
                            <span class="menu_title">Flight</span>
                        </a>

                        <ul>
                            <li id="sidebar_submission" class="" title="reports">
                                <a href="{{ route('submission') }}">
                                    <span class="menu_icon"></span>
                                    <span class="menu_title">Submission</span>
                                </a>
                            </li>

                            <li id="sidebar_confirmation" class="" title="Logbook">
                                <a href="{{ route('confirmation') }}">
                                    <span class="menu_title">Confirmation</span>
                                </a>
                            </li>

                        </ul>

                    </li>

                    <li id="sidebar_arrival_recruit" class="" title="reports">
                        <a href="{{ route('arrival_recruit_index') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>
                            <span class="menu_title">Arrival Recruit</span>
                        </a>
                    </li>

                    <li id="sidebar_iqama" class="" title="Iqama Approval">
                        <a id="iqama_tiktok" href="#">
                            <span class="menu_icon"><i class="material-icons">person</i></span>
                            <span class="menu_title">Iqama</span>
                        </a>

                        <ul>
                            <li id="iqama_approval" class="" title="Approval">
                                <a href="{{ route('iqama_approval_index') }}">
                                    <span class="menu_icon"><i class="material-icons">verified_user</i></span>
                                    <span class="menu_title">Approval</span>
                                </a>
                            </li>
                            <li id="iqama_insurance" class="" title="Insurance">
                                <a href="{{ route('iqama_insurance_index') }}">
                                    <span class="menu_icon"><i class="material-icons">person</i></span>
                                    <span class="menu_title">Insurance</span>
                                </a>
                            </li>
                            <li id="iqama_submission" class="" title="Insurance">
                                <a href="{{ route('iqama_submission_index') }}">
                                    <span class="menu_icon"><i class="material-icons">person</i></span>
                                    <span class="menu_title">Submission</span>
                                </a>
                            </li>
                            <li id="iqama_receive" class="" title="Insurance">
                                <a href="{{ route('iqama_receive_index') }}">
                                    <span class="menu_icon"><i class="material-icons">person</i></span>
                                    <span class="menu_title">Receive</span>
                                </a>
                            </li>
                            <li id="sidebar_iqama" class="" title="Iqama Delivery">
                                <a id="iqama_tiktok_delivery" href="#">
                                    <span class="menu_icon"><i class="material-icons">person</i></span>
                                    <span class="menu_title">Delivery</span>
                                </a>

                                <ul>
                                    <li id="iqama_delivery_clearance" class="" title="Approval">
                                        <a href="{{ route('iqama_Delivery_Clearance_index') }}">
                                            <span class="menu_icon"><i class="material-icons">verified_user</i></span>
                                            <span class="menu_title">Clearance</span>
                                        </a>
                                    </li>
                                    <li id="iqama_Delivery_receipient_index" class="" title="Approval">
                                        <a href="{{ route('iqama_Delivery_receipient_index') }}">
                                            <span class="menu_icon"><i class="material-icons">person</i></span>
                                            <span class="menu_title">Recipient</span>
                                        </a>
                                    </li>
                                    <li id="iqama_Delivery_acknowledgement_index" class="" title="Acknowledgement">
                                        <a href="{{ route('iqama_Delivery_acknowledgement_index') }}">
                                            <span class="menu_icon"><i class="material-icons">beenhere</i></span>
                                            <span class="menu_title">Acknowledge</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                    <li id="kafala" class="" title="kafala">
                        <a href="#">
                            <span class="menu_icon"><i class="material-icons">&#xE0AF;</i></span>
                            <span class="menu_title">Kafala</span>
                        </a>

                        <ul>

                            <li id="iqama_kafala_index" class="" title="Before 60 days">
                                <a href="{{ route('iqama_kafala_index') }}">
                                    <span class="menu_icon"><i class="material-icons" style="">update</i></span>
                                    <span class="menu_title">Before 60 days</span>
                                </a>
                            </li>
                            <li id="iqama_kafala_after_index" class="" title="Before 60 days">
                                <a href="{{ route('iqama_kafala_after_index') }}">
                                    <span class="menu_icon"><i class="material-icons" style="">update</i></span>
                                    <span class="menu_title">After 60 days</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li id="settlement" class="" title="settlement">
                        <a href="{{ route('settlement_index') }}">
                            <span class="menu_icon"><i class="material-icons">hourglass_full</i></span>
                            <span class="menu_title">Settlement</span>
                        </a>
                    </li>
                    {{--<li id="sidebar_mediccal_reports" class="" title="reports">--}}
                        {{--<a href="{{ route('medicalslip') }}">--}}
                            {{--<span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>--}}
                            {{--<span class="menu_title">Report</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li id="sidebar_gamca" class="" title="reports">--}}
                        {{--<a href="{{ route('gamca_index') }}">--}}
                            {{--<span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>--}}
                            {{--<span class="menu_title">Gamca</span>--}}

                        {{--</a>--}}
                    {{--</li>--}}


                    {{--<li id="sidebar_mofa" class="" title="reports">--}}
                        {{--<a href="{{ route('mofa') }}">--}}
                            {{--<span class="menu_icon"><i class="material-icons">flight_takeoff</i></span>--}}
                            {{--<span class="menu_title">Mofa </span>--}}
                        {{--</a>--}}
                    {{--</li>--}}


                    <!-- <li id="sidebar_flight_index" class="" title="reports">

                        <a href="{{ route('flight_index') }}">
                            <span class="menu_icon"><i class="material-icons">Flight</i></span>
                            <span class="menu_title">Flight</span>
                        </a>
                    </li> -->
                    <li id="sidebar_order_" class="" title="Docuemnt">
                        <a href="{{ route('document') }}">
                            <span class="menu_icon"><i class="material-icons">library_books</i></span>
                            <span class="menu_title">Accounts </span>
                        </a>
                        <ul>
                            <li id="sidebar_order_expense_accounts" class="" title="Docuemnt">
                                <a href="{{ route('order_expense_accounts') }}">
                                    <span class="menu_icon"><i class="material-icons">explicit</i></span>
                                    <span class="menu_title">Expense </span>
                                </a>
                            </li>

                            <li id="sidebar_order_expense_sector" class="" title="Docuemnt">
                                <a href="{{ route('order_expense_sector') }}">
                                    <span class="menu_icon"><i class="material-icons">payment</i></span>
                                    <span class="menu_title">Expense Sector </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li id="sidebar_recruit_document" class="" title="Docuemnt">
                        <a href="{{ route('document') }}">
                            <span class="menu_icon"><i class="material-icons">description</i></span>
                            <span class="menu_title">Documents </span>
                        </a>
                    </li>


                    <li id="sidebar_recruit_forms" class="" title="Money Out">

                        <a id="ticktok3" href="#">
                            <span class="menu_icon"><i class="material-icons">&#xE89C;</i></span>
                            <span class="menu_title">Forms</span>

                        </a>

                        <ul>

                            <li id="sidebar_form_basis_edit" class="" title="reports">
                                <a href="{{ route('form_basis_edit') }}">
                                    <span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>
                                    <span class="menu_title">Basic Information</span>
                                </a>
                            </li>
                            {{--<li id="medical_slip_form_index" class="" title="reports">--}}
                                {{--<a href="{{ route('medical_slip_form_index') }}">--}}
                                    {{--<span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>--}}
                                    {{--<span class="menu_title">Medical Slip</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}

                            <li id="sidebar_visaacceptance" class="" title="visaacceptance">
                                <a href="{{ route('visaacceptance') }}">
                                    <span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>
                                    <span class="menu_title">Visa Acceptance</span>
                                </a>
                            </li>
                            <li id="sidebar_agreement_index" class="" title="reports">
                                <a href="{{ route('agreement_index') }}">
                                    <span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>
                                    <span class="menu_title">Agreement</span>
                                </a>
                            </li>
                            <li id="sidebar_Objection" class="" title="reports">
                                <a href="{{ route('objection_index') }}">
                                    <span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>
                                    <span class="menu_title">No Objection</span>

                                </a>
                            </li>
                            <li id="sidebar_VLS" class="" title="reports">
                                <a href="{{ route('visa_process_index') }}">
                                    <span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>
                                    <span class="menu_title">VLS Process</span>

                                </a>
                            </li>
                            <li id="sidebar_Immigration" class="" title="reports">
                                <a href="{{ route('immigration_index') }}">
                                    <span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>
                                    <span class="menu_title">Immigration</span>

                                </a>
                            </li>
                            <li id="sidebar_note_sheet_index" class="" title="reports">
                                <a href="{{ route('note_sheet_index') }}">
                                    <span class="menu_icon"><i class="material-icons">&#xE88A;</i></span>
                                    <span class="menu_title">Note Sheet</span>

                                </a>
                            </li>
                            
                        </ul>
                    </li>

                    <li id="sidebar_customer_report" class="" title="Customer Reports">
                        <a href="{{ route('recrutereport') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE85C;</i></span>
                            <span class="menu_title">Report</span>
                        </a>
                    </li>

                </ul>

            </li>

            <li id="Hajj" class="" title="Hajj">
                <a href="#">
                    <span class="menu_icon"><i class="material-icons">&#xE0AF;</i></span>
                    <span class="menu_title">Hajj</span>
                </a>

                <ul>

                    <li id="Hajj_Police_Clearence" class="" title="Clearence">
                        <a href="{{ route('Hajj_Police_Clearence') }}">
                            <span class="menu_icon"><i class="material-icons" style="color: red">Progress</i></span>
                            <span class="menu_title">Police Clearance</span>
                        </a>
                    </li>
                    <li id="Hajj_Medicale_Certificate" class="" title="Certificate">
                        <a href="{{ route('Hajj_Medicale_Certificate') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE548;</i></span>
                            <span class="menu_title">Medical Certificate</span>
                        </a>
                    </li>
                    <li id="Hajj_Visa_Processing" class="" title="Visa">
                        <a href="{{ route('Hajj_Visa_Processing') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE7F1;</i></span>
                            <span class="menu_title">Visa Processing</span>
                        </a>
                    </li>
                    <li id="Hajj_Training" class="" title="Training">
                        <a href="{{ route('Hajj_Training') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE84E;</i></span>
                            <span class="menu_title">Training</span>
                        </a>
                    </li>

                    <li id="Hajj_GiftPack" class="" title="GiftPack">
                        <a href="{{ route('Hajj_GiftPack') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE8F6;</i></span>
                            <span class="menu_title">Gift Pack</span>
                        </a>
                    </li>
                    <li id="Hajj_Flight" class="" title="Flight">
                        <a href="{{ route('Hajj_Flight') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE905;</i></span>
                            <span class="menu_title">Flight</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li id="Umrah" class="" title="Umrah">
                <a href="#">
                    <span class="menu_icon"><i class="material-icons">&#xE84F;</i></span>
                    <span class="menu_title">Umrah</span>
                </a>

                <ul>
                    <li id="Umrah_Police_Clearence" class="" title="Clearence">
                        <a href="{{ route('Umrah_Police_Clearence') }}">
                            <span class="menu_icon"><i class="material-icons" style="color: red">Progress</i></span>
                            <span class="menu_title">Police Clearance</span>
                        </a>
                    </li>
                    <li id="Umrah_Medicale_Certificate" class="" title="Certificate">
                        <a href="{{ route('Umrah_Medicale_Certificate') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE548;</i></span>
                            <span class="menu_title">Medical Certificate</span>
                        </a>
                    </li>
                    <li id="Umrah_Visa_Processing" class="" title="Visa">
                        <a href="{{ route('Umrah_Visa_Processing') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE7F1;</i></span>
                            <span class="menu_title">Visa Processing</span>
                        </a>
                    </li>
                    <li id="Umrah_Training" class="" title="Training">
                        <a href="{{ route('Umrah_Training') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE84E;</i></span>
                            <span class="menu_title">Training</span>
                        </a>
                    </li>

                    <li id="Umrah_GiftPack" class="" title="GiftPack">
                        <a href="{{ route('Umrah_GiftPack') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE8F6;</i></span>
                            <span class="menu_title">Gift Pack</span>
                        </a>
                    </li>
                    <li id="Umrah_Flight" class="" title="Flight">
                        <a href="{{ route('Umrah_Flight') }}">
                            <span class="menu_icon"><i class="material-icons">&#xE905;</i></span>
                            <span class="menu_title">Flight</span>
                        </a>
                    </li>
                </ul>

            </li>

             <li id="sidebar_hrm" class="" title="HRM">
                <a href="#">
                    <span class="menu_icon"><i class="material-icons">&#xE407;</i></span>
                    <span class="menu_title">HRM</span>
                </a>

                <ul>

                    <li id="sidebar_hrm_view" class="" title="Logbook">
                        <a href="{{ route('reception_logbook_index') }}">
                            <span class="menu_title">Logbook</span>
                        </a>
                    </li>

                </ul>

            </li>
            <li id="sidebar_pms" class="" title="PMS">
                <a id="pms_tiktok" href="#">
                    <span class="menu_icon"> <i class="material-icons">explore</i></span>
                    <span class="menu_title">PMS</span>
                </a>

                <ul>

                    <li id="sidebar_pms_site_view" class="" title="Sites">
                        <a href="{{ route('pms_sites_index') }}">
                            <i class="material-icons">pets</i>  <span class="menu_title">Sites</span>
                        </a>
                    </li>
                    <li id="sidebar_pms_emp_view" class="" title="Employees">
                        <a href="{{ route('pms_employees_index') }}">
                            <i class="material-icons">supervisor_account</i> <span class="menu_title">Employees</span>
                        </a>
                    </li>
                    <li id="sidebar_pms_assign_site_view" class="" title="Assign sites">
                        <a href="{{ route('pms_assign_sites_index') }}">
                            <i class="material-icons">videogame_asset</i> <span class="menu_title">Assign to Site</span>
                        </a>
                    </li>
                    <li id="sidebar_pms_attendance_view" class="" title="Attendance">
                        <a href="{{ route('pms_attendance_index') }}">
                            <i class="material-icons">open_with</i> <span class="menu_title">Attendance</span>
                        </a>
                    </li>

                    <li id="sidebar_pms_payroll_settings" class="" title="Settings">
                        <a id="pms_payroll_leave_tiktok" href="#">
                            <i class="material-icons">equalizer</i> <span class="menu_title">Leave</span>
                        </a>
                        <ul>
                            <li id="pms_leave_setting" title="Leave Settings">
                                <a href="{{ route('pms_leave_settings_index') }}">
                                    <i class="material-icons">settings_power</i> <span class="menu_title">Setting</span>
                                </a>
                            </li>
                            <li id="pms_leave_assign" title="Leave Assign">
                                <a href="{{ route('pms_leave_assign_index') }}">
                                    <i class="material-icons">av_timer</i> <span class="menu_title">Assign</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="sidebar_pms_payroll" class="" title="Payroll">
                        <a id="pms_payroll_tiktok" href="#">
                            <i class="material-icons">filter_list</i> <span class="menu_title">Payroll</span>
                        </a>
                        <ul>
                            <li id="pms_setting" title="Pms Settings">
                                <a id="pms_setting_tiktok" href="#">
                                    <i class="material-icons">settings_ethernet</i> <span class="menu_title">Pms Setting</span>
                                </a>
                                <ul>
                                    <li id="pms_settings" class="" title="Pms Settings">
                                        <a href="{{ route('pms_settings_index') }}">
                                            <span class="menu_icon"><i class="material-icons">&#xE8B9;</i></span>
                                            <span class="menu_title">Settings</span>
                                        </a>
                                    </li>
                                   <li id="pms_sectors" class="" title="Pms Sector">
                                        <a href="{{ route('pms_sectors_index') }}">
                                            <span class="menu_icon"><i class="material-icons">blur_linear</i></span>
                                            <span class="menu_title">Sectors</span>
                                        </a>
                                    </li>
                                    <li id="pms_company" class="" title="Pms Payroll Company">
                                        <a href="{{ route('pms_payroll_company_index') }}">
                                            <span class="menu_icon"><i class="material-icons">show_chart</i></span>
                                            <span class="menu_title">Company</span>
                                        </a>
                                    </li> 
                                </ul>
                            </li>
                            <li id="pms_assign" title="Pms Assign">
                                <a id="pms_assign_tiktok" href="#">
                                    <i class="material-icons">timeline</i> <span class="menu_title">Assign</span>
                                </a>
                                <ul>
                                   <li id="pms_assign_allowance" class="" title="Pms Allowance">
                                        <a href="{{ route('pms_assign_allowance_index') }}">
                                            <span class="menu_icon"><i class="material-icons">multiline_chart</i></span>
                                            <span class="menu_title">Allowance</span>
                                        </a>
                                    </li>
                                    <li id="pms_assign_deduction" class="" title="Pms Deduction">
                                        <a href="{{ route('pms_assign_deduction_index') }}">
                                            <span class="menu_icon"><i class="material-icons">power_input</i></span>
                                            <span class="menu_title">Deduction</span>
                                        </a>
                                    </li> 
                                </ul>
                            </li>
                            <li id="pms_payroll_sheet" title="Pms Payroll Sheet">
                                <a href="{{ route('pms_payroll_sheet_index') }}">
                                    <i class="material-icons">av_timer</i> <span class="menu_title">Sheet</span>
                                </a>
                            </li>
                            <li id="pms_payroll_payslip" title="Pms Payroll Payslip">
                                <a href="{{ route('pms_payroll_payslip_index') }}">
                                    <i class="material-icons">av_timer</i> <span class="menu_title">Payslip</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="sidebar_pms_invoice" class="" title="Invoice">
                        <a href="{{ route('pms_invoice_index') }}">
                            <i class="material-icons">open_with</i> <span class="menu_title">Invoice</span>
                        </a>
                    </li>
                    <li id="sidebar_pms_payroll_Expense" class="" title="Expense">
                        <a id="pms_expense_tiktok" href="#">
                            <i class="material-icons">&#xE01E;</i> <span class="menu_title">Expense</span>
                        </a>
                        <ul>
                            <li id="sidebar_pms_expense_list" title="PMS Expense">
                                <a href="{{ route('pms_expense_sector_index') }}">
                                    <i class="material-icons">dialpad</i> <span class="menu_title">Sector</span>
                                </a>
                            </li>
                            <li id="sidebar_pms_expense_list_2" title="PMS Expense Sector">
                                <a href="{{ route('pms_expense_index') }}">
                                    <i class="material-icons">&#xE01E;</i> <span class="menu_title">Expense</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="sidebar_pms_report" class="" title="Pms Report ">
                        <a href="{{ route('pms_report_all') }}">
                            <i class="material-icons">&#xE1B8;</i> <span class="menu_title">Report</span>
                        </a>
                    </li>
                    
                </ul>

            </li>


        @endif
    @endif


        </ul>
    </div>
</aside>
<!-- main sidebar end -->