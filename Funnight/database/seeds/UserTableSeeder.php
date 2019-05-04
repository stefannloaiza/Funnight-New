<?php

use App\Role;
use App\User;
use Datetime;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = new User();
        $user->name = 'User';
        $user->role = '2';
        $user->surname = 'User';
        $user->nick = 'userone';
        $user->email = 'user@example.com';
        $user->image = ' ';
        $user->password = bcrypt('funnigth');
        $user->lastInteraction = new DateTime();
        $user->save();
        $user->roles()->attach($role_user);
        
        $user = new User();
        $user->name = 'Admin';
        $user->role = '1';
        $user->surname = 'Admin';
        $user->nick = 'Administ';
        $user->email = 'admin@example.com';
        $user->image = ' ';
        $user->password = bcrypt('funnigth');
        $user->lastInteraction = new DateTime();
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
