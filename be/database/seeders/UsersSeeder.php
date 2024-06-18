<?php

namespace Database\Seeders;

use App\Models\Users;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new Users();
        $user->id = 1;
        $user->username = 'Lead Admin';
        $user->email = 'leadadmin@gmail.com';
        $user->password = Hash::make('123456');
        $user->date_of_birth = Carbon::parse('2003-10-10');
        $user->is_admin = 1;
        $user->status = 1;
        $user->save();
        Users::factory()->count(10)->create();
    }
}
