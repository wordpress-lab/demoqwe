<?php

use Illuminate\Database\Seeder;

class OrganizationProfileSeeder extends Seeder
{
    public function run()
    {
        $data = Faker\Factory::create();

        DB::table('organization_profiles')->insert([
            'logo'           => 'logo.png',
            'display_name'   => 'Ontik Tech',
            'company_name'   => 'Ontik Technology',
            'street'         => 'Dhanmondi Rd.No. 2',
            'city'           => 'Dhaka',
            'state'          => 'Dhaka',
            'country'        => 'Bangladesh',
            'zip_code'       => '1200',
            'website'        => 'http://ontiktechnology.com',
            'contact_number' => '01xxx xxxxxx',
            'email'          => 'info@ontiktechnology.com',
            'created_at'     => $data->dateTime($max = 'now'),
            'updated_at'     => $data->dateTime($max = 'now'),
        ]);
    }
}
