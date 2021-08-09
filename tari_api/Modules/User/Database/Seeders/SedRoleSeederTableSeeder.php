<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\User\Entities\Role;

class SedRoleSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Schema::disableForeignKeyConstraints();
        \DB::table('roles')->truncate();

        $role = Role::firstOrNew(['name' => 'superadministrator']);
        $role->name = 'superadministrator';
        $role->guard_name = 'web';
        $role->save();

        $role = Role::firstOrNew(['name' => 'administrator']);
        $role->name = 'administrator';
        $role->guard_name = 'web';
        $role->save();

        $role = Role::firstOrNew(['name' => 'instructor']);
        $role->name = 'instructor';
        $role->guard_name = 'web';
        $role->save();

        $role = Role::firstOrNew(['name' => 'free']);
        $role->name = 'free';
        $role->guard_name = 'web';
        $role->save();

        Schema::enableForeignKeyConstraints();
    }
}