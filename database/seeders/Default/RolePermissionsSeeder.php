<?php

namespace Database\Seeders\Default;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use App\Zaions\Helpers\ZHelpers;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default Roles
        $superAdminRole = Role::where('name', RolesEnum::superAdmin->name)->first();
        if (!$superAdminRole) {
            $superAdminRole = Role::create(['name' => RolesEnum::superAdmin->name]);
        }

        $adminRole = Role::where('name', RolesEnum::admin->name)->first();
        if (!$adminRole) {
            $adminRole = Role::create(['name' => RolesEnum::admin->name]);
        }

        $managerRole = Role::where('name', RolesEnum::manager->name)->first();
        if (!$managerRole) {
            $managerRole = Role::create(['name' => RolesEnum::manager->name]);
        }

        $employeeRole = Role::where('name', RolesEnum::employee->name)->first();
        if (!$employeeRole) {
            $employeeRole = Role::create(['name' => RolesEnum::employee->name]);
        }
        
        $userRole = Role::where('name', RolesEnum::user->name)->first();
        if (!$userRole) {
            $userRole = Role::create(['name' => RolesEnum::user->name]);
        }

        // workspace member roles
        Role::create(['name' => RolesEnum::ws_contributor->name]);
        Role::create(['name' => RolesEnum::ws_administrator->name]);
        Role::create(['name' => RolesEnum::ws_writer->name]);
        Role::create(['name' => RolesEnum::ws_approver->name]);
        Role::create(['name' => RolesEnum::ws_guest->name]);


        // All App Permissions
        $allPermissions = ZHelpers::createPermissions();

        $canBeImpersonatePermission = Permission::where('name', PermissionsEnum::canBe_impersonate->name)->first();

        $superAdminRolePermissions = array_filter($allPermissions, function ($permission) {
            return $permission->name !== PermissionsEnum::canBe_impersonate->value;
        });

        $adminRolePermissions = array_filter($superAdminRolePermissions, function ($permission) {
            return !Str::of($permission->name)->contains('restore_') && !Str::of($permission->name)->contains('forceDelete_') && !Str::of($permission->name)->contains('_user'); 
        });

        // add canBeImpersonatePermission Permission
        array_push($adminRolePermissions, $canBeImpersonatePermission);

        $managerRolePermissions = array_filter($superAdminRolePermissions, function ($permission) {
            return !Str::of($permission->name)->contains('delete_') && !Str::of($permission->name)->contains('restore_') && !Str::of($permission->name)->contains('forceDelete_') && !Str::of($permission->name)->contains('_user') && !Str::of($permission->name)->contains('_role') && !Str::of($permission->name)->contains('_permission') && !Str::of($permission->name)->contains('Impersonate_');
        });

        $employeeRolePermissions = array_filter($superAdminRolePermissions, function ($permission) {
            return !Str::of($permission->name)->contains('delete_') && !Str::of($permission->name)->contains('restore_') && !Str::of($permission->name)->contains('forceDelete_') && !Str::of($permission->name)->contains('_user') && !Str::of($permission->name)->contains('_role') && !Str::of($permission->name)->contains('_permission') && !Str::of($permission->name)->contains('Impersonate_');
        });

        $userRolePermissions = array_filter($adminRolePermissions, function ($permission) {
            return !Str::of($permission->name)->contains('delete_') && !Str::of($permission->name)->contains('update_') && !Str::of($permission->name)->contains('_user') && !Str::of($permission->name)->contains('_role') && !Str::of($permission->name)->contains('_permission') && !Str::of($permission->name)->contains('Impersonate_') && !Str::of($permission->name)->contains('restore_');
        });

        // Assign permissions to roles
        $superAdminRole->syncPermissions($superAdminRolePermissions);
        $adminRole->syncPermissions($adminRolePermissions);
        $managerRole->syncPermissions($managerRolePermissions);
        $employeeRole->syncPermissions($employeeRolePermissions);
        $userRole->syncPermissions($userRolePermissions);
    }
}
