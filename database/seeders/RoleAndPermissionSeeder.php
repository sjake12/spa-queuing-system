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
            case RoleEnum::MasterAdmin:
                $permissions = [
                    Permission::EDIT_OFFICE,
                    Permission::START_CLEARANCE,
                    Permission::END_CLEARANCE,
                    Permission::CREATE_USER,
                    Permission::EDIT_USER,
                    Permission::DELETE_USER,
                ];
                break;
            case RoleEnum::Admin:
                $permissions = [
                    Permission::ASSIGN_OFFICE,
                    Permission::VIEW_USER,
                    Permission::VIEW_EVENT,
                    Permission::CREATE_EVENT,
                    Permission::EDIT_EVENT,
                    Permission::DELETE_EVENT,
                    Permission::VIEW_PAYMENT,
                    Permission::CREATE_PAYMENT,
                    Permission::EDIT_PAYMENT,
                    Permission::DELETE_PAYMENT,
                    Permission::VIEW_CLEARANCES,
                ];
                break;
            case RoleEnum::User:
                $permissions = [
                    Permission::VIEW_EVENT,
                    Permission::VIEW_PAYMENT,
                    Permission::VIEW_CLEARANCES,
                    Permission::QUEUE,
                ];
                break;
            case RoleEnum::Dean:
            case RoleEnum::Program_Head:
            case RoleEnum::Librarian:
                $permissions = [
                    Permission::VIEW_USER,
                    Permission::VIEW_CLEARANCES,
                    Permission::SIGN_CLEARANCE,
                    Permission::VIEW_REQUIREMENTS,
                    Permission::CREATE_REQUIREMENT,
                    Permission::EDIT_REQUIREMENT,
                    Permission::DELETE_REQUIREMENT,
                ];
                break;
            case RoleEnum::CCSO:
            case RoleEnum::SBO:
            case RoleEnum::PSITS:
                $permissions = [
                    Permission::VIEW_USER,
                    Permission::VIEW_EVENT,
                    Permission::CREATE_EVENT,
                    Permission::EDIT_EVENT,
                    Permission::DELETE_EVENT,
                    Permission::VIEW_PAYMENT,
                    Permission::CREATE_PAYMENT,
                    Permission::EDIT_PAYMENT,
                    Permission::DELETE_PAYMENT,
                    Permission::SIGN_CLEARANCE,
                    Permission::VIEW_REQUIREMENTS,
                    Permission::CREATE_REQUIREMENT,
                    Permission::EDIT_REQUIREMENT,
                    Permission::DELETE_REQUIREMENT,
                ];
                break;
        }

        $role->syncPermissions($permissions);
    }
}
