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
      User::insert([
        ['name' => 'Admin',
         'email' => 'admin@admin.com',
         'password' => bcrypt('admin123'),
         'role_id' => 1,
         'is_active' => 1,],
      ]);
    }
}
