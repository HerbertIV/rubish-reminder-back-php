<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Role as SpatieRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $this->call(PermissionSeeder::class);
        $this->userSuperadmin = $admin;
        $this->setRoles();
    }

    private function setRoles(): void
    {
        $role = Role::findOrCreate('superadmin');
        $this->userSuperadmin->roles()->attach($role->getKey());

        $permissions = Permission::all();
        $role->givePermissionTo($permissions->pluck('name'));
    }

}
