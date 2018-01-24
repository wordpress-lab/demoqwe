<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <style>
        

        table#header tr td {
            text-align: left;
            width: 33%;
            font-size: 15px;
        }

        table#body {
            border-collapse: collapse;
        }

        table#body tr td {
            border: 1px solid black;
            text-align: center;
        }

        table#body tr tr:first-child td {
            border-bottom: 1px solid grey;
            padding: 10px;
        }

    </style>
</head>

<body>

<div style="text-align: center;">
    <h3>Payroll</h3>
</div>
<div style="text-align: right; font-size: 12;">
    For the period from 01 January to 01 January
</div>
<div style="font-size: 13;">
    <p>We Hereby Acknowledge to have received from ................ at its office at ...............
    the sum specified opposite our respective names, as full compensation for the period.</p>
</div>
<hr  style="height: 2px; color: #0a001f" />
<table id="body" style="width: 100%; text-align: left; vertical-align: top; font-size: 10px;">

    <tr>
        <td style="border-bottom: 1px solid black; padding: 7px;">#</td>
        <td style="border-bottom: 1px solid black; padding: 7px; text-align: center;">Employee<br>Name</td>
        <td style="border-bottom: 1px solid black;padding: 7px; text-align: center;">Basic<br>Pay</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">Allowance</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">Total</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">Over<br>Time</td>
        <td style="border-bottom: 1px solid black; padding: 7px; width: 100px; text-align: center;">Total<br/>Overtime<br>Amount </td>
        <td style="border-bottom: 1px solid black; padding: 7px; text-align: center;">Days<br>Absent </td>
        <td style="border-bottom: 1px solid black; padding: 7px; text-align: center;" colspan="3">Allowance
            <table id="sub" style="width: 125%; border-top: 1px solid black;">
                <tr>
                    <th>FB</th>
                    <th>TA</th>
                    <th>DA</th>
                </tr>
            </table>
        </td>
        <td style="border-bottom: 1px solid black; padding: 7px;width: 100px; text-align: center;">Total<br>Allowance </td>
        <td style="border-bottom: 1px solid black; padding: 7px; text-align: center;" colspan="3">Deduction
            <table id="sub" style="width: 125%; border-top: 1px solid black;">
                <tr>
                    <th>FB</th>
                    <th>TA</th>
                    <th>DA</th>
                </tr>
            </table>
        </td>
        <td style="border-bottom: 1px solid black; padding: 7px;width: 100px; text-align: center;">Total<br>Deduction </td>
        <td style="border-bottom: 1px solid black; padding: 7px; text-align: center;">Net<br>Amount<br>Paid</td>
        <td style="border-bottom: 1px solid black; padding: 7px; text-align: center;">Signature of<br>Payee</td>


    </tr>


    <?php $i=1; ?>
   
        <tr>
            <td>1</td>
            <td>dd</td>
            <td>dd</td>
            <td>dd</td>
            <td>dd</td>
            <td width="50px">dd</td>
            <td>dd</td>
            <td>dd</td>
            <td style="text-align: center;" >
                dd
            </td>
            <td>asd</td>
            <td>asd</td>
            <td>asd</td>
            <td style="text-align: center;">dd</td>
            <td>dd</td>
            <td>dd</td>
            <td>dd</td>
            <td>
                dd
            </td>
            <td>ss</td>

            
        </tr>
        <tr>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
            <td>Total</td>
        </tr>
    

</table>
<br>
<div>
    <p>I Hereby certify that I have personally paid in cash to each employee whose name appears above the amount set opposite his/her name.</p>
</div>
<br>
<table id="header"  style="width: 100%">

    <tr>
        <td style="text-align: left;">&nbsp; Approved By &nbsp;</td>
        <td style="text-align: right;">Cerfified Correct:</td>

    </tr>

</table>
<br>
<br>
<table id="signature"  style="width: 100%">

    <tr>
        <td style="text-align: left; text-decoration: overline;">&nbsp; &nbsp; Disbursing Officer &nbsp; &nbsp;</td>
        <td style="text-align: left; text-decoration: overline;">&nbsp; &nbsp; Department Head &nbsp; &nbsp;</td>
        <td style="text-align: right; text-decoration: overline;">&nbsp; &nbsp; Paymaster &nbsp; &nbsp;</td>

    </tr>

</table>

</body>

</html>