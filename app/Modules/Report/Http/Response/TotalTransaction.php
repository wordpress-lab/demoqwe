<?php
/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 1/18/2018
 * Time: 5:16 PM
 */

namespace App\Modules\Report\Http\Response;


use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\MoneyOut\Bill;

Final class TotalTransaction
{
   protected $data = [];
   protected $start =null;
   protected $end =null;
   public function __construct($start,$end)
   {
       $this->start = $start;
       $this->end = $end;
   }

   public function get()
   {

    $this->purchase();
    $this->sales();
    $this->generalExpense();
    $this->receipt();
    $this->payments();
    return $this->data;
   }

   public function purchase()
   {

    $purchase= JournalEntry::whereBetween("assign_date",[$this->start,$this->end])
                      ->where("jurnal_type","bill")
                      ->where("account_name_id",11)
                      ->where("debit_credit",0)
                      ->with("bill.customer","bill.billEntries.item")
                      ->get();

    $this->data['purchase'] = $purchase;

    return $purchase;
   }
   public function sales()
   {

       $sales= JournalEntry::whereBetween("assign_date",[$this->start,$this->end])
           ->where("jurnal_type","invoice")
           ->where("account_name_id",5)
           ->where("debit_credit",1)
           ->with("invoice.invoiceEntries.item","invoice.customer")
           ->get();
       $this->data['sales'] = $sales;

       return $sales;
   }
   public function generalExpense()
   {
       $generalExpense= JournalEntry::whereBetween("assign_date",[$this->start,$this->end])
           ->where("jurnal_type","expense")
           ->where("debit_credit",0)
           ->with("expense.account")
           ->get();
       $this->data['generalExpense'] = $generalExpense;

       $sales_commission= JournalEntry::whereBetween("assign_date",[$this->start,$this->end])
           ->where("jurnal_type","sales_commission")
           ->where("account_name_id",11)
           ->where("debit_credit",1)
           ->with("SalesCommission.Agents")
           ->get();
       $this->data['sales_commission'] = $sales_commission;
       return ["generalExpense"=>$generalExpense,"sales_commission"=>$sales_commission];
   }
   public function receipt()
   {
       $receipt= JournalEntry::whereBetween("assign_date",[$this->start,$this->end])
           ->where("jurnal_type","payment_receive2")
           ->where("account_name_id",10)
           ->where("debit_credit",0)
           ->with("paymentReceive.paymentContact")
           ->get();
       $this->data['receipt'] = $receipt;

       $income= JournalEntry::whereBetween("assign_date",[$this->start,$this->end])
           ->where("jurnal_type","income")
           ->where("debit_credit",1)
           ->with("income.account")
           ->get();
       $this->data['income'] = $income;


       return ["receipt"=>$receipt,"income"=>$income];
   }
   public function payments()
   {
       $payments= JournalEntry::whereBetween("assign_date",[$this->start,$this->end])
           ->where("jurnal_type","payment_made2")
           ->where("account_name_id",27)
           ->where("debit_credit",1)
           ->with("paymentMade.customer")
           ->get();
       $this->data['payments'] = $payments;
       //
       $payments_12= JournalEntry::whereBetween("assign_date",[$this->start,$this->end])
           ->where("jurnal_type",12)
           ->where("account_name_id",5)
           ->where("debit_credit",1)
           ->with("creditNote.customer")
           ->get();
       $this->data['payments_12'] = $payments_12;
       return ["payemnts"=>$payments,"payemnts_12"=>$payments_12];
   }

   public function getUpStairSheet()
   {
     $sheet = [];
     $this->get();
     $sheet["purchase"] =$this->purchaseParticulars();
     $sheet["sales"] =$this->salesParticulars();
     $sheet["expenseAndCommission"] =$this->expenseParticulars();
     $sheet["expenseAndCommission"] =$this->expenseParticulars();
     $sheet["receiptAndIncome"] =$this->receiptParticulars();
     $sheet["payment"] =$this->paymentsParticulars();
     $sheet["invoiceDue"] = $this->invoiceDue();
     $sheet["billDue"]=$this->billDue();

     return $sheet;
   }

   public function invoiceDue()
   {
      $due = Invoice::whereRaw("STR_TO_DATE(invoices.invoice_date,'%d-%m-%Y') BETWEEN '$this->start' AND '$this->end'")
                      ->sum("due_amount");
      $this->data['invoiceDue'] = $due;
      return $due;
   }

    public function billDue()
    {
        $due = Bill::whereRaw("bill_date BETWEEN '$this->start' AND '$this->end'")
                        ->sum("due_amount");

        $this->data['billDue'] = $due;

        return $due;
    }

    public function purchaseParticulars()
    {
        $data = [];
       foreach($this->data["purchase"] as $key=>$value)
       {
         $product_name = [];
         $data[$key]["transaction"] = "BILL-".$value->bill["bill_number"];
         $data[$key]["display_name"] = $value->bill["customer"]["display_name"];
         $data[$key]["amount"] = $value->amount;
         foreach($value->bill["billEntries"] as $item)
         {
          $product_name[] = $item["item"]["item_name"];
         }
         $data[$key]["items"] = implode(",",array_unique($product_name));
       }
        $this->data['purchaseParticulars'] = $data;
        return $data;
    }

    public function salesParticulars()
    {
        $data = [];
        foreach($this->data["sales"] as $key=>$value)
        {
            $product_name = [];
            $data[$key]["transaction"] =  "INV-".$value["invoice"]["invoice_number"];
            $data[$key]["display_name"] = $value->invoice["customer"]["display_name"];
            $data[$key]["amount"] = $value->amount;
            foreach($value->invoice["invoiceEntries"] as $item)
            {
                $product_name[] = $item["item"]["item_name"];
            }
            $data[$key]["items"] = implode(",",array_unique($product_name));
        }
        $this->data['salesParticulars'] = $data;

        return $data;
    }
    public function expenseParticulars()
    {
        $data = [];
        foreach($this->data["generalExpense"] as $key=>$value)
        {
            $product_name = '';
            $data[$key]["amount"] = $value->amount;
            $data[$key]["transaction"] = "EXP-".str_pad($value["expense"]["expense_number"],6,'0',STR_PAD_LEFT);
            $data[$key]["display_name"] = $value->expense["customer"]["display_name"];
            $product_name = $value["expense"]["account"]["account_name"];
            $data[$key]["items"] = $product_name;
        }
        $this->data['expenseParticulars'] = $data;
        $commission = $this->salesComissionParticulars();
        return array_merge($data,$commission);
    }

    public function salesComissionParticulars()
    {
        $data = [];
        foreach($this->data["sales_commission"] as $key=>$value)
        {
            $product_name = '';
            $data[$key]["amount"] = $value->amount;
            $data[$key]["transaction"] = "SC-".str_pad($value["SalesCommission"]["scNumber"],6,'0',STR_PAD_LEFT );
            $data[$key]["display_name"] = $value->SalesCommission["Agents"]["display_name"];

            $data[$key]["items"] = $product_name;
        }
        $this->data['salesComissionParticulars'] = $data;

        return $data;
    }

    public function receiptParticulars()
    {
        $data = [];
        foreach($this->data['receipt'] as $key=>$value)
        {
            $product_name = '';
            $data[$key]["amount"] = $value->amount;
            $data[$key]["transaction"] = "PR-".str_pad($value["paymentReceive"]["pr_number"],6,'0',STR_PAD_LEFT );
            $data[$key]["display_name"] = $value->paymentReceive["paymentContact"]["display_name"];
            $data[$key]["items"] = $product_name;
        }
        $this->data['receiptParticulars'] = $data;
        $income = $this->incomeParticulars();
        return array_merge($data,$income);
    }

    public function incomeParticulars()
    {
        $data = [];
        foreach($this->data['income'] as $key=>$value)
        {
            $product_name = '';
            $data[$key]["amount"] = $value->amount;
            $data[$key]["transaction"] = "INC-".str_pad($value["income"]["income_number"],6,'0',STR_PAD_LEFT );
            $data[$key]["display_name"] = $value->income["account"]["account_name"];
            $data[$key]["items"] = $product_name;
        }
        $this->data['incomeParticulars'] = $data;

        return $data;
    }

    public function paymentsParticulars()
    {
        $data = [];
        foreach($this->data['payments'] as $key=>$value)
        {
            $product_name = '';
            $data[$key]["amount"] = $value->amount;
            $data[$key]["transaction"] = "PM-".str_pad($value["paymentMade"]["pm_number"],6,'0',STR_PAD_LEFT );
            $data[$key]["display_name"] = $value->paymentMade["customer"]["display_name"];
            $data[$key]["items"] = $product_name;
        }
        $this->data['paymentsParticulars'] = $data;
        $payments_12 = $this->payments_12Particulars();
        return array_merge($data,$payments_12);
    }

    public function payments_12Particulars()
    {
        $data = [];
        foreach($this->data['payments_12'] as $key=>$value)
        {
            $product_name = '';
            $data[$key]["amount"] = $value->amount;
            $data[$key]["transaction"] = "CN-".str_pad($value["creditNote"]["credit_note_number"],6,'0',STR_PAD_LEFT );
            $data[$key]["display_name"] = $value->creditNote["customer"]["display_name"];

            $data[$key]["items"] = $product_name;
        }
        $this->data['payments_12Particulars'] = $data;

        return $data;
    }
}