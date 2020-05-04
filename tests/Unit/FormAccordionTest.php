<?php

namespace Tests\Unit;

use App\Http\Livewire\FormAccordion;
use Livewire\Livewire;
use Tests\TestCase;

class FormAccordionTest extends TestCase
{
    /**
     * Test that the show variable can be toggled.
     *
     * @return void
     */
    public function test_can_toggle()
    {
        $component = Livewire::test(FormAccordion::class);

        $component->assertSee('Advanced');
        $component->assertDontSee('Password');

        $this->assertFalse($component->get('show'));
        $component->call('toggle');
        $this->assertTrue($component->get('show'));

        $component->assertSee('Advanced');
        $component->assertSee('Password');
    }

    /**
     * Test that an initial show value can be set.
     *
     * @return void
     */
    public function test_set_initial_show()
    {
        $component = Livewire::test(FormAccordion::class, [
            'show' => true
        ]);

        $this->assertTrue($component->get('show'));
        $component->assertSee('Advanced');
        $component->assertSee('Password');
    }
}
