@extends('layouts.main')

@section('title', 'Contact')

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
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Contact</span></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('contact_create') }}">Create Contact</a></li>
                        <li><a href="{{ route('contact') }}">All Contact </a></li>
                    </ul>
                </div>
            </li>

            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Category</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        {{--<li><a href="{{ route('category_create') }}">Create Category</a></li>--}}
                        <li><a href="{{ route('category') }}">All Category</a></li>
                    </ul>
                </div>
            </li>
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Search By Category</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                    <li><a href="{{ route('contact') }}">All Contact</a></li>
                    @foreach($contactCategories as $contactCategory)
                        <li><a href="{{ route('contact_search', ['id' => $contactCategory->id]) }}">{{ $contactCategory->contact_category_name }}</a></li>
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
            <form action="" class="uk-form-stacked" id="user_edit_form">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Contact List</span></h2>
                                    <a class="md-fab md-fab-primary md-bg-deep-orange-400" href="{{ route('contact_pdf') }}"><i class="material-icons">picture_as_pdf</i></a>
                                </div>
                                
                            </div>
                            

                            <div class="user_content">
                                <div class="uk-overflow-container uk-margin-bottom">

                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>

                                    <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Name</th>
                                            <th>Display Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Category</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                           <th>Name</th>
                                            <th>Display Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Category</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </tfoot>
                                        <?php $i=1; ?>
                                        <tbody>
                                        @foreach($contacts as $contact)

                                            <tr>
                                                <td>{!! $i++ !!}</td>
                                                <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                                                <td>{{ $contact->display_name }}</td>
                                                <td>{{ $contact->email_address }}</td>
                                                <td>{{ $contact->phone_number_1 }}</td>
                                                <td>{{ $contact->contactCategory->contact_category_name }}</td>
                                                <td class="uk-text-center">
                                                    <a href="{{ route('contact_view',['id'=>$contact->id])}}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">&#xE8F4;</i></a>
                                                    <a href="{{ url('contact/edit'.'/'.$contact->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                    <input class="category_id" type="hidden" value="{{ $contact->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{--@foreach($agents as $agent)--}}
                                            {{--<tr>--}}
                                               {{--<td> {!! $i++ !!}</td>--}}
                                                {{--<td>{{ $agent->first_name }} {{ $agent->last_name }}</td>--}}
                                                {{--<td>{{ $agent->display_name }}</td>--}}
                                                {{--<td>{{ $agent->email_address }}</td>--}}
                                                {{--<td>{{ $agent->phone_number_1 }}</td>--}}
                                                {{--<td>Agent</td>--}}
                                                {{--<td class="uk-text-center">--}}
                                                    {{--<a href="{{ route('contact_view_agent',['id'=>$agent->id])}}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">&#xE8F4;</i></a>--}}
                                                    {{--<a href="{{ url('contact/edit-agent'.'/'.$agent->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>--}}
                                                    {{--<a class="agent_delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>--}}
                                                    {{--<input class="agent_id" type="hidden" value="{{ $agent->id }}">--}}
                                                {{--</td>--}}
                                            {{--</tr>--}}
                                        {{--@endforeach--}}
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Add branch plus sign -->

                                <div class="md-fab-wrapper branch-create">
                                    <a id="add_branch_button" href="{{ route('contact_create') }}" class="md-fab md-fab-accent branch-create">
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
            var id = $(this).next('.category_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/contact/remove/"+id;
            })
        })
    </script>

    <script>
        $('.agent_delete_btn').click(function () {
            var id = $(this).next('.agent_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/contact/remove-agent/"+id;
            })
        })
    </script>

    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_contact').addClass('act_item');
        
    </script>
@endsection