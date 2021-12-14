<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'sulkifli',
                'email' => "sulkifli@gmail.com",
                'password' => Hash::make("12345678"),
            ],
            [
                'name' => 'sul',
                'email' => "sul@gmail.com",
                'password' => Hash::make("12345678"),
            ],
            [
                'name' => 'ijul',
                'email' => "ijul@gmail.com",
                'password' => Hash::make("12345678"),
            ],
            [
                'name' => 'ijulkifli',
                'email' => "ijulkifli@gmail.com",
                'password' => Hash::make("12345678"),
            ],
            [
                'name' => 'ijulsul',
                'email' => "ijulsul@gmail.com",
                'password' => Hash::make("12345678"),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
