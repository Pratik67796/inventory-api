<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Supplier::insert([
            [
                'name' => 'Pratik',
                'contact_email' => 'pratik@yopmail.com',
                'phone' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ravi',
                'contact_email' => 'ravi@yopmail.com',
                'phone' => '9898586644',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dwarkesh',
                'contact_email' => 'dwarkesh@yopmail.com',
                'phone' => '9898123456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
