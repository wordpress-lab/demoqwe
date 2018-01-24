<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Boss Ltd </title>
    <style>
        .flex-container {
            display: -webkit-flex;
            display: flex;
            width: 100%;
            height: auto;
            position: relative;
        }
        .center{
            text-align: center;
        }
        .float_left{
            float: left;
        }
        .float_right{
            float: right;
        }
        .clear{
         clear: both;
        }
        .flex-item{
            width: 100%;

        }


        .flex-item1 {

            width: 16.66%;

        }

        .flex-item-2 {

            width: 16.66%;

        }

        .flex-item-3 {

            width: 50%;

            margin-left: 300px;
            margin-top: -20px;

        }
        .padding {
            padding:15px 0px;

        }

        table tr td{


        }
        .border{

        border-top:none ;
        size: 10px;
        }
      /*input{*/
          /*border: none;*/
      /*}*/
    </style>
</head>

<body  style="margin-top: -45px; font-size: 13px; font-family: freeserif;">

 <div class="flex-container">

    <div class="flex-item">
        <h3 class="center"> BOSS LTD </h3>
        <p style="text-align: left"><span class="float_left"> Application Date ..................</span>  <span class="float_right"> Account Inforation Form (AIF)</span>
         <div  class="clear"></div>
        <p>Name of sales reprentative:  1) <input type="text" class="border"/></p>
        <p style="line-height: 1px; line-height: 0px;">Machines:</p>
        <div style="float: left;width: 16.66%; line-height: 3px;">
            <p>Model No:<input style="width: 50px;" type="text" class="border"/></p>
            <p>Model No:<input style="width: 50px" type="text" class="border"/></p>

            <p style="line-height: 12px;">Optional <br> Item:
                Model No:<input style="width: 23px" type="text" class="border"/>
               <p style="margin-left: 25px;"> Model No:<input style="width: 30px" type="text" class="border"/> <p>
            </p>
        </div>
        <div style="float: left;width: 16.66%; line-height: 8px; ">
            <p>Part No:<input style="width: 50px;" type="text" class="border"/></p>
            <p>Part No:<input style="width: 50px" type="text" class="border"/></p>
            <p>Part No:<input style="width: 50px" type="text" class="border"/></p>
            <p>Part No:<input style="width: 50px" type="text" class="border"/></p>
        </div>
        <div style="float: left;width: 16.66%; line-height: 8px; ">
            <p>Serial No:<input style="width: 50px;" type="text" class="border"/></p>
            <p>Serial No:<input style="width: 50px" type="text" class="border"/></p>
            <p>Serial No:<input style="width: 50px" type="text" class="border"/></p>
            <p>Serial No:<input style="width: 50px" type="text" class="border"/></p>
        </div>
        <div style="float: left;width: 16.66%; line-height: 8px; ">
            <p>Quantity:<input style="width: 50px;" type="text" class="border"/></p>
            <p>Quantity:<input style="width: 50px" type="text" class="border"/></p>
            <p>Quantity:<input style="width: 50px" type="text" class="border"/></p>
            <p>Quantity:<input style="width: 50px" type="text" class="border"/></p>
        </div>
        <div style="float: left;width: 16.66%; line-height: 8px; ">
            <p>Warrenty:<input style="width: 50px;" type="text" class="border"/></p>
            <p>Warrenty:<input style="width: 50px" type="text" class="border"/></p>
            <p>Warrenty:<input style="width: 50px" type="text" class="border"/></p>
            <p>Warrenty:<input style="width: 50px" type="text" class="border"/></p>
        </div>

        <div style="float: left;width: 16.66%; line-height: 8px; ">
            <p>Unit Price:<input style="width: 50px;" type="text" class="border"/></p>
            <p>Unit Price:<input style="width: 50px" type="text" class="border"/></p>
            <p>Unit Price:<input style="width: 50px" type="text" class="border"/></p>
            <p>Unit Price:<input style="width: 50px" type="text" class="border"/></p>
        </div>

        <div  class="clear"></div>

        <div style="float: left;width: 25%; line-height: 0px; ">
            <p>Bill Date:<input style="width: 100px;" type="text" class="border"/></p>

        </div>
        <div style="float: left;width: 25%; line-height: 0px; ">
            <p>Bill Amount(total):<input style="width: 50px;" type="text" class="border"/></p>

        </div>
        <div style="float: left;width: 33%; line-height: 0px; ">
            <p>Bussiness Promotion Amount:<input style="width: 60px;" type="text" class="border"/></p>

        </div>
        <div style="float: left;width: 17%; line-height: 8px; ">
            <p style="position: absolute; top:-20px; font-size: 11px; ">
                If there is any  BPA with the bill amount please provide the BPA approved
                quotation with
                this form
            </p>

        </div>
        <div class="clear"></div>

        <div style="float: left;width: 10%;margin-top: 0px;">
            <p style="font-size: 13px; ">
                Bill format
            </p>

        </div>
        <div style="float: left;width: 12%; line-height: 2px;margin-top: 3px;">
            <p style="font-size: 13px; ">

                <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Consolidated</span></label>
            </p>

        </div>
        <div style="float: left;width: 11%; line-height: 2px;margin-top: 3px;">
            <p style="font-size: 13px; ">

                <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Item wise</span></label>
            </p>

        </div>
        <div style="float: left;width: 16%; line-height: 2px;margin-top: 3px;">
            <p style="font-size: 13px; ">

                <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Customer Type</span></label>
            </p>

        </div>
        <div style="float: left;width: 11%; line-height: 2px;margin-top: 3px;">
            <p style="font-size: 13px; ">

                <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Individual</span></label>
            </p>

        </div>

        <div style="float: left;width: 11%; line-height: 2px;margin-top: 3px;">
            <p style="font-size: 13px; ">

                <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Corporate</span></label>
            </p>

        </div>
        <div style="float: left;width: 11%; line-height: 2px;margin-top: 3px;">
            <p style="font-size: 12px;position: absolute; left: -10px;">

                <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Price</span></label>
            </p>

        </div>
        <div style="float: left;width: 10%; line-height: 2px;margin-top: 5px; ">
            <p style="font-size: 12px; position: absolute; left: -47px; ">

                <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Project</span></label>
            </p>

        </div>

    </div>



 </div>
 <div class="clear"></div>
 <div class="flex-container">

     <div style="float: left;width: 50%; line-height: 2px;margin-top: 0px; ">
         <p style="font-size: 12px;">
             Billing information (Consignee)
         </p>
         <p style="width: 100%; height: 10px;">
             <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100% ;height: 10px;">
             <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100%; height: 10px;">
             <input style="width: 200px;"  type="text" class="border"/>
         </p>
         <p style="width: 100%; height: 10px;">
             <input style="width: 100px;"  type="text" class="border"/> Tel No <input style="width: 80px; border-top: none;"  type="text" class="border"/>
         </p>





     </div>
     <div style="float: left;width: 50%; line-height: 2px;margin-top: 0px; ">
         <p style="font-size: 12px;">
             Billing information ( If consignee is different)
         </p>

         <p style="width: 100%; height: 10px;">
             <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100% ;height: 10px;">
             <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100%; height: 10px;">
             <input style="width: 200px;"  type="text" class="border"/>
         </p>
         <p style="width: 100%; height: 10px;">
             <input style="width: 100px;"  type="text" class="border"/> Tel No <input style="width: 80px; border-top: none;"  type="text" class="border"/>
         </p>

     </div>

 </div>

 <div class="clear"></div>
 <div class="flex-container">

     <div style="float: left;width: 15%;margin-top: 0px;">
         <p style="font-size: 13px; ">
             Payment Terms
         </p>

     </div>
     <div style="margin-left: 2px;">
         <div style="float: left;width: 8%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; position:absolute; top:3px; ">

                 <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Cash</span></label>
             </p>

         </div>
         <div style="float: left;width: 10%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Cheque</span></label>
             </p>

         </div>
         <div style="float: left;width: 6%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">TT </span></label>
             </p>

         </div>
         <div style="float: left;width: 12%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Bank Draft</span></label>
             </p>

         </div>

         <div style="float: left;width: 12%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Credit Card</span></label>
             </p>

         </div>
         <div style="float: left;width: 17%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px;position: absolute; ">

                 <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Post dated Check</span></label>
             </p>

         </div>
         <div style="float: left;width: 15%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px;position: absolute; top: 10px; ">

                 Tel No <input style="width: 40px; border-top: none;"  type="text" class="border"/>
             </p>

         </div>
     </div>




 </div>

 <div class="clear"></div>
 <div class="flex-container">

     <div style="float: left;">

     </div>
     <div style="margin-left: 2px; position: absolute; top:-35px; left: 106px;" >
         <div style="float: left;width: 22%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; position:absolute; top:0px; ">

                 <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: middle;">Check before Delivery</span></label>
             </p>

         </div>
         <div style="float: left;width: 6%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: middle;">PO</span></label>
             </p>

         </div>
         <div style="float: left;width: 15%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: middle;">Cash Cheque </span></label>
             </p>

         </div>
         <div style="float: left;width: 30%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: middle;">partial payment & amount</span></label><input style="width: 20px; border-top: none;"  type="text" class="border"/>
             </p>

         </div>

         <div style="float: left;width: 30%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px;">

                 <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: middle;">Balance due will clear on</span></label><input style="width: 20px; border-top: none;"  type="text" class="border"/>
             </p>

         </div>


     </div>






 </div>
 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 2px;margin-top: 0px; ">
         <p style="width: 100%; height: 10px;">
             Purchaser:
         </p>
         <p style="width: 100%; height: 10px;">
             Name: <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100% ;height: 10px;">
             Tel No:  <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100%; height: 10px;">
             Email No:  <input style="width: 200px;"  type="text" class="border"/>
         </p>






     </div>
     <div style="float: left;width: 50%; line-height: 10px;margin-top: 10px; position: absolute; top:15px;">
         <p style="font-size: 12px;">
             Designation: <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100%; height: 10px;">
             Mobile No: <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100% ;height: 10px;">
             Fax No: <input style="width: 200px;" type="text" class="border"/>
         </p>



     </div>

 </div>

 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 2px;margin-top: 0px; ">
         <p style="width: 100%; height: 10px;">
             Person in Charge of Payament:
         </p>
         <p style="width: 100%; height: 10px;">
             Name: <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100% ;height: 10px;">
             Tel No:  <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100%; height: 10px;">
             Email No:  <input style="width: 200px;"  type="text" class="border"/>
         </p>






     </div>
     <div style="float: left;width: 50%; line-height: 10px;margin-top: 10px; position: absolute; top:15px;">
         <p style="font-size: 12px;">
             Designation: <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100%; height: 10px;">
             Mobile No: <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100% ;height: 10px;">
             Fax No: <input style="width: 200px;" type="text" class="border"/>
         </p>



     </div>

 </div>
 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 2px;margin-top: 0px; ">

         <p style="width: 100%; height: 10px;">
           1. Have you Visited the customer's premises?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;margin-top: -5px; ">
         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Yes</span></label>
         </p>




     </div>
     <div style="float: left;width: 15%; line-height: 10px;margin-top: -5px; ">
         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">No</span></label>
         </p>



     </div>
     <div style="float: left;width: 15%; line-height: 10px;margin-top: -5px; ">
         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Later</span></label>
         </p>



     </div>

 </div>

 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 2px; position: absolute; top:-20px;">

         <p style="width: 100%; height: 10px;">
             2. How Long the customer been occupying the premises?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-25px; ">
         <p style="font-size: 12px;  ">

             <label><input style="width: 30px;" type="text" ><span style="vertical-align: text-top;">Year</span></label>
         </p>




     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-25px; ">
         <p style="font-size: 12px;  ">

             <label><input style="width: 30px;" type="text"  ><span style="vertical-align: text-top;">Month</span></label>
         </p>



     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-25px; ">
         <p style="font-size: 12px;  ">

             <label><input style="width: 30px;" type="text" ><span style="vertical-align: text-top;">day</span></label>
         </p>



     </div>

 </div>
 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 10px; position: absolute; top:-20px;">

         <p style="width: 100%; height: 10px;">
             3. Have you checked with the neighbours to confirm answer given in question no 2 ?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-20px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Yes</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-20px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">No</span></label>
         </p>

     </div>


 </div>
 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 10px; position: absolute; top:-20px;">

         <p style="width: 100%; height: 10px;">
             4. Is the premises rented or owned ?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-20px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Owned</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-20px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Rented</span></label>
         </p>

     </div>


 </div>
 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 5px; position: absolute; top:-20px;">

         <p style="width: 100%; height: 10px;">
             5. How is the Office setup?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-20px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Old</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-20px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">New</span></label>
         </p>

     </div>


 </div>

 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 5px; position: absolute; top:-30px;">

         <p style="width: 100%; height: 10px;">
             6. No of Staff?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-20px; ">

         <p style="font-size: 12px;  ">

            <input type="text" name="checkbox" >
         </p>


     </div>



 </div>
 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 5px; position: absolute; top:-10px;">

         <p style="width: 100%; height: 10px;">
             7. Building type?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Shoplot</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">House</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">M/Story Building</span></label>
         </p>


     </div>



 </div>

 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 2px; position: absolute; top:-10px;">

         <p style="width: 100%; height: 10px;">
             8. How did customer get into contact with you?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Canvas</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Inquiry</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Walk in</span></label>
         </p>


     </div>



 </div>
 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 2px; position: absolute; top:-10px;">

         <p style="width: 100%; height: 10px;">
             9. Who did you liase with?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Owner</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Manager</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Executive</span></label>
         </p>


     </div>



 </div>
 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 2px; position: absolute; top:-10px;">

         <p style="width: 100%; height: 10px;">
             10. Are you confident of the payment?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Yes</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">No</span></label>
         </p>


     </div>




 </div>
 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 2px; position: absolute; top:-10px;">

         <p style="width: 100%; height: 10px;">
             11. Have you receive the Purchase Order?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Yes</span></label>
         </p>


     </div>
     <div style="float: left;width: 30%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">No <span style="font-size: 9px; vertical-align: text-top">(If Yes Please attached the PO with this form)</span></span></label>
         </p>


     </div>




 </div>
 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 2px; position: absolute; top:-10px;">

         <p style="width: 100%; height: 10px;">
             12. Have you delivered any product before?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">Yes</span></label>
         </p>


     </div>
     <div style="float: left;width: 20%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value"><span style="vertical-align: text-top;">No </span></label>
         </p>


     </div>




 </div>

 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 2px; position: absolute; top:-10px;">

         <p style="width: 100%; height: 10px;">
             13.Required Credit Days?
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-10px; ">

         <p style="font-size: 12px;  ">

             <label><input type="text" name="checkbox"><span style="vertical-align: text-bottom;"></span></label>
         </p>


     </div>





 </div>
 <div class="clear"></div>
 <div class="flex-container">
    <div style="float: left;width: 90%; line-height: 2px; position: absolute; top:-10px;">

         <p style="width: 100%; height: 10px;">
           As per My best knowledge above provided information is correct and I'm fully responsive to collect the payment
         </p>

     </div>
 </div>
 <div class="clear"></div>
 <div class="flex-container">
     <div style="float: left;width: 50%; line-height: 2px; position: absolute; top:10px;">

         <p style="width: 100%; height: 10px; text-decoration: overline">
      Signature of Executive
         </p>

     </div>
     <div style="float: left;width: 50%; line-height: 2px; position: absolute; top:10px; text-align: right">

         <p style="width: 100%; height: 10px; text-decoration: overline ">
             Signature of Manager
         </p>

     </div>
 </div>
 <div class="clear"></div>
 <div class="flex-container">
     <div style="float: left;width: 90%; line-height: 2px; position: absolute; top:-10px;">

         <p style="width: 100%; height: 10px;">
     Comments of sales Asst. Manager /Manager:
         </p>

     </div>
 </div>

 <div class="clear"></div>
 <div class="flex-container">
     <div style="float: left;width: 30%; line-height: 2px; position: absolute; top:-10px; text-align: left">

         <p style="width: 100%; height: 10px;">
             Operation No in CRM<input type="text" class="border" style="width: 50px;">
         </p>

     </div>
     <div style="float: left;width: 40%; line-height: 2px; position: absolute; top:-10px; text-align: left">

         <p style="width: 100%; height: 10px;">
             Opportunity Name <input type="text" class="border" style="width: 50px;">
         </p>

     </div>
     <div style="float: left;width: 30%; line-height: 2px; position: absolute; top:-10px; text-align: left">

         <p style="width: 100%; height: 10px;">
             Quotation No<input type="text" class="border" style="width: 100px;">
         </p>

     </div>
 </div>
 <div class="clear"></div>
 <div class="flex-container">
     <div style="float: left;width: 33%; position: absolute; top:10px;">

         <p style="width: 100%; ">
              <span style=" text-decoration: overline ">Signature of </span><br/> Accounts Dept
         </p>

     </div>
     <div style="float: left;width: 33%;  position: absolute; top:10px; text-align: center">

         <p style="width: 100%;  ">
              <span style=" text-decoration: overline ">Signature of </span> <br/> Manager/Admin Dept
         </p>

     </div>
     <div style="float: left;width: 33%;  position: absolute; top:10px; text-align: right">

         <p style="width: 100%;">
             <span style=" text-decoration: overline ">Signature of </span> <br/> Director / Manager Director
         </p>


     </div>
 </div>
 <div class="clear"></div>
 <div class="flex-container">
     <div style="float: left;width: 33%; position: absolute; top:10px;">

         <p style="width: 100%; ">
            Bill No: <input type="text" class="border" style="width: 50px;"> Bill Date: <input type="text" class="border" style="width: 50px;">
         </p>

     </div>
     <div style="float: left;width: 30%;  position: absolute; top:10px; text-align: center">

         <p style="width: 100%; text-decoration: overline  ">
               Signature of Billing Officer
         </p>

     </div>
     <div style="float: left;width: 36%;  position: absolute; top:10px; text-align: center">

         <p style="width: 100%;">
         Account Information Form (AIF Version 1.05)
         </p>


     </div>
 </div>
</body>

</html>