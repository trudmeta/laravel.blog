<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::factory()->admin()->create();

        $admin = User::factory()
            ->admin()
            ->create();

        $admin->roles()->sync([$role_admin->id]);

        $role_editor = Role::factory()->editor()->create();
        $editor = User::factory()
            ->editor()
            ->create();

        $editor->roles()->sync([$role_editor->id]);
    }
}
