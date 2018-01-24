@inject('option' , 'App\Lib\RouteOption')
@extends('layouts.main')

@section('title', 'Delete Module')

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
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Delete Module</span></h2>
                                </div>
                            </div>
                            <div class="md-card-content">
                            {!! Form::open(['url' => route('module_delete_update'), 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form']) !!}
                                
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-7">
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5">
                                                    <label>Ticketing:</label>
                                                </div>
                                                @if($option->ticket()->status == 0)
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="ticketing" value="1" data-md-icheck checked/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="ticketing" value="0" data-md-icheck disabled />
                                                 No</label>
                                                </p>
                                                </div>
                                                @else
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="ticketing" value="1" data-md-icheck/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="ticketing" value="0" data-md-icheck checked/>
                                                 No</label>
                                                </p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-7">
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5">
                                                    <label>Manpower Service:</label>
                                                </div>
                                                @if($option->manPower()->status == 0)
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="manpower" value="1" data-md-icheck checked/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="manpower" value="0" data-md-icheck disabled/>
                                                 No</label>
                                                </p>
                                                </div>
                                                @else
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="manpower" value="1" data-md-icheck/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="manpower" value="0" data-md-icheck checked/>
                                                 No</label>
                                                </p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-7">
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5">
                                                    <label>Recruit:</label>
                                                </div>
                                                @if($option->recruit()->status == 0)
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="recruit" value="1" data-md-icheck checked/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="recruit" value="0" data-md-icheck disabled />
                                                 No</label>
                                                </p>
                                                </div>
                                                @else
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="recruit" value="1" data-md-icheck/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="recruit" value="0" data-md-icheck checked />
                                                 No</label>
                                                </p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-7">
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5">
                                                    <label>Hazz:</label>
                                                </div>
                                                @if($option->hazz()->status == 0)
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="hazz" value="1" data-md-icheck checked/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="hazz" value="0" data-md-icheck disabled />
                                                 No</label>
                                                </p>
                                                </div>
                                                @else
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="hazz" value="1" data-md-icheck/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="hazz" value="0" data-md-icheck checked />
                                                 No</label>
                                                </p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-7">
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5">
                                                    <label>Umrah:</label>
                                                </div>
                                                @if($option->umrah()->status == 0)
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="umrah" value="1" data-md-icheck checked/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="umrah" value="0" data-md-icheck disabled />
                                                 No</label>
                                                </p>
                                                </div>
                                                @else
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="umrah" value="1" data-md-icheck/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="umrah" value="0" data-md-icheck checked />
                                                 No</label>
                                                </p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-7">
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5">
                                                    <label>HRM:</label>
                                                </div>
                                                @if($option->hrm()->status == 0)
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="hrm" value="1" data-md-icheck checked/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="hrm" value="0" data-md-icheck disabled />
                                                 No</label>
                                                </p>
                                                </div>
                                                @else
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="hrm" value="1" data-md-icheck/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="hrm" value="0" data-md-icheck checked />
                                                 No</label>
                                                </p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-medium-1-7">
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5">
                                                    <label>PMS:</label>
                                                </div>
                                                @if($option->pms()->status == 0)
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="pms" value="1" data-md-icheck checked/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="pms" value="0" data-md-icheck disabled />
                                                 No</label>
                                                </p>
                                                </div>
                                                @else
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="pms" value="1" data-md-icheck/>
                                                 Yes</label>
                                                </p>
                                                </div>
                                                <div class="uk-width-medium-1-5">
                                                <p>
                                                <label class="inline-label"><input type="radio" name="pms" value="0" data-md-icheck checked />
                                                 No</label>
                                                </p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <button type="submit" href="#" class="md-btn md-btn-primary">Submit</button>
                                    </div>
                                </div>

                            {!! Form::close() !!}
                        </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection


@section('scripts')


    <script type="text/javascript">
        $('#sidebar_dashboard').addClass('current_section');

    </script>

    
@endsection
