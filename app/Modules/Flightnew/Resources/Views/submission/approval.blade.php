@extends('layouts.main')

@section('title', 'Owner Approval')

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
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Owner Approval</span></h2>

                            </div>
                        </div>
                    </div>
                    <div class="uk-grid" style="padding-top: 50px">
                        <div class="uk-width-1-1">
                            <div class="uk-grid uk-grid-width-1-1 uk-grid-width-large-1-2" data-uk-grid-margin>
                                <div>
                                    <a href="{!! route('submission_confirm',$recruit->submission['id']) !!}" class="md-btn md-btn-facebook md-btn-large md-btn-block md-btn-icon"><i class="material-icons">&#xE876;</i>Yes</a>
                                </div>
                                <div>
                                    <a href="{!! route('submission_not_confirm',$recruit->submission['id']) !!}" class="md-btn md-btn-gplus md-btn-large md-btn-block md-btn-icon"><i class="material-icons">&#xE14C;</i>No</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-5 uk-vertical-align">
                            <label class="uk-vertical-align-middle" for="comments">Due Amount</label>
                        </div>
                        <div class="uk-width-medium-2-5">
                            <label for="comments">{{ $recruit->invoice['due_amount'] }} BDT </label>
                        </div>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-5 uk-vertical-align">
                            <label class="uk-vertical-align-middle" for="comments">Submission Comment</label>
                        </div>
                        <div class="uk-width-medium-2-5">
                            <label for="comments">{{ $recruit->submission['comment'] }}</label>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_submission').addClass('act_item');
        $(window).load(function(){
            $("#tiktok2").trigger('click');
        })

        $('.delete_btn').click(function () {
            var id = $(this).next('.mofa_id').val();
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this! If you delete this Mofa all record will be deleted related to this MOFA",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                window.location.href = "{{ route('fit_card_delete') }}"+"/"+id;
            })
        })
    </script>
@endsection
