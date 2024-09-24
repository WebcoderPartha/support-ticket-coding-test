<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::create([
            'name' => 'Net Coden Support',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@gmail.com'),
            'phone' => '0170000000',
            'is_active' => 1,
        ]);

    }
}
