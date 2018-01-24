<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        .flex-container {
            display: -webkit-flex;
            display: flex;
            width: 700px;
            height: auto;
            border-bottom: 1px solid black;

        }

        .flex-item {

            width: 30%;
            margin: 1px;
        }

        .flex-item-2 {

            width: 50%;
            margin: 1px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script src="../assets/js/html2canvas.js"></script>

    <script>

        function genPDF() {


            html2canvas(document.getElementById('testdiv'),{
                onrendered : function(canvas){
                    var img = canvas.toDataURL('image/png');
                    var doc= new jsPDF();
                    doc.addImage(img,'JPEG',10 ,10);
                    doc.save('test.pdf');
                },
                background:'#fff'
			
            })
        }
    </script>
</head>


<body >
<a href="javascript:genPDF()">Download PDF</a>
<div id="testdiv">
<div class="flex-container">
    <div class="flex-item"><img height="80" width="80" src="user.png" /></div>
    <div class="flex-item" style="position: relative; left: 50px;"> <img height="80" width="80" src="embassy.png" /></div>
    <div class="flex-item"> <span style="text-transform: uppercase; font-weight: bold; font-size: 10px; text-align: right; position: relative; left:120px; ">
        ????? ??????? ??????? ???????? <br/>????? ???????
        <br/>Embassy of soudia arabia <br/> consular section</span></div>
</div>
<div class="flex-container">
    <div class="flex-item-2"> Full Name: <span style="text-transform: uppercase; font-size: 12px; font-weight: bold">MOHAMMAD FARUK .S/O NURUL AMIN</span> </div>
    <div class="flex-item-2"> <span style="text-align: right; position: relative; right: -280px; top:-0px;">  :????? ????</span></div>

</div>

<div class="flex-container">
    <div class="flex-item-2"> Mothers Name: <span style="text-transform: uppercase; font-size: 12px; font-weight: bold">Payer BEGUM</span> </div>
    <div class="flex-item-2"> <span style="text-align: right; position: relative; right: -284px; top:-0px;">????? ????</span></div>

</div>

<div class="flex-container">
    <div class="flex-item">Date Of Birth : <span style="text-align: center"> ????????? </span></div>
    <div class="flex-item" style="width: 50%"> Place Of birth : <span style="text-transform: uppercase; font-weight: bold; font-size: 12px;">Lakshinipur , 01,01,1987</span></div>
    <div class="flex-item" style="width: 20%"><span style="text-align: left; position: relative; left:78px; top:-0px;">????? ????</span></div>
</div>
<div class="flex-container">
    <div class="flex-item" style="width: 40%">Previous Nationality :  <span style="text-transform: uppercase; font-weight: bold;font-size: 12px;">Bangladesi :????? ????</span> </div>
    <div class="flex-item" style="width: 40%"> Present Nationality : <span style="text-transform: uppercase; font-weight: bold;font-size: 12px;">Bangladeshi</span></div>
    <div class="flex-item" style="width: 20%"><span style="text-align: left; position: relative; left:89px; top:-0px;">????????? </span></div>
</div>
<div class="flex-container">
    <div class="flex-item" style="width: 100%"> Sex : <span style="border: 1px solid black;"> Female </span>
    <span style="border: 1px solid black; margin: 1px; "> Male   </span>
    <span>:?????? ?? ??? ??????</span>
    Marital Status: <span style="text-transform: uppercase; font-weight: bold;font-size: 11px;">Married</span>
    <span style="text-align: left; position: relative; left:156px; top:-0px;" > :?????? ?? ??? ??????</span>
</div>

</div>

<div class="flex-container">
    <div class="flex-item" style="width: 100%">
        Sect :   <span style="padding-left: 150px;">:?? ??? ??????</span>


        Religion: <span style="text-transform: uppercase;font-weight: bold; font-size: 12px;">Islam</span>
        <span style="text-align: left; position: relative; left:190px; top:-0px;" > :?????? ?? ??? ??????</span>
    </div>
 </div>

<div class="flex-container">
    <div   style="width: 25%;"> <span style="text-align: left; position: relative; top:10px;" >Place Of Issue :</span></div>
    <div  style="width: 25%">    :???????
        <br/>
        Qualification:</div>
    <div  style="width: 25%">                                                                       :???????
        <br/>
        Profession:
    </div>
    <div  style="width: 25%; text-align: right">:???????
        <br/>
        Personal Driver</div>
</div>

<div class="flex-container">
    <div class="flex-item-2" style="width: 75%"> Home Address and telephone No: <span style="text-transform: uppercase; font-size: 12px; font-weight: bold ">BaUor khara .laxmipur AMIN</span> </div>
    <div class="flex-item-2" style="width: 25%; text-align: right">  ?????:????? ????</div>

</div>

<div class="flex-container">
    <div class="flex-item-2" style="width: 75%"> Business Address and telephone No: <span style="text-transform: uppercase; font-size: 12px; font-weight: bold ">Ananda trading .laxmipur Rl - 125</span></div>
    <div class="flex-item-2" style="width: 25%; text-align: right">  ?????:????? ????:</div>

</div>

<div class="flex-container">
    <div style="width: 100%; text-align: center"> <span style="text-transform: uppercase; position: relative; text-align: center; font-size: 12px; font-weight: bold "> Shawan Tower ,2/c purana paltan ,Dhaka-1000,tel:947854 </span></div>


</div>
<div class="flex-container">
    <div  style="width: 80%;padding: 10px 0px;">  Purpose of Travel :
        <span style="border: 1px solid black;margin: 1px; padding: 5px;">    work  </span>
        <span style=" border: 1px solid black;margin: 1px; padding: 5px;"> Transit  </span>
        <span style="border: 1px solid black;margin: 1px; padding: 5px;"> Visit  </span>
        <span style="border: 1px solid black;margin: 1px; padding: 5px;"> Umrah   </span>
        <span style=" border: 1px solid black;margin: 1px; padding: 5px;"> Residence  </span>

        <span style=" border: 1px solid black;margin: 1px; padding: 5px; "> Hajj   </span>
        <span style=" border: 1px solid black;margin: 1px; padding: 5px; "> Diplomacy  </span>
    </div>
    <div  style="width: 20%; padding: 5px 0px; text-align: right">  ?????:????? ????:</div>

</div>

<div class="flex-container">
    <div class="flex-item" style="width: 45%">???? ?????: <br/>  Place of Issue :<span style="text-align: center"> Dhaka</span> <br/> Date of passport's Expiry :<span style="text-align: center"> 24.15.2017</span> </div>
    <div class="flex-item" style="width: 30%"> ????? ????? ??????: <br/>Date Passport Issue : <span style="text-transform: uppercase; font-weight: bold"> 01,01,1987</span></div>
    <div class="flex-item" style="width: 25%; text-align: right">  ??? ???? ?????: <br/> Passport No : <span style="text-align: center"> bln784kl  </span> <br/> <span style="text-align: center"> ????? ?????? ???? ?????: </span>
    </div>
</div>
<div class="flex-container">
    <div class="flex-item" style="width: 45%">:???? ????<br/>  Duration stay in the kingdom :<span style="text-align: center"> 90</span> </div>
    <div class="flex-item" style="width: 30%"> ????? ????? ??????: <br/>Date of arrival : <span style="text-transform: uppercase; font-weight: bold"> 01,01,1987</span></div>
    <div class="flex-item" style="width: 25%; text-align: right">  ????? ????? ??????: <br/>  <span style="position: relative; right: 80px;"> Date of departure : </span>
    </div>
</div>

<div class="flex-container">
    <div  style="width: 20%;padding: 5px 0px;"> Mode of Payment :???
    </div>
    <div  style="width: 80%; padding: 5px 0px; text-align: right">

        <span style="word-spacing:10px; ">   ()  ???? ???? ()  ???? ????   ()  ???? ???? ()  ???? ???? ()  ???? ????</span>
        <br/>
        <span style=" position: relative; right: 100px; word-spacing:10px;  "> Fee() Cash() Check No () Date: No() Date: </span>
    </div>

</div>

<div class="flex-container">
    <div class="flex-item" style="width: 45%"> Relationship :</div>
    <div class="flex-item" style="width: 30%"> ????? ????:</div>
    <div class="flex-item" style="width: 25%; text-align: right">  ????? ????? </div>
</div>
<div class="flex-container">
    <div class="flex-item" style="width: 25%"> Destination :</div>
    <div class="flex-item" style="width: 25%;text-align: right"> ????? ?????:</div>
    <div class="flex-item" style="width: 25%; text-align: left"> Carrier's name:</div>
    <div class="flex-item" style="width: 25%; text-align: right">  ?????  </div>
</div>
<div class="flex-container">
    <div class="flex-item" style="width: 50%"> Dependents traveling in the same passport:</div>
    <div class="flex-item" style="width: 50%;text-align: right"> ???????? ????? ?? ??? ???? ?????:</div>

</div>
<div class="flex-container">
<table cellpadding="0" cellspacing="0" width="100%" border="1">
    <thead>
    <tr>
        <th width="25%">
            ????????

            <br/>
           <span style="font-size: 14px; font-weight: bold "> RelationShip</span>
        </th>
        <th width="25%">
            ????? ???????

            <br/>
            <span style="font-size: 14px; font-weight: bold "> Date of Birth </span>
        </th>
        <th width="25%">
            ???
            <br/>
            <span style="font-size: 14px; font-weight: bold ">  Sex </span>
        </th>
        <th width="25%">
            ????? ??????
            <br/>
            <span style="font-size: 14px; font-weight: bold "> Full name </span>
        </th>
    </tr>
    </thead>
    <tr>
        <td width="25%">Group :01;</td>
        <td width="25%">City: RASS;</td>
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
    </tr>
    <tr>
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
    </tr>
    <tr>
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
    </tr>
    <tr>
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
    </tr>

</table>
</div>
<div class="flex-container">
    <div class="flex-item" style="width: 60%"> Name and address of company or individual in the kingdom :</div>
    <div class="flex-item" style="width: 40%;text-align: right"> ???????? ????? ?? ??? ???? ?????:</div>

</div>
<div class="flex-container">
    <div class="flex-item" style="width: 100%; font-size: 13px;"> MOHAMMAD FARUK .S/O NURUL AMIN ,ksa</div>
</div>
<div class="flex-container" style="border: none;">
    <div class="flex-item" style="width: 60%;font-size: 12px;">  The undersigned hereby certify that all information I have provoder are correct . <br/>
        I will abide by the laws of the Kingdom during the period of my residence in it.</div>
    <div class="flex-item" style="width: 40%; font-size: 12px;text-align: right"> ?? ??????, ?? ???????, ?? ???????, ?? ??? ?????, ?? ???????, ?? <br/>??????, ?? ?????, ?? ????? ??????, ?? ??????, ?? ????????</span></div>

</div>

<div class="flex-container" style="border: none;" >
    <div class="flex-item" style="width: 15%"> Date :</div>
    <div class="flex-item" style="width: 15%;text-align: right"> ????? :</div>
    <div class="flex-item" style="width: 15%; text-align: left"> Signature:</div>
    <div class="flex-item" style="width: 20%; text-align: right">  ?????  </div>
    <div class="flex-item" style="width: 40%; text-align: left">  Name :<span style="text-transform: uppercase"> Mohammad Faruk</span>  </div>
    <div class="flex-item" style="width: 25%; text-align: right">  ??? </div>
</div>

<div class="flex-container" style="border: none;">
    <div class="flex-item" style="width: 60%;font-size: 12px;">   <span style="text-decoration: underline; font-weight: bold"> For official use only </span></div>
    <div class="flex-item" style="width: 40%; font-size: 12px;text-align: right"><span style="text-align: right;text-decoration: underline; font-weight: bold;border-bottom-color:white"> ????????? ?????? ???:</span></div>

</div>

<div class="flex-container" >
    <div class="flex-item" style="width: 25%"> Date : 14/12/19</div>
    <div class="flex-item" style="width: 25%">Authorization</div>
    <div class="flex-item" style="width: 20%; text-align: right"> 656565 </div>
    <div class="flex-item" style="width: 30%; text-align: right">  ???????????????????? ????:</div>

</div>
<div class="flex-container" >
    <div class="flex-item" style="width: 40%"> Visit /Works for:</div>
    <div class="flex-item" style="width: 35%; text-align: left ">??  ??????, ??? ????????</div>

    <div class="flex-item" style="width: 30%; text-align: right">  ??, ?? ???????, ?? ??????????, ????:</div>

</div>

<div class="flex-container" >
    <div class="flex-item" style="width: 25%"> Date : </div>
    <div class="flex-item" style="width: 15%">?????</div>
    <div class="flex-item" style="width: 30%; text-align: left"> Visa No: </div>
    <div class="flex-item" style="width: 30%; text-align: right">  ?????? ????:</div>

</div>
<div class="flex-container" >
    <div class="flex-item" style="width: 25%"> Fee Collection: : </div>
    <div class="flex-item" style="width: 15%">:?????? ??????</div>
    <div class="flex-item" style="width: 15%; text-align: left"> Type: </div>
    <div class="flex-item" style="width: 15%; text-align: right">  ?????? :</div>
    <div class="flex-item" style="width: 15%; text-align: left">  Duration :</div>
    <div class="flex-item" style="width: 15%; text-align: right">  ??????? :</div>

</div>

<div class="flex-container" style="border: none;">
    <div class="flex-item" style="width: 35%">  <span style=" font-weight: bold"> ???? ????? ???????<br/> Head of Consular Section </span>:</div>
    <div class="flex-item" style="width: 30%; text-align: left ">   ??? ????????   1054541321</div>

    <div class="flex-item" style="width: 35%; text-align: right"> <span style="text-align: right; font-weight: bold;border-bottom-color:white">??? ??????
 <br/> Checked By</span> </div>

</div>
</div>
</body>
</html>