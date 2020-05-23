<?php

use App\Fika;

it('has correct types', function () {
    $fika = factory(Fika::class)->make();

    $this->assertIsString($fika->title);
    $this->assertIsString($fika->slug);
    $this->assertIsString($fika->password);
});
