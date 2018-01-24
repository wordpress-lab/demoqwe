<?php

use Illuminate\Database\Seeder;

class ParentAccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();

        DB::table('parent_account_type')->insert([
            'id' => 1,
            'account_name' => 'Assets',
            'description' => 'Assets',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('parent_account_type')->insert([
            'id' => 2,
            'account_name' => 'Liability',
            'description' => 'Liability',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('parent_account_type')->insert([
            'id' => 3,
            'account_name' => 'Equity',
            'description' => 'Equity',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('parent_account_type')->insert([
            'id' => 4,
            'account_name' => 'income',
            'description' => 'income',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('parent_account_type')->insert([
            'id' => 5,
            'account_name' => 'Expense',
            'description' => 'Expense',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);
    }
}
