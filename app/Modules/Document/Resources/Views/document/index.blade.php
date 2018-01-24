@extends('layouts.admin')

@section('title', 'All document')

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
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Document</span></a>
            </li>

            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Category</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('document_category_create') }}">Create Category</a></li>
                        <li><a href="{{ route('document_category') }}">All Category</a></li>
                    </ul>
                </div>
            </li>
            @inject('Categories', 'App\Lib\Category')
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Search By Category</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('document') }}">All Document</a></li>
                        @foreach($Categories->getlist() as $documentCategory)
                            <li><a href="{{ route('document_category_search', ['id' => $documentCategory->id]) }}">{{ $documentCategory->categoryName }}</a></li>
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
                                    <h2 class="heading_b"><span class="uk-text-truncate">Document List</span></h2>
                                </div>

                            </div>

                            <?php
                            $i=1;
                           ?>
                            <div class="user_content">
                                <div class="uk-overflow-container uk-margin-bottom">
                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                    <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Created At</th>
                                            <th>Category</th>
                                            <th>Pax Id</th>
                                            <th>title</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Created At</th>
                                            <th>Category</th>
                                            <th>Pax Id</th>
                                            <th>title</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </tfoot>

                                        <tbody>
                                        @foreach($document as $contact)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $contact['created_at'] }}</td>
                                                <td>{{ $contact->Category['categoryName'] }}</td>
                                                <td>{{ $contact->Pax['paxid'] }}</td>
                                                <td>{{ $contact['title'] }}</td>
                                                <td class="uk-text-center">
                                                    <a download href="{{ URL::to($contact['file_url'])  }}" target="_blank"> <i class="material-icons">file_download</i></a>
                                                    <a href="{{ route('document_edit',['id'=>$contact['id']])}}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                    <input class="category_id" type="hidden" value="{{ $contact['id'] }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Add branch plus sign -->

                                {{--<div class="md-fab-wrapper branch-create">--}}
                                    {{--<a id="add_branch_button" href="{{ route('document_create',0) }}" class="md-fab md-fab-accent branch-create">--}}
                                        {{--<i class="material-icons">&#xE145;</i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
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
                window.location.href = "{{ route('document_delete') }}"+"/"+id;
            })
        })
    </script>

    <script type="text/javascript">
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_recruit_document').addClass('act_item');
    </script>
@endsection