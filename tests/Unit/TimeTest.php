<?php

use App\Time;

it('has correct types', function () {
    $time = factory(Time::class)->make();

    $this->assertIsString($time->start);
    $this->assertIsString($time->end);
});