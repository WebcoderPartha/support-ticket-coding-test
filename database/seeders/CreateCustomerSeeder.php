<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::create([
           'name' => 'Net Coden Support',
           'email' => 'admin@gmail.com',
           'password' => 'admin@gmail.com',
           'phone' => '0170000000',
           'is_active' => 1,
        ]);
    }
}
