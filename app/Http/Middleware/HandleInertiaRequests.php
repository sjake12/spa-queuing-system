<?php

namespace App\Http\Middleware;

use App\Enums\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $isClearanceOnGoing = DB::table('settings')
            ->where('key', 'isClearanceOnGoing')
            ->value('value');

        $roleId = $request->user() ? $request->user()->student->rolesWithoutTeam->first()->id : null;
        $role = DB::table('roles')
            ->where('id', $roleId)
            ->value('name');

        $permissionsId = $roleId ? DB::table('role_has_permissions')
            ->where('role_id', $roleId)
            ->pluck('permission_id')
            ->unique()
            ->values() : null;

        $permissions = $permissionsId ? $permissionsId->map(function ($permissionId) {
            return DB::table('permissions')
                ->where('id', $permissionId)
                ->value('name');
        })->toArray() : null;

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user() ? [
                    'role' => $role,
                    'permissions' => $permissions,
                    'student' => $request->user()->student,
                ] : null,
                'isClearanceOnGoing' => $isClearanceOnGoing,
            ],
        ];
    }
}
