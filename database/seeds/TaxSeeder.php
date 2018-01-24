<?php

use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();


        DB::table('tax')->insert([
            'tax_name' => '0%-tax',
            'amount_percentage' => 0,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('tax')->insert([
            'tax_name' => '5%-tax',
            'amount_percentage' => 5,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('tax')->insert([
            'tax_name' => '10%-tax',
            'amount_percentage' => 10,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('tax')->insert([
            'tax_name' => '15%-tax',
            'amount_percentage' => 15,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('tax')->insert([
            'tax_name' => '20%-tax',
            'amount_percentage' => 20,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);
    }
}
