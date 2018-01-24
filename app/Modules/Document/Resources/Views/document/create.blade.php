@extends('layouts.admin')

@section('title', 'Add document')

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
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile"
         xmlns:color="http://www.w3.org/1999/xhtml">
        <div class="uk-width-large-10-10">
                {!! Form::open(['url' => 'document/store', 'method' => 'post', 'class' => 'uk-form-stacked', 'id' => 'user_edit_form', 'files' => 'true']) !!}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create Document</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">
                                    <h3 class="full_width_in_card heading_c">
                                        General info
                                    </h3>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="contact_category_id" class="uk-vertical-align-middle">Category <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select id="contact_category_id" name="contact_category_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" required>
                                                <option value="">Select category</option>
                                                @foreach($categories as $contact_category)
                                                <option value="{{ $contact_category->id }}">{{ $contact_category->categoryName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="contact_category_id" class="uk-vertical-align-middle">Pax Id <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <select id="contact_category_id" name="pax_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" required>
                                                <option value="">Select Pax</option>
                                                @foreach($pax as $value)
                                                    @if($value->id==$id)
                                                    <option value="{{ $value->id }}" selected>{{ $value->paxid }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="first_name">Title <i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="first_name">Title</label>
                                            <input class="md-input" type="text" id="title" name="title" value="{{ old('title') }}"  />
                                            <p style="color:red;">{{ $errors -> first('title') }}</p>
                                        </div>
                                    </div>




                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label class="uk-vertical-align-middle" for="display_name">Select File<i style="color:red" class="material-icons">stars</i></label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <input class="md-input" type="file" id="profile_picture" name="file_url" />
                                            @if($errors->has('file_url'))
                                                <p style="color: red">{{ $errors->first('file_url') }}</p>
                                            @endif
                                        </div>

                                    </div>




                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-1-1">
                                            <label for="about">Note</label>
                                            <textarea class="md-input" name="note" id="note" cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-1-1 uk-float-right">
                                            <button type="submit" class="md-btn md-btn-primary" >Submit</button>
                                            <button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_recruit_document').addClass('act_item');
    </script>
@endsection