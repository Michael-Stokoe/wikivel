<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
        $configuredRoles = collect(config('wiki.roles'));

        foreach ($roles as $role) {
            $configuredRole = $configuredRoles->firstWhere('name', $role->name);
            $configuredPermissions = $configuredRole['permissionGroups'];

            foreach ($configuredPermissions as $permissionName) {
                $permissions = config('wiki.permissions.' . $permissionName);

                foreach ($permissions as $permission) {
                    $permissionRecord = Permission::where('name', $permission)->first();

                    if (!$role->hasPermissionTo($permissionRecord)) {
                        $role->givePermissionTo($permissionRecord);

                        $this->command->info(
                            sprintf(
                                'Permission [%s] given to role [%s]',
                                $permissionRecord->name,
                                $role->name
                            )
                        );
                    } else {
                        $this->command->info(
                            sprintf(
                                'Role [%s] already has permission: [%s]',
                                $role->name,
                                $permissionRecord->name
                            )
                        );
                    }
                }
            }
        }
    }
}
