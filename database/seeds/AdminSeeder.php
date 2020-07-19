<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Factory::create();

      \App\Models\Admin::truncate();
      $admin = new \App\Models\Admin();
      $admin->name = 'Admin';
      $admin->email = 'admin@test.com';
      $admin->password = bcrypt('12345678');
      $admin->active = 1;
      $admin->created_at = now()->toDateTimeString();
      $admin->save();
      $admin->assignRole('admin');
      for ($i = 0; $i < 10; $i++) {
        $admin = new \App\Models\Admin();
        $admin->name = $faker->name;
        $admin->email = $faker->unique()->safeEmail;
        $admin->password = bcrypt('12345678');
        $admin->active = 1;
        $admin->created_at = now()->toDateTimeString();
        $admin->save();
        $admin->assignRole('user');
      }
//      $chunks = array_chunk($data, 10);
//      $i = 0;
//      foreach ($chunks as $chunk) {
//        \App\Models\Admin::insert($chunk);
//        dd($chunk);
//        $admin = \App\Models\Admin::where('email', $chunk[$i]['email'])->first();
//        if ($admin->email == 'admin@test.com')
//          $admin->assignRole('admin');
//        $admin->assignRole('user');
//        $i++;
//      }
    }
}
