<?php

use App\Http\Livewire\FormAccordion;
use Livewire\Livewire;

it('can toggle', function () {
    $component = Livewire::test(FormAccordion::class);

    $component->assertSee('Advanced');
    $component->assertDontSee('Password');

    $this->assertFalse($component->get('show'));
    $component->call('toggle');
    $this->assertTrue($component->get('show'));

    $component->assertSee('Advanced');
    $component->assertSee('Password');
});


it('can set initial show', function() {
    $component = Livewire::test(FormAccordion::class, [
        'show' => true
    ]);

    $this->assertTrue($component->get('show'));
    $component->assertSee('Advanced');
    $component->assertSee('Password');
});