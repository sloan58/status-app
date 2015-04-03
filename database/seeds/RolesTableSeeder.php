<?php

use App\User;
use App\Role;
use App\AssignedRoles;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->display_name = 'admin';
        $adminRole->description = 'description';
        $adminRole->is_admin = 1;
        $adminRole->save();

        $reportingRole = new Role;
        $reportingRole->name = 'reporting';
        $reportingRole->display_name = 'reporting';
        $reportingRole->description = 'Can Generate Reports';
        $reportingRole->is_admin = 1;
        $reportingRole->save();

        $user = User::where('email','=','admin@admin.com')->first();
        $assignedrole = new AssignedRoles;
        $assignedrole->user_id = $user->id;
        $assignedrole->role_id = $adminRole->id;
        $assignedrole->role_id = $reportingRole->id;
        $assignedrole->save();

        $user = User::where('email','=','user@user.com')->first();
        $assignedrole = new AssignedRoles;
        $assignedrole->user_id = $user->id;
        $assignedrole->role_id = $reportingRole->id;
        $assignedrole->save();
    }

}
