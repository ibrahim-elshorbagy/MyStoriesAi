<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {

    $SystemAdminRole = Role::firstOrCreate(['name' => 'admin']);
    $userRole = Role::firstOrCreate(['name' => 'user']);

    $admin = User::create([
      'id' => 1,
      'name' => 'ibrahim elshorbagy',
      'username' => 'a',
      'email' => 'ibrahim.elshorbagy47@gmail.com',
      'password' => Hash::make('a'),
      "email_verified_at" => now(),
    ]);
    $admin->assignRole($SystemAdminRole);


    $user = User::create([
      'id' => 2,
      'name' => 'ibrahim',
      'username' => 'u',
      'email' => 'ibrahim@gmail.com',
      'password' => Hash::make('u'),
      "email_verified_at" => now(),

    ]);

    $user->assignRole($userRole);


  }
}
