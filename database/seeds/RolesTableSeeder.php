<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = config('wiki.roles');

        foreach ($roles as $role) {
            $newRole = Role::firstOrNew(
                [
                    'name' => $role['name'],
                ]
            );

            if ($newRole->isDirty()) {
                $newRole->save();

                $this->command->info(
                    sprintf(
                        'Role [%s] created',
                        $newRole->name
                    )
                );
            } else {
                $this->command->info(
                    'Role [%s] already exists',
                    $newRole->name
                );
            }
        }
    }
}
