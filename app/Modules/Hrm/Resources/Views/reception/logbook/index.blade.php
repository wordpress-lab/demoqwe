@extends('layouts.main')

@section('title', 'Reception Logbook')

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
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Category</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{route('reception_category_index')}}">All Category</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
@section('content')
@if(Session::has('message'))
    <div class="uk-alert uk-alert-success" data-uk-alert="">
        <a href="#" class="uk-alert-close uk-close"></a>
        {{ Session::get('message') }}
    </div>
@endif
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <form action="" class="uk-form-stacked" id="user_edit_form">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Reception Logbook</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-overflow-container uk-margin-bottom">
                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                    <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Contact Name</th>
                                            <th>Organization Name</th>
                                            <th>Meeting Date</th>
                                            <th>Updated By</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Contact Name</th>
                                            <th>Organization Name</th>
                                            <th>Meeting Date</th>
                                            <th>Updated By</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </tfoot>

                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($category as $all)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>Log-00000{{ $all->id }}</td>
                                                <td>{{ $all->categoryId->name }}</td>
                                                <td>{{ $all->name!=Null?$all->name:'No Contact Name' }}</td>
                                                <td>{{ $all->organization_name!=Null?$all->organization_name:'No Organization Name' }}</td>
                                                <td>{{ date('d-m-Y', strtotime($all->meeting_date)) }} , {{ $all->meeting_time }}</td>
                                                <td>{{ $all->updatedBy->name }}</td>
                                                <td class="uk-text-center">

                                                    <a href="{{ route('reception_logbook_show', $all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">visibility</i></a>
                                                    <a href="{{ route('reception_logbook_edit', $all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                    <input class="inventory_id" type="hidden" value="{{ route('reception_logbook_delete',$all->id) }}">

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Add branch plus sign -->
                                <div class="md-fab-wrapper branch-create">
                                <a id="add_branch_button" href="{{ route('reception_logbook_create') }}" class="md-fab md-fab-accent branch-create">
                                    <i class="material-icons">&#xE145;</i>
                                </a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection


@section('scripts')
    
    <script>
        $('.delete_btn').click(function () {
            var url = $(this).next('.inventory_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = url;
            })
        })
    </script>
    
    <script type="text/javascript">
        $('#sidebar_hrm').addClass('current_section');
        $('#sidebar_hrm_view').addClass('act_item');

        $(window).load(function(){
            $("#tiktok6").trigger('click');
        })
    </script>

@endsection
