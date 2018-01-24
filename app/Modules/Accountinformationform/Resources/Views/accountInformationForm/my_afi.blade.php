@extends('layouts.main')

@section('title', 'Account Information Form')

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
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Inventory</span></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{route('inventory_create')}}">Create Inventory</a></li>
                        <li><a href="{{route('inventory')}}">All Inventory</a></li>
                    </ul>
                </div>
            </li>

            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Category</span></a>
                <div class="uk-dropdown uk-dropdown-scrollable">
                    <ul class="uk-nav uk-nav-dropdown">
                        {{--<li><a href="{{route('inventory_category_create')}}">Create Category</a></li>--}}
                        <li><a href="{{route('inventory_category')}}">All Category</a></li>
                    </ul>
                </div>
            </li>
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="{{route('stock_create')}}"><i class="material-icons">&#xE02E;</i><span>Add Stock</span></a>
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
                                    <h2 class="heading_b"><span class="uk-text-truncate">My Account Information Form</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-overflow-container uk-margin-bottom">
                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                    <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Form ID</th>
                                            <th>Representative Name</th>
                                            <th>Purchaser Name</th>
                                            <th>Updated By</th>
                                            <th>Created At</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Form ID</th>
                                            <th>Representative Name</th>
                                            <th>Purchaser Name</th>
                                            <th>Updated By</th>
                                            <th>Created At</th>
                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </tfoot>

                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($information as $all)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>AIF-00000{{ $all->id }}</td>
                                                <td>{{ $all->user->name }}</td>
                                                <td>{{ $all->purchaser_name }}</td>
                                                <td>{{ $all->updatedBy->name }}</td>
                                                <td>{{ $all->created_at }}</td>
                                                <td class="uk-text-center">

                                                    <a href="{{ route('aif_show', $all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">visibility</i></a>
                                                    <a href="{{ route('aif_edit', $all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                    <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                    <input class="inventory_id" type="hidden" value="{{ route('aif_delete',$all->id) }}">

                                                    <a href="{{ route('aif_pdf', $all->id) }}"><i data-uk-tooltip="{pos:'top'}" title="PDF" class="md-icon material-icons">picture_as_pdf</i></a>

                                                    @if($all->signature_of_executive === NULL)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Execuitive" class="md-icon material-icons">filter_1</i>
                                                    @elseif($all->signature_of_executive === 1)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Execuitive" class="md-icon material-icons" style="color: green;">filter_1</i>

                                                    @elseif($all->signature_of_executive === 0)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Execuitive" class="md-icon material-icons" style="color: red;">filter_1</i>
                                                    @endif

                                                    @if($all->signature_of_manager === 1)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Manager" class="md-icon material-icons" style="color: green;">filter_2</i>
                                                    @elseif($all->signature_of_manager === 0)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Manager" class="md-icon material-icons" style="color: red;">filter_2</i>
                                                    @elseif($all->signature_of_manager===NULL)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Manager" class="md-icon material-icons">filter_2</i>
                                                    @endif

                                                    @if($all->signature_of_account===1)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Account" class="md-icon material-icons" style="color: green;">filter_3</i>
                                                    @elseif($all->signature_of_account===0)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Account" class="md-icon material-icons" style="color: red;">filter_3</i>
                                                    @elseif($all->signature_of_account===NULL)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Account" class="md-icon material-icons">filter_3</i>
                                                    @endif

                                                    @if($all->signature_of_admin===1)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Admin" class="md-icon material-icons" style="color: green;">filter_4</i>
                                                    @elseif($all->signature_of_admin===0)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Admin" class="md-icon material-icons" style="color: red;">filter_4</i>
                                                    @elseif($all->signature_of_admin===NULL)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Admin" class="md-icon material-icons">filter_4</i>
                                                    @endif

                                                    @if($all->signature_of_director===1)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Director" class="md-icon material-icons" style="color: green;">filter_5</i>
                                                    @elseif($all->signature_of_director===0)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Director" class="md-icon material-icons" style="color: red;">filter_5</i>
                                                    @elseif($all->signature_of_director===NULL)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Director" class="md-icon material-icons">filter_5</i>
                                                    @endif

                                                    @if($all->signature_of_billing_officer===1)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Billing Officer" class="md-icon material-icons" style="color: green;">filter_6</i>
                                                    @elseif($all->signature_of_billing_officer===0)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Billing Officer" class="md-icon material-icons" style="color: red;">filter_6</i>
                                                    @elseif($all->signature_of_billing_officer===NULL)
                                                    <i data-uk-tooltip="{pos:'top'}" title="Billing Officer" class="md-icon material-icons">filter_6</i>
                                                    @endif

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

        $('#sidebar_my_aif').addClass('act_item');

        $('#sidebar_main_account').addClass('current_section');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
            $("#aif_tick").trigger('click');
            $("#tiktok5").trigger('click');
        })
    </script>
@endsection
