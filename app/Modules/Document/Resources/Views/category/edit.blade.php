@extends('layouts.main')

@section('title', 'Document Category')

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
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('document_create') }}">Create Document</a></li>
                        <li><a href="{{ route('document') }}">All Document </a></li>
                    </ul>
                </div>
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
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">Update Category</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                {!! Form::open(['url' => route('document_cateregory_update', ['id' => $category->id]), 'method' => 'POST']) !!}
                                    <div class="uk-grid" data-uk-grid-margin>
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="contact_category_name" class="uk-vertical-align-middle">Name</label>
                                        </div>
                                        <div class="uk-width-medium-2-5">
                                            <label for="contact_category_name">Category Name</label>
                                            <input class="md-input" type="text" id="contact_category_name" name="contact_category_name" value="{{ old('contact_category_name') ? old('contact_category_name') : $category->categoryName }}" required/>
                                            @if($errors->first('contact_category_name'))
                                                <div class="uk-text-danger">Category name is required.</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-medium-1-5 uk-vertical-align">
                                            <label for="contact_category_description" class="uk-vertical-align-middle">Description</label>
                                        </div>
                                        <div class="uk-width-medium-4-5">
                                            <label for="contact_category_description">Category summary</label>
                                            <textarea class="md-input" name="contact_category_description" id="contact_category_description" cols="30" rows="4" required>{{ old('contact_category_description') ? old('contact_category_description') : $category->summary }}</textarea>
                                            @if($errors->first('contact_category_description'))
                                                <div class="uk-text-danger">Category description is required.</div>
                                            @endif
                                        </div>
                                    </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact_category_description" class="uk-vertical-align-middle">Created By</label>
                                    </div>
                                    <div class="uk-width-medium-4-5">
                                        <label for="contact_category_description"> {{ $category->createdBy->name }} </label>

                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact_category_description" class="uk-vertical-align-middle">Updated By</label>
                                    </div>
                                    <div class="uk-width-medium-4-5">
                                        <label for="contact_category_description">{{ $category->updatedBy->name }}</label>

                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact_category_description" class="uk-vertical-align-middle">Created At</label>
                                    </div>
                                    <div class="uk-width-medium-4-5">
                                        <label for="contact_category_description">{{ $category->created_at }}</label>

                                    </div>
                                </div>
                                <div class="uk-grid">
                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                        <label for="contact_category_description" class="uk-vertical-align-middle">Updated At</label>
                                    </div>
                                    <div class="uk-width-medium-4-5">
                                        <label for="contact_category_description">{{ $category->updated_at }}  </label>

                                    </div>
                                </div>
                                    <div class="uk-grid">
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
        $('#sidebar_contact').addClass('current_section');
    </script>
@endsection