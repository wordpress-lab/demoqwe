@extends('layouts.main')

@section('title', 'MedicalSlip')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    @if(Session::has('msg'))
        <div class="uk-alert uk-alert-success" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            {!! Session::get('msg') !!}
        </div>
    @endif
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_content">
                            <div class="uk-overflow-container uk-margin-bottom">
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Serial</th>
                                        <th>Pax ID</th>
                                        <th>Medical Centre Name</th>
                                        <th>Status</th>
                                        <th>Testdate</th>
                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Serial</th>
                                        <th>Pax ID</th>
                                        <th>Medical Centre Name</th>
                                        <th>Status</th>
                                        <th>Testdate</th>

                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection

@section('scripts')
    <script>
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_recruit_dashboard').addClass('act_item');
    </script>
@endsection