<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin');
        $user->save();

        $user = new User();
        $user->name = 'Admin2';
        $user->email = 'admin2@admin.com';
        $user->password = bcrypt('admin');
        $user->save();
    }
}
