@extends('layouts.main')

@section('title', 'Hajj  Flight')

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
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Medical</span></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('Hajj_Medicale_Certificate') }}">Medical Cerificate</a></li>

                    </ul>
                </div>
            </li>
            <li data-uk-dropdown class="uk-hidden-small">
                <a href="#"><i class="material-icons">&#xE02E;</i><span>Police</span></a>
                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown">
                        <li><a href="{{ route('Hajj_Police_Clearence') }}">Police Clearence</a></li>

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
            <form action="" class="uk-form-stacked" id="user_edit_form">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-10-10">
                        <div class="md-card">
                            <div class="user_heading">
                                <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                </div>
                                <div class="user_heading_content">
                                    <h2 class="heading_b"><span class="uk-text-truncate">Flight Date</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-overflow-container uk-margin-bottom">
                                    <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                    <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                        <thead>
                                        <tr>
                                            <th>Serial No</th>
                                            <th>CustomerID</th>
                                            <th>Passport Number</th>
                                            <th>Expected Flight Date</th>
                                            <th>Flight Date</th>
                                            <th>Carrier Number</th>


                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr>
                                            <th>Serial No</th>
                                            <th>CustomerID</th>
                                            <th>Passport Number</th>
                                            <th>Expected Flight Date</th>
                                            <th>Flight Date</th>
                                            <th>Carrier Number</th>


                                            <th class="uk-text-center">Action</th>
                                        </tr>
                                        </tfoot>
                                        <?php $i=1;?>
                                        <tbody>
                                        @foreach($police as $value)

                                            <tr>
                                                <td>{!! $i++ !!}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>



                                                <td class="uk-text-center">

                                                    <a href="{{ route('Hajj_Flight_edit',$value->id) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>

                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Add branch plus sign -->


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
        $('#Hajj').addClass('current_section');
        $('#Hajj_Flight').addClass('act_item');
    </script>
@endsection