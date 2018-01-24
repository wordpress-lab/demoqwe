@extends('layouts.setting')

@section('title', 'Lock Transaction')

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
                @include('inc.alert')

                <div class="md-card">

                    <div class="user_heading">
                        <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        </div>
                        <div class="user_heading_content">

                            <h2 class="heading_b"><span class="uk-text-truncate">Update Lock Transaction</span></h2>
                        </div>
                    </div>
                    <div class="user_content">
                        <div class="uk-margin-top">

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                    <label for="display_name" class="uk-vertical-align-middle">Transaction Status</label>
                                </div>
                                <div class="uk-width-medium-2-5">


                                    <select onchange="lock(this)" name="status" id="select_demo_6" data-md-selectize >

                                        <option {{ $op->status==0?"selected":'' }} value="0">No Locked</option>
                                        <option {{ $op->status==1?"selected":'' }} value="1"> Locked</option>
                                    </select>


                                    @if($errors->first('status'))
                                    <div class="uk-text-danger">Status is required.</div>
                                    @endif
                                </div>
                            </div>





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('admin/assets/js/custom/dropify/dist/js/dropify.min.js') }} "></script>

<!--  form file input functions -->
<script src="{{ asset('admin/assets/js/pages/forms_file_input.min.js') }}"></script>
<script type="text/javascript">
    $('#settings_menu_locktransaction').addClass('md-list-item-active');

    function lock(status) {

        window.location.href = "{{ route('locktransaction_update') }}"+"?status="+status.value;
    }
</script>
@endsection