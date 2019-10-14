<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = config('wiki.users');

        foreach ($users as $user) {
            $name = $user['name'];
            $email = $user['email'];
            $password = $user['password'];
            $roles = $user['roles'];
            $picture = $user['display_picture'];

            $newUser = User::firstOrNew(
                [
                    'name' => $name,
                ],
                [
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'display_picture' => $picture ?? null,
                ]
            );

            if ($newUser->isDirty()) {
                $newUser->save();

                $this->command->info(
                    sprintf(
                        'User [%s] created',
                        $newUser->name
                    )
                );
            } else {
                $this->command->info(
                    sprintf(
                        'User [%s] already exists',
                        $newUser->name
                    )
                );
            }
        }
    }
}
