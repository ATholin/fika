<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FikaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCorrectTypes()
    {
        $fika = factory(\App\Fika::class)->make();

        $this->assertIsString($fika->title);
        $this->assertIsString($fika->slug);
        $this->assertIsString($fika->password);
    }
}
