<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <style>
         body{
         text-transform:uppercase;
        }

     table#header tr td {
       text-align: center;
       text-transform:uppercase;
       width: 33%;
       font-size: 12px;
       font-weight: bold;

     }

         table#body tr td {
             text-align: center;


         }
         table#body tr tr:first-child td {
             border-bottom: 1px solid grey;
             padding: 10px;
         }


    </style>
</head>

<body>

<table id="header"  style="width: 100%">
  <tr>
      <td>modele serial</td>
      <td> Agent Billing Details</td>
      <td>42-3 014522 air chennel international</td>

  </tr>

</table>
<hr  style="height: 2px; color: #0a001f" />
<table id="body"  style="width: 100%; text-align: right; vertical-align: top; font-size: 10px;">

    <tr>
        <td style="border-bottom: 1px solid black; padding: 7px;">SERIAL</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">SRTNC</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">DOCUMENT <br/> NUMBER</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">Issue Date</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">CPUI</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">NR <br/>Code</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">STATE FOP</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">Transection <br/> Amount</td>
        <td style="border-bottom: 1px solid black; padding: 7px;">FARE Amount</td>
        <td style="border-bottom: 1px solid black; padding: 7px; width: 100px;"> <br/>TAX </td>
        <td style="border-bottom: 1px solid black; width: 110px;">Taxes, Fees & Charges <br/>F&C  </td>
        <td style="border-bottom: 1px solid black; padding: 7px;"> <br/> PEN </td>
        <td style="border-bottom: 1px solid black; padding: 7px;width: 100px;"> COBL Amount.....</td>
        <td style="border-bottom: 1px solid black; padding: 7px;"> <br/> Rate </td>
        <td style="border-bottom: 1px solid black; padding: 7px; width: 100px;"> .....STD Comm...... </td>
        <td style="border-bottom: 1px solid black; padding: 7px;"> <br/>amt </td>
        <td style="border-bottom: 1px solid black; padding: 7px;"> <br/>rate </td>
        <td style="border-bottom: 1px solid black; padding: 7px;width: 100px;"> .....Supp Comm--- </td>
        <td style="border-bottom: 1px solid black; padding: 7px;"> <br/>Amt </td>
        <td style="border-bottom: 1px solid black; padding: 7px;width: 100px;"> Tax on Comm </td>
        <td style="border-bottom: 1px solid black; padding: 7px;"> Balance <br> Payable</td>


    </tr>

    @for($i=0;$i<18;$i++)
    <tr>
        <td>997</td>
        <td>tktc</td>
        <td>54646165</td>
        <td>04Aprc</td>
        <td>sdsds</td>
        <td></td>
        <td>CA</td>
        <td>26.224</td>
        <td>19,2545</td>
        <td width="50px"> 500 bdt <br/> 159 ind<br/> 5959 es <br/> 5959 es <br/> 5959 es </td>
        <td></td>
        <td></td>
        <td> 19,8522</td>
        <td> 7.00 </td>
        <td> .... </td>
        <td> 1,524 </td>
        <td> 00.00 </td>
        <td>  </td>
        <td> 0 </td>
        <td> -56 </td>
        <td> 24,22455</td>


    </tr>
    @endfor
</table>



</body>

</html>