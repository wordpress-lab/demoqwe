@extends('layouts.main')

@section('title', 'Chart Of Accounts')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')

    <div class="md-card">
        <div class="md-card-content">
            <div class="uk-overflow-container uk-margin-bottom">
                <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Account Name</th>
                        <th>Account Code</th>
                        <th>Type</th>
                        <th>Updated At</th>
                        <th>Updated By</th>
                        <th class="uk-text-center">Action</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Account Name</th>
                        <th>Account Code</th>
                        <th>Type</th>
                        <th>Updated At</th>
                        <th>Updated By</th>
                        <th class="uk-text-center">Action</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    <?php $count = 1; ?>
                    @foreach($accounts as $account)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $account->account_name }}</td>
                        <td>{{ $account->account_code }}</td>
                        <td>{{ $account->accountType->account_name }}</td>
                        <td>{{ $account->updated_at }}</td>
                        <td>{{ $account->updatedBy->name }}</td>
                        <td class="uk-text-center">
                            <a href="{{ route('account_chart_edit',['id' => $account->id]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                            <a class="delete_btn"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                            <input type="hidden" class="account_id" value="{{ $account->id }}">
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-accent" href="{{ route('account_chart_create') }}">
            <i class="material-icons">&#xE145;</i>
        </a>
    </div>
@endsection
@section('scripts')
    <script>
        $('.delete_btn').click(function () {
            var id = $(this).next('.account_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this! If you delete this invoice all record will be deleted related to this invoice",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "/account-chart/delete/"+id;
            })
        })
    </script>
    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_account_chart_of_accounts').addClass('act_item');
        $(window).load(function(){
            $("#tiktok_account").trigger('click');
        });
    </script>
@endsection