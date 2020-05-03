<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TimeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCorrectTypes()
    {
        $time = factory(\App\Time::class)->make();

        $this->assertIsString($time->start);
        $this->assertIsString($time->end);
    }
}
