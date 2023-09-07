<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'first_name' => 'sathapat',
                'last_name' => 'pliantas',
                'email' => 'nameza036@gmail',
                'phone' => '0625080203'
            ],
            [
                'first_name' => 'besttie',
                'last_name' => 'janngam',
                'email' => 'besttie@gmail',
                'phone' => '094685912'
            ]
        ];

        foreach ($data as $key => $value) {
            Customer::create($value);
        }
    }
}
