<?php

namespace Database\Seeders;

use App\Enums\PermissionEnums;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissionGroups = PermissionEnums::CRUD_PERMISSION_GROUP;
        foreach ($permissionGroups as $key => $permissionGroup) {
            foreach ($permissionGroup as $permission) {
                Permission::firstOrCreate([
                    'name' => $key . PermissionEnums::HYPHEN . $permission,
                    'guard_name' => 'web',
                ]);
            }
        }

        $otherPermissions = [
            'survey-read',
            'user-activity-read',
            'audit-read',
        ];

        foreach ($otherPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }

}
