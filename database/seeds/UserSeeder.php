<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Admin',
            'lastname'  => 'Grecon',
            'username'  => 'admin123',
            'password'  => Hash::make('password'),
            'image'     => '1565630577.jpg',
            'number'    => '09195241355',
            'role_id'      => '2',
        ]);

        User::create([
            'firstname' => 'Admin1',
            'lastname'  => 'Grecon1',
            'username'  => 'admin1234',
            'password'  => Hash::make('password'),
            'image'     => '1565630577.jpg',
            'number'    => '09195241355',
            'role_id'      => '12',
        ]);
    }
}
