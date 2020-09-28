<?php

use Illuminate\Database\Seeder;

class ModelHasRoleTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('model_has_roles')->insert([
        'role_id' => 1,
        'model_type' => 'App\Models\Admin',
        'model_id' => 1,
      ]);
   }
}
