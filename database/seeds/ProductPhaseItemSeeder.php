<?php

use Illuminate\Database\Seeder;

class ProductPhaseItemSeeder extends Seeder
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
            DB::table('product_phase_item')->insert([
                'date' => str_random(10),
                'issued_number' => str_random(10),
                'reference' => str_random(10),
                'reason' => str_random(10),
                'personal_note' => $data->paragraph,
                'recipient_id' => $data->numberBetween(1,10),
                'issued_by' => $data->numberBetween(1,10),
                'product_id' => $data->numberBetween(1,10),
                'product_phase_id' => $data->numberBetween(1,10),
                'created_by' => $data->numberBetween(1,10),
                'updated_by' => $data->numberBetween(1,10),
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
        }
    }
}
