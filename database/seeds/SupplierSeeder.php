<?php

use Illuminate\Database\Seeder;
use App\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'firstname' => "Grecon",
            'lastname'  => "Inventory",
            'company'   => "Grecon",
            'email'     => "grecon@supplier.com",
            'number'    => "09543215",
        ]);
    }
}
