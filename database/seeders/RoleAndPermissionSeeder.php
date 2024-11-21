<?php

namespace Database\Seeders;

use App\Enums\Permission;
use App\Models\User;
use App\Enums\Role as RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

use function Symfony\Component\String\b;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Permission::cases() as $permission) {
            \Spatie\Permission\Models\Permission::create([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        foreach (RoleEnum::cases() as $role) {
            $role = Role::create([
                'name' => $role,
                'guard_name' => 'web',
            ]);

            $this->syncPermissionsToRole($role);
        }
    }

    private function syncPermissionsToRole(Role $role): void
    {
        $permissions = [];

        switch ($role->name) {
            case RoleEnum::MasterAdmin->value:
                $permissions = [
                    Permission::EDIT_OFFICE,
                    Permission::START_CLEARANCE,
                    Permission::END_CLEARANCE,
                ];
                break;
            case RoleEnum::Admin->value:
                $permissions = [
                    Permission::ASSIGN_OFFICE,
                    Permission::VIEW_USER,
                    Permission::CREATE_USER,
                    Permission::EDIT_USER,
                    Permission::DELETE_USER,
                    Permission::VIEW_USER,
                    Permission::CREATE_USER,
                    Permission::EDIT_USER,
                    Permission::DELETE_USER,
                    Permission::VIEW_PAYMENT,
                    Permission::CREATE_PAYMENT,
                    Permission::EDIT_PAYMENT,
                    Permission::DELETE_PAYMENT,
                ];
                break;
            case RoleEnum::User->value:
                $permissions = [
                    Permission::VIEW_EVENTS,
                    Permission::VIEW_PAYMENT,
                    Permission::VIEW_CLEARANCES,
                ];
                break;
        }

        $role->syncPermissions($permissions);
    }
}
