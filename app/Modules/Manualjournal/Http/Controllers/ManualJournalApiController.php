<?php

namespace App\Modules\Manualjournal\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Models\Contact\Contact;
use App\Models\Contact\ContactCategory;
use App\Models\ManualJournal\Journal;
use App\Models\ManualJournal\JournalEntry;

class ManualJournalApiController extends Controller
{
    public function getContactAccountTaxList($id)
    {
        $item           = DB::table('item')->select('item_name as text', 'id as value')->get();
        $account        = DB::table('account')->select('account_name as text', 'id as value')->get();

        $contact = DB::table('contact')->select('display_name as text', 'id as value')->get();
        $tax            = DB::table('tax')->select('tax_name as text', 'id as value')->get();
        $account        = DB::table('account')->select('account_name as text', 'id as value')->get();
        $paid_throughs  = DB::table('account')->select('account_name as text', 'id as value')
                                ->whereIn('account_type_id',[4,5])->orderBy('account_name','asc')->get();

        // $journalEntries = Journal::find($id)->journalEntries()->whereNotIn('account_name_id', [1])->get();
        $journalEntries = Journal::find($id)->journalEntries()->where('account_name_id','!=', 9)->get();
        // return $journalEntries;

        $journalEntriesTax = Journal::find($id)->journalEntries()->where('account_name_id', 1)->get();

        return response()->json([
            'item'          =>  $item,
            'account'       =>  $account,
            'contact'       =>  $contact,
            'tax'           =>  $tax,
            'account'       =>  $account,
            'paid_throughs' =>  $paid_throughs,
            'journalEntries' => $journalEntries,
            'journalEntriesTax' => $journalEntriesTax,
        ], 201);
    }

    public function getContactAccountTaxList2($id)
    {
        $item           = DB::table('item')->select('item_name as text', 'id as value')->get();
        $account        = DB::table('account')->select('account_name as text', 'id as value')->get();

        $contact = DB::table('contact')->select('display_name as text', 'id as value')->get();
        $tax            = DB::table('tax')->select('tax_name as text', 'id as value')->get();
        $account        = DB::table('account')->select('account_name as text', 'id as value')->get();
        $paid_throughs  = DB::table('account')->select('account_name as text', 'id as value')
                                ->whereIn('account_type_id',[4,5])->orderBy('account_name','asc')->get();

        // $journalEntries = Journal::find($id)->journalEntries()->whereNotIn('account_name_id', [1])->get();
        $journalEntries = Journal::find($id)->journalEntries()->where('account_name_id', 9)->get();
        // return $journalEntries;

        $journalEntriesTax = Journal::find($id)->journalEntries()->where('account_name_id', 1)->get();

        return response()->json([
            'item'          =>  $item,
            'account'       =>  $account,
            'contact'       =>  $contact,
            'tax'           =>  $tax,
            'account'       =>  $account,
            'paid_throughs' =>  $paid_throughs,
            'journalEntries' => $journalEntries,
            'journalEntriesTax' => $journalEntriesTax,
        ], 201);
    }

    public function getContactAccountTaxName()
    {
        $item           = DB::table('item')->select('item_name as text', 'id as value')->get();
        $account        = DB::table('account')->select('account_name as text', 'id as value')->get();
        $contact        = DB::table('contact')->select('display_name as text', 'id as value')->get();
        $tax            = DB::table('tax')->select('tax_name as text', 'id as value')->get();
        $account        = DB::table('account')->select('account_name as text', 'id as value')->get();
        $paid_throughs  = DB::table('account')->select('account_name as text', 'id as value')
                                ->whereIn('account_type_id',[4,5])->orderBy('account_name','asc')->get();

        return response()->json([
            'item'          =>  $item,
            'account'       =>  $account,
            'contact'       =>  $contact,
            'tax'           =>  $tax,
            'account'       =>  $account,
            'paid_throughs' =>  $paid_throughs,
        ], 201);
    }

}
