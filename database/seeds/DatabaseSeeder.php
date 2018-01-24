<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\User::truncate();
        App\Models\AccessLevel\AccessLevel::truncate();
        App\Models\AccessLevel\Modules::truncate();
        App\Models\AccessLevel\Role::truncate();
        App\Models\AccountChart\Account::truncate();
        App\Models\AccountChart\AccountType::truncate();
        App\Models\AccountChart\ParentAccountType::truncate();
        App\Models\Branch\Branch::truncate();
        App\Models\Contact\Contact::truncate();
        App\Models\Contact\ContactCategory::truncate();
        App\Models\Inventory\Item::truncate();
        App\Models\Inventory\ItemCategory::truncate();
        App\Models\Inventory\Product::truncate();
        App\Models\Inventory\ProductPhase::truncate();
        App\Models\Inventory\ProductPhaseItem::truncate();
        App\Models\Inventory\ProductPhaseItemAdd::truncate();
        App\Models\Inventory\Stock::truncate();
        App\Models\ManualJournal\Journal::truncate();
        App\Models\ManualJournal\JournalEntry::truncate();
        App\Models\MoneyIn\CreditNote::truncate();
        App\Models\MoneyIn\CreditNoteEntry::truncate();
        App\Models\MoneyIn\CreditNotePayment::truncate();
        App\Models\MoneyIn\CreditNoteRefund::truncate();
        App\Models\MoneyIn\ExcessPayment::truncate();
        App\Models\MoneyIn\Invoice::truncate();
        App\Models\MoneyIn\InvoiceEntry::truncate();
        App\Models\MoneyIn\PaymentReceiveEntryModel::truncate();
        App\Models\MoneyIn\PaymentReceives::truncate();
        App\Models\OrganizationProfile\OrganizationProfile::truncate();
        App\Models\PaymentMode\PaymentMode::truncate();
        App\Models\MoneyOut\Expense::truncate();
        App\Models\MoneyOut\Bill::truncate();
        App\Models\MoneyOut\BillEntry::truncate();
        App\Models\MoneyOut\PaymentMade::truncate();
        App\Models\MoneyOut\PaymentMadeEntry::truncate();
        App\Models\Tax::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call(UsersTableSeeder::class);
        $this->call(BranchTableSeeder::class);
        $this->call(ContactCategoryTableSeeder::class);
        //$this->call(ContactTableSeeder::class);
        $this->call(ParentAccountTypeSeeder::class);
        $this->call(PaymentModeTableSeeder::class);
        $this->call(AccountTypeSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(ItemCategorySeeder::class);
        //$this->call(ItemSeeder::class);
        //$this->call(StockSeeder::class);
        //$this->call(ProductSeeder::class);
        //$this->call(ProductPhaseSeeder::class);
        //$this->call(ProductPhaseItemSeeder::class);
        $this->call(TaxSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AccessLevelSeeder::class);
        $this->call(OrganizationProfileSeeder::class);
        $this->call(ModuleDeleteSeeder::class);
        //$this->call(JournalTableSeeder::class);
        //$this->call(InvoicesTableSeeder::class);
        //$this->call(InvoiceEntriesTableSeeder::class);
        //$this->call(CreditNotesTableSeeder::class);
        //$this->call(CreditNoteEntriesTableSeeder::class);
        //$this->call(CreditNotePaymentsTableSeeder::class);
        //$this->call(CreditNoteRefundsTableSeeder::class);
        //$this->call(PaymentReceivesTableSeeder::class);
        //$this->call(PaymentReceivesEntriesTableSeeder::class);
        //$this->call(ExcessPaymentTableSeeder::class);

        //$this->call(ExpenseTableSeeder::class);
        //$this->call(BillTableSeeder::class);
        //$this->call(BillEntryTableSeeder::class);
        //$this->call(PaymentMadeTableSeeder::class);
        //$this->call(PaymentMadeEntryTableSeeder::class);
        //$this->call(JournalEntriesTableSeeder::class);
        $this->call(PmsSectorsTableSeeder::class);
    }
}
