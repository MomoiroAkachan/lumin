<?php

namespace Database\Factories;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactMessage>
 */
class ContactMessageFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'subject' => fake()->sentence(4),
            'message' => fake()->paragraph(),
            'service_id' => null,
            'status' => ContactMessage::STATUS_NEW,
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'read_at' => null,
        ];
    }

    public function read(): static
    {
        return $this->state(fn () => [
            'status' => ContactMessage::STATUS_READ,
            'read_at' => now(),
        ]);
    }
}
