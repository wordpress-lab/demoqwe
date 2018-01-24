<?php

use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
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
            DB::table('contact')->insert([
                'first_name'      => str_random(10),
                'last_name'       => str_random(10),
                'profile_pic_url' => str_random(10),
                'display_name'    => str_random(10),
                'company_name'    => str_random(10),
                'email_address'   => str_random(10),
                'skype_name'      => str_random(10),
                'phone_number_1'  => str_random(10),
                'phone_number_2'  => str_random(10),
                'phone_number_3'  => str_random(10),
                'billing_street'  => str_random(10),
                'billing_city'    => str_random(10),
                'billing_state'   => str_random(10),
                'billing_zip_code' => str_random(10),
                'billing_country' => str_random(10),
                'shipping_street' => str_random(10),
                'shipping_city' => str_random(10),
                'shipping_state' => str_random(10),
                'shipping_zip_code' => str_random(10),
                'shipping_country' => str_random(10),
                'fb_id' => str_random(10),
                'tw_id' => str_random(10),
                'about' => str_random(10),
                'contact_status' => str_random(10),
                'contact_category_id' => $data->numberBetween(1,2),
                'branch_id' => $data->numberBetween(1,10),
                'created_by' => $data->numberBetween(1,10),
                'updated_by' => $data->numberBetween(1,10),
            ]);
        }
    }
}
