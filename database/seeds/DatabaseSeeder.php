<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleAssignmentSeeder::class);

        $this->call(UsersTableSeeder::class);
        $this->call(UserRoleAssignmentSeeder::class);

        if (in_array(app()->env, ['local', 'dev'])) {
            $this->call(DevelopmentSeeder::class);
            // $this->call(SqlSeeder::class);
        }
    }
}
