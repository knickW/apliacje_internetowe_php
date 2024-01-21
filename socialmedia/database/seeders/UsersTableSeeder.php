<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // Dodajemy użytkownika jako administratora
        DB::table('users')->insert([
            'name' => 'konrad',
            'email' => 'konrad@example.com',
            'password' => Hash::make('konrad'),
            'role' => 'admin',
        ]);
        \App\Models\User::factory(5)->create();
    }
}
