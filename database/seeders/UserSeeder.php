<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        // Create sample users
        $users = [
            [
                'user_id' => 1,
                'first_name' => 'Mark Louis',
                'last_name' => 'Odavar',
                'email' => 'mlodavar@my.cspc.edu.ph',
                'contact' => '09106002059',
                'role' => '0',
                'assigned_program' => null,
                'assigned_department' => null,
            ],
            // Add more sample users as needed
        ];

        // Insert the users into the database
        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
