@extends('layouts.main')

@section('title', 'BackUp DB')

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
                    @if(session()->has('msg'))

                        <div class="uk-alert uk-alert-{{ session('status') }}" data-uk-alert>
                            <a href="" class="uk-alert-close uk-close"></a>
                            <p>{{ session('msg') }}</p>
                        </div>
                    @endif
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">

                                <h2 class="heading_b"><span class="uk-text-truncate">DB Backup List</span></h2>
                            </div>
                        </div>

                        <div class="user_content">

                            <div class="uk-overflow-container uk-margin-bottom">
                                <a class="md-btn md-btn-primary md-btn-large md-btn-wave-light md-btn-icon" style="float: right" href="{{ route('backup_create') }}">
                                    <i class="material-icons">file_download</i>
                                    Create Backup
                                </a>
                                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>

                                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date Of Backup</th>
                                        <th>User Name</th>
                                        <th>Last Downloaded By</th>

                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Date Of Backup</th>
                                        <th>User Name</th>
                                        <th>Last Downloaded By</th>

                                        <th class="uk-text-center">Action</th>
                                    </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $count = 1; ?>
                                    @foreach($backup as $value)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ $value->createdBy->name }}</td>
                                            <td>{{ $value->updatedBy->name }}</td>

                                            <td class="uk-text-center">
                                                <a href="{{ route('backup_download',['id' => $value->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Download" class="material-icons">file_download</i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Add branch plus sign -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')



    <script type="text/javascript">
        $('#settings_menu_backup').addClass('md-list-item-active');
    </script>
@endsection


