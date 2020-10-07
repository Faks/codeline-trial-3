<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class CalculateWeekendsTest extends TestCase
{
    /**
     * @test
     */
    public function calculateWeek(): void
    {
        $response = $this->get('/calculate/2020-10-1/2020-10-31');

        $response->assertStatus(200);
    }
}
