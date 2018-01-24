<?php

use Illuminate\Database\Seeder;

class ContactCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();
        DB::table('contact_category')->insert([
            'contact_category_name' => 'Customer',
            'contact_category_description' => 'Customer Description',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
            'created_by' => $data->numberBetween(1,1),
            'updated_by' => $data->numberBetween(1,1),
        ]);

        DB::table('contact_category')->insert([
            'contact_category_name' => 'Dealer',
            'contact_category_description' => 'Dealer Description',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
            'created_by' => $data->numberBetween(1,1),
            'updated_by' => $data->numberBetween(1,1),
        ]);

        DB::table('contact_category')->insert([
            'contact_category_name' => 'Employee',
            'contact_category_description' => 'Employee Description',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
            'created_by' => $data->numberBetween(1,1),
            'updated_by' => $data->numberBetween(1,1),
        ]);

        DB::table('contact_category')->insert([
            'contact_category_name' => 'Vendor',
            'contact_category_description' => 'Vandor Description',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
            'created_by' => $data->numberBetween(1,1),
            'updated_by' => $data->numberBetween(1,1),
        ]);

        DB::table('contact_category')->insert([
            'contact_category_name' => 'Bank',
            'contact_category_description' => 'Bank Description',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
            'created_by' => $data->numberBetween(1,1),
            'updated_by' => $data->numberBetween(1,1),
        ]);

        DB::table('contact_category')->insert([
            'contact_category_name' => 'Agent',
            'contact_category_description' => 'Agent Description',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
            'created_by' => $data->numberBetween(1,1),
            'updated_by' => $data->numberBetween(1,1),
        ]);
    }
}
