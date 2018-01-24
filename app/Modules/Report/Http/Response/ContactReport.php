<?php
namespace App\Modules\Report\Http\Response;
use App\Facades\ArrayRequestFlat;
use App\Models\ManualJournal\JournalEntry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

/**
 * Created by PhpStorm.
 * User: Ontik
 * Date: 11/2/2017
 * Time: 10:49 AM
 */
class ContactReport
{
      private $all = array();
      public function all()
      {
          $condition = "YEAR(str_to_date(assign_date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(assign_date,'%Y-%m-%d')) = MONTH(CURDATE())";

          $auth_id = Auth::id();
          $branch_id = session('branch_id');
          if($branch_id==1){
              $this->all = JournalEntry::with('contact')->whereRaw($condition)->groupBy('contact_id')->get();
          }else{
              $this->all = JournalEntry::with('contact')->groupBy('journal_entries.contact_id')->whereRaw($condition)->join('users','users.id','=','journal_entries.created_by')->where('users.branch_id',$branch_id)->get();
          }


         return $this->all;
      }
      public function checkBranch($data)
      {



      }
      public function allByBranch($id=1)
      {
          $auth_id = Auth::id();
          $branch_id = $id;
          if($branch_id==1){
              $this->all = JournalEntry::with('contact')->groupBy('contact_id')->get();
          }else{
              $this->all = JournalEntry::with('contact')->groupBy('journal_entries.contact_id')->join('users','users.id','=','journal_entries.created_by')->where('users.branch_id',$branch_id)->get();
          }

        return $this->all;
      }
    public function allByContact($id=1,$name=null)
    {

        $q= "%".trim($name)."%";

        $auth_id = Auth::id();
        $branch_id = $id;
        if($branch_id==1){

            $this->all = JournalEntry::with('contact')
                ->leftjoin("contact","contact.id","journal_entries.contact_id")
                ->select("journal_entries.*")
                ->where("contact.display_name","like",$q)
                ->groupBy('contact_id')
                ->get();

        }else{
            $this->all = JournalEntry::with('contact')
                ->leftjoin("contact","contact.id","journal_entries.contact_id")
                ->join('users','users.id','=','journal_entries.created_by')
                ->where('users.branch_id',$branch_id)
                ->where("contact.display_name","like",$q)
                ->select("journal_entries.*")
                ->groupBy('journal_entries.contact_id')
                ->get();


        }

        return $this->all;
    }
    public function allByAlphaRange($id=1,$char_from='a' ,$char_to='z')
    {
      try{
          $from = $char_from;
          $to = $char_to;
          if($char_from>$char_to)
          {
              $temp=  $char_from;
              $from = $char_to;
              $to = $temp;

          }
          $str = $from."-".$to;
          $q= "^[$str]";
          $auth_id = Auth::id();
          $branch_id = $id;
          if($branch_id==1){

              $this->all = JournalEntry::with('contact')
                  ->leftjoin("contact","contact.id","journal_entries.contact_id")
                  ->select("journal_entries.*")
                  ->where("contact.display_name","regexp",$q)
                  ->groupBy('contact_id')
                  ->get();
          }else{
              $this->all = JournalEntry::with('contact')
                  ->leftjoin("contact","contact.id","journal_entries.contact_id")
                  ->join('users','users.id','=','journal_entries.created_by')
                  ->where('users.branch_id',$branch_id)
                  ->where("contact.display_name","regexp",$q)
                  ->select("journal_entries.*")
                  ->groupBy('journal_entries.contact_id')
                  ->get();


          }

          return $this->all;
      }catch (\Exception $exception){

          return [];
      }

    }
      public function findById($id=null,$start,$end,$group=null)
      {
          if(is_null($id))
          {
              return [];
          }


          //bank
          $all[]=  JournalEntry::join("bank","bank.id","journal_entries.bank_id")
                               ->selectRaw('journal_entries.*, concat("BANK-",LPAD(journal_entries.bank_id,6,0)) as transectionid,bank.particulars as particularsname')
                               ->where('journal_entries.contact_id',$id)
                               ->where("journal_entries.debit_credit",1)
                               ->where("journal_entries.jurnal_type",'bank')
                               ->where("bank.type",'Deposit')
                               ->whereBetween('journal_entries.assign_date',[$start,$end])
                               ->with('bank')
                               ->orderBy("journal_entries.assign_date",'asc')
                               ->get();

//
//
//           //bank
          $all[] =  JournalEntry::join("bank","bank.id","journal_entries.bank_id")
                              ->selectRaw('journal_entries.*,concat("BANK-",LPAD(journal_entries.bank_id,6,0)) as transectionid,bank.particulars as particularsname')
                              ->where('journal_entries.contact_id',$id)
                              ->where("journal_entries.debit_credit",0)
                              ->where("journal_entries.jurnal_type",'bank')
                              ->whereBetween('journal_entries.assign_date',[$start,$end])
                              ->where("bank.type",'Withdrawal')
                              ->with('bank')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->get();

//
//          // income
          $all[] =  JournalEntry::join("incomes","incomes.id","journal_entries.income_id")
                              ->selectRaw('journal_entries.*,concat("INC-",LPAD(incomes.income_number,6,0)) as transectionid,account.account_name as particularsname')
                              ->leftjoin('account','account.id','journal_entries.account_name_id')
                              ->where('journal_entries.contact_id',$id)
                              ->where("journal_entries.debit_credit",1)
                              ->whereBetween('journal_entries.assign_date',[$start,$end])
                              ->where("journal_entries.jurnal_type",'income')
                              ->with('income')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->get();

//
//          //income
          $all[] =  JournalEntry::join("incomes","incomes.id","journal_entries.income_id")
                              ->selectRaw('journal_entries.*,concat("INC-",LPAD(incomes.income_number,6,0)) as transectionid,account.account_name as particularsname')
                              ->leftjoin('account','account.id','journal_entries.account_name_id')
                              ->where('journal_entries.contact_id',$id)
                              ->where('journal_entries.account_name_id',9)
                              ->where('journal_entries.amount','!=',0)
                              ->where("journal_entries.debit_credit",0)
                              ->where("journal_entries.jurnal_type",'income')
                              ->whereBetween('journal_entries.assign_date',[$start,$end])
                              ->with('income')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->get();
//          //income
          $all[] =  JournalEntry::join("incomes","incomes.id","journal_entries.income_id")
                              ->leftjoin('account','account.id','journal_entries.account_name_id')
                              ->selectRaw('journal_entries.*,concat("INC-",LPAD(incomes.income_number,6,0)) as transectionid,account.account_name as particularsname')
                              ->where('journal_entries.contact_id',$id)
                              ->where('journal_entries.account_name_id','!=',9)
                             ->whereBetween('journal_entries.assign_date',[$start,$end])
                              ->where("journal_entries.debit_credit",0)
                              ->where("journal_entries.jurnal_type",'income')
                              ->with('income')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->get();


          //invoice
          $all[] =  JournalEntry::join("invoices","invoices.id","journal_entries.invoice_id")
                              ->selectRaw('journal_entries.*, concat("INV-",LPAD(invoices.invoice_number,6,0)) as transectionid,(SELECT group_concat(item.item_name,concat("(",invoice_entries.quantity,IFNULL(item.unit_type,""),")")) FROM invoice_entries join item on item.id =invoice_entries.item_id WHERE invoice_entries.invoice_id = invoices.id) as particularsname ')
                              ->where('journal_entries.contact_id',$id)
                              ->where("journal_entries.debit_credit",1)
                              ->whereBetween('journal_entries.assign_date',[$start,$end])
                              ->where("journal_entries.jurnal_type",'invoice')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->with('invoice')
                              ->get();



          //invoice
          $all[] =  JournalEntry::join("invoices","invoices.id","journal_entries.invoice_id")
                              ->selectRaw('journal_entries.*,concat("INV-",LPAD(invoices.invoice_number,6,0)) as transectionid,(SELECT group_concat(item.item_name,concat("(",invoice_entries.quantity,IFNULL(item.unit_type,""),")")) FROM invoice_entries join item on item.id =invoice_entries.item_id WHERE invoice_entries.invoice_id = invoices.id) as particularsname ')
                              ->where('journal_entries.contact_id',$id)
                              ->whereBetween('journal_entries.assign_date',[$start,$end])
                              ->where('journal_entries.account_name_id',21)
                              ->where("journal_entries.jurnal_type",'invoice')
                              ->with('invoice')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->get();


          //payment recieve
          $all[] =  JournalEntry::join("payment_receives","payment_receives.id","journal_entries.payment_receives_id")
                                  ->selectRaw('journal_entries.*, concat("PR-",LPAD(payment_receives.pr_number,6,0)) as transectionid ,payment_receives.reference as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",0)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.jurnal_type",'payment_receive2')
                                  ->with('paymentReceive')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->get();
          //credit note
          $all[] =  JournalEntry::join("credit_notes","credit_notes.id","journal_entries.credit_note_id")
                                  ->selectRaw('IF(journal_entries.jurnal_type=11,\'credit note\',\'null\') as jurnal_type,journal_entries.`amount`,journal_entries.debit_credit,journal_entries.assign_date,journal_entries.credit_note_id,journal_entries.credit_note_refunds_id,journal_entries.account_name_id,journal_entries.journal_id,journal_entries.invoice_id,journal_entries.income_id,journal_entries.payment_receives_id,journal_entries.payment_receives_entries_id,journal_entries.contact_id,journal_entries.payment_made_id,journal_entries.payment_made_entry_id, concat("CR-",LPAD(credit_notes.credit_note_number,6,0)) as transectionid ,credit_notes.reference as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",0)
                                  ->where('journal_entries.account_name_id','=',5)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.jurnal_type",11)
                                  ->with('creditNote')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->get();
          //credit note refund
          $all[] =  JournalEntry::join("credit_note_refunds","credit_note_refunds.id","journal_entries.credit_note_refunds_id")
                                  ->leftjoin("credit_notes","credit_notes.id","credit_note_refunds.credit_note_id")
                                  ->selectRaw('IF(journal_entries.jurnal_type=12,\'credit note refund\',\'null\') as jurnal_type,journal_entries.`amount`,journal_entries.debit_credit,journal_entries.assign_date,journal_entries.credit_note_id,journal_entries.credit_note_refunds_id,journal_entries.account_name_id,journal_entries.journal_id,journal_entries.invoice_id,journal_entries.income_id,journal_entries.payment_receives_id,journal_entries.payment_receives_entries_id,journal_entries.contact_id,journal_entries.payment_made_id,journal_entries.payment_made_entry_id, concat("CN-",LPAD(credit_notes.credit_note_number,6,0)) as transectionid ,credit_notes.reference as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",1)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.jurnal_type",12)
                                  ->with('creditNoteRefund')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->get();
          //expense
          $all[] =  JournalEntry::join("expense","expense.id","journal_entries.expense_id")
                                  ->leftjoin('account','account.id','journal_entries.account_name_id')
                                  ->selectRaw('journal_entries.*,concat("EXP-",LPAD(expense.expense_number,6,0)) as transectionid,account.account_name as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where('journal_entries.account_name_id','!=',9)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.debit_credit",1)
                                  ->where("journal_entries.jurnal_type",'expense')
                                  ->with('expense')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->get();
          //expense
          $all[] =  JournalEntry::join("expense","expense.id","journal_entries.expense_id")
                                  ->leftjoin('account','account.id','journal_entries.account_name_id')
                                  ->selectRaw('journal_entries.*,concat("EXP-",LPAD(expense.expense_number,6,0)) as transectionid,account.account_name as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where('journal_entries.account_name_id','!=',9)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.debit_credit",0)
                                  ->where("journal_entries.jurnal_type",'expense')
                                  ->with('expense')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->get();
          //bill
          $all[] =  JournalEntry::join("bill","bill.id","journal_entries.bill_id")
                                  ->selectRaw('journal_entries.*,concat("BILL-",LPAD(bill.bill_number,6,0)) as transectionid,(SELECT group_concat(item.item_name,concat("(",bill_entry.quantity,IFNULL(item.unit_type,""),")")) FROM bill_entry join item on item.id =bill_entry.item_id WHERE bill_entry.bill_id = bill.id) as particularsname ')
                                  ->where('journal_entries.contact_id',$id)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.debit_credit",0)
                                  ->where("journal_entries.jurnal_type",'bill')
                                  ->with('bill')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->get();
          //payment made
          $all[] =  JournalEntry::join("payment_made","payment_made.id","journal_entries.payment_made_id")
                                  ->selectRaw('journal_entries.*, concat("PM-",LPAD(payment_made.pm_number,6,0)) as transectionid ,payment_made.reference as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",1)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.jurnal_type",'payment_made2')
                                  ->with('paymentMade')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->get();
          // journal

          $all[] =  JournalEntry::join("journal","journal.id","journal_entries.journal_id")
                                  ->selectRaw('journal_entries.*, concat("MJ-",LPAD(journal_entries.journal_id,6,0)) as transectionid ,journal_entries.note as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",1)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.jurnal_type",'journal')
                                  ->with('journal')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->get();
          // journal

          $all[] =  JournalEntry::join("journal","journal.id","journal_entries.journal_id")
                                  ->selectRaw('journal_entries.*, concat("MJ-",LPAD(journal_entries.journal_id,6,0)) as transectionid ,journal_entries.note as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",0)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.jurnal_type",'journal')
                                  ->with('journal')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->get();
          //sales comission dr
          $all[]=  JournalEntry::join("salescommisions","salescommisions.id","journal_entries.salesComission_id")
                                  ->selectRaw('journal_entries.*, concat("SC-",LPAD(salescommisions.scNumber,6,0)) as transectionid,salescommisions.CustomerNote as particularsname')
                                  ->where('journal_entries.agent_id',$id)
                                  ->where("journal_entries.debit_credit",1)
                                  ->where("journal_entries.jurnal_type",'sales_commission')
                                  ->where("journal_entries.account_name_id",11)

                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->get();
          //sales commission cr
          $all[]=  JournalEntry::join("invoices","invoices.id","journal_entries.invoice_id")
                                  ->selectRaw('journal_entries.*, concat("INV-",LPAD(invoices.invoice_number,6,0)) as transectionid,(SELECT group_concat(item.item_name,concat("(",invoice_entries.quantity,IFNULL(item.unit_type,""),")")) FROM invoice_entries join item on item.id =invoice_entries.item_id WHERE invoice_entries.invoice_id = invoices.id) as particularsname')
                                  ->where('journal_entries.agent_id',$id)
                                  ->where("journal_entries.debit_credit",0)
                                  ->where("journal_entries.jurnal_type",'sales_commission')
                                  ->where("journal_entries.account_name_id",11)

                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->get();
         if(is_null($group))
         {
             return $this->merge($all);
         }

         $type= $this->merge($all);
         return $this->groupByType($type);
      }

      public function contactList($list=[],$start,$end)
      {
          $data= [];
         try{

             foreach($list as $key=>$contacts)
             {


                 if($contacts['contact']){
                     $openning_all = $this->openningBalance($contacts->contact['id'], $start);
                     $openning_balance = $this->sumDrCR($openning_all);
                     $transactionBalance_all = $this->transactionBalance($contacts->contact['id'], $start, $end);


                     $transactionBalance = $this->sumDrCR($transactionBalance_all);
                     //$balance = $openning_balance['dr'] - $openning_balance['cr'];

                     $data[$key]['category'] = $contacts->contact['contact_category_id'];
                     $data[$key]['category_id'] = $contacts->contact['id'];
                     $data[$key]['display_name'] = $contacts->contact['display_name'];
                     $data[$key]['openning_balance'] = 0;
                     $data[$key]['transaction_dr'] = $transactionBalance['dr']+$openning_balance['dr'];
                     $data[$key]['transaction_cr'] = $transactionBalance['cr']+$openning_balance['cr'];

                     $data[$key]['balance'] = ($openning_balance['dr']+$transactionBalance['dr'])-($openning_balance['cr']+$transactionBalance['cr']);


                 }


             }


             return $data;

         }catch(\Exception $exception){

           return $data;
         }


      }
      public function openningBalance($id=null,$start)
      {
          if(is_null($id))
          {
              return [];
          }

          //bank
          $all['bank_dr']=  JournalEntry::join("bank","bank.id","journal_entries.bank_id")
                                           ->where('journal_entries.contact_id',$id)
                                           ->where("journal_entries.debit_credit",1)
                                           ->where("journal_entries.jurnal_type",'bank')
                                           ->where("bank.type",'Deposit')
                                           ->whereDate('journal_entries.assign_date','<',$start)
                                           ->sum('journal_entries.amount');

          //dd($all);
//
//
//           //bank
          $all['bank_cr'] =  JournalEntry::join("bank","bank.id","journal_entries.bank_id")
                              ->selectRaw('journal_entries.*,concat("BANK-",LPAD(journal_entries.bank_id,6,0)) as transectionid,bank.particulars as particularsname')
                              ->where('journal_entries.contact_id',$id)
                              ->where("journal_entries.debit_credit",0)
                              ->where("journal_entries.jurnal_type",'bank')
                              ->whereDate('journal_entries.assign_date','<',$start)
                              ->where("bank.type",'Withdrawal')
                              ->with('bank')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->sum('journal_entries.amount');

//
//          // income
          $all['income_dr'] =  JournalEntry::join("incomes","incomes.id","journal_entries.income_id")
                              ->selectRaw('journal_entries.*,concat("INC-",LPAD(incomes.income_number,6,0)) as transectionid,account.account_name as particularsname')
                              ->leftjoin('account','account.id','journal_entries.account_name_id')
                              ->where('journal_entries.contact_id',$id)
                              ->where("journal_entries.debit_credit",1)
                              ->whereDate('journal_entries.assign_date','<',$start)
                              ->where("journal_entries.jurnal_type",'income')
                              ->with('income')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->sum('journal_entries.amount');

//
//          //income
          $all['income_cr'][] =  JournalEntry::join("incomes","incomes.id","journal_entries.income_id")
                              ->selectRaw('journal_entries.*,concat("INC-",LPAD(incomes.income_number,6,0)) as transectionid,account.account_name as particularsname')
                              ->leftjoin('account','account.id','journal_entries.account_name_id')
                              ->where('journal_entries.contact_id',$id)
                              ->where('journal_entries.account_name_id',9)
                              ->where('journal_entries.amount','!=',0)
                              ->where("journal_entries.debit_credit",0)
                              ->where("journal_entries.jurnal_type",'income')
                              ->whereDate('journal_entries.assign_date','<',$start)
                              ->with('income')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->sum('journal_entries.amount');
//          //income
          $all['income_cr'][] =  JournalEntry::join("incomes","incomes.id","journal_entries.income_id")
                              ->leftjoin('account','account.id','journal_entries.account_name_id')
                              ->selectRaw('journal_entries.*,concat("INC-",LPAD(incomes.income_number,6,0)) as transectionid,account.account_name as particularsname')
                              ->where('journal_entries.contact_id',$id)
                              ->where('journal_entries.account_name_id','!=',9)
                              ->whereDate('journal_entries.assign_date','<',$start)
                              ->where("journal_entries.debit_credit",0)
                              ->where("journal_entries.jurnal_type",'income')
                              ->with('income')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->sum('journal_entries.amount');


          //invoice
          $all['invoice_dr'] =  JournalEntry::join("invoices","invoices.id","journal_entries.invoice_id")
                              ->selectRaw('journal_entries.*, concat("INV-",LPAD(invoices.invoice_number,6,0)) as transectionid,(SELECT group_concat(item.item_name) FROM invoice_entries join item on item.id =invoice_entries.item_id WHERE invoice_entries.invoice_id = invoices.id) as particularsname ')
                              ->where('journal_entries.contact_id',$id)
                             ->where('journal_entries.account_name_id',5)
                             ->whereDate('journal_entries.assign_date','<',$start)
                              ->where("journal_entries.jurnal_type",'invoice')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->with('invoice')
                              ->sum('journal_entries.amount');

          $all['invoice_cr'] = 0;
//          //invoice
//          $all['invoice_cr'] =  JournalEntry::join("invoices","invoices.id","journal_entries.invoice_id")
//                              ->selectRaw('journal_entries.*,concat("INV-",LPAD(invoices.invoice_number,6,0)) as transectionid,(SELECT group_concat(item.item_name) FROM invoice_entries join item on item.id =invoice_entries.item_id WHERE invoice_entries.invoice_id = invoices.id) as particularsname ')
//                              ->where('journal_entries.contact_id',$id)
//                              ->whereDate('journal_entries.assign_date','<',$start)
//                              ->where('journal_entries.account_name_id','=',21)
//                              ->where("journal_entries.jurnal_type",'invoice')
//                              ->with('invoice')
//                              ->orderBy("journal_entries.assign_date",'asc')
//                              ->sum('journal_entries.amount');


          //payment recieve
          $all['payment_recieve_cr'] =  JournalEntry::join("payment_receives","payment_receives.id","journal_entries.payment_receives_id")
                                  ->selectRaw('journal_entries.*, concat("PR-",LPAD(payment_receives.pr_number,6,0)) as transectionid ,payment_receives.reference as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",0)
                                  ->whereDate('journal_entries.assign_date','<',$start)
                                  ->where("journal_entries.jurnal_type",'payment_receive2')
                                  ->with('paymentReceive')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          //credit note
          $all['credit_note_cr'] =  JournalEntry::join("credit_notes","credit_notes.id","journal_entries.credit_note_id")
                                  ->selectRaw('IF(journal_entries.jurnal_type=11,\'credit note\',\'null\') as jurnal_type,journal_entries.`amount`,journal_entries.debit_credit,journal_entries.assign_date,journal_entries.credit_note_id,journal_entries.credit_note_refunds_id,journal_entries.account_name_id,journal_entries.journal_id,journal_entries.invoice_id,journal_entries.income_id,journal_entries.payment_receives_id,journal_entries.payment_receives_entries_id,journal_entries.contact_id,journal_entries.payment_made_id,journal_entries.payment_made_entry_id, concat("CR-",LPAD(credit_notes.credit_note_number,6,0)) as transectionid ,credit_notes.reference as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",0)
                                  ->where('journal_entries.account_name_id','=',5)
                                  ->whereDate('journal_entries.assign_date','<',$start)
                                  ->where("journal_entries.jurnal_type",11)
                                  ->with('creditNote')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          //credit note refund
          $all['credit_note_refund_dr'] =  JournalEntry::join("credit_note_refunds","credit_note_refunds.id","journal_entries.credit_note_refunds_id")
                                  ->leftjoin("credit_notes","credit_notes.id","credit_note_refunds.credit_note_id")
                                  ->selectRaw('IF(journal_entries.jurnal_type=12,\'credit note refund\',\'null\') as jurnal_type,journal_entries.`amount`,journal_entries.debit_credit,journal_entries.assign_date,journal_entries.credit_note_id,journal_entries.credit_note_refunds_id,journal_entries.account_name_id,journal_entries.journal_id,journal_entries.invoice_id,journal_entries.income_id,journal_entries.payment_receives_id,journal_entries.payment_receives_entries_id,journal_entries.contact_id,journal_entries.payment_made_id,journal_entries.payment_made_entry_id, concat("CN-",LPAD(credit_notes.credit_note_number,6,0)) as transectionid ,credit_notes.reference as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",1)
                                  ->whereDate('journal_entries.assign_date','<',$start)
                                  ->where("journal_entries.jurnal_type",12)
                                  ->with('creditNoteRefund')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                 ->sum('journal_entries.amount');
          //expense
          $all['expense_dr'] =  JournalEntry::join("expense","expense.id","journal_entries.expense_id")
                                  ->leftjoin('account','account.id','journal_entries.account_name_id')
                                  ->selectRaw('journal_entries.*,concat("EXP-",LPAD(expense.expense_number,6,0)) as transectionid,account.account_name as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where('journal_entries.account_name_id','!=',9)
                                  ->whereDate('journal_entries.assign_date','<',$start)
                                  ->where("journal_entries.debit_credit",1)
                                  ->where("journal_entries.jurnal_type",'expense')
                                  ->with('expense')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          //expense
          $all['expense_cr'] =  JournalEntry::join("expense","expense.id","journal_entries.expense_id")
                                  ->leftjoin('account','account.id','journal_entries.account_name_id')
                                  ->selectRaw('journal_entries.*,concat("EXP-",LPAD(expense.expense_number,6,0)) as transectionid,account.account_name as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where('journal_entries.account_name_id','!=',9)
                                  ->whereDate('journal_entries.assign_date','<',$start)
                                  ->where("journal_entries.debit_credit",0)
                                  ->where("journal_entries.jurnal_type",'expense')
                                  ->with('expense')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          //bill
          $all['bill_cr'] =  JournalEntry::join("bill","bill.id","journal_entries.bill_id")
                                  ->selectRaw('journal_entries.*,concat("BILL-",LPAD(bill.bill_number,6,0)) as transectionid,(SELECT group_concat(item.item_name,concat("(",bill_entry.quantity,IFNULL(item.unit_type,""),")")) FROM bill_entry join item on item.id =bill_entry.item_id WHERE bill_entry.bill_id = bill.id) as particularsname ')
                                  ->where('journal_entries.contact_id',$id)
                                  ->whereDate('journal_entries.assign_date','<',$start)
                                  ->where("journal_entries.debit_credit",0)
                                  ->where("journal_entries.jurnal_type",'bill')
                                  ->with('bill')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          //payment made
          $all['payment_made_dr'] =  JournalEntry::join("payment_made","payment_made.id","journal_entries.payment_made_id")
                                  ->selectRaw('journal_entries.*, concat("PM-",LPAD(payment_made.pm_number,6,0)) as transectionid ,payment_made.reference as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",1)
                                  ->whereDate('journal_entries.assign_date','<',$start)
                                  ->where("journal_entries.jurnal_type",'payment_made2')
                                  ->with('paymentMade')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          // journal

          $all['journal_dr'] =  JournalEntry::join("journal","journal.id","journal_entries.journal_id")
                                  ->selectRaw('journal_entries.*, concat("MJ-",LPAD(journal_entries.journal_id,6,0)) as transectionid ,journal_entries.note as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",1)
                                  ->whereDate('journal_entries.assign_date','<',$start)
                                  ->where("journal_entries.jurnal_type",'journal')
                                  ->sum('journal_entries.amount');
          // journal

          $all['journal_cr'] =  JournalEntry::join("journal","journal.id","journal_entries.journal_id")
                                  ->selectRaw('journal_entries.*, concat("MJ-",LPAD(journal_entries.journal_id,6,0)) as transectionid ,journal_entries.note as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",0)
                                  ->whereDate('journal_entries.assign_date','<',$start)
                                  ->where("journal_entries.jurnal_type",'journal')
                                  ->with('journal')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          //sales comission dr
          $all['sales_commission_dr']=  JournalEntry::join("salescommisions","salescommisions.id","journal_entries.salesComission_id")
                                  ->selectRaw('journal_entries.*, concat("SC-",LPAD(salescommisions.scNumber,6,0)) as transectionid,salescommisions.CustomerNote as particularsname')
                                  ->where('journal_entries.agent_id',$id)
                                  ->where("journal_entries.debit_credit",1)
                                  ->where("journal_entries.jurnal_type",'sales_commission')
                                  ->where("journal_entries.account_name_id",11)
                                  ->whereDate('journal_entries.assign_date','<',$start)

                                  ->sum('journal_entries.amount');
          //sales commission cr
          $all['sales_commission_cr']=  JournalEntry::join("invoices","invoices.id","journal_entries.invoice_id")
                                  ->selectRaw('journal_entries.*, concat("INV-",LPAD(invoices.invoice_number,6,0)) as transectionid,(SELECT group_concat(item.item_name) FROM invoice_entries join item on item.id =invoice_entries.item_id WHERE invoice_entries.invoice_id = invoices.id) as particularsname')
                                  ->where('journal_entries.agent_id',$id)
                                  ->where("journal_entries.debit_credit",0)
                                  ->where("journal_entries.jurnal_type",'sales_commission')
                                  ->where("journal_entries.account_name_id",11)
                                  ->whereDate('journal_entries.assign_date','<',$start)
                                   ->sum('journal_entries.amount');





          return $all;

      }
      public function transactionBalance($id=null,$start,$end)
      {
          if(is_null($id))
          {
              return [];
          }

          //bank
          $all['bank_dr']=  JournalEntry::join("bank","bank.id","journal_entries.bank_id")
                                           ->where('journal_entries.contact_id',$id)
                                           ->where("journal_entries.debit_credit",1)
                                           ->where("journal_entries.jurnal_type",'bank')
                                           ->where("bank.type",'Deposit')
                                           ->whereBetween('journal_entries.assign_date',[$start,$end])
                                           ->sum('journal_entries.amount');

          //dd($all);
//
//
//           //bank
          $all['bank_cr'] =  JournalEntry::join("bank","bank.id","journal_entries.bank_id")
                              ->selectRaw('journal_entries.*,concat("BANK-",LPAD(journal_entries.bank_id,6,0)) as transectionid,bank.particulars as particularsname')
                              ->where('journal_entries.contact_id',$id)
                              ->where("journal_entries.debit_credit",0)
                              ->where("journal_entries.jurnal_type",'bank')
                             ->whereBetween('journal_entries.assign_date',[$start,$end])
                              ->where("bank.type",'Withdrawal')
                              ->with('bank')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->sum('journal_entries.amount');

//
//          // income
          $all['income_dr'] =  JournalEntry::join("incomes","incomes.id","journal_entries.income_id")
                              ->selectRaw('journal_entries.*,concat("INC-",LPAD(incomes.income_number,6,0)) as transectionid,account.account_name as particularsname')
                              ->leftjoin('account','account.id','journal_entries.account_name_id')
                              ->where('journal_entries.contact_id',$id)
                              ->where("journal_entries.debit_credit",1)
                              ->whereBetween('journal_entries.assign_date',[$start,$end])
                              ->where("journal_entries.jurnal_type",'income')
                              ->with('income')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->sum('journal_entries.amount');

//
//          //income
          $all['income_cr'][] =  JournalEntry::join("incomes","incomes.id","journal_entries.income_id")
                              ->selectRaw('journal_entries.*,concat("INC-",LPAD(incomes.income_number,6,0)) as transectionid,account.account_name as particularsname')
                              ->leftjoin('account','account.id','journal_entries.account_name_id')
                              ->where('journal_entries.contact_id',$id)
                              ->where('journal_entries.account_name_id',9)
                              ->where('journal_entries.amount','!=',0)
                              ->where("journal_entries.debit_credit",0)
                              ->where("journal_entries.jurnal_type",'income')
                              ->whereBetween('journal_entries.assign_date',[$start,$end])
                              ->with('income')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->sum('journal_entries.amount');
//          //income
          $all['income_cr'][] =  JournalEntry::join("incomes","incomes.id","journal_entries.income_id")
                              ->leftjoin('account','account.id','journal_entries.account_name_id')
                              ->selectRaw('journal_entries.*,concat("INC-",LPAD(incomes.income_number,6,0)) as transectionid,account.account_name as particularsname')
                              ->where('journal_entries.contact_id',$id)
                              ->where('journal_entries.account_name_id','!=',9)
                              ->whereBetween('journal_entries.assign_date',[$start,$end])
                              ->where("journal_entries.debit_credit",0)
                              ->where("journal_entries.jurnal_type",'income')
                              ->with('income')
                              ->orderBy("journal_entries.assign_date",'asc')
                              ->sum('journal_entries.amount');


          //invoice
          $all['invoice_dr'] =  JournalEntry::join("invoices","invoices.id","journal_entries.invoice_id")
                                ->selectRaw('journal_entries.*, concat("INV-",LPAD(invoices.invoice_number,6,0)) as transectionid,(SELECT group_concat(item.item_name) FROM invoice_entries join item on item.id =invoice_entries.item_id WHERE invoice_entries.invoice_id = invoices.id) as particularsname ')
                                ->where('journal_entries.contact_id',$id)
                               ->where('journal_entries.account_name_id',5)
                               ->whereBetween('journal_entries.assign_date',[$start,$end])
                               ->where("journal_entries.jurnal_type",'invoice')
                               ->orderBy("journal_entries.assign_date",'asc')
                               ->with('invoice')
                               ->sum('journal_entries.amount');



          $all['invoice_cr'] = 0;
//          //invoice
//          $all['invoice_cr'] =  JournalEntry::join("invoices","invoices.id","journal_entries.invoice_id")
//                              ->selectRaw('journal_entries.*,concat("INV-",LPAD(invoices.invoice_number,6,0)) as transectionid,(SELECT group_concat(item.item_name) FROM invoice_entries join item on item.id =invoice_entries.item_id WHERE invoice_entries.invoice_id = invoices.id) as particularsname ')
//                              ->where('journal_entries.contact_id',$id)
//                              ->whereDate('journal_entries.assign_date','<',$start)
//                              ->where('journal_entries.account_name_id','=',21)
//                              ->where("journal_entries.jurnal_type",'invoice')
//                              ->with('invoice')
//                              ->orderBy("journal_entries.assign_date",'asc')
//                              ->sum('journal_entries.amount');


          //payment recieve
          $all['payment_recieve_cr'] =  JournalEntry::join("payment_receives","payment_receives.id","journal_entries.payment_receives_id")
                                  ->selectRaw('journal_entries.*, concat("PR-",LPAD(payment_receives.pr_number,6,0)) as transectionid ,payment_receives.reference as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",0)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.jurnal_type",'payment_receive2')
                                  ->with('paymentReceive')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          //credit note
          $all['credit_note_cr'] =  JournalEntry::join("credit_notes","credit_notes.id","journal_entries.credit_note_id")
                                  ->selectRaw('IF(journal_entries.jurnal_type=11,\'credit note\',\'null\') as jurnal_type,journal_entries.`amount`,journal_entries.debit_credit,journal_entries.assign_date,journal_entries.credit_note_id,journal_entries.credit_note_refunds_id,journal_entries.account_name_id,journal_entries.journal_id,journal_entries.invoice_id,journal_entries.income_id,journal_entries.payment_receives_id,journal_entries.payment_receives_entries_id,journal_entries.contact_id,journal_entries.payment_made_id,journal_entries.payment_made_entry_id, concat("CR-",LPAD(credit_notes.credit_note_number,6,0)) as transectionid ,credit_notes.reference as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",0)
                                  ->where('journal_entries.account_name_id','=',5)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.jurnal_type",11)
                                  ->with('creditNote')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          //credit note refund
          $all['credit_note_refund_dr'] =  JournalEntry::join("credit_note_refunds","credit_note_refunds.id","journal_entries.credit_note_refunds_id")
                                  ->leftjoin("credit_notes","credit_notes.id","credit_note_refunds.credit_note_id")
                                  ->selectRaw('IF(journal_entries.jurnal_type=12,\'credit note refund\',\'null\') as jurnal_type,journal_entries.`amount`,journal_entries.debit_credit,journal_entries.assign_date,journal_entries.credit_note_id,journal_entries.credit_note_refunds_id,journal_entries.account_name_id,journal_entries.journal_id,journal_entries.invoice_id,journal_entries.income_id,journal_entries.payment_receives_id,journal_entries.payment_receives_entries_id,journal_entries.contact_id,journal_entries.payment_made_id,journal_entries.payment_made_entry_id, concat("CN-",LPAD(credit_notes.credit_note_number,6,0)) as transectionid ,credit_notes.reference as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",1)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.jurnal_type",12)
                                  ->with('creditNoteRefund')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                 ->sum('journal_entries.amount');
          //expense
          $all['expense_dr'] =  JournalEntry::join("expense","expense.id","journal_entries.expense_id")
                                  ->leftjoin('account','account.id','journal_entries.account_name_id')
                                  ->selectRaw('journal_entries.*,concat("EXP-",LPAD(expense.expense_number,6,0)) as transectionid,account.account_name as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where('journal_entries.account_name_id','!=',9)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.debit_credit",1)
                                  ->where("journal_entries.jurnal_type",'expense')
                                  ->with('expense')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          //expense
          $all['expense_cr'] =  JournalEntry::join("expense","expense.id","journal_entries.expense_id")
                                  ->leftjoin('account','account.id','journal_entries.account_name_id')
                                  ->selectRaw('journal_entries.*,concat("EXP-",LPAD(expense.expense_number,6,0)) as transectionid,account.account_name as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where('journal_entries.account_name_id','!=',9)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.debit_credit",0)
                                  ->where("journal_entries.jurnal_type",'expense')
                                  ->with('expense')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          //bill
          $all['bill_cr'] =  JournalEntry::join("bill","bill.id","journal_entries.bill_id")
                                  ->selectRaw('journal_entries.*,concat("BILL-",LPAD(bill.bill_number,6,0)) as transectionid,(SELECT group_concat(item.item_name) FROM bill_entry join item on item.id =bill_entry.item_id WHERE bill_entry.bill_id = bill.id) as particularsname ')
                                  ->where('journal_entries.contact_id',$id)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.debit_credit",0)
                                  ->where("journal_entries.jurnal_type",'bill')
                                  ->with('bill')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          //payment made
          $all['payment_made_dr'] =  JournalEntry::join("payment_made","payment_made.id","journal_entries.payment_made_id")
                                  ->selectRaw('journal_entries.*, concat("PM-",LPAD(payment_made.pm_number,6,0)) as transectionid ,payment_made.reference as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",1)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.jurnal_type",'payment_made2')
                                  ->with('paymentMade')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          // journal

          $all['journal_dr'] =  JournalEntry::join("journal","journal.id","journal_entries.journal_id")
                                  ->selectRaw('journal_entries.*, concat("MJ-",LPAD(journal_entries.journal_id,6,0)) as transectionid ,journal_entries.note as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",1)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.jurnal_type",'journal')
                                  ->sum('journal_entries.amount');
          // journal

          $all['journal_cr'] =  JournalEntry::join("journal","journal.id","journal_entries.journal_id")
                                  ->selectRaw('journal_entries.*, concat("MJ-",LPAD(journal_entries.journal_id,6,0)) as transectionid ,journal_entries.note as particularsname')
                                  ->where('journal_entries.contact_id',$id)
                                  ->where("journal_entries.debit_credit",0)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                  ->where("journal_entries.jurnal_type",'journal')
                                  ->with('journal')
                                  ->orderBy("journal_entries.assign_date",'asc')
                                  ->sum('journal_entries.amount');
          //sales comission dr
          $all['sales_commission_dr']=  JournalEntry::join("salescommisions","salescommisions.id","journal_entries.salesComission_id")
                                  ->selectRaw('journal_entries.*, concat("SC-",LPAD(salescommisions.scNumber,6,0)) as transectionid,salescommisions.CustomerNote as particularsname')
                                  ->where('journal_entries.agent_id',$id)
                                  ->where("journal_entries.debit_credit",1)
                                  ->where("journal_entries.jurnal_type",'sales_commission')
                                  ->where("journal_entries.account_name_id",11)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])

                                  ->sum('journal_entries.amount');
          //sales commission cr
          $all['sales_commission_cr']=  JournalEntry::join("invoices","invoices.id","journal_entries.invoice_id")
                                  ->selectRaw('journal_entries.*, concat("INV-",LPAD(invoices.invoice_number,6,0)) as transectionid,(SELECT group_concat(item.item_name) FROM invoice_entries join item on item.id =invoice_entries.item_id WHERE invoice_entries.invoice_id = invoices.id) as particularsname')
                                  ->where('journal_entries.agent_id',$id)
                                  ->where("journal_entries.debit_credit",0)
                                  ->where("journal_entries.jurnal_type",'sales_commission')
                                  ->where("journal_entries.account_name_id",11)
                                  ->whereBetween('journal_entries.assign_date',[$start,$end])
                                   ->sum('journal_entries.amount');





          return $all;

      }

      public function sumDrCR(Array $total)
      {
          $final_balance = [];
          $final_balance['dr'] = 0;
          $final_balance['cr'] = 0;
          if(!is_array($total))
          {
              return $final_balance;
          }



          $final_balance['dr'] = $total['sales_commission_dr']+$total['bank_dr']+$total['income_dr']+$total['invoice_dr']+$total['credit_note_refund_dr']+$total['expense_dr']+$total['payment_made_dr']+$total['journal_dr'];
          $final_balance['cr'] =$total['sales_commission_cr'] + $total['bill_cr'] +$total['journal_cr']+ $total['expense_cr']+$total['credit_note_cr']+$total['payment_recieve_cr']+$total['invoice_cr']+array_sum($total['income_cr'])+$total['bank_cr'];


          return $final_balance;
      }
      public function merge($all = [])
      {
          $refine_ref =[];
          if(!is_array($all))
          {
              return [];
          }

          if(!count($all))
          {
              return [];
          }
          foreach($all as $value)
          {
              foreach ($value as $item)
              {
                  $refine_ref[] = $item;
              }
          }
          return collect($refine_ref);
      }

      public function findByDate($start = null,$end=null)
      {


          return null;
      }

      public function groupByType($list=null)
      {
          if(is_null($list))
          {
              return [];
          }

         $bytype = $list->groupBy("jurnal_type");

        return $bytype;
      }
}