<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 100)->create();

        User::create([
            'name' => 'Developer tester',
            'email' => 'dev@dev.dev',
            'password' => Hash::make('dev'),
            'cpf' => '00123321123',
            'administrator' => 1,
            'approved' => 1
        ]);
    }
}
