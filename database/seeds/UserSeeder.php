<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Model\Admin;

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
        	'username' => 'testsubject',
        	'email' => 'test@resto.app',
        	'password' => bcrypt('secret')
        ]);

        Admin::create([
        	'username' => 'testadmin',
        	'email' => 'admin@resto.app',
        	'password' => bcrypt('adminsecret')
        ]);
    }
}
