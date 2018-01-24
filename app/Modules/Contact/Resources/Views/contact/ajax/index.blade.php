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
<script>
    function contactRemove(row){
        var id = $(row).next('.category_id').val();
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
    }
</script>
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
                                    <div class="spinner"></div>
                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>

                                    <table class="uk-table" cellspacing="0" width="100%" id="data_table_1" >
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
        var all_contact_list = "{{ route("contact_api_get_all_contact_list") }}";
        var all_contact_view = "{{ route('contact_view',["id"=>'']) }}";
        var all_contact_edit = "{{ route('contact_edit',["id"=>'']) }}";
        window.onload = function () {
            $.get(all_contact_list,function (datalist) {
                var data = [];

                $.each(datalist, function(k, v) {
                    data.push([++k,v.first_name+" " +v.last_name, v.display_name, v.email_address,v.phone_number_1,v.contact_category_name,v.id ] );
                });



                $('#data_table_1').DataTable({
                    "pageLength": 50,
                    data:           data,
                    deferRender:    true,
                    "columnDefs": [
                        {
                            "targets": 6,
                            "render": function ( link, type, row ) {
                                var contact_url = "<a target='_blank' href="+all_contact_view+"/"+link+">"+'<i data-uk-tooltip="{pos:\'top\'}" title="View" class="md-icon material-icons">&#xE8F4;</i>'+"</a>";
                                contact_url+="<a target='_blank' href="+all_contact_edit+"/"+link+">"+'<i data-uk-tooltip="{pos:\'top\'}" title="Edit" class="md-icon material-icons">&#xE254;</i>'+"</a>";
                                contact_url+='<a onclick="contactRemove(this)" class="delete_btn"><i data-uk-tooltip="{pos:\'top\'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>';
                                contact_url+='<input class="category_id" type="hidden" value="'+link+'">';
                                return contact_url ;
                               // return link;
                            }
                        }
                    ]
                });
                $(".spinner").remove();
            });


        };
    </script>
@endsection