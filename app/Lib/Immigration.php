<?php namespace App\Lib;

use App\Models\Contact\Contact;
use App\Models\MoneyIn\CreditNote;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\ExcessPayment;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Inventory\Item;
use App\Models\MoneyOut\PaymentMadeEntry;
use App\Models\Recruit\Recruitorder;
use App\Models\Recruit_Customer\Recruit_customer;
use App\Models\Tax;
use App\Models\ManualJournal\JournalEntry;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;
use App\Models\Company\Company;

use Illuminate\Support\Facades\DB;
use NumberFormatter;

class Immigration {

    public function __construct()
    {

    }

    public function contact($id){
        $customer=Recruitorder::find($id);
         return $customer;
    }

    public function recruit_customer($id){
        $recruit_customer=Recruit_customer::where('recruit_id',$id)->first();
        return $recruit_customer;

    }

}