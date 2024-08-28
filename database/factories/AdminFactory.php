<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AdminFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'admin_name' => 'Muhammad Syahmi bin Ahmad Kamal',
            'admin_username' => 'cxmie',
            'admin_email' => 'muhammadsyahmi422@gmail.com',
            'admin_notel' => '0183203439',
            'email_verified_at' => now(),
            'admin_password' => Hash::make('cxmie'),
            'remember_token' => Str::random(10),
            'admin_status' => 'active',
            'admin_category' => 'superadmin',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
