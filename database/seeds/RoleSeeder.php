<?php

use Illuminate\Database\Seeder;
use App\{Role,Category};


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::Create([
            'role' => 'ADMIN'
        ]);
        Role::Create([
            'role' => 'CASHIER'
        ]);
        Role::Create([
            'role' => 'INVENTORY'
        ]);
        Category::Create([
            'category' => 'ACCESORIES'
        ]);
    }
}
