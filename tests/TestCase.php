<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Clockwork\Support\Laravel\Tests\UsesClockwork;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp() :void
    {
        parent::setUp();
    }

    /**
     * Return an admin user
     * @return User $admin
     */
    protected function admin($overrides = [])
    {
        $admin = $this->user($overrides);
        $admin->roles()->attach(
            Role::factory()->admin()->create()
        );

        return $admin;
    }

    /**
     * Return an user
     * @return User
     */
    protected function user($overrides = [])
    {
        return User::factory()->create($overrides);
    }

    /**
     * Acting as an admin
     */
    protected function actingAsAdmin($api = null)
    {
        $this->actingAs($this->admin(), $api);

        return $this;
    }

    /**
     * Acting as an user
     */
    protected function actingAsUser($api = null)
    {
        $this->actingAs($this->user(), $api);

        return $this;
    }
}
