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
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'permName' => NULL,
        ]);

        // User Permissions
            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 0,
            ]);

            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 1,
            ]);

            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 2,
            ]);

            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 3,
            ]);
            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 5,
            ]);

            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 6,
            ]);
            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 7,
            ]);

            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 8,
            ]);
            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 9,
            ]);

            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 10,
            ]);
            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 11,
            ]);

            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 12,
            ]);
            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 13,
            ]);

            DB::table('user_permissions')->insert([
                'userId' => $userId,
                'permissionId' => 14,
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
        ]);

        DB::table('email_configurations')->insert([
            'companyId' => $companyId,
            'host' => 'localhost',
            'port' => 485,
            'ssl' => 0,
            'username' => 'example',
            'password' => 'password',
            'display_name' => 'firma',
            'reply_address' => 'info@example.com'
        ]);
    }
}
