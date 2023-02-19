<?php

namespace Tests\Feature;

use App\Models\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogCreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function log_can_be_created()
    {
        Log::factory()->count(1)->create();
        $this->assertDatabaseHas('logs', ['id' => 1,]);
    }
}
