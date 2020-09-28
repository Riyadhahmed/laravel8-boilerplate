<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Setting::create([
        'name' => 'Laravel Boilerplate',
        'slogan' => 'Admin Dashboard',
        'reg' => '12345',
        'stablished' => '2020',
        'email' => 'riyadhahmed777@gmail.com',
        'contact' => '01851334237',
        'address' => 'Chittagong,Bangladesh',
        'website' => 'http://www.laravelboilerplate.com',
        'logo' => 'assets/images/logo/default.png',
        'layout' => '1',
        'running_year' => '2020',
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d')
      ]);
   }
}
