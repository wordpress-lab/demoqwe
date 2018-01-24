@extends('layouts.main')

@section('title', 'Access Level')

@section('header')
@include('inc.header')
@endsection

@section('sidebar')
@include('inc.sidebar')
@endsection

@section('content')

<div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
    <div class="uk-width-large-10-10">
        <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
            <div class="uk-width-xLarge-2-10 uk-width-large-2-10">
                <div class="md-list-outside-wrapper">
                    @include('inc.settings_menu')
                </div>
            </div>
            <div class="uk-width-xLarge-8-10  uk-width-large-8-10">
                <div class="md-card">
                    <div class="user_heading">
                        <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        </div>
                        <div class="user_heading_content">
                            <h2 class="heading_b"><span class="uk-text-truncate">User List</span></h2>
                        </div>
                    </div>
                    <div class="user_content">
                        <div class="uk-overflow-container uk-margin-bottom">
                            <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                            <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Access Level</th>
                                    <th class="uk-text-center">Action</th>
                                </tr>
                                </thead>

                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Access Level</th>
                                    <th class="uk-text-center">Action</th>
                                </tr>
                                </tfoot>

                                <tbody>
                                <?php $count = 1; ?>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->userRole->name }}</td>
                                        <td class="uk-text-center">
                                            <a href="{{ route('user_role',['id' => $user->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Change Role" class="md-icon material-icons">&#xE32A;</i></a>
                                            <a href="{{ route('user_password',['id' => $user->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Password Change" class="md-icon material-icons">&#xE0DA;</i></a>
                                            <a href="{{ route('user_edit',['id' => $user->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit User" class="md-icon material-icons">&#xE254;</i></a>
                                            <a class="delete_btn" href="#"><i data-uk-tooltip="{pos:'top'}" title="Delete User" class="md-icon material-icons">&#xE872;</i></a>
                                            <input type="" name="" id="user_id" value="{{$user->id}}" class="hidden">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Add branch plus sign -->

                        <div class="md-fab-wrapper branch-create">
                            <a id="add_branch_button" href="{{ route('user_create') }}" class="md-fab md-fab-accent branch-create">
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
    <script type="text/javascript">
        $('#settings_menu_users').addClass('md-list-item-active');
    </script>

    <script>
        $('.delete_btn').click(function () {
            var id = $(this).next('#user_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/settings/users/delete/"+id;
            })
        })
    </script>
@endsection