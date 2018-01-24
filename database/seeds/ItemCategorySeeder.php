<?php

use Illuminate\Database\Seeder;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();

        DB::table('item_category')->insert([
            'item_category_name' => 'Product',
            'item_category_description' => $data->paragraph,
            'branch_id' => $data->numberBetween(1,10),
            'branch_id' => $data->numberBetween(1,10),
            'created_by' => $data->numberBetween(1,1),
            'updated_by' => $data->numberBetween(1,1),
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('item_category')->insert([
            'item_category_name' => 'Service',
            'item_category_description' => $data->paragraph,
            'branch_id' => $data->numberBetween(1,10),
            'branch_id' => $data->numberBetween(1,10),
            'created_by' => $data->numberBetween(1,1),
            'updated_by' => $data->numberBetween(1,1),
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);
    }
}
