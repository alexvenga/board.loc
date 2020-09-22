<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'id'             => '1',
            'name'           => 'Alex',
            'email'          => 'alex@alex.alex',
            'password'       => Hash::make('alexalexalex'),
            'remember_token' => Str::random(10),
            'role'           => User::ROLE_ADMIN,
            'status'         => User::STATUS_ACTIVE,
        ]);

        factory(User::class, 100)->create();
    }
}
