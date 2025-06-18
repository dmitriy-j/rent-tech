<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([

'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
        'balance' => 10000.00
    ]);

    User::create([
    'name' => 'test',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
        'role' => 'user',
        'balance' => 10000.00
    ]);
    }

}

