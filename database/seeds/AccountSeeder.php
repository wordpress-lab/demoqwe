pet<?php

use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();
        
        
            DB::table('account')->insert([
                'id' => 1,
                'account_name' => 'Advance Tax',
                'account_code' => 'Advance Tax',
                'description' => 'Any tax which is paid in advance is recorded into the advance tax account. This advance tax payment could be a quarterly, half yearly or yearly payment.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 3,
                'parent_account_type_id' => 1,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account')->insert([
                'id' => 2,
                'account_name' => 'Employee Advance',
                'account_code' => 'Employee Advance',
                'description' => 'Money paid out to an employee in advance can be tracked here till it is repaid or shown to be spent for company purposes.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 3,
                'parent_account_type_id' => 1,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


            DB::table('account')->insert([
                'id' => 3,
                'account_name' => 'Cash',
                'account_code' => 'Cash',
                'description' => 'It is a small amount of cash that is used to pay your minor or casual expenses rather than writing a check.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 4,
                'parent_account_type_id' => 1,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account')->insert([
                'id' => 4,
                'account_name' => 'Undeposited Funds',
                'account_code' => 'Undeposited Funds',
                'description' => 'Record funds received by your company yet to be deposited in a bank as undeposited funds and group them as a current asset in your balance sheet.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 4,
                'parent_account_type_id' => 1,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            

            DB::table('account')->insert([
                'id' => 5,
                'account_name' => 'Accounts Receivable',
                'account_code' => 'Accounts Receivable',
                'description' => 'The money that customers owe you becomes the accounts receivable. A good example of this is a payment expected from an invoice sent to your customer.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 2,
                'parent_account_type_id' => 1,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account')->insert([
                'id' => 6,
                'account_name' => 'Inventory Asset',
                'account_code' => 'Inventory Asset',
                'description' => 'An account which tracks the value of goods in your inventory.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 7,
                'parent_account_type_id' => 1,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account')->insert([
                'id' => 7,
                'account_name' => 'Opening Balance Adjustments',
                'account_code' => 'Opening Balance Adjustments',
                'description' => 'This account will hold the difference in the debits and credits entered during the opening balance.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 9,
                'parent_account_type_id' => 2,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 8,
                'account_name' => 'Employee Reimbursements',
                'account_code' => 'Employee Reimbursements',
                'description' => 'This account can be used to track the reimbursements that are due to be paid out to employees.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 9,
                'parent_account_type_id' => 2,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 9,
                'account_name' => 'Tax Payable',
                'account_code' => 'Tax Payable',
                'description' => 'The amount of money which you owe to your tax authority is recorded under the tax payable account. This amount is a sum of your outstanding in taxes and the tax charged on sales.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 9,
                'parent_account_type_id' => 2,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 10,
                'account_name' => 'Unearned Revenue',
                'account_code' => 'Unearned Revenue',
                'description' => 'A liability account that reports amounts received in advance of providing goods or services. When the goods or services are provided, this account balance is decreased and a revenue account is increased.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 9,
                'parent_account_type_id' => 2,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


             DB::table('account')->insert([
                'id' => 11,
                'account_name' => 'Accounts Payable',
                'account_code' => 'Accounts Payable',
                'description' => 'This is an account of all the money which you owe to others like a pending bill payment to a vendor,etc.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 13,
                'parent_account_type_id' => 2,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 12,
                'account_name' => 'Tag Adjustments',
                'account_code' => 'Tag Adjustments',
                'description' => 'This adjustment account tracks the transfers between different reporting tags.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 12,
                'parent_account_type_id' => 2,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


             DB::table('account')->insert([
                'id' => 13,
                'account_name' => 'Drawings',
                'account_code' => 'Drawings',
                'description' => 'The money withdrawn from a business by its owner can be tracked with this account.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 14,
                'parent_account_type_id' => 3,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 14,
                'account_name' => 'Opening Balance Offset',
                'account_code' => 'Opening Balance Offset',
                'description' => 'This is an account where you can record the balance from your previous years earning or the amount set aside for some activities. It is like a buffer account for your funds.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 14,
                'parent_account_type_id' => 3,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 15,
                'account_name' => 'Owner Equity',
                'account_code' => 'Owner Equity',
                'description' => 'The owners rights to the assets of a company can be quantified in the owner\'s equity account.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 14,
                'parent_account_type_id' => 3,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


             DB::table('account')->insert([
                'id' => 16,
                'account_name' => 'Sales',
                'account_code' => 'Sales',
                'description' => 'The income from the sales in your business is recorded under the sales account.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 15,
                'parent_account_type_id' => 4,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 17,
                'account_name' => 'General Income',
                'account_code' => 'General Income',
                'description' => 'A general category of account where you can record any income which cannot be recorded into any other category.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 15,
                'parent_account_type_id' => 4,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 18,
                'account_name' => 'Other Charges',
                'account_code' => 'Other Charges',
                'description' => 'Miscellaneous charges like adjustments made to the invoice can be recorded in this account.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 15,
                'parent_account_type_id' => 4,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 19,
                'account_name' => 'Interest Income',
                'account_code' => 'Interest Income',
                'description' => 'A percentage of your balances and deposits are given as interest to you by your banks and financial institutions. This interest is recorded into the interest income account.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 15,
                'parent_account_type_id' => 4,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 20,
                'account_name' => 'Shipping Charge',
                'account_code' => 'Shipping Charge',
                'description' => 'Shipping charges made to the invoice will be recorded in this account.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 15,
                'parent_account_type_id' => 4,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 21,
                'account_name' => 'Discount',
                'account_code' => 'Discount',
                'description' => 'Any reduction on your selling price as a discount can be recorded into the discount account.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 15,
                'parent_account_type_id' => 4,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 22,
                'account_name' => 'Late Fee Income',
                'account_code' => 'Late Fee Income',
                'description' => 'Any late fee income is recorded into the late fee income account. The late fee is levied when the payment for an invoice is not received by the due date.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 15,
                'parent_account_type_id' => 4,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 23,
                'account_name' => 'Other Expenses',
                'account_code' => 'Other Expenses',
                'description' => 'Any minor expense on activities unrelated to primary business operations is recorded under the other expense account.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 17,
                'parent_account_type_id' => 5,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 24,
                'account_name' => 'Bad Debt',
                'account_code' => 'Bad Debt',
                'description' => 'Any amount which is lost and is unrecoverable is recorded into the bad debt account.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 17,
                'parent_account_type_id' => 5,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


             DB::table('account')->insert([
                'id' => 25,
                'account_name' => 'Exchange Gain or Loss',
                'account_code' => 'Exchange Gain or Loss',
                'description' => 'Changing the conversion rate can result in a gain or a loss. You can record this into the exchange gain or loss account.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 19,
                'parent_account_type_id' => 5,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

             DB::table('account')->insert([
                'id' => 26,
                'account_name' => 'Cost of Goods Sold',
                'account_code' => 'Cost of Goods Sold',
                'description' => 'An expense account which tracks the value of the goods sold.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 18,
                'parent_account_type_id' => 5,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account')->insert([
                'id' => 27,
                'account_name' => 'Prepaid Expense',
                'account_code' => 'Prepaid Expense',
                'description' => 'An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 3,
                'parent_account_type_id' => 1,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


            DB::table('account')->insert([
                'id' => 28,
                'account_name' => 'Conveyance',
                'account_code' => 'Conveyance',
                'description' => 'An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 17,
                'parent_account_type_id' => 5,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
            DB::table('account')->insert([
                'id' => 30,
                'account_name' => 'Agent Commission',
                'account_code' => 'Agent Commission',
                'description' => 'Agent Commission.',
                'dashboard_watchlist' => 0,
                'required_status' => 1,
                'account_type_id' => 3,
                'parent_account_type_id' => 1,
                'branch_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
        
    }
}
