@extends('layouts.admin')
@section('title')
   Edit Musaned
@endsection

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection


@section('content')

    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <form action="{{ route('musaned_update',$recruit->musanand['id']) }}"  method="post" class="uk-form-stacked" id="musaned_store">
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                            {{ csrf_field() }}
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate" id="user_edit_uname"> Edit Musaned </span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-grid">
                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                    <label class="uk-vertical-align-middle" for="customer_name">Pax Id <i style="color:red" class="material-icons">stars</i></label>
                                </div>
                                <div class="uk-width-1-4">
                                    <div class="parsley-row">
                                        <select name="paxid" id="paxid" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="select id">
                                            <option value="">Select Customer</option>
                                            @foreach($order as $value)
                                                @if($value->id==$recruit->musanand->pax_id)
                                                <option selected value="{!! $value->id !!}">{!! $value->paxid !!}</option>
                                                @else
                                                    <option value="{!! $value->id !!}">{!! $value->paxid !!}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if($errors->has('paxid'))

                                            <span style="color:red;">{!!$errors->first('paxid')!!}</span>
                                        @endif
                                    </div>
                                </div>


                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                    <label class="uk-vertical-align-middle" for="customer_name">Issue Date <i style="color:red" class="material-icons">stars</i></label>
                                </div>
                                <div class="uk-width-1-4">
                                    <label for="isssue_date">Issue date</label>
                                    <input class="md-input" type="text" id="isssue_date" value="{!! $recruit->musanand->issue_date !!}" name="isssue_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                    @if($errors->has('isssue_date'))

                                        <span style="color:red">{!!$errors->first('isssue_date')!!}</span>

                                    @endif
                                </div>

                            </div>

                            <div class="uk-grid">
                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                    <label class="uk-vertical-align-middle" for="customer_name">Company</label>
                                </div>
                                <div class="uk-width-1-4">
                                    <div class="parsley-row">
                                        <select name="cpname" id="cpname" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="select id">
                                            <option value="">Select company</option>
                                            @foreach($company as $value)
                                                @if($value->id==$recruit->musanand->company_id)
                                                <option selected value="{!! $value->id !!}">{!! $value->name !!}</option>
                                                @else
                                                    <option  value="{!! $value->id !!}">{!! $value->name !!}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                      @if($errors->has('cpname'))
                                  <span style="color:red; position: relative; right:-500px">{!!$errors->first('cpname')!!}</span>
                            @endif
                            </div>
                           
                        

                        <br>
                        <br>
                        <br>

                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Created By</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle">{!! isset($recruit->createdBy['name']) ? $recruit->createdBy['name']:''  !!}</span>
                            </div>
                        </div>
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Updated By</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle">{!! isset($recruit->updatedBy['name']) ? $recruit->updatedBy['name']:''  !!}</span>
                            </div>
                        </div>


                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Created At</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle">{!! isset($recruit->created_at) ? $recruit->created_at:''  !!}</span>
                            </div>
                        </div>
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Updated At</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle">{!! isset($recruit->updated_at) ? $recruit->updated_at:''  !!}</span>
                            </div>
                        </div>

                        <br>
                        <br>
                        <hr>
                        <br>
                        <br>

                         <div class="uk-grid">
                            <div class="uk-width-1-5 uk-float-right">
                                <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                {{--<button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>--}}
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
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_musaned').addClass('act_item');

    </script>



@endsection