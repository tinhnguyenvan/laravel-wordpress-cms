<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $myUser = User::query()->create(
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => 1,
                'status' => 1,
            ]
        );
        $myUser->syncRoles([Role::ROLE_KEY[$myUser->role_id]]);
    }
}
