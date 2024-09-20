<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'superadmin')->first();

        if (is_null($user)) {
            $user = new User();
            $user->name = 'Super Admin';
            $user->email = 'super-admin@corp.com';
            $user->username = 'superadmin';
            $user->password = Hash::make('qwerty123');
            $user->save();
        }

        User::factory(20)->create();
    }
}
