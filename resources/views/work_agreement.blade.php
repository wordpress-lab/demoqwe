<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
   <title> Work Agreement</title>
    <style type="text/css">

        #wrap {
            width:800px;
            margin:0 auto;


        }
        #left_col {
            float:left;
            width:50%;

        }
        #right_col {
            margin-top: 10px;
            float:right;
            width:50%;
        }

        #sec tr{


        }



    </style>
</head>

<body style="font-family: freeserif;">

<div>
    <div id="testdiv" >

        <h2 style="text-align: center;text-decoration: underline">Work Agreement</h2>

        <table width="100%">

            <tr>
                <td height="30" colspan="3"></td>

            </tr>
            <tr style="">

                <td style="vertical-align: center; width: 15%"><h4> 1<sup>st</sup>  party    </h4></td>
                <td style="text-align: left; width: 40%">         : <span style="text-transform: uppercase;"> {{ $company->nameAr }} </span>  </td>

            </tr>
            <tr style="">

                <td style="vertical-align: center; width: 15%"> <h4> 2<sub>nd</sub>  party </h4></td>
                <td style="text-align: left; width: 40%">    : <span style="text-transform: uppercase;">{{ $contact }}</span></h4>     </td>

            </tr>

            <tr style="">

                <td style="vertical-align: center; width: 15%"><h4> Passport No </h4> </td>
                <td style="text-align: left; width: 40%">    : <span style="text-transform: uppercase;"> {{ $recruit->passportNumber }}</span></h4>     </td>

            </tr>

            <tr style="">

                <td style="vertical-align: center; width: 15%"> <h4> Nationality </h4> </td>
                <td style="text-align: left; width: 40%">     : <span style="text-transform: uppercase;"> {{ $customer->presentNationality }}</span></h4>   </td>

            </tr>

            <tr style="">

                <td style="vertical-align: center; width: 15%"> <h4> Profession </h4> </td>
                <td style="text-align: left; width: 40%">      : <span style="text-transform: uppercase;"> {{ $customer->professionAR }}</span></h4>   </td>

            </tr>

        </table>
<br/>
<br/>
        <table id="sec" width="100%">


            @foreach($agreement as $key=> $item)
                @php
                $k= ++$key;
                @endphp
                <tr>
                    <td  style="vertical-align: top;">{{ $k }}.</td>
                    <td style="vertical-align: top;"> {!! $item->agreementEn !!}
                    </td>

                    <td style="text-align: right">{!! $item->agreementAr !!}  </td>
                    <td style="vertical-align: top">.{{ $k }}</td>
                </tr>

            @endforeach



        </table>
<br/>
 <br/>
  <br/>
        <table id="sec">

            <tr style="">
                <td width="30%"> Signature of the first party-</td>
                <td width="45%"> </td>

            </tr>

            <tr>
                <td  width="30%" style="padding: 30px 0px;"> Signature of the second party-</td>
                <td width="45%"> </td>

            </tr>
        </table>

    </div>
</div>
</body>

</html>