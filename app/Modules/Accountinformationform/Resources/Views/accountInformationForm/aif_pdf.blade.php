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
        @page { margin: 70px 50px; }
        #header { position: fixed; left: 0px; top: -60px;   right: 0px; text-align: center; }
        #header2 { position: fixed; left: 0px; top: -40px;   right: 0px; text-align: center; }

      /*input{*/
          /*border: none;*/
      /*}*/
    </style>
</head>

<body  style="margin-top: -45px; font-size: 13px; font-family: freeserif;">
 <div id="header"><h3> {{ $profile->display_name }}</h3> </div>
 <div id="header2"><h5>Account Inforation Form (AIF)</h5></div>
 <div class="flex-container">

    <div class="flex-item">
       
        <p style="text-align: left;"><span class="float_left" style="font-weight: bold;"> Application Date:</span> {{  date('d F  Y', strtotime($information->created_at)) }}  
         <div  class="clear"></div>
        <p><span style="font-weight: bold;">Name of sales representative:</span>  1) {{ $information->user->name }}</p>
        <p style="line-height: 1px; line-height: 0px;font-weight: bold;">Machines:</p>
        <div style="float: left;width: 16.66%; line-height: 3px;">
            <p>Model No: {{ isset($information->modelNo1->item_name)?$information->modelNo1->item_name:'' }}</p>
            <p>Model No: {{ isset($information->modelNo2->item_name)?$information->modelNo2->item_name:'' }}</p>

            <p style="line-height: 12px;font-weight: bold;">Optional Item:
                <p style="margin-left: 25px;">Model No: {{ isset($information->optionalModelNo1->item_name)?$information->optionalModelNo1->item_name:'' }}</p>
                <p style="margin-left: 25px;">Model No: {{ isset($information->optionalModelNo2->item_name)?$information->optionalModelNo2->item_name:'' }}</p>
            </p>
        </div>
        <div style="float: left;width: 16.66%; line-height: 8px; ">
            <p>Part No: {{ $information->machine_part_no_1 }}</p>
            <p>Part No: {{ $information->machine_part_no_2 }}</p>
            <p>Part No: {{ $information->optional_part_no_1 }}</p>
            <p>Part No: {{ $information->optional_part_no_2 }}</p>
        </div>
        <div style="float: left;width: 16.66%; line-height: 8px; ">
            <p>Serial No: {{ $information->machine_serial_no_1 }}</p>
            <p>Serial No: {{ $information->machine_serial_no_2 }}</p>
            <p>Serial No: {{ $information->optional_serial_no_1 }}</p>
            <p>Serial No: {{ $information->optional_serial_no_2 }}</p>
        </div>
        <div style="float: left;width: 16.66%; line-height: 8px; ">
            <p>Quantity: {{ $information->machine_quantity_1 }}</p>
            <p>Quantity: {{ $information->machine_quantity_2 }}</p>
            <p>Quantity: {{ $information->optional_quantity_1 }}</p>
            <p>Quantity: {{ $information->optional_quantity_2 }}</p>
        </div>
        <div style="float: left;width: 16.66%; line-height: 8px; ">
            <p>Warrenty: {{ $information->machine_warranty_1 }}</p>
            <p>Warrenty: {{ $information->machine_warranty_2 }}</p>
            <p>Warrenty: {{ $information->optional_warranty_1 }}</p>
            <p>Warrenty: {{ $information->optional_warranty_2 }}</p>
        </div>

        <div style="float: left;width: 16.66%; line-height: 8px; ">
            <p>Unit Price: {{ $information->machine_unit_price_1 }}</p>
            <p>Unit Price: {{ $information->machine_unit_price_2 }}</p>
            <p>Unit Price: {{ $information->optional_unit_price_1 }}</p>
            <p>Unit Price: {{ $information->optional_unit_price_2 }}</p>
        </div>

        <div  class="clear"></div>

        <div style="float: left;width: 25%; line-height: 0px; ">
            <p>Bill Date: {{ date('d/m/Y', strtotime($information->bill_date)) }}</p>

        </div>
        <div style="float: left;width: 25%; line-height: 0px; ">
            <p>Bill Amount(total): {{ $information->bill_amount }}</p>

        </div>
        <div style="float: left;width: 33%; line-height: 0px; ">
            <p>Bussiness Promotion Amount: {{ $information->business_promotion_amount }}</p>

        </div>
        <div style="float: left;width: 20%; line-height: 8px; ">
            <p style="position: absolute; top:-20px; font-size: 8px; ">
                If there is any  BPA with the bill amount please provide the BPA approved
                quotation with
                this form
            </p>

        </div>
        <div class="clear"></div>

        <div style="float: left;width: 10%;margin-top: 0px;">
            <p style="font-size: 13px; ">
                Bill format:
            </p>

        </div>
        <div style="float: left;width: 12%; line-height: 2px;margin-top: 3px;">
            <p style="font-size: 13px; ">

                <label><input type="checkbox" name="checkbox" value="value" {{ $information->bill_format==0? "checked":'' }}><span style="vertical-align: text-top;">Consolidated</span></label>
            </p>

        </div>
        <div style="float: left;width: 11%; line-height: 2px;margin-top: 3px;">
            <p style="font-size: 13px; ">

                <label><input type="checkbox" name="checkbox" value="value" {{ $information->bill_format==1? "checked":'' }}><span style="vertical-align: text-top;">Item wise</span></label>
            </p>

        </div>
        <div style="float: left;width: 13%;margin-top: 0px;">
            <p style="font-size: 13px; ">
                Customer Type:
            </p>

        </div>
        <div style="float: left;width: 11%; line-height: 2px;margin-top: 3px;">
            <p style="font-size: 13px; ">

                <label><input type="checkbox" name="checkbox" value="value" {{ $information->customer_type==0? "checked":'' }}><span style="vertical-align: text-top;">Individual</span></label>
            </p>

        </div>

        <div style="float: left;width: 11%; line-height: 2px;margin-top: 3px;">
            <p style="font-size: 13px; ">

                <label><input type="checkbox" name="checkbox" value="value" {{ $information->customer_type==1? "checked":'' }}><span style="vertical-align: text-top;">Corporate</span></label>
            </p>

        </div>

        <div style="float: left;width: 13%;margin-top: 0px;">
            <p style="font-size: 13px; ">
                Price Type:
            </p>

        </div>

        <div style="float: left;width: 11%; line-height: 2px;margin-top: 3px;">
            <p style="font-size: 12px;position: absolute; left: -10px;">

                <label><input type="checkbox" name="checkbox" value="value" {{ $information->price_type==0? "checked":'' }}><span style="vertical-align: text-top;">Normal</span></label>
            </p>

        </div>
        <div style="float: left;width: 10%; line-height: 2px;margin-top: 5px; ">
            <p style="font-size: 12px; position: absolute; left: -30px; ">

                <label><input type="checkbox" name="checkbox" value="value" {{ $information->price_type==1? "checked":'' }}><span style="vertical-align: text-top;">Project</span></label>
            </p>

        </div>

    </div>



 </div>
 <div class="clear"></div>
 <div class="flex-container">

     <div style="float: left;width: 50%; line-height: 2px;margin-top: 0px; ">
         <p style="font-size: 12px;font-weight: bold;">
             Billing information (Consignee)
         </p>
         <br/>
         <p style="width: 100%; height: 10px;">
             {{ $information->billing_information_consignee }}
         </p>

         <!-- <p style="width: 100% ;height: 10px;">
             <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100%; height: 10px;">
             <input style="width: 200px;"  type="text" class="border"/>
         </p>
         <p style="width: 100%; height: 10px;">
             <input style="width: 100px;"  type="text" class="border"/> Tel No <input style="width: 80px; border-top: none;"  type="text" class="border"/>
         </p> -->





     </div>
     <div style="float: left;width: 50%; line-height: 2px;margin-top: 0px; ">
         <p style="font-size: 12px;font-weight: bold;">
             Billing information ( If consignee is different)
         </p>

         <br/>

         <p style="width: 100%; height: 10px;">
             {{ $information->billing_information__different_consignee }}
         </p>

         <!-- <p style="width: 100% ;height: 10px;">
             <input style="width: 200px;" type="text" class="border"/>
         </p>

         <p style="width: 100%; height: 10px;">
             <input style="width: 200px;"  type="text" class="border"/>
         </p>
         <p style="width: 100%; height: 10px;">
             <input style="width: 100px;"  type="text" class="border"/> Tel No <input style="width: 80px; border-top: none;"  type="text" class="border"/>
         </p> -->

     </div>

 </div>

 <div class="clear"></div>
 <div class="flex-container">

     <div style="float: left;width: 15%;margin-top: 0px;">
         <p style="font-size: 13px;font-weight: bold; ">
             Payment Terms
         </p>

     </div>
     <div style="margin-left: 2px;">
         <div style="float: left;width: 8%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; position:absolute; top:3px; ">

                 <label><input type="checkbox" name="checkbox" value="value" {{ $information->payment_terms==1? "checked":'' }}><span style="vertical-align: text-top;">Cash</span></label>
             </p>

         </div>
         <div style="float: left;width: 10%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value" {{ $information->payment_terms==2? "checked":'' }}><span style="vertical-align: text-top;">Cheque</span></label>
             </p>

         </div>
         <div style="float: left;width: 6%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value" {{ $information->payment_terms==3? "checked":'' }}><span style="vertical-align: text-top;">TT </span></label>
             </p>

         </div>
         <div style="float: left;width: 12%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value" {{ $information->payment_terms==4? "checked":'' }}><span style="vertical-align: text-top;">Bank Draft</span></label>
             </p>

         </div>

         <div style="float: left;width: 12%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value" {{ $information->payment_terms==5? "checked":'' }}><span style="vertical-align: text-top;">Credit Card</span></label>
             </p>

         </div>
         <div style="float: left;width: 17%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px;position: absolute; ">

                 <label><input type="checkbox" name="checkbox" value="value" {{ $information->payment_terms==6? "checked":'' }}><span style="vertical-align: text-top;">Post dated Check</span></label>
             </p>

         </div>
         <div style="float: left;width: 17%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px;position: absolute; ">

                 <label><input type="checkbox" name="checkbox" value="value" {{ $information->payment_terms==7? "checked":'' }}><span style="vertical-align: text-top;">Others</span></label>
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

                 <label><input type="checkbox" name="checkbox" value="value" {{ $information->payment_terms==8? "checked":'' }}><span style="vertical-align: middle;">Check before Delivery</span></label>
             </p>

         </div>
         <div style="float: left;width: 6%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value" {{ $information->payment_terms==9? "checked":'' }}><span style="vertical-align: middle;">PO</span></label>
             </p>

         </div>
         <div style="float: left;width: 15%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value" {{ $information->payment_terms==10? "checked":'' }}><span style="vertical-align: middle;">Cash Cheque </span></label>
             </p>

         </div>
         <div style="float: left;width: 30%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px; ">

                 <label><input type="checkbox" name="checkbox" value="value" {{ $information->payment_terms==11? "checked":'' }}><span style="vertical-align: middle;">Partial Payment & Amount</span></label><input style="width: 20px; border-top: none;"  type="text" class="border"/>
             </p>

         </div>

         <div style="float: left;width: 30%; line-height: 2px;margin-top: 3px;">
             <p style="font-size: 12px;">

                 <label><input type="checkbox" name="checkbox" value="value" {{ $information->payment_terms==12? "checked":'' }}><span style="vertical-align: middle;">Balance due will clear on</span></label><input style="width: 20px; border-top: none;"  type="text" class="border"/>
             </p>

         </div>


     </div>






 </div>
 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 2px;margin-top: 0px; ">
         <p style="width: 100%; height: 10px;font-weight: bold;">
             Purchaser
         </p>
         <p style="width: 100%; height: 10px;">
             Name: {{ $information->purchaser_name }}
         </p>

         <p style="width: 100% ;height: 10px;">
             Tel No:  {{ $information->purchaser_telephone_number }}
         </p>

         <p style="width: 100%; height: 10px;">
             Email No:  {{ $information->purchaser_email_no }}
         </p>






     </div>
     <div style="float: left;width: 50%; line-height: 10px;margin-top: 10px; position: absolute; top:15px;">
         <p style="font-size: 12px;">
             Designation: {{ $information->purchaser_designation }}
         </p>

         <p style="width: 100%; height: 10px;">
             Mobile No: {{ $information->purchaser_mobile_no }}
         </p>

         <p style="width: 100% ;height: 10px;">
             Fax No: {{ $information->purchaser_fax_no }}
         </p>



     </div>

 </div>

 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 2px;margin-top: 0px; ">
         <p style="width: 100%; height: 10px;font-weight: bold;">
             Person in Charge of Payament
         </p>
         <p style="width: 100%; height: 10px;">
             Name: {{ $information->charge_of_payment_name }}
         </p>

         <p style="width: 100% ;height: 10px;">
             Tel No:  {{ $information->charge_of_payment_telephone_number }}
         </p>

         <p style="width: 100%; height: 10px;">
             Email No:  {{ $information->charge_of_payment_email_no }}
         </p>






     </div>
     <div style="float: left;width: 50%; line-height: 10px;margin-top: 10px; position: absolute; top:15px;">
         <p style="font-size: 12px;">
             Designation: {{ $information->charge_of_payment_designation }}
         </p>

         <p style="width: 100%; height: 10px;">
             Mobile No: {{ $information->charge_of_payment_mobile_no }}
         </p>

         <p style="width: 100% ;height: 10px;">
             Fax No: {{ $information->charge_of_payment_fax_no }}
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

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->visit_customer_permises==1? "checked":'' }}><span style="vertical-align: text-top;">Yes</span></label>
         </p>




     </div>
     <div style="float: left;width: 15%; line-height: 10px;margin-top: -5px; ">
         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->visit_customer_permises==0? "checked":'' }}><span style="vertical-align: text-top;">No</span></label>
         </p>



     </div>
     <div style="float: left;width: 15%; line-height: 10px;margin-top: -5px; ">
         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->visit_customer_permises==2? "checked":'' }}><span style="vertical-align: text-top;">Later</span></label>
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

             <label>{{ date('Y', strtotime($information->customer_occupying_permises)) }} Year</label>
         </p>




     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-25px; ">
         <p style="font-size: 12px;  ">

             <label>{{ date('m', strtotime($information->customer_occupying_permises)) }} Month</label>
         </p>



     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-25px; ">
         <p style="font-size: 12px;  ">

             <label>{{ date('d', strtotime($information->customer_occupying_permises)) }} Day</label>
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

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->neighbours_to_confirm_answer==1? "checked":'' }}><span style="vertical-align: text-top;">Yes</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-20px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->neighbours_to_confirm_answer==0? "checked":'' }}><span style="vertical-align: text-top;">No</span></label>
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

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->permises_rent==0? "checked":'' }}><span style="vertical-align: text-top;">Owned</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-20px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->permises_rent==1? "checked":'' }}><span style="vertical-align: text-top;">Rented</span></label>
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

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->office_setup==0? "checked":'' }}><span style="vertical-align: text-top;">Old</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-20px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->office_setup==1? "checked":'' }}><span style="vertical-align: text-top;">New</span></label>
         </p>

     </div>


 </div>

 <div class="clear"></div>



 <div class="flex-container">


     <div style="float: left;width: 50%; line-height: 5px; position: absolute; top:-20px;">

         <p style="width: 100%; height: 10px;">
             6. No of staff
         </p>

     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-20px; ">

         <p style="font-size: 12px;  ">

             {{ $information->no_of_staff }}
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

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->building_type==0? "checked":'' }} ><span style="vertical-align: text-top;">Shoplot</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->building_type==1? "checked":'' }} ><span style="vertical-align: text-top;">House</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->building_type==2? "checked":'' }} ><span style="vertical-align: text-top;">M/Story Building</span></label>
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

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->customer_get_contact==0? "checked":'' }}><span style="vertical-align: text-top;">Canvas</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->customer_get_contact==1? "checked":'' }}><span style="vertical-align: text-top;">Inquiry</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->customer_get_contact==2? "checked":'' }}><span style="vertical-align: text-top;">Walk in</span></label>
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

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->liase_with==0? "checked":'' }}><span style="vertical-align: text-top;">Owner</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->liase_with==1? "checked":'' }}><span style="vertical-align: text-top;">Manager</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->liase_with==2? "checked":'' }}><span style="vertical-align: text-top;">Executive</span></label>
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

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->confident_of_payment==1? "checked":'' }}><span style="vertical-align: text-top;">Yes</span></label>
         </p>


     </div>
     <div style="float: left;width: 15%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->confident_of_payment==0? "checked":'' }}><span style="vertical-align: text-top;">No</span></label>
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

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->receive_purchase_order==1? "checked":'' }}><span style="vertical-align: text-top;">Yes</span></label>
         </p>


     </div>
     <div style="float: left;width: 30%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->receive_purchase_order==0? "checked":'' }}><span style="vertical-align: text-top;">No <span style="font-size: 9px; vertical-align: text-top">(If Yes Please attached the PO with this form)</span></span></label>
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

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->delivery_product_before==1? "checked":'' }}><span style="vertical-align: text-top;">Yes</span></label>
         </p>


     </div>
     <div style="float: left;width: 20%; line-height: 10px;position: absolute; top:-15px; ">

         <p style="font-size: 12px;  ">

             <label><input type="checkbox" name="checkbox" value="value" {{ $information->delivery_product_before==0? "checked":'' }}><span style="vertical-align: text-top;">No </span></label>
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
     <div style="float: left;width: 15%; line-height: 2px;position: absolute; top:-10px; ">

         <p style="font-size: 12px;  ">

             <label>{{ $information->credit_days}}</label>
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
        @if($information->signature_of_executive===1)
        <label>Approved {{ !empty($information->executive_comment)?'('.$information->executive_comment.')':'(No Comments)' }}</label>
        @elseif($information->signature_of_executive===0)
        <label>Dis-Approved {{ !empty($information->executive_comment)?'('.$information->executive_comment.')':'(No Comments)' }}</label>
        @elseif($information->signature_of_executive===NULL)
        <label>Non-Reviewed {{ !empty($information->executive_comment)?'('.$information->executive_comment.')':'(No Comments)' }}</label>
        @endif
         <p style="width: 100%; height: 10px; text-decoration: overline;font-weight: bold;">
      Signature of Executive
         </p>

     </div>
     <div style="float: left;width: 50%; line-height: 2px; position: absolute; top:10px; text-align: right">
        @if($information->signature_of_manager===1)
        <label>Approved {{ !empty($information->manager_comment)?'('.$information->manager_comment.')':'(No Comments)' }}</label>
        @elseif($information->signature_of_manager===0)
        <label>Dis-Approved {{ !empty($information->manager_comment)?'('.$information->manager_comment.')':'(No Comments)' }}</label>
        @elseif($information->signature_of_manager===NULL)
        <label>Non-Reviewed {{ !empty($information->manager_comment)?'('.$information->manager_comment.')':'(No Comments)' }}</label>
        @endif
         <p style="width: 100%; height: 10px; text-decoration: overline;font-weight: bold; ">
             Signature of Manager
         </p>

     </div>
 </div>
 <div class="clear"></div>
 <div class="flex-container">
     <div style="float: left;width: 90%; line-height: 2px; position: absolute; top:-10px;">

         <p style="width: 100%; height: 10px;font-weight: bold;">
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
        @if($information->signature_of_account===1)
        <label>Approved {{ !empty($information->account_comment)?'('.$information->account_comment.')':'(No Comments)' }}</label>
        @elseif($information->signature_of_account===0)
        <label>Dis-Approved {{ !empty($information->account_comment)?'('.$information->account_comment.')':'(No Comments)' }}</label>
        @elseif($information->signature_of_account===NULL)
        <label>Non-Reviewed {{ !empty($information->account_comment)?'('.$information->account_comment.')':'(No Comments)' }}</label>
        @endif
         <p style="width: 100%; ">
              <span style=" text-decoration: overline;font-weight: bold; ">Signature of </span><br/> <span style="font-weight: bold;">Accounts Dept.</span>
         </p>

     </div>
     <div style="float: left;width: 33%;  position: absolute; top:10px; text-align: center">
        @if($information->signature_of_admin===1)
        <label>Approved {{ !empty($information->admin_comment)?'('.$information->admin_comment.')':'(No Comments)' }}</label>
        @elseif($information->signature_of_admin===0)
        <label>Dis-Approved {{ !empty($information->admin_comment)?'('.$information->admin_comment.')':'(No Comments)' }}</label>
        @elseif($information->signature_of_admin===NULL)
        <label>Non-Reviewed {{ !empty($information->admin_comment)?'('.$information->admin_comment.')':'(No Comments)' }}</label>
        @endif
         <p style="width: 100%;  ">
              <span style=" text-decoration: overline;font-weight: bold; ">Signature of </span> <br/> <span style="font-weight: bold;">Manager/Admin Dept.</span>
         </p>

     </div>
     <div style="float: left;width: 33%;  position: absolute; top:10px; text-align: center">
        @if($information->signature_of_director===1)
        <label>Approved {{ !empty($information->director_comment)?'('.$information->director_comment.')':'(No Comments)' }}</label>
        @elseif($information->signature_of_director===0)
        <label>Dis-Approved {{ !empty($information->director_comment)?'('.$information->director_comment.')':'(No Comments)' }}</label>
        @elseif($information->signature_of_director===NULL)
        <label>Non-Reviewed {{ !empty($information->director_comment)?'('.$information->director_comment.')':'(No Comments)' }}</label>
        @endif
         <p style="width: 100%;">
             <span style=" text-decoration: overline;font-weight: bold; ">Signature of </span> <br/><span style="font-weight: bold;"> Director / Manager Director</span>
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
        @if($information->signature_of_billing_officer===1)
        <label>Approved {{ !empty($information->billing_officer_comment)?'('.$information->billing_officer_comment.')':'(No Comments)' }}</label>
        @elseif($information->signature_of_billing_officer===0)
        <label>Dis-Approved {{ !empty($information->billing_officer_comment)?'('.$information->billing_officer_comment.')':'(No Comments)' }}</label>
        @elseif($information->signature_of_billing_officer===NULL)
        <label>Non-Reviewed {{ !empty($information->billing_officer_comment)?'('.$information->billing_officer_comment.')':'(No Comments)' }}</label>
        @endif
         <p style="width: 100%; text-decoration: overline;font-weight: bold;  ">
               Signature of Billing Officer
         </p>

     </div>
     <div style="float: left;width: 36%;  position: absolute; top:10px; text-align: center">

         <p style="width: 100%;font-weight: bold;">
         Account Information Form (AIF Version 1.05)
         </p>


     </div>
 </div>
</body>

</html>