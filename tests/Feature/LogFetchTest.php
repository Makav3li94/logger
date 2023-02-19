<?php

namespace Tests\Feature;

use App\Models\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogFetchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_fetch_log()
    {
        Log::factory()->count(2)->create();

        $this->json('GET', 'api/logs/count', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    /** @test */
    public function guest_can_fetch_log_with_filters()
    {
        Log::factory()->count(5)->create();
        $filters = [
            "serviceNames" => "test",
            "statusCode" => "200",
            "startDate" => now(),
//            "endDate" =>""
        ];

        $this->json('GET', 'api/logs/count', $filters, ['Accept' => 'application/json'])
            ->assertStatus(200);

    }
}
