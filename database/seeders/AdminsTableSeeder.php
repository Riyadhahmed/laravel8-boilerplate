<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Admin::create([
    		'name' => 'superadmin',
    		'email' => 'superadmin@admin.com',
    		'password' => Hash::make('123456'),
    		'status' => 1,
    		'created_at' => date('Y-m-d'),
    		'updated_at' => date('Y-m-d')
    	]);
    }
}
