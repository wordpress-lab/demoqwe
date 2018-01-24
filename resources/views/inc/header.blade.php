<!-- main header -->
<header id="header_main">
    <div class="header_main_content">
        <nav class="uk-navbar">
            <!-- main sidebar switch -->
            <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                <span class="sSwitchIcon"></span>
            </a>
            <!-- secondary sidebar switch -->
            <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                <span class="sSwitchIcon"></span>
            </a>
            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav user_actions">
                    <li>
                        <a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large">
                            <i class="material-icons md-24 md-light">&#xE5D0;</i>
                        </a>
                    </li>
                    <li>
                        <a href="#" id="main_search_btn" class="user_action_icon">
                            <i class="material-icons md-24 md-light">&#xE8B6;</i>
                        </a>
                    </li>
                    <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                    
                        <a href="#" class="user_action_image">
                        @if(Auth::user()->image == 'user.jpg')
                        <img class="md-user-image" src="{{ url('admin/assets/img/avatars/user-2.png') }}">
                        @else
                        <img class="md-user-image" src="{{ url('uploads/users/'.Auth::user()->image) }}" alt="">
                        @endif
                        </a>
                        <div class="uk-dropdown uk-dropdown-small">
                            <ul class="uk-nav js-uk-prevent">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="{{url('settings/my-profile')}}">My profile</a></li>
                                    <li><a href="{{route('organization_profile')}}">Settings</a></li>

                                    <li><a href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="header_main_search_form">
        <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
        <form class="uk-form uk-autocomplete">
            <input type="text" class="header_main_search_input" />
            <button class="header_main_search_btn uk-button-link">
                <i class="md-icon material-icons">&#xE8B6;</i>
            </button>
        </form>
    </div>
</header>
<!-- main header end -->

<!-- secondary sidebar -->
<aside id="sidebar_secondary" class="tabbed_sidebar">
    <ul class="uk-tab uk-tab-icons uk-tab-grid" data-uk-tab="{connect:'#dashboard_sidebar_tabs', animation:'slide-horizontal'}">

        <a style="margin: 10px;" class="md-btn md-btn-primary md-btn-small md-btn-wave-light md-btn-icon waves-effect waves-button waves-light" data-uk-modal="{target:'#modal_default'}" href="javascript:void(0)">
            <i class="material-icons">note_add</i>
            ADD
        </a>

    </ul>

    <div class="scrollbar-inner">
        <ul id="dashboard_sidebar_tabs" class="uk-switcher">
            <li>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">


                        <div class="uk-grid">

                            <div class=uk-width-1-1">
                                <div class="uk-width-medium-1-1">
                                    <p class="uk-text-large">Default</p>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @inject('Dashboard', 'App\Lib\Deshboard')
                <div class="timeline timeline_small uk-margin-bottom" id="reminder-1">
                    @foreach($Dashboard->Reminder() as $value)
                    <div class="timeline_item" v-for="item in items">
                        <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE85D;</i></div>
                        <div class="timeline_date">
                           @if(explode(' ',$value->reminddatetime)[0]=="0000-00-00")
                           {{  explode(' ',$value->created_at)[0]  }} <span>At {{ explode(' ',$value->created_at)[1] }}</span>
                           @else
                                {{ explode(' ',$value->reminddatetime)[0] }} <span>At {{ explode(' ',$value->reminddatetime)[1] }}</span>
                           @endif
                            <a class="re_delete_btn" onclick="removereminder(this); return false;"  href="{{ route('dashboard_reminder_destroy',$value->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                            <input type="hidden" class="rem_id" value="{{ $value->id }}">

                        </div>
                        <div class="timeline_content">
                            {{ $value->note }}
                        </div>
                    </div>
                     @endforeach
                </div>
            </li>

        </ul>
    </div>



</aside>
<div class="uk-modal" id="modal_default">

    <div class="uk-modal-dialog">
        <button type="button" class="uk-modal-close uk-close"></button>

        <div class="uk-grid">
        <div class="uk-width-medium-1-2">

            <h3 class="heading_a uk-margin-medium-bottom"><i class="material-icons">alarm_add</i> Add Reminder</h3>
            <div id="reminderadd" style="display:none;opacity: 0; transition: visibility 0s, opacity 0.5s linear;" class="uk-alert uk-alert-success" data-uk-alert="">
                <a href="#" class="uk-alert-close uk-close"></a>
             </div>
                <div id="reminderaddfail" style="display:none;opacity: 0; transition: visibility 0s, opacity 0.5s linear;" class="uk-alert uk-alert-warning" data-uk-alert="">
                <a href="#" class="uk-alert-close uk-close"></a>

            </div>
            <div class="uk-form-row">
                <label>Pick Date</label>
                <input class="md-input" type="text" id="date" value="{{ date('Y-m-d') }}" data-uk-datepicker="{format:'YYYY-MM-DD'}">
            </div>

            <div class="uk-form-row">
                <label style="margin-top:-10px; ">Pick Time</label>
                <input class="md-input" type="time" id="time" data-uk-timepicker="" autocomplete="off">
            </div>
        </div>

      </div>
      <div class="uk-grid">
        <div class="uk-width-medium-1-1">

           <div class="uk-form-row">
               <label>Note(Required)</label>
            <textarea cols="30" rows="4" id="note" class="md-input"></textarea>
           </div>

            <div class="uk-form-row">

                <button onclick="AddReminder()" class="md-btn md-btn-success md-btn-wave-light waves-effect waves-button waves-light" href="javascript:void(0)"><i style="color: ghostwhite" class="material-icons">library_add</i> Save</button>


            </div>
        </div>
       </div>


    </div>


</div>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/vue.min.js') }}"></script>
<script>


    function removereminder(id) {

        var url = id;


        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this! If you delete this invoice all record will be deleted related to this invoice",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
             window.location.href = url;
        })
    }
    updatetodaynote();
    function updatetodaynote()
    {

    }

    function AddReminder()
    {

       var msg = document.getElementById('reminderadd');
       var reminderaddfail = document.getElementById('reminderaddfail');


        var note = document.getElementById('note').value;
        var time = document.getElementById('time').value;
        var date = document.getElementById('date').value;

         if(note.length==0){
          return false;
         }

        axios.post('{{ route('dashboard_reminder') }}', {
            note: note,
            time: time,
            date: date,
               })
                .then(function (response) {

                    if(response.data=="200"){

                        msg.innerText = "Successfully Added";
                        msg.style.display = "block";
                        msg.style.opacity = "1";
                        setTimeout(function()
                        {
                            msg.innerText = "";
                            msg.style.display = "none";
                            msg.style.opacity = "0";
                        },5000);
                    }else{

                        reminderaddfail.innerText = "Not Added";
                        reminderaddfail.style.display = "block";
                        reminderaddfail.style.opacity = "1";

                        setTimeout(function(){
                            reminderaddfail.innerText = "";
                            reminderaddfail.style.display = "none";
                            reminderaddfail.style.opacity = "0";}, 5000);
                    }


                })
                .catch(function (error) {

                    reminderaddfail.innerText = "Not Added";
                    reminderaddfail.style.display = "block";
                    reminderaddfail.style.opacity = "1";

                    setTimeout(function(){
                        reminderaddfail.innerText = "";
                        reminderaddfail.style.display = "none";
                        reminderaddfail.style.opacity = "0";
                    }, 5000);
                });

    }





</script>
<!-- secondary sidebar end -->

<!-- google web fonts -->