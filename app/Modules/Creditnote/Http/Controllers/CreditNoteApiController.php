<?php

namespace App\Modules\Creditnote\Http\Controllers;

use DB;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

// Models...
use App\Models\Contact\Contact;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\CreditNoteEntry;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\CreditNoteRefund;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Inventory\Item;
use App\Models\Tax;
use App\Models\AccountChart\Account;

class CreditNoteApiController extends Controller
{
    public function getItems($cn_id)
    {
        $credit_note = CreditNote::with('creditNoteEntries')->find($cn_id);
        $credit_note_entries = $credit_note->creditNoteEntries;
        $items = DB::table('item')->select('item_name as text', 'id as value')->get();
        $taxes = DB::table('tax')->select('tax_name as text', 'id as value')->get();
        $accounts = DB::table('account')->select('account_name as text', 'id as value')->get();
        return compact('items', 'taxes', 'credit_note_entries', 'accounts', 'credit_note');
    }
}
