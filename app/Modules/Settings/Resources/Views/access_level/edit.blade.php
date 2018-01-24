@extends('layouts.main')

@section('title', ' Access Level')

@section('header')
@include('inc.header')
@endsection

@section('sidebar')
@include('inc.sidebar')
@endsection

@section('styles')
<style type="text/css">
    
    .squaredOne {
        -webkit-appearance: none;
    background-color: #fafafa;
    border: 10px solid #cacece;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
    padding: 9px;
    border-radius: 3px;
    display: inline-block;
    position: relative;
}

.squaredOne:active, .squaredOne:checked:active {
    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
}

.squaredOne:checked {
    background-color: #e9ecee;
    border: 10px solid #009E89;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);
    color: #99a1a7;
}

.squaredOne:checked:after {
    content: '\2714';
    font-size: 15px;
    position: absolute;
    top: -10.5px;
    left: -7px;
    color: white;
}

</style>
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
                    <div class="user_content">
                        <div class="uk-margin-top">
                            {!! Form::open(['url' => route('access_level_update'), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                    <label for="role_id" class="uk-vertical-align-middle">Select Role</label>
                                </div>
                                <div class="uk-width-medium-2-5">
                                    <select id="role_id" name="role_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select with tooltip">
                                        <option value="">Select role</option>
                                        @foreach($roles as $role)
                                        @if($role->id == $role_id)
                                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-1">
                                    <div class="uk-overflow-container">
                                        <table class="uk-table uk-table-hover">
                                            <thead>
                                            <tr>
                                                <th style="width: 47%;">Module</th>
                                                <th>Create
                                                <input type="checkbox" class="squaredOne" id="all_mark" />
                                                </th>
                                                <th>Read
                                                <input type="checkbox" class="squaredOne" id="all_mark2" />
                                                </th>
                                                <th>Update
                                                <input type="checkbox" class="squaredOne" id="all_mark3" />
                                                </th>
                                                <th>Delete
                                                <input type="checkbox" class="squaredOne" id="all_mark4" />
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td colspan="5">
                                                    <div class=""> 
                                                        <div class="uk-accordion" id="accor" data-uk-accordion>
                                                            <h3 class="uk-accordion-title uk-accordion-title-primary">Accounting</h3>
                                                            <div class="uk-accordion-content">
                                                                <table class="uk-table uk-table-hover">
                                                                <?php $count = 1; ?>
                                                                    @foreach($access_levels as $access_level)
                                                                    @if($access_level->module_id <= 25)
                                                                    <tr>
                                                                        <td>{{ $access_level->module->module_name }}</td>
                                                                        <td>
                                                                            <input type="hidden" name="module[]" value="{{ $access_level->module->id }}">
                                                                            @if($access_level->create == 1)
                                                                                <input type="checkbox" name="create_{{ $access_level->module->id }}" id="create_{{ $access_level->module->id }}" class="aa squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="create_{{ $access_level->module->id }}" id="create_{{ $access_level->module->id }}" class="aa squaredOne"/>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->read == 1)
                                                                                <input type="checkbox" name="read_{{ $access_level->module->id }}" id="read_{{ $access_level->module->id }}" class="bb squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="read_{{ $access_level->module->id }}" id="read_{{ $access_level->module->id }}" class="bb squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->update == 1)
                                                                                <input type="checkbox" name="update_{{ $access_level->module->id }}" id="update_{{ $access_level->module->id }}val_check_ski" class="cc squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="update_{{ $access_level->module->id }}" id="update_{{ $access_level->module->id }}val_check_ski" class="cc squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->delete == 1)
                                                                                <input type="checkbox" name="delete_{{ $access_level->module->id }}" id="delete_{{ $access_level->module->id }}" class="dd squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="delete_{{ $access_level->module->id }}" id="delete_{{ $access_level->module->id }}" class="dd squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                </table>
                                                            </div>

                                                            <h3 class="uk-accordion-title uk-accordion-title-success">Ticketing</h3>
                                                            <div class="uk-accordion-content">
                                                                <table class="uk-table uk-table-hover">
                                                                <?php $count = 1; ?>
                                                                    @foreach($access_levels as $access_level)
                                                                    @if($access_level->module_id > 25 && $access_level->module_id <= 31)
                                                                    <tr>
                                                                        <td>{{ $access_level->module->module_name }}</td>
                                                                        <td>
                                                                            <input type="hidden" name="module[]" value="{{ $access_level->module->id }}">
                                                                            @if($access_level->create == 1)
                                                                                <input type="checkbox" name="create_{{ $access_level->module->id }}" id="create_{{ $access_level->module->id }}" class="aa squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="create_{{ $access_level->module->id }}" id="create_{{ $access_level->module->id }}" class="aa squaredOne"/>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->read == 1)
                                                                                <input type="checkbox" name="read_{{ $access_level->module->id }}" id="read_{{ $access_level->module->id }}" class="bb squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="read_{{ $access_level->module->id }}" id="read_{{ $access_level->module->id }}" class="bb squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->update == 1)
                                                                                <input type="checkbox" name="update_{{ $access_level->module->id }}" id="update_{{ $access_level->module->id }}val_check_ski" class="cc squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="update_{{ $access_level->module->id }}" id="update_{{ $access_level->module->id }}val_check_ski" class="cc squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->delete == 1)
                                                                                <input type="checkbox" name="delete_{{ $access_level->module->id }}" id="delete_{{ $access_level->module->id }}" class="dd squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="delete_{{ $access_level->module->id }}" id="delete_{{ $access_level->module->id }}" class="dd squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                            
                                                            <h3 class="uk-accordion-title uk-accordion-title-warning">Recruit</h3>
                                                            <div class="uk-accordion-content">
                                                                <table class="uk-table uk-table-hover">
                                                                <?php $count = 1; ?>
                                                                    @foreach($access_levels as $access_level)
                                                                    @if($access_level->module_id > 31 && $access_level->module_id <= 89)
                                                                    <tr>
                                                                        <td>{{ $access_level->module->module_name }}</td>
                                                                        <td>
                                                                            <input type="hidden" name="module[]" value="{{ $access_level->module->id }}">
                                                                            @if($access_level->create == 1)
                                                                                <input type="checkbox" name="create_{{ $access_level->module->id }}" id="create_{{ $access_level->module->id }}" class="aa squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="create_{{ $access_level->module->id }}" id="create_{{ $access_level->module->id }}" class="aa squaredOne"/>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->read == 1)
                                                                                <input type="checkbox" name="read_{{ $access_level->module->id }}" id="read_{{ $access_level->module->id }}" class="bb squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="read_{{ $access_level->module->id }}" id="read_{{ $access_level->module->id }}" class="bb squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->update == 1)
                                                                                <input type="checkbox" name="update_{{ $access_level->module->id }}" id="update_{{ $access_level->module->id }}val_check_ski" class="cc squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="update_{{ $access_level->module->id }}" id="update_{{ $access_level->module->id }}val_check_ski" class="cc squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->delete == 1)
                                                                                <input type="checkbox" name="delete_{{ $access_level->module->id }}" id="delete_{{ $access_level->module->id }}" class="dd squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="delete_{{ $access_level->module->id }}" id="delete_{{ $access_level->module->id }}" class="dd squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                </table>
                                                            </div>

                                                            <h3 class="uk-accordion-title uk-accordion-title-danger">Manpower Service</h3>
                                                            <div class="uk-accordion-content">
                                                                <table class="uk-table uk-table-hover">
                                                                <?php $count = 1; ?>
                                                                    @foreach($access_levels as $access_level)
                                                                    @if($access_level->module_id > 89 && $access_level->module_id <= 92)
                                                                    <tr>
                                                                        <td>{{ $access_level->module->module_name }}</td>
                                                                        <td>
                                                                            <input type="hidden" name="module[]" value="{{ $access_level->module->id }}">
                                                                            @if($access_level->create == 1)
                                                                                <input type="checkbox" name="create_{{ $access_level->module->id }}" id="create_{{ $access_level->module->id }}" class="aa squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="create_{{ $access_level->module->id }}" id="create_{{ $access_level->module->id }}" class="aa squaredOne"/>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->read == 1)
                                                                                <input type="checkbox" name="read_{{ $access_level->module->id }}" id="read_{{ $access_level->module->id }}" class="bb squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="read_{{ $access_level->module->id }}" id="read_{{ $access_level->module->id }}" class="bb squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->update == 1)
                                                                                <input type="checkbox" name="update_{{ $access_level->module->id }}" id="update_{{ $access_level->module->id }}val_check_ski" class="cc squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="update_{{ $access_level->module->id }}" id="update_{{ $access_level->module->id }}val_check_ski" class="cc squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->delete == 1)
                                                                                <input type="checkbox" name="delete_{{ $access_level->module->id }}" id="delete_{{ $access_level->module->id }}" class="dd squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="delete_{{ $access_level->module->id }}" id="delete_{{ $access_level->module->id }}" class="dd squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                </table>
                                                            </div>

                                                            <h3 class="uk-accordion-title uk-accordion-title-primary md-bg-cyan-500">PMS</h3>
                                                            <div class="uk-accordion-content">
                                                                <table class="uk-table uk-table-hover">
                                                                <?php $count = 1; ?>
                                                                    @foreach($access_levels as $access_level)
                                                                    @if($access_level->module_id > 92 && $access_level->module_id <= 103)
                                                                    <tr>
                                                                        <td>{{ $access_level->module->module_name }}</td>
                                                                        <td>
                                                                            <input type="hidden" name="module[]" value="{{ $access_level->module->id }}">
                                                                            @if($access_level->create == 1)
                                                                                <input type="checkbox" name="create_{{ $access_level->module->id }}" id="create_{{ $access_level->module->id }}" class="aa squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="create_{{ $access_level->module->id }}" id="create_{{ $access_level->module->id }}" class="aa squaredOne"/>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->read == 1)
                                                                                <input type="checkbox" name="read_{{ $access_level->module->id }}" id="read_{{ $access_level->module->id }}" class="bb squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="read_{{ $access_level->module->id }}" id="read_{{ $access_level->module->id }}" class="bb squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->update == 1)
                                                                                <input type="checkbox" name="update_{{ $access_level->module->id }}" id="update_{{ $access_level->module->id }}val_check_ski" class="cc squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="update_{{ $access_level->module->id }}" id="update_{{ $access_level->module->id }}val_check_ski" class="cc squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($access_level->delete == 1)
                                                                                <input type="checkbox" name="delete_{{ $access_level->module->id }}" id="delete_{{ $access_level->module->id }}" class="dd squaredOne" checked/>
                                                                            @else
                                                                                <input type="checkbox" name="delete_{{ $access_level->module->id }}" id="delete_{{ $access_level->module->id }}" class="dd squaredOne" />
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                </table>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-1-1 uk-float-right">
                                    <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                    <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
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
        $('#role_id').change(function(){
            var id = $("#role_id :selected").val();
            var base_url = window.location.origin;
            var redirect_url = base_url + '/settings/access-level/edit/' + id;
            window.location.href = redirect_url;
        });
        var accordion = UIkit.accordion(document.getElementById('accor'), {
            showfirst:false

        });
    </script>
    <script type="text/javascript">
        $('#settings_menu_user_access').addClass('md-list-item-active');
    </script>
    <script type="text/javascript">
        $('#all_mark').click(function() {   
            $('.aa').each(function(){
                if($('#all_mark').is(':checked')){
                    $(this).prop('checked',true);
                }
                else{
                    $(this).prop('checked',false);
                }
                
            })
        });

        $('#all_mark2').click(function() {   
            $('.bb').each(function(){
                if($('#all_mark2').is(':checked')){
                    $(this).prop('checked',true);
                }
                else{
                    $(this).prop('checked',false);
                }
                
            })
        });

        $('#all_mark3').click(function() {   
            $('.cc').each(function(){
                if($('#all_mark3').is(':checked')){
                    $(this).prop('checked',true);
                }
                else{
                    $(this).prop('checked',false);
                }
                
            })
        });

        $('#all_mark4').click(function() {   
            $('.dd').each(function(){
                if($('#all_mark4').is(':checked')){
                    $(this).prop('checked',true);
                }
                else{
                    $(this).prop('checked',false);
                }
                
            })
        });
    </script>
@endsection