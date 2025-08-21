<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction; 

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          Transaction::create([
            'title' => 'salary',
            'amount' => '50000',
            'category_name'=> 'Income',
            'date' => '2023-08-21',
            'user_id' => 2, 
        ]);// Example transaction for user with ID 2
    }
}
