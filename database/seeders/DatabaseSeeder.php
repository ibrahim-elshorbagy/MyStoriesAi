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
    ]);
    $admin->assignRole($SystemAdminRole);

    $admin = User::create([
      'id' => 3,
      'name' => 'ihab',
      'username' => 'i',
      'email' => 'ihab@gmail.com',
      'password' => Hash::make('i'),
    ]);


    $admin->assignRole($SystemAdminRole);

    $user = User::create([
      'id' => 2,
      'name' => 'saad',
      'username' => 's',
      'email' => 'saad@gmail.com',
      'password' => Hash::make('s'),
    ]);

    $user->assignRole($userRole);


  }
}
