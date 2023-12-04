<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
     /**
     * The users to seed.
     *
     * @var array
     */
    protected $users = [
        [
            'email' => 'user1@example.com',
            'username' => 'user1',
            'name' => 'User One',
            'password' => 'password1',
        ],
        [
            'email' => 'user2@example.com',
            'username' => 'user2',
            'name' => 'User Two',
            'password' => 'password2',
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->users as $user) {
            DB::table('users')->insert([
                'email' => $user['email'],
                'username' => $user['username'],
                'name' => $user['name'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
