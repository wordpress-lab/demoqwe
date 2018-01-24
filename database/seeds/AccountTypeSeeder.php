<?php

use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();
        
        // Assets accounts 
            DB::table('account_type')->insert([
                'id' => 1,
                'account_name' => 'Other Asset',
                'description' => 'Track special assets like goodwill and other intangible assets',
                'parent_account_type_id' => 1,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_type')->insert([
                'id' => 2,
                'account_name' => 'Accounts Receivable',
                'description' => 'Reflects money owed to you by your customers. Zoho Books provides a default Accounts Receivable account. E.g. Unpaid Invoices',
                'parent_account_type_id' => 1,
                'required_status' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_type')->insert([
                'id' => 3,
                'account_name' => 'Other Current asset',
                'description' => 'Any short term asset that can be converted into cash or cash equivalents easily - Prepaid expenses - Stocks and Mutual Funds',
                'parent_account_type_id' => 1,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_type')->insert([
                'id' => 4,
                'account_name' => 'Cash',
                'description' => 'To keep track of cash and other cash equivalents like petty cash, undeposited funds, etc.',
                'parent_account_type_id' => 1,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_type')->insert([
                'id' => 5,
                'account_name' => 'Bank',
                'description' => 'To keep track of bank accounts like Savings, Checking, and Money Market accounts',
                'parent_account_type_id' => 1,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_type')->insert([
                'id' => 6,
                'account_name' => 'Fixed asset',
                'description' => 'Any long term investment or an asset that cannot be converted into cash easily like:-Land and Buildings - Plant, Machinery and Equipment - Computers -Furniture',
                'parent_account_type_id' => 1,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_type')->insert([
                'id' => 7,
                'account_name' => 'Stock',
                'description' => 'To keep track of your inventory assets.',
                'parent_account_type_id' => 1,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


            // liability accounts 

            DB::table('account_type')->insert([
                'id' => 9,
                'account_name' => 'Other Current Liability',
                'description' => 'Any short term liability like:Customer Deposits - Tax Payable',
                'parent_account_type_id' => 2,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_type')->insert([
                'id' => 10,
                'account_name' => 'Credit Card',
                'description' => 'Create a trail of all your credit card transactions by creating a credit card account',
                'parent_account_type_id' => 2,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_type')->insert([
                'id' => 11,
                'account_name' => 'Long Term Liability',
                'description' => 'Liabilities that mature after a minimum period of one year like Notes Payable, Debentures, and Long Term Loans',
                'parent_account_type_id' => 2,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


            DB::table('account_type')->insert([
                'id' => 12,
                'account_name' => 'Other Liability',
                'description' => 'Obligation of an entity arising from past transactions or events which would require repayment.- Tax to be paid Loan to be Repaid Accounts Payable etc',
                'parent_account_type_id' => 2,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_type')->insert([
                'id' => 13,
                'account_name' => 'Accounts Payable',
                'description' => 'Accounts Payable',
                'parent_account_type_id' => 2,
                'required_status' => 1,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            // Equity accounts

            DB::table('account_type')->insert([
                'id' => 14,
                'account_name' => 'Equity',
                'description' => 'Equity',
                'parent_account_type_id' => 3,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            //income accounts 

            DB::table('account_type')->insert([
                'id' => 15,
                'account_name' => 'income',
                'description' => 'income',
                'parent_account_type_id' => 4,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


            DB::table('account_type')->insert([
                'id' => 16,
                'account_name' => 'Other Income',
                'description' => 'Other Income',
                'parent_account_type_id' => 4,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            // expense accounts

            DB::table('account_type')->insert([
                'id' => 17,
                'account_name' => 'Expense',
                'description' => 'Expense',
                'parent_account_type_id' => 5,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_type')->insert([
                'id' => 18,
                'account_name' => 'Cost of Goods Sold',
                'description' => 'Cost of Goods Sold',
                'parent_account_type_id' => 5,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);

            DB::table('account_type')->insert([
                'id' => 19,
                'account_name' => 'Other Expense',
                'description' => 'Other Expense',
                'parent_account_type_id' => 5,
                'required_status' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);


    }
}
