<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <style>
        .flex-container {
            display: -webkit-flex;
            display: flex;
            width: 750px;
            height: auto;
            margin:0 auto;
            text-transform:uppercase;
        }

        .flex-item {

            width: 30%;
            margin: 1px;
        }

        .flex-item-2 {

             width: 50%;

         }

        .flex-item-3 {

            width: 50%;

            margin-left: 300px;
            margin-top: -20px;

        }





        .padding {
            padding:15px 0px;

        }
    </style>
</head>

<body style="font-family: freeserif;">

<div>
    <div id="testdiv">
        <div class="flex-container" style=" padding: 20px 0px; line-height:3px;">
            <div style="width:30%;padding-left: 95px"><img width="50%" src="{!! asset('uploads/op-logo/') !!}/{!! isset($organ->logo)?$organ->logo:'' !!}" /></div>
            <div style="width:70%;text-align:center; float: left; margin-left: 150px; margin-top: -70px;">
                <h1 style="font-size:30px;"> {!! $form->companyNameEN !!} </h1> <p style="font-size:14px;"> (Govt. Approved Recruiting Agent ,{!! $form->licenceEN !!}) </p>
            </div>

        </div>
        <div class="flex-container" style="margin-top: 30px;">
            <div style="width:50%; text-transform:uppercase; line-height:2px; padding: 10px 0px;" >
                <h4> His Excellency</h4>
                <h4> the Chief of consulate section </h4>
                <h4> the royal embassy of saudi arabia </h4>
                <h4> Dhaka , Bangladesh</h4>
                <h4>  </h4>
            </div>

        </div>

        <div class="flex-container">
            <div style="width:50%; text-transform:uppercase; line-height:0px;" >
                <h4> Excellency, </h4>

            </div>

        </div>
        <div class="flex-container">
            <div style="width:100%; text-transform:uppercase; line-height:20px;" >
                <p> with Due respect i am submitting one passport for work visa with all necessary documents and particulars  mentioned as below , and i abide by all the rule and regulartion of the consulate section:  </p>

            </div>

        </div>

        <div class="flex-container padding">
            <div class="flex-item-2">1. Name of the employer <br/> &nbsp;&nbsp;&nbsp;&nbsp;in saudi arabia  </div>
            <div class="flex-item-3" > : {{ $name->nameAr }}</div>

        </div>

        <div class="flex-container padding">
            <div class="flex-item-2">2. visa no. & date  </div>
            <div class="flex-item-3"> : <span style="text-align: left; padding:0px 50px; font-weight:bold"> {{ $visanumber->visaNumber }} </span>&nbsp;&nbsp;&nbsp; Date. {{ $visanumber->visaIssuedate }} </div>

        </div>
        <div class="flex-container padding">
            <div class="flex-item-2">3. full name of the employee  </div>
            <div class="flex-item-3"> : <span style="text-align: left; padding:0px 20px; font-weight:bold"> {{ strtoupper($contact) }} </span> </div>

        </div>

        <div class="flex-container padding">
            <div class="flex-item-2">4. passport no. and issue date  </div>
            <div class="flex-item-3"> : <span style="text-align: left; padding:0px 50px; font-weight:bold"> {{ $recruit->passportNumber }} </span>&nbsp;&nbsp;&nbsp; dt. {{ $recruit->passportDate }} </div>

        </div>
        <div class="flex-container padding">
            <div class="flex-item-2">5. Profession  </div>
            <div class="flex-item-3"> : <span style="text-align: left; padding:0px 20px; font-weight:bold"> {{ strtoupper($customer->professionAR) }} </span>  </div>

        </div>
        <div class="flex-container padding">
            <div class="flex-item-2">6. Religion  </div>
            <div class="flex-item-3"> : <span style="text-align: left; padding:0px 20px; font-weight:bold"> {{ strtoupper($customer->religionEN) }} </span>  </div>

        </div>
        <div class="flex-container">
            <div style="width:100%; text-transform:uppercase; font-size:15px; line-height:18px;" >
                <p> i do hereby confirm and declare that , the religion stated in the visa form and forwarding letter is correct . i also take the responsibility to cancel the
                    visa and prevent us from functioning to our office , if the statement is found incorrect.
                </p>

            </div>

        </div>

        <div class="flex-container">
            <div style="width:100%; text-transform:uppercase; font-size:15px; line-height:20px;" >
                <p>
                    i therefore , request your excellency to kindly issue employment visa out of ..................... visas and oblige thereby
                </p>

            </div>

        </div>

        <div class="flex-container">
            <div style="width:100%; text-transform:uppercase; text-align:left; line-height:2px;" >
                <h4> Yours Faithfully, </h4>

            </div>

        </div>
    </div>
    </div>
</body>

</html>