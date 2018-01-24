@extends('layouts.main')

@section('title', 'Stock Management')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-2-10 uk-width-large-3-10">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Photos
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-margin-bottom uk-text-center">
                                <img src="{{ url('admin/assets/img/ecommerce/s6_edge.jpg') }}" alt="" class="img_medium" />
                            </div>
                            <ul class="uk-grid uk-grid-width-small-1-3 uk-text-center" data-uk-grid-margin>
                                <li>
                                    <img src="{{ url('admin/assets/img/ecommerce/s6_edge.jpg') }}" alt="" class="img_small"/>
                                </li>
                                <li>
                                    <img src="{{ url('admin/assets/img/ecommerce/s6_edge.jpg') }}" alt="" class="img_small"/>
                                </li>
                                <li>
                                    <img src="{{ url('admin/assets/img/ecommerce/s6_edge.jpg') }}" alt="" class="img_small"/>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="uk-width-xLarge-8-10  uk-width-large-7-10">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Details
                            </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium">
                                <div class="uk-width-large-1-2">

                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Item Name</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            <span class="uk-text-large uk-text-middle">Glass</span>
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Bar Code No :</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            SM-G925TZKFTMB
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Total Stock:</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            100
                                        </div>
                                    </div>
                                    <hr class="uk-grid-divider">
                                    <div class="uk-grid uk-grid-small">
                                        <div class="uk-width-large-1-3">
                                            <span class="uk-text-muted uk-text-small">Sell</span>
                                        </div>
                                        <div class="uk-width-large-2-3">
                                            60
                                        </div>
                                    </div>

                                    <hr class="uk-grid-divider">
                                </div>
                                <div class="uk-width-large-1-2">

                                    <p>
                                        <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">Description</span>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam necessitatibus suscipit velit voluptatibus! Ab accusamus ad adipisci alias aliquid at atque consectetur, dicta dignissimos, distinctio dolores esse fugiat iste laborum libero magni maiores maxime modi nemo neque, nesciunt nisi nulla optio placeat quas quia quibusdam quis saepe sit ullam!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md-card">
                        <div class="md-card uk-margin-medium-bottom">
                            <div class="md-card-content">
                                <div class="uk-grid">
                                    <div class="uk-width-1-1">
                                        <ul class="uk-tab" data-uk-tab="{connect:'#item_details_tab'}" id="tabs_1">
                                            <li class="uk-active"><a href="#">Overview</a></li>
                                            <li><a href="#">Comments</a></li>
                                            <li class="#"><a href="#">Sales History</a></li>
                                            <li class="#"><a href="#">Stock History</a></li>
                                            <li class="#"><a href="#">Statement</a></li>
                                        </ul>
                                        <ul id="item_details_tab" class="uk-switcher uk-margin">

                                            <li>
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-3-5 uk-text-right">
                                                        <div class="uk-vertical-align">
                                                            <label for="item_category_id" class="uk-vertical-align-middle uk-margin-top">Filter</label>
                                                        </div>
                                                    </div>
                                                    <div class="uk-width-medium-2-5">
                                                        <select id="overview_filter" name="overview_filter" data-md-selectize>
                                                            <option value="">Select</option>
                                                            <option value="1">Today</option>
                                                            <option value="2">This Week</option>
                                                            <option value="3">This Month</option>
                                                            <option value="4">This Year</option>
                                                            <option value="5">Previous Week</option>
                                                            <option value="6">Previous Month</option>
                                                            <option value="7">Previous Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="timeline">
                                                    <div class="timeline_item">
                                                        <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE836;</i></div>
                                                        <div class="timeline_date">
                                                            09 <span>Aug</span>
                                                        </div>
                                                        <div class="timeline_content">Payments Received added <a href="#"><strong>View Details</strong></a>
                                                            </br><span class="uk-text-muted uk-text-small">Payment of amount BDT154.00 received and applied for INV-000002 by aliazam3006</span>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_item">
                                                        <div class="timeline_icon timeline_icon_danger"><i class="material-icons">&#xE836;</i></div>
                                                        <div class="timeline_date">
                                                            15 <span>Aug</span>
                                                        </div>
                                                        <div class="timeline_content">Invoice updated <a href="#"><strong>View Details</strong></a>
                                                            </br><span class="uk-text-muted uk-text-small">Invoice INV-000002 emailed by aliazam3006</span>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_item">
                                                        <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE836;</i></div>
                                                        <div class="timeline_date">
                                                            09 <span>Aug</span>
                                                        </div>
                                                        <div class="timeline_content">Payments Received added <a href="#"><strong>View Details</strong></a>
                                                            </br><span class="uk-text-muted uk-text-small">Payment of amount BDT154.00 received and applied for INV-000002 by aliazam3006</span>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_item">
                                                        <div class="timeline_icon timeline_icon_danger"><i class="material-icons">&#xE836;</i></div>
                                                        <div class="timeline_date">
                                                            15 <span>Aug</span>
                                                        </div>
                                                        <div class="timeline_content">Invoice updated <a href="#"><strong>View Details</strong></a>
                                                            </br><span class="uk-text-muted uk-text-small">Invoice INV-000002 emailed by aliazam3006</span>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_item">
                                                        <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE836;</i></div>
                                                        <div class="timeline_date">
                                                            09 <span>Aug</span>
                                                        </div>
                                                        <div class="timeline_content">Payments Received added <a href="#"><strong>View Details</strong></a>
                                                            </br><span class="uk-text-muted uk-text-small">Payment of amount BDT154.00 received and applied for INV-000002 by aliazam3006</span>
                                                        </div>
                                                    </div>
                                                    <div class="timeline_item">
                                                        <div class="timeline_icon timeline_icon_danger"><i class="material-icons">&#xE836;</i></div>
                                                        <div class="timeline_date">
                                                            15 <span>Aug</span>
                                                        </div>
                                                        <div class="timeline_content">Invoice updated <a href="#"><strong>View Details</strong></a>
                                                            </br><span class="uk-text-muted uk-text-small">Invoice INV-000002 emailed by aliazam3006</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <form action="" class="uk-form-stacked" id="user_edit_form">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-large-10-10">
                                                            <div class="md-card">
                                                                <div class="uk-grid" data-uk-grid-margin>
                                                                    <div class="uk-width-1-1">
                                                                        <label for="user_edit_personal_info_control">Comment</label>
                                                                        <textarea class="md-input" name="user_edit_personal_info_control" id="user_edit_personal_info_control" cols="30" rows="4"></textarea>
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
                                                </form>
                                            </li>
                                            <li>
                                                <div class="uk-width-medium-1-3">
                                                    <select id="select_demo_2" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select with tooltip">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        <option value="a">Today</option>
                                                        <option value="b">This Week</option>
                                                        <option value="c">This Month</option>
                                                        <option value="c">This Year</option>
                                                        <option value="c">Previous Week</option>
                                                        <option value="c">Previous Month</option>
                                                        <option value="c">Previous Year</option>
                                                    </select>
                                                </div>
                                                <div class="md-card-content">
                                                    <div class="uk-accordion" data-uk-accordion>
                                                        <h3 class="uk-accordion-title">Sells History</h3>
                                                        <div class="uk-accordion-content">
                                                            <div class="md-card-content">
                                                                <div class="uk-overflow-container">
                                                                    <table class="uk-table uk-table-hover uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_align">
                                                                        <thead>
                                                                        <tr>
                                                                            <th data-align-char="&nbsp;">Date</th>
                                                                            <th data-align-char=" " data-align-adjust="0">Sell</th>
                                                                            <th data-align-char=" " data-align-index="1">Sell By</th>
                                                                            <th data-align-char=" " data-align-index="2">Income</th>

                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="uk-width-medium-1-3">
                                                    <select id="select_demo_2" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select with tooltip">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        <option value="a">Today</option>
                                                        <option value="b">This Week</option>
                                                        <option value="c">This Month</option>
                                                        <option value="c">This Year</option>
                                                        <option value="c">Previous Week</option>
                                                        <option value="c">Previous Month</option>
                                                        <option value="c">Previous Year</option>
                                                    </select>
                                                </div>
                                                <div class="md-card-content">
                                                    <div class="uk-accordion" data-uk-accordion>

                                                        <h3 class="uk-accordion-title">Stock History</h3>
                                                        <div class="uk-accordion-content">
                                                            <div class="md-card-content">
                                                                <div class="uk-overflow-container">
                                                                    <table class="uk-table uk-table-hover uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair" id="ts_align">
                                                                        <thead>
                                                                        <tr>
                                                                            <th data-align-char="&nbsp;">Date</th>
                                                                            <th data-align-char=" " data-align-adjust="0">Stock#</th>
                                                                            <th data-align-char=" " data-align-index="1">Stock By</th>
                                                                            <th data-align-char=" " data-align-index="2">Expense</th>

                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>10 Jan 2017</td>
                                                                            <td>11</td>
                                                                            <td>Arful Islam</td>
                                                                            <td>899</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="uk-width-medium-1-3">
                                                    <select id="select_demo_2" class="md-input" data-uk-tooltip="{pos:'top'}" title="Select with tooltip">
                                                        <option value="" disabled selected hidden>Select...</option>
                                                        <option value="a">Today</option>
                                                        <option value="b">This Week</option>
                                                        <option value="c">This Month</option>
                                                        <option value="c">This Year</option>
                                                        <option value="c">Previous Week</option>
                                                        <option value="c">Previous Month</option>
                                                        <option value="c">Previous Year</option>
                                                    </select>
                                                </div>
                                                <div class="md-card-toolbar">
                                                    <h3 class="md-card-toolbar-heading-text">
                                                        Options
                                                    </h3>
                                                </div>
                                                <div class="md-card-content large-padding">
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-2-10">
                                                            <span class="uk-display-block uk-margin-small-top uk-text-large">Colors</span>
                                                        </div>
                                                        <div class="uk-width-medium-8-10">
                                                            <table class="uk-table">
                                                                <thead>
                                                                <tr>
                                                                    <th class="uk-width-4-10">Color</th>
                                                                    <th class="uk-width-3-10">In stock</th>
                                                                    <th class="uk-width-3-10 uk-text-right">Price</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>Black</td>
                                                                    <td><i class="material-icons uk-text-success md-24">&#xE5CA;</i></td>
                                                                    <td class="uk-text-right">$0.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>White</td>
                                                                    <td></td>
                                                                    <td class="uk-text-right">+ $25.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Red</td>
                                                                    <td><i class="material-icons uk-text-success md-24">&#xE5CA;</i></td>
                                                                    <td class="uk-text-right">- $10.00</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-2-10">
                                                            <span class="uk-display-block uk-margin-small-top uk-text-large">Internal memory</span>
                                                        </div>
                                                        <div class="uk-width-medium-8-10">
                                                            <table class="uk-table">
                                                                <thead>
                                                                <tr>
                                                                    <th class="uk-width-4-10">Memory</th>
                                                                    <th>In stock</th>
                                                                    <th class="uk-width-3-10 uk-text-right">Price</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>32GB</td>
                                                                    <td></td>
                                                                    <td class="uk-text-right">- $50.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>64GB</td>
                                                                    <td><i class="material-icons uk-text-success md-24">&#xE5CA;</i></td>
                                                                    <td class="uk-text-right">$0.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>128BG</td>
                                                                    <td><i class="material-icons uk-text-success md-24">&#xE5CA;</i></td>
                                                                    <td class="uk-text-right">+ $80.00</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
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
        $('#sidebar_inventory').addClass('current_section');
        $('#sidebar_inventory_inventory').addClass('act_item');
    </script>
@endsection