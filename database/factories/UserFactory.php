<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'login' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'birthday' => $this->faker->dateTimeBetween('1980-01-01', '2010-12-31'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user is admin.
     */
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'login' => 'admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('admin1234'),
            ];
        });
    }

    /**
     * Editor
     */
    public function editor()
    {
        return $this->state(function (array $attributes) {
            return [
                'login' => 'editor',
                'email' => 'editor@test.com',
                'password' => bcrypt('12345678'),
            ];
        });
    }
}
