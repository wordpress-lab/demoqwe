@extends('layouts.main')

@section('title', 'Opening Balance ')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-xLarge-2-10 uk-width-large-2-10">
                    <div class="md-list-outside-wrapper">
                        @include('inc.settings_menu')
                    </div>
                </div>
                <div class="uk-width-large-8-10">
                    <div class="md-card">
                        <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Opening Balance</span></h2>


                            </div>
                        </div>

                        {{--<div class="uk-grid">--}}
                            {{--<div class="uk-width-medium-1-1 uk-vertical-align" style="text-align: center;margin-top:2px;">--}}

                                {{--<a class="md-btn md-btn-danger md-btn-block md-btn-wave-light" href="{{ route('setting_openingbalance_delete') }}">Delete</a>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="user_content">
                            <div class="uk-margin-top">
                                 {{--{!!  Form::open(['url' => route('setting_openingbalance_edit',200), 'method' => 'POST']) !!}--}}
                                <div class="uk-grid" data-uk-grid-margin style="border: 10px solid #e0e0e0; width: 90%; margin-left: 8px; background-color: #e0e0e0">
                                    <div class="uk-width-medium-2-5 uk-vertical-align" style="text-align: right">

                                        <label for="tax_name" class="uk-vertical-align-middle">Opening Balance Date</label>
                                    </div>
                                    <div class="uk-width-medium-2-5">
                                        <br/>
                                        <label for="tax_name">Opening Balance Date</label>
                                        <input class="md-input" type="text" id="balance_date" name="balance_date" value="{{ $balance->openningBalanceDate }}" data-uk-datepicker="{format:'YYYY-MM-DD'}" required>

                                    </div>
                                </div>
                                <br/>
                                <div class="uk-grid" style="margin: 0 auto">
                                   <table class="uk-table"  cellspacing="0" width="80%" style="text-align: center;">
                                       <tr style="background-color: #00A000; border-left: 0px solid white; border-right: 40px solid white;color: white">
                                           <th width="40%">Accounts</th>
                                           <th width="30%" >Debit(BDT)</th>
                                           <th width="30%" >Credit(BDT)</th>
                                       </tr>
                                   <tbody id="accountlist" onmouseover="total_debit_credit()">
                                       @foreach($journal_up as $value)

                                           <tr>
                                               <td width="40%">{{ $value->account->account_name }}</td>
                                               @if($value->debit_credit==1)
                                               <td width="30%"><input onkeypress='return event.charCode==46 || event.charCode >= 48 && event.charCode <= 57' onkeyup="accountcheck(this)" onchange="accountcheck(this)" style="size: 10px;padding: 5px;direction: rtl;" type="text" value="{{ $value->amount?$value->amount:''  }}"  id="{{ $value->id }}_dbt" name="{{ $value->id }}_dbt" ></td>
                                               <td width="30%"><input onkeypress='return event.charCode==46 || event.charCode >= 48 && event.charCode <= 57' onkeyup="accountcheck(this)" onchange="accountcheck(this)"  style="size: 10px; padding: 5px;direction: rtl;"type="text" value="" id="{{ $value->id }}_crt" name="{{ $value->id }}_crt" ></td>
                                               @endif
                                               @if($value->debit_credit==0)
                                                   <td width="30%"><input onkeyup="accountcheck(this)" onchange="accountcheck(this)" style="size: 10px;padding: 5px;direction: rtl;" type="text" value=""  id="{{ $value->id }}_dbt" name="{{ $value->id }}_dbt" ></td>
                                                   <td width="30%"><input  onkeyup="accountcheck(this)" onchange="accountcheck(this)"  style="size: 10px; padding: 5px;direction: rtl;"type="text" value="{{ $value->amount?$value->amount:'' }}" id="{{ $value->id }}_crt" name="{{ $value->id }}_crt" ></td>
                                               @endif
                                           </tr>


                                       @endforeach
                                   </tbody>
                                   </table>
                                    <table class="uk-table" cellspacing="0" width="80%" id="data_table" style="text-align: center;">
                                       <tr style="background-color: #e0e0e0; padding: 10px; margin: 5px; color: black">
                                           <td width="35%" style="text-align: center">Total</td>
                                           <td width="35%" id="totaldebit">0</td>
                                           <td width="30%" id="totalcedit">0</td>
                                       </tr>
                                       <tr style="padding: 10px; margin: 5px; color: black">
                                           <td width="40%" style="text-align: right">Opening Balance Adjustments</td>

                                           <td width="30%" ><input type="text" id="adjustdebit" value="{{ $adjustment_debit_credit==1?$adjustment_amount:'' }}" name="{{ $adjustment_id?$adjustment_id:'7' }}_dbt" style="direction: rtl; border:none;" />(BDT)</td>
                                           <td width="30%" ><input type="text" size="15" id="adjustcredit" value="{{ $adjustment_debit_credit==0?$adjustment_amount:'' }}" name="{{ $adjustment_id }}_crt" style="direction: rtl; border:none;" />(BDT)</td>
                                       </tr>
                                   </table>
                                </div>
                            <!--
                               <div class="uk-grid">
                                    <div class="uk-width-1-1 uk-float-right">
                                        <button type="submit"  class="md-btn md-btn-primary" >Submit</button>
                                        <button type="submit"  class="md-btn md-btn-flat uk-modal-close">Close</button>
                                    </div>
                                </div>
                                -->

                                {{--{!!  Form::close() !!}--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
       function accountcheck(row) {
           var thisrow = row.id;
           var type = thisrow.split("_");
          if(type[1]=="crt"){
              var crt = thisrow.split("_")[0];
              var rowvalue=type[0]+"_"+"dbt";
              var data =  document.getElementById(rowvalue).value='';

          }else{
              var dbt = thisrow.split("_")[0];
              var rowvalue=type[0]+"_"+"crt";
              var data =  document.getElementById(rowvalue).value='';
             // console.log(dbt);
          }
           total_debit_credit();
       }

     function total_debit_credit()
     {
       //var debit = document.getElementById('accountlist');
         var theTbl = document.getElementById('accountlist');
         var len = theTbl.rows.length;
         var dbtsum = 00;
         var crtsum = 00;
         // console.log(theTbl.rows[2].cells[1].children[0].value);
         for(var i=0;i<len;i++)
         {
            var debt = theTbl.rows[i].cells[1].children[0].value;
            var crt = theTbl.rows[i].cells[2].children[0].value;

             dbtsum =dbtsum+(parseFloat(debt) || 0);
             crtsum = crtsum+(parseFloat(crt) || 0);
         }

         document.getElementById("totaldebit").innerText = dbtsum;
         document.getElementById("totalcedit").innerText = crtsum;

         if(dbtsum>crtsum)
         {
             var credit= dbtsum- crtsum;
             document.getElementById("adjustdebit").value = '';
             document.getElementById("adjustcredit").value = credit;


         }else{
             var debit= crtsum-dbtsum;
             document.getElementById("adjustcredit").value = '';
             document.getElementById("adjustdebit").value = debit;
         }
     }
    </script>
    <script type="text/javascript">
        $('#settings_menu_openingbalance').addClass('md-list-item-active');
    </script>
@endsection