<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => __('voyager::seeders.roles.admin'),
                ])->save();
        }
        $role = Role::firstOrNew(['name' => 'moderador']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Moderador',
                ])->save();
        }
        $role = Role::firstOrNew(['name' => 'conductor']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Conductor',
                ])->save();
        }
        $role = Role::firstOrNew(['name' => 'user']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => __('voyager::seeders.roles.user'),
                ])->save();
        }
    }
}
