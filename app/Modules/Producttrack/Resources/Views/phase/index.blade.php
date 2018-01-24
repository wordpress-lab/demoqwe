@extends('layouts.main')

@section('title', 'Contact Category')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
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
                                    <h2 class="heading_b"><span class="uk-text-truncate">Create New Item</span></h2>
                                </div>
                            </div>
                            <div class="user_content">
                                <div class="uk-margin-top">

                                    <h3 class="full_width_in_card heading_c">
                                        <span>First Phase</span>
                                        <div class="uk-float-right">
                                            <input type="checkbox" name="first_phase" id="first_phase" data-md-icheck />
                                            <label for="first_phase" class="inline-label">Uncomplete</label>
                                        </div>
                                    </h3>

                                    <div class="uk-overflow-container uk-margin-bottom">
                                        <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                        <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                            <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Totall quantity</th>
                                                <th>Recepient Name</th>
                                                <th>Issued By</th>
                                                <th>Issued Number</th>
                                                <th>Reference</th>
                                                <th>Date:</th>
                                                <th class="uk-text-center">Action</th>
                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Totall quantity</th>
                                                <th>Recepient Name</th>
                                                <th>Issued By</th>
                                                <th>Issued Number</th>
                                                <th>Reference</th>
                                                <th>Date:</th>
                                                <th class="uk-text-center">Action</th>
                                            </tr>
                                            </tfoot>

                                            <tbody>
                                            <tr>
                                                <td>Light</td>
                                                <td>11</td>
                                                <td>Arful Islam</td>
                                                <td>Arful Islam</td>
                                                <td>655665</td>
                                                <th>4554</th>
                                                <th>12-18-2017</th>
                                                <td class="uk-text-center">
                                                    <a href="{{ route('phase') }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">&#xE8F4;</i></a>
                                                    <a href="{{ route('phase_edit',['id' => 1]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                    <a href="{{ route('track_delete',['id' => 1]) }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h3 class="full_width_in_card heading_c">
                                        <span>Second Phase</span>
                                        <div class="uk-float-right">
                                            <input type="checkbox" name="first_phase" id="first_phase" data-md-icheck />
                                            <label for="first_phase" class="inline-label">Uncomplete</label>
                                        </div>
                                    </h3>

                                    <div class="uk-overflow-container uk-margin-bottom">
                                        <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                        <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                            <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Totall quantity</th>
                                                <th>Recepient Name</th>
                                                <th>Issued By</th>
                                                <th>Issued Number</th>
                                                <th>Reference</th>
                                                <th>Date:</th>
                                                <th class="uk-text-center">Action</th>
                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Totall quantity</th>
                                                <th>Recepient Name</th>
                                                <th>Issued By</th>
                                                <th>Issued Number</th>
                                                <th>Reference</th>
                                                <th>Date:</th>
                                                <th class="uk-text-center">Action</th>
                                            </tr>
                                            </tfoot>

                                            <tbody>
                                            <tr>
                                                <td>Light</td>
                                                <td>11</td>
                                                <td>Arful Islam</td>
                                                <td>Arful Islam</td>
                                                <td>655665</td>
                                                <th>4554</th>
                                                <th>12-18-2017</th>
                                                <td class="uk-text-center">
                                                    <a href="{{ route('phase') }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">&#xE8F4;</i></a>
                                                    <a href="{{ route('phase_edit',['id' => 1]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                    <a href="{{ route('track_delete',['id' => 1]) }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <h3 class="full_width_in_card heading_c">
                                        <span>Third Phase</span>
                                        <div class="uk-float-right">
                                            <input type="checkbox" name="first_phase" id="first_phase" data-md-icheck />
                                            <label for="first_phase" class="inline-label">Uncomplete</label>
                                        </div>
                                    </h3>

                                    <div class="uk-overflow-container uk-margin-bottom">
                                        <div style="padding: 5px;margin-bottom: 10px;" class="dt_colVis_buttons"></div>
                                        <table class="uk-table" cellspacing="0" width="100%" id="data_table" >
                                            <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Totall quantity</th>
                                                <th>Recepient Name</th>
                                                <th>Issued By</th>
                                                <th>Issued Number</th>
                                                <th>Reference</th>
                                                <th>Date:</th>
                                                <th class="uk-text-center">Action</th>
                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Totall quantity</th>
                                                <th>Recepient Name</th>
                                                <th>Issued By</th>
                                                <th>Issued Number</th>
                                                <th>Reference</th>
                                                <th>Date:</th>
                                                <th class="uk-text-center">Action</th>
                                            </tr>
                                            </tfoot>

                                            <tbody>
                                            <tr>
                                                <td>Light</td>
                                                <td>11</td>
                                                <td>Arful Islam</td>
                                                <td>Arful Islam</td>
                                                <td>655665</td>
                                                <th>4554</th>
                                                <th>12-18-2017</th>
                                                <td class="uk-text-center">
                                                    <a href="{{ route('phase') }}"><i data-uk-tooltip="{pos:'top'}" title="View" class="md-icon material-icons">&#xE8F4;</i></a>
                                                    <a href="{{ route('phase_edit',['id' => 1]) }}"><i data-uk-tooltip="{pos:'top'}" title="Edit" class="md-icon material-icons">&#xE254;</i></a>
                                                    <a href="{{ route('track_delete',['id' => 1]) }}"><i data-uk-tooltip="{pos:'top'}" title="Delete" class="md-icon material-icons">&#xE872;</i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
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

            </form>
        </div>
    </div>
@endsection
