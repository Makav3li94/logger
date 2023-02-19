<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $r = rand(0, 1);
        return [
            'log_date' => now(),
            'service_name' => $this->faker->name,
            'request_type' => $r == 1 ? 'POST' : 'GET',
            'request_route' => $r == 1 ? 'orders' : 'invoices',
            'request_header' => 'HTTP/1.1',
            'response_type' => $r == 1 ? 201 : 422,
        ];
    }
}
