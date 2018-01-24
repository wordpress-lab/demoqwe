@if(session()->has('alert.message'))
    <div class="uk-alert uk-alert-{{ session('alert.status') }}" data-uk-alert>
        <a href="" class="uk-alert-close uk-close"></a>
        <p>{{ session('alert.message') }}</p>
    </div>
@endif