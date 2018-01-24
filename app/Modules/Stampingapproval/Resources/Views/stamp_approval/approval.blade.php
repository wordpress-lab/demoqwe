@extends('layouts.main')

@section('title', 'Owner Approval')

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
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Owner Approval</span></h2>

                            </div>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-5 uk-vertical-align">
                            <label class="uk-vertical-align-middle" for="company_name">Visa Category<i style="color:red" class="material-icons">stars</i></label>
                        </div>
                        <div class="uk-width-medium-2-5">
                            <select data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Company Name" id="company_name" name="visa_category_id">
                                    @if($recruit->visa_type == 1)
                                    <option value="3" {{ $recruit->visa_category_id==3?'selected':'' }}>Processing Visa</option>
                                    @elseif($recruit->visa_type == 0)
                                    <option value="1" {{ ($recruit->visa_category_id==1 || $recruit->visa_category_id==Null)?'selected':'' }}>Company Visa (Free)</option>
                                    <option value="2" {{ $recruit->visa_category_id==2?'selected':'' }}>Company Visa (Contact)</option>
                                    @endif
                            </select>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-5 uk-vertical-align">
                            <label class="uk-vertical-align-middle" for="company_name">Remarks</label>
                        </div>
                        <div class="uk-width-medium-2-5">
                            <label for="remarks">Write Remarks</label>
                            <input class="md-input" type="text" id="remarks" name="remarks" value="{{ empty($recruit->stamp_approval['remarks'])?$recruit->remarks:$recruit->stamp_approval['remarks'] }}"/>
                        </div>
                    </div>

                    <div class="uk-grid" style="padding-top: 50px">
                        <div class="uk-width-1-1">
                            <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
                                <div>
                                    <button id="approval_yes" class="md-btn md-btn-facebook md-btn-large md-btn-block md-btn-icon"><i class="material-icons">&#xE876;</i>Yes</button>
                                </div>
                                <div>
                                    <button id="approval_no" class="md-btn md-btn-gplus md-btn-large md-btn-block md-btn-icon"><i class="material-icons">&#xE14C;</i>No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-2">
                    <div class="uk-form-row">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <label>Passenger Name:</label>       
                            </div>
                            <div class="uk-width-medium-1-2">
                                <label>{{ $recruit->passenger_name }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-medium-1-2">
                    <div class="uk-form-row">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <label>Pax Id:</label>       
                            </div>
                            <div class="uk-width-medium-1-2">
                                <label>{{ $recruit->paxid }}</label>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-2">
                    <div class="uk-form-row">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <label>Passport Number:</label>       
                            </div>
                            <div class="uk-width-medium-1-2">
                                <label>{{ $recruit->passportNumber }}</label>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-medium-1-2">
                    <div class="uk-form-row">
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                                <label>Reference Name:</label>       
                            </div>
                            <div class="uk-width-medium-1-2">
                                <label>{{ $recruit->customer['display_name']}}</label>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>

            <h2 style="text-decoration: underline;">Reference Excess Payments</h2>

            <div class="user_content">
                <div class="uk-overflow-container uk-margin-bottom">
                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                    <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Payment</th>
                            <th>Reference</th>
                            <th>Amount</th>
                            <th>Unused Amount</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Payment</th>
                            <th>Reference</th>
                            <th>Amount</th>
                            <th>Unused Amount</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>

                        <tbody>
                            @foreach($payment_receive as $all)
                            <tr>
                                <td>{{ $all->payment_date }}</td>
                                <td>PR-{{ str_pad($all->pr_number, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $all->reference }}</td>
                                <td>{{ $all->amount }}</td>
                                <td>{{ $all->excess_payment }}</td>
                                <td class="uk-text-left" style="white-space:nowrap !important;">
                                    <a href="{{ route('payment_received_show', ['id' => $all->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="material-icons">visibility</i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#sidebar_recruit').addClass('current_section');
        $('#visa_stamp_approval').addClass('act_item');
        

        $('.delete_btn').click(function () {
            var id = $(this).next('.mofa_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this! If you delete this Mofa all record will be deleted related to this MOFA",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "{{ route('fit_card_delete') }}"+"/"+id;
            })
        })

        $('#company_name').on('change',function(){
            var company_id = $(this).val();
            
            var remarks = $('#remarks').val();

            if(remarks == ""){
                var approval_yes = $('#approval_yes').attr("href").split('?')[0];

                approval_yes = approval_yes+"?company_id="+company_id;
                $('#approval_yes').attr("href",approval_yes);

                var approval_no = $('#approval_no').attr("href").split('?')[0];

                approval_no = approval_no+"?company_id="+company_id;
                $('#approval_no').attr("href",approval_no);
            }
            else{
                var approval_yes = $('#approval_yes').attr("href").split('?')[0];

                approval_yes = approval_yes+"?company_id="+company_id+"?remrks="+remarks;
                $('#approval_yes').attr("href",approval_yes);

                var approval_no = $('#approval_no').attr("href").split('?')[0];

                approval_no = approval_no+"?company_id="+company_id+"?remrks="+remarks;
                $('#approval_no').attr("href",approval_no);
            }
            

        })

        $('#approval_yes').on('click',function(){
            var company_id = $('#company_name').val();
            
            var remarks = $('#remarks').val();

            if(remarks == ""){
                window.location.replace("{{ route('stamp_approval_confirm',['id'=>'']) }}/"+{{$recruit->id}}+"?company_id="+company_id);
            }
            else{
                window.location.replace("{{ route('stamp_approval_confirm',['id'=>'','remarks'=>'']) }}/"+{{$recruit->id}}+"/"+remarks+"?company_id="+company_id);
            }
            
        })

        $('#approval_no').on('click',function(){
            var company_id = $('#company_name').val();
            
            var remarks = $('#remarks').val();

            if(remarks == ""){
                window.location.replace("{{ route('stamp_approval_not_confirm',['id'=>'']) }}/"+{{$recruit->id}}+"?company_id="+company_id);
            }
            else{
                window.location.replace("{{ route('stamp_approval_not_confirm',['id'=>'','remarks'=>'']) }}/"+{{$recruit->id}}+"/"+remarks+"?company_id="+company_id);
            }
            
        })


        window.onload = function(){

            var select_company_id = '{{ is_null($recruit->visa_category_id)?1:$recruit->visa_category_id }}';

            var approval_yes = $('#approval_yes').attr("href");

            approval_yes = approval_yes+"?company_id="+select_company_id;
            $('#approval_yes').attr("href",approval_yes);

            var approval_no = $('#approval_no').attr("href");

            approval_no = approval_no+"?company_id="+select_company_id;
            $('#approval_no').attr("href",approval_no);
        };
    </script>
@endsection
