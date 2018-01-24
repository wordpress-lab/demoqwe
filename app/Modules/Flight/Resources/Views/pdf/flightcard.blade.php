<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    #company_header{
        font-size:9px;
    }
    #flight_card{
        font-size:12px;
    }
    #companyinfo{
        clear: both;
    }
    #table_content tr td{
        border: 1px solid black;
    }
    #table_content
    {
        width: 60%;
        font-size:11px;
        margin: 0 auto;


    }
    #table_title{
        text-align: right;
        width: 25%;
    }
    #table_conttent{
        text-align: left;
        width: 75%;
    }
</style>
    <title>Flight Card</title>
</head>

<body>

<div id="company_header">

    <div class="companyinfo" style="text-align: center;">
        <img style="text-align: center;" class="logo_regular" src="{{ url('uploads/op-logo/logo.png') }}" alt="" height="35" width="71"/>
        <div style="line-height:22px;font-size:17px;width: 100%; text-align: center;">{{ $OrganizationProfile->company_name }}</div>
        <div>{{ $OrganizationProfile->street }},{{ $OrganizationProfile->city }},{{ $OrganizationProfile->state }},{{ $OrganizationProfile->country }}</div>

        <div style="">{{ $OrganizationProfile->email }},{{ $OrganizationProfile->contact_number }}</div>

        <div id="flight_card" style="margin-top: 10px; text-transform: uppercase; text-decoration: underline; font-weight: 600;  font-family: Arial, Verdana, sans-serif"> Flight Card</div>
    </div>

    <div  style="margin-top: 10px; width: 100%">
        <table id="table_content" cellspacing="0" cellpadding="5">
               <tr>
                   <td id="table_title">Passenger Name :</td>
                   <td id="table_conttent"> {{ $flightcard->paxId['passenger_name'] }}</td>
               </tr>

               <tr>
                   <td id="table_title">Pax Id: </td>
                   <td id="table_conttent"> {{ $flightcard->paxId['paxid'] }} </td>
               </tr>
               <tr>
                   <td id="table_title">Passport Number :</td>
                   <td id="table_conttent">{{ $flightcard->paxId['passportNumber'] }} </td>
               </tr>
               <tr>
                   <td id="table_title">Contact Number :</td>
                   <td id="table_conttent"> {{ isset($flightcard->paxId->recruit_customer)?$flightcard->paxId->recruit_customer['contact_number']:'' }}</td>
               </tr>
               <tr>
                   <td id="table_title">Reference Name: </td>
                   <td id="table_conttent"> {{ $flightcard->paxId->customer_id?$flightcard->paxId->customer['display_name']:'' }}</td>
               </tr>
               <tr>
                   <td id="table_title">Expected Date of Flight: </td>
                   <td id="table_conttent"> {{ $flightcard['flightDate'] }} </td>
               </tr>
       </table>
    </div>

</div>

</body>
</html>