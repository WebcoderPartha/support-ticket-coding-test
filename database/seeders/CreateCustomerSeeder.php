<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = Customer::create([
            'name' => 'Parthadeb Mondal',
            'email' => 'parthadev76@gmail.com',
            'password' => Hash::make('parthadev76@gmail.com'),
            'phone' => '01710147887',
            'is_active' => 1,
        ]);
    }
}
