<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = DB::table('users')->insertGetId([
            'name' => 'Developer',
            'email' => 'dev@swisstransport.com',
            'password' => Hash::make('camdalio1983'),
            'permName' => 'superAdmin',
        ]);

        $companyId = DB::table('companies')->insertGetId([
            'name' => 'Example Company',
            'street' => 'Examplestrasse 190',
            'post_code' => '5555',
            'city' => 'Regensdorf ZH',
            'phone' => '+41 055 555 55 55',
            'mobile' => '+41 055 555 55 55',
            'contact_person' => 'John Doe',
            'email' => 'example@example.com',
            'website' => 'https://www.google.com/',
            'crmPrimaryColor' => '#286090',
            'crmSecondaryColor' => '#C8DFF3',
            'pdfPrimaryColor' => '#D10D0C'
        ]);

        
    }
}
