<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $configuredUsers = collect(config('wiki.users'));

        foreach ($users as $user) {
            $configuredUser = $configuredUsers->firstWhere('email', $user->email);

            if ($configuredUser) {
                $roles = $configuredUser['roles'];

                if (!is_iterable($roles)) {
                    $roles = [$roles];
                }

                foreach ($roles as $role) {
                    if (!$user->hasRole($role)) {
                        $user->assignRole($role);

                        $this->command->info(
                            sprintf(
                                'User [%s] assined role [%s]',
                                $user->name,
                                $role
                            )
                        );
                    }
                }
            }
        }
    }
}
