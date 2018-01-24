<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();

        foreach(range(1,10) as $index)
        {
            DB::table('item')->insert([
                'item_name' => str_random(10),
                'item_about' => str_random(10),
                'item_sales_rate' => $data->numberBetween(10,50),
                'item_sales_account' => str_random(10),
                'item_sales_description' => $data->paragraph,
                'item_sales_tax' => $data->numberBetween(1,10),
                'item_purchase_rate' => $data->numberBetween(1,100),
                'item_purchase_account' => $data->numberBetween(1,10),
                'item_purchase_description' => $data->paragraph,
                'reorder_point' => $data->numberBetween(1,100),
                'barcode' => str_random(10),
                'item_image_url' => str_random(10),
                'item_about' => str_random(10),
                'total_purchases' => $data->numberBetween(1,100),
                'total_sales' => $data->numberBetween(1,10),
                'item_category_id' => $data->numberBetween(1,10),
                'branch_id' => $data->numberBetween(1,10),
                'created_by' => $data->numberBetween(1,1),
                'updated_by' => $data->numberBetween(1,1),
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
        }
    }
}
