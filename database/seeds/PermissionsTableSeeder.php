<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = config('wiki.permissions');

        foreach ($permissions as $permissionGroup) {
            foreach ($permissionGroup as $permission) {
                $newPermission = Permission::firstOrNew(
                    [
                        'name' => $permission
                    ]
                );

                if ($newPermission->isDirty()) {
                    $newPermission->save();

                    $this->command->info(
                        sprintf(
                            'Permission [%s] created',
                            $newPermission->name
                        )
                    );
                } else {
                    $this->command->info(
                        sprintf(
                            'Permission [%s] already exists',
                            $newPermission->name
                        )
                    );
                }
            }
        }
    }
}
