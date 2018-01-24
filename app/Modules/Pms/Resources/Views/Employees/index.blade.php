@extends('layouts.main')

@section('title', 'Pms Employees')

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
                                <h2 style="color:white" class="heading_b"><span class="uk-text-truncate">All Employees</span></h2>
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>

                        </div>

                        @php
                            $i=1;
                        @endphp


                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Site Name</th>
                                        <th>Code Name</th>
                                        <th>Employee Name</th>
                                        <th>Nationality</th>
                                        <th>Passport Number</th>
                                        <th>Mobile Number</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Site Name</th>

                                        <th>Code Name</th>

                                        <th>Employee Name</th>
                                        <th>Nationality</th>
                                        <th>Passport Number</th>
                                        <th>Mobile Number</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    @foreach($employees as $value)

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td style="white-space:nowrap !important;">{{ $value->site["company_name"] }}</td>
                                            <td>EMP-{{ $value->code_name }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->nationality }}</td>
                                            <td>{{ $value->passport_number }}</td>





                                            <td>{{ $value->mobile_number  }}</td>

                                            <td class="uk-text-right" style="white-space:nowrap !important;">

                                                @if(is_file($value->photo_url) || is_file($value->passport_url) || is_file($value->iqama_url))
                                                    <div class="uk-button-dropdown" data-uk-dropdown="{pos:'left-center'}">
                                                        <button class="md-btn">Attached File<i class="material-icons">&#xE313;</i></button>
                                                        <div class="uk-dropdown">
                                                            <ul class="uk-nav uk-nav-dropdown">

                                                                <p title="see below" class="md-bg-green-500" style="text-align: right; padding: 10px; color: white">Download File <i style="color: white" class="material-icons">&#xE2C4;</i></p>


                                                                <hr/>
                                                                @if(is_file($value->photo_url))
                                                                    <li>
                                                                        <a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('pms_employees_download',['id'=>$value->id,'type'=>'photo_url']) }}">Photo</a>

                                                                    </li>
                                                                @endif
                                                                @if(is_file($value->passport_url))
                                                                    <li>
                                                                        <a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('pms_employees_download',['id'=>$value->id,'type'=>'passport_url']) }}">Passport</a>

                                                                    </li>
                                                                @endif
                                                                @if(is_file($value->iqama_url))
                                                                    <li>
                                                                        <a title="open file" style="text-transform: capitalize" target="_blank" href="{{ route('pms_employees_download',['id'=>$value->id,'type'=>'iqama_url']) }}">Iqama</a>

                                                                    </li>
                                                                @endif



                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif

                                                <a href="{{ route('pms_employees_edit', ['id' => $value->id]) }}">
                                                    <i data-uk-tooltip="{pos:'top'}" title="Edit" style="font-size: 23px;" class="material-icons">&#xE254;</i>
                                                </a>
                                                @if(empty($value->site_name)|| is_null($value->site_name))
                                                <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="material-icons">&#xE872;</i></a>
                                                <input type="hidden" class="sites_id" value="{{ $value->id }}">
                                                @endif

                                            </td>
                                        </tr>

                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->

                            <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('pms_employees_create') }}" class="md-fab md-fab-accent branch-create">
                                    <i class="material-icons">&#xE145;</i>
                                </a>
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
        $('#sidebar_pms').addClass('current_section');
        $('#sidebar_pms_emp_view').addClass('act_item');
        $('.delete_btn').click(function () {
            var id = $(this).next('.sites_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "{{ route('pms_employees_destory') }}"+"/"+id;
            })
        })
    </script>
@endsection
