<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $role = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'name'           => 'Rene Rodriguez',
                'email'          => 'rene.rodriguez@aguaclean.app',
                'password'       => bcrypt('password'),
                'celular'        => '+56973747615',
                'remember_token' => Str::random(60),
                'role_id'        => $role->id,
            ]);
            User::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'celular'        => '+56945264569',
                'remember_token' => Str::random(60),
                'role_id'        => $role->id,
            ]);
            User::create([
                'name'           => 'Moderador',
                'email'          => 'moderador@aguaclean.app',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id'        => 2,
            ]);
            User::create([
                'name'           => 'Conductor',
                'email'          => 'conductor@aguaclean.app',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id'        => 3,
            ]);
            
        }
    }
}
