@extends('layouts.admin')

@section('title', 'Customer Information')

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
                @include('inc.customer_nav')
                    <div class="uk-width-xLarge-8-10  uk-width-large-8-10">

                        {!! Form::open(['url' => array('customer/information/update', base64_encode($customer_info->id)), 'method' => 'post', 'class' => 'uk-form-stacked','files' => true]) !!}
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-large-10-10">
                                <div class="md-card">
                                    <div class="user_heading" data-uk-sticky="{ top: 48, media: 960 }">
                                        <div class="user_heading_content">
                                            <h2 class="heading_b"><span class="uk-text-truncate">Edit Customer Information</span></h2>
                                        </div>
                                    </div>
                                    <div class="user_content">
                                        <div class="uk-grid" data-uk-grid-margin>
                                            <div class="uk-width-1-1 uk-float-right" >
                                                <button type="submit" class="md-btn md-btn-primary" style="float: right">Save</button>
                                            </div>
                                        </div>
                                        <div class="uk-margin-top">
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" style="color:royalblue; font-size:25px; font-weight: bold">Pax ID</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <span style="font-size: 25px; color: royalblue; font-weight: bold "> {{ $Rorder->paxid }}</span>
                                                </div>
                                            </div>
                                            <h3 class="full_width_in_card heading_c">
                                                General info
                                            </h3>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="dateOfBirthEN">Date Of Birth (EN)</label>
                                                </div>
                                                <div class="uk-width-2-5">
                                                    <div class="parsley-row">
                                                        <label>Date of Birth</label>
                                                        <input class="md-input" type="text" id="customerb_date" name="dateOfBirthEN" data-uk-datepicker="{format:'DD/MM/YYYY'}" value="{{ $customer_info->dateOfBirthEN }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="first_name">Date Of Birth (BN)</label>
                                                </div>
                                                <div class="uk-width-2-5">
                                                    <div class="parsley-row">
                                                        <label>Date of Birth (BN)</label>
                                                        <input class="md-input" type="text" name="dateOfBirthBN"  value="{{ $customer_info->dateOfBirthBN }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="placeOfBirth">Place Of Birth</label>
                                                </div>
                                                <div class="uk-width-2-5">
                                                    <div class="parsley-row">
                                                        <label>Place Of Birth</label>
                                                        <input class="md-input" type="text" name="placeOfBirth"  value="{{ $customer_info->placeOfBirth }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="gender">Gender</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <span>
                                                        <input {{ isEmptyOrNullString($customer_info->gender)||substr(strtoupper($customer_info->gender),0,2)=="MA"? 'checked':'' }} type="radio" name="gender"  value="male" data-md-icheck />
                                                        <label for="radio_demo_1" class="inline-label">Male</label>
                                                    </span>

                                                    <span>
                                                        <input {{ substr(strtoupper($customer_info->gender),0,2)=="FE"? "checked":''  }} type="radio" name="gender" value="female" data-md-icheck />
                                                        <label for="radio_demo_2" class="inline-label">Female</label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="addressEN">Address EN </label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="addressEN">AddressEN</label>
                                                    <textarea class="md-input" name="addressEN" id="addressEN" cols="30" rows="4"> {{ $customer_info->addressEN }}</textarea>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="addressBN">Address BN </label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="addressBN">AddressBN</label>
                                                    <textarea class="md-input" name="addressBN" id="addressBN" cols="30" rows="4"> {{ $customer_info->addressBN }} </textarea>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="religionEN">Religion EN</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="religionEN">Religion EN</label>
                                                    <input class="md-input" type="text" id="religionEN" name="religionEN" value="{{ $customer_info->religionEN }}" />
                                                </div>
                                            </div>

                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="religionEN">Passenger Name BN</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="religionEN">Passenger Name BN</label>
                                                    <input class="md-input" type="text" id="religionEN" name="passengerNameBN" value="{{ $customer_info->passengerNameBN }}" />
                                                </div>
                                            </div>

                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="religionEN">Passport Number BN</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="religionEN">Passport Number BN</label>
                                                    <input class="md-input" type="text" id="religionEN" name="passportNumberBN" value="{{ $customer_info->passportNumberBN }}" />
                                                </div>
                                            </div>

                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="religionBN">Religion BN</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="religionBN">Religion BN</label>
                                                    <input class="md-input" type="text" id="religionBN" name="religionBN" value="{{ $customer_info->religionBN }}" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="previousNationality">Previous Nationality</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="previousNationality">Previous Nationality</label>
                                                    <input class="md-input" type="text" id="previousNationality" name="previousNationality" value="{{ $customer_info->previousNationality }}" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="presentNationality">Present Nationality</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="presentNationality">Present Nationality</label>
                                                    <input class="md-input" type="text" id="presentNationality" name="presentNationality" value="{{ $customer_info->presentNationality }}" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="maritalStatus">Marital Status</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="maritalStatus">Marital Status</label>
                                                    <input class="md-input" type="text" id="maritalStatus" name="maritalStatus" value="{{ $customer_info->maritalStatus }}" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="group">Blood Group</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="group">Blood Group</label>
                                                    <input class="md-input" type="text" id="group" name="group" value="{{ $customer_info->group }}" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="group">Contact Number</label>
                                                </div>
                                                <div class="uk-width-medium-2-5">
                                                    <label for="group">Contact Number</label>
                                                    <input class="md-input" type="text" id="group" name="contact_number" value="{{ $customer_info->contact_number }}" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="">Sub Reference</label>
                                                </div>


                                                <div class="uk-width-medium-1-2">

                                                    @if(count($subref))
                                                      @foreach($subref as $key=>$name)
                                                    <div class="uk-grid form_section" data-section-added="{{ $key }}">
                                                        <div class="uk-width-1-1">
                                                            <div class="uk-input-group">
                                                                <div class="md-input-wrapper">
                                                                    <input autocomplete="off" oninput="autosuggest(this.value)" list="sub_ref"  type="text" class="md-input" value="{{ $name }}" name="sub_reference[]">


                                                                </div>

                                                                <span class="uk-input-group-addon">
                                            <a  href="#" class="btnSectionRemove"><i style="color: darkred; font-size: 25px; " class="material-icons">delete_forever</i></a>
                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                   @endif
                                                    <div class="uk-grid form_section" id="d_form_row">
                                                        <div class="uk-width-1-1">



                                                                <div id="p_scents">
                                                                 </div>
                                                            <a href="#" class="md-btn md-btn-primary" id="addScnt">Add New</a>
                                                    </div>


                                                        </div>

                                                        <datalist style="background-color: green" id="sub_ref">
                                                        </datalist>


                                                </div>
                                            </div>

                                            <div class="uk-grid">
                                                <div class="uk-width-1-2">
                                                    <h3 class="full_width_in_card heading_c" style="text-transform: uppercase">
                                                       Guardian
                                                    </h3>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="guardianName">Guardian Name</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="guardianName">Guardian Name</label>
                                                            <input class="md-input" type="text" id="guardianName" name="guardianName" value="{{ $customer_info->guardianName }}" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="guardianFatherName">Father Name</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="guardianFatherName">Guardian FatherName</label>
                                                            <input class="md-input" type="text" id="guardianFatherName" name="guardianFatherName" value="{{ $customer_info->guardianFatherName }}" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="guardianAddressEN">Guardian AddressEN</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="guardianAddressEN">Guardian AddressEN</label>
                                                            <textarea class="md-input" name="guardianAddressEN" id="guardianAddressEN" cols="30" rows="4">{{ $customer_info->guardianAddressEN }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="guardianReligion">Guardian Religion</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="guardianReligion">GuardianReligion</label>
                                                            <input class="md-input" type="text" id="guardianReligion" name="guardianReligion" value="{{ $customer_info->guardianReligion }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-width-1-2">
                                                    <h3 class="full_width_in_card heading_c">
                                                        Family
                                                    </h3>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="motherName">Mother Name</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="motherName">Mother Name</label>
                                                            <input class="md-input" type="text" id="motherName" name="motherName" value=" {{ $customer_info->motherName }}" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="fatherName">Father Name</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="fatherName">Father Name</label>
                                                            <input class="md-input" type="text" id="fatherName" name="fatherName" value="{{ $customer_info->fatherName }}" />
                                                        </div>
                                                    </div>
                                                    <h3 class="full_width_in_card heading_c">
                                                        Reference
                                                    </h3>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="guardianAddressBN">Guardian AddressBN</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="guardianAddressBN">Guardian AddressBN</label>
                                                            <textarea class="md-input" name="guardianAddressEN" id="guardianAddressEN" cols="30" rows="4">{{ $customer_info->guardianAddressEN }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="relationWithCustomer_1">Relation with Customer </label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="relationWithCustomer_1">in english</label>
                                                            <input class="md-input" type="text" id="relationWithCustomer_1" name="relationWithCustomer_1" value="{{ $customer_info->relationWithCustomer_1 }}" />
                                                        </div>
                                                    </div>
                                                    <div class="uk-grid" data-uk-grid-margin>
                                                        <div class="uk-width-medium-1-4 uk-vertical-align">
                                                            <label class="uk-vertical-align-middle" for="relationWithCustomer_2">Relation with Customer</label>
                                                        </div>
                                                        <div class="uk-width-medium-3-4">
                                                            <label for="relationWithCustomer_2">in Bangla</label>
                                                            <input class="md-input" type="text" id="relationWithCustomer_2" name="relationWithCustomer_2" value="{{ $customer_info->relationWithCustomer_2 }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="full_width_in_card heading_c">
                                                Professional
                                            </h3>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="qualification">Qualification </label>
                                                </div>
                                                <div class="uk-width-3-4">
                                                    <div class="parsley-row">
                                                        <label class="uk-vertical-align-middle" for="qualification">Qualification </label>
                                                        <input class="md-input" type="text" name="qualification"  value="{{ $customer_info->qualification }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="professionEn">Profession EN</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="professionEn">Profession EN</label>
                                                    <input class="md-input" type="text" id="professionEn" name="professionEn" value="{{ $customer_info->professionEn }}" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="professionBn">Profession BN</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="professionBn">Profession BN</label>
                                                    <input class="md-input" type="text" id="professionBn" name="professionBn" value="{{ $customer_info->professionBn }}" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="professionAR">Profession AR</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="professionAR">Profession AR</label>
                                                    <input class="md-input" type="text" id="professionAR" name="professionAR" value="{{ $customer_info->professionAR }}" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="businessAddressEN">BusinessAddress EN</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="businessAddressEN">BusinessAddress EN</label>
                                                    <textarea class="md-input" name="businessAddressEN" id="businessAddressEN" cols="30" rows="4">{{ $customer_info->businessAddressEN }}</textarea>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="businessAddressBN">BusinessAddress BN</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="businessAddressBN">BusinessAddress BN</label>
                                                    <textarea class="md-input" name="businessAddressBN" id="businessAddressBN" cols="30" rows="4"> {{ $customer_info->businessAddressBN }}</textarea>
                                                </div>
                                            </div>
                                            <!-- <h3 class="full_width_in_card heading_c">
                                               Travels
                                            </h3>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="purposeOfTravel">Purpose Of Travel</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="purposeOfTravel">Purpose Of Travel</label>
                                                    <input class="md-input" type="text" id="purposeOfTravel" name="purposeOfTravel" value="{{ $customer_info->purposeOfTravel }}" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="durationOfStay">	Duration Of Stay</label>
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <label for="durationOfStay">	Duration Of Stay</label>
                                                    <input class="md-input" type="text" id="durationOfStay" name="durationOfStay" value="{{ $customer_info->durationOfStay }}" />
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="departureDate">Departure Date</label>
                                                </div>
                                                <div class="uk-width-3-4">
                                                    <div class="parsley-row">
                                                        <label>Departure Date</label>
                                                        <input class="md-input" type="text" id="departureDate" name="departureDate" data-uk-datepicker="{format:'DD/MM/YYYY'}" value="{{ $customer_info->departureDate }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="arrivalDate">Arrival Date</label>
                                                </div>
                                                <div class="uk-width-3-4">
                                                    <div class="parsley-row">
                                                        <input class="md-input" type="text" name="arrivalDate"  data-uk-datepicker="{format:'DD/MM/YYYY'}" value="{{ $customer_info->arrivalDate }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="visaAdvice">Visa Advice </label>
                                                </div>
                                                <div class="uk-width-3-4">
                                                    <div class="parsley-row">
                                                        <input class="md-input" type="text" name="visaAdvice"  value="{{ $customer_info->visaAdvice }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-4 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="destination">Destination </label>
                                                </div>
                                                <div class="uk-width-3-4">
                                                    <div class="parsley-row">
                                                        <label class="uk-vertical-align-middle" for="destination">Destination </label>
                                                        <input class="md-input" type="text" name="destination"  value="{{ $customer_info->destination }}" />
                                                    <input type="hidden" name="id" value="{{ base64_encode($customer_info->id) }}">
                                                    <input type="hidden" name="pid" value="{{ base64_encode($Rorder->paxid) }}">
                                                    </div>
                                                </div>
                                            </div> -->

                                           <!-- <hr>
                                            <br>
                                            <br>
                                            <div class="uk-grid main_upload_sec" data-uk-grid-margin>
                                                <div class="uk-width-medium-1-5 uk-vertical-align">
                                                    <label class="uk-vertical-align-middle" for="visaType">Upload File</label>
                                                </div>
                                                <div class="uk-width-medium-2-4">
                                                    <div class="md-card">
                                                        <div class="md-card-content">
                                                            <div class="uk-grid form_section" id="d_form_row">
                                                                <div class="uk-width-1-1">
                                                                    <div class="uk-input-group">
                                                                        <label for="visaType">Title</label>
                                                                        <input type="text" id="visaType" class="md-input" name="title[]" />
                                                                        <br>
                                                                        <br>
                                                                        <input id="img_url" type="file" class="md-input" name="img_url[]">
                                                                        <span class="uk-input-group-addon">
                                                                     <a href="#" class="btnSectionClone" data-section-clone="#d_form_row"><i class="material-icons md-24">&#xE146;</i></a>
                                                                 </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @foreach($customer_info->contact_file as $file)
                                                <div class="uk-grid" data-uk-grid-margin>
                                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                                        <label class="uk-vertical-align-middle" for="visaType">Upload File</label>
                                                    </div>
                                                    <div class="uk-width-medium-2-4">
                                                        <div class="md-card">
                                                            <div class="md-card-content">
                                                                <div class="uk-grid form_section" id="d_form_row">
                                                                    <div class="uk-width-1-1">
                                                                        <a href="{!! asset('all_image/') !!}/{!! $file->img_url !!}" style="float:right;" class="md-btn md-btn-primary md-btn-mini md-btn-wave-light" download>Download</a>

                                                                        <div class="uk-input-group">
                                                                            <label for="visaType">Title</label>
                                                                            <input type="text" id="visaType" class="md-input" value="{!! $file['title'] !!}"  name="title[{!! 'old_'.$file['id'] !!}]" required="1" />
                                                                            <br>
                                                                            <br>
                                                                            <input id="img_url" type="file" class="md-input old" name="img_url[{!! 'old_'.$file['id'] !!}]">
                                                                            <input type="hidden" value="{!! $file['id'] !!}" name="img_id[]" >
                                                                            <br>
                                                                            @if($errors->has('img_url'))
                                                                                <div class="uk-text-danger">{{ $errors->first('img_url') }}</div>
                                                                            @endif
                                                                            <span  class="uk-input-group-addon">
                                                                    <a href="#" class="btnSectionRemove"><i class="material-icons md-24"></i></a>
                                                                 </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="uk-width-medium-1-5 uk-vertical-align">
                                                        <img  src="{!! asset('all_image/') !!}/{!! $file->img_url !!}" alt="...." height="60" width="150"/>
                                                    </div>
                                                </div>
                                            @endforeach
                                        -->
                                            <div class="uk-grid" data-uk-grid-margin>
                                                <div class="uk-width-1-1 uk-float-right">
                                                    <button type="submit" class="md-btn md-btn-primary" >Save</button>

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
        </div>
    </div>


@endsection
@section('scripts')
    <script>

            var scntDiv = $('#p_scents');
            var i = $('#p_scents p').size() + 1;

            $('#addScnt').on('click', function() {
                $('<p><div class="uk-input-group"><div class="md-input-wrapper"><input autocomplete="off" oninput="autosuggest(this.value)" list="sub_ref"  type="text" id="p_scnt" class="md-input" size="20" name="sub_reference[]" value="" placeholder="sub reference" /></div>  <span class="uk-input-group-addon" style="color:red;cursor:pointer" onclick="removeRow(this); return false;" id="remScnt"><i style="color:darkred;font-size: 25px;" class="material-icons">delete_forever</i></span></div></p>').appendTo(scntDiv);
                i++;
                return false;
            });

           function removeRow(de) {


                   $(de).parent().remove();

               return false;
           }

    function autosuggest(txt) {
        var link = "{{ route('customer_subreference_autosuggest') }}";
        var data= null;
        link = link+"?name="+txt;

        if(txt.length>0){
            axios.get(link)
                    .then(function (response) {
                        data = response.data;
                        $('#sub_ref').empty();

                        $.each(data, function (i, currdata) {
                            $('#sub_ref').append("<option value='" + currdata.name + "'>");
                        });


                    })
                    .catch(function (error) {
                        data= null;
                        console.log(error);
                    });
        }

    }

      setInterval(function () {
          var uploadedfile = document.querySelectorAll('#img_url').length;
          var old = document.querySelectorAll('.old').length;

          if(uploadedfile>=3){

              $('.main_upload_sec').hide();

          }else{
              $('.main_upload_sec').show();
          }


          if(uploadedfile==3){
              $('.btnSectionRemove').hide();

          }else{
              $('.btnSectionRemove').show();

          }

      },1000);
      $('.btnSectionClone').on('click',function(e){
          var uploadedfile = document.querySelectorAll('#img_url').length;
             if(uploadedfile>=2){
                 e.stop();


             }
      });


        $('#sidebar_recruit').addClass('current_section');
        $('#sidebar_customer').addClass('act_item');
        $('.customer_information').addClass('md-bg-blue-grey-100');
    </script>
    <!-- handlebars.js -->
    <script src="{{ url('admin/bower_components/handlebars/handlebars.min.js')}}"></script>
    <script src="{{ url('admin/assets/js/custom/handlebars_helpers.min.js')}}"></script>

    <!--  invoices functions -->


@endsection

