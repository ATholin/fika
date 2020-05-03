<?php

namespace Tests\Unit;

use App\Http\Livewire\FikaTimePicker;
use Livewire\Livewire;
use Tests\TestCase;

class FikaTimerPickerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_set_initial_times()
    {
        Livewire::test(FikaTimePicker::class, ['times' => [
            'start' => '22:30',
            'end' => '23:30',
        ]])
            ->assertSet('times', [
                'start' => '22:30',
                'end' => '23:30',
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_add_time()
    {
        $component = Livewire::test(FikaTimePicker::class);

        $component->call('addTime');

        $this->assertCount(2, $component->get('times'));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_max_5_times()
    {
        $component = Livewire::test(FikaTimePicker::class, [
            'times' => [
                [],
                [],
                [],
                [],
                []
            ]
        ]);

        $this->assertCount(5, $component->get('times'));
        $component->call('addTime');
        $this->assertCount(5, $component->get('times'));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_remove_time()
    {
        $component = Livewire::test(FikaTimePicker::class, [
            'times' => [
                [],
                [],
                [],
                [],
                []
            ]
        ]);


        $this->assertCount(5, $component->get('times'));
        $component->call('removeTime', 0);
        $this->assertCount(4, $component->get('times'));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_min_1_times()
    {
        $component = Livewire::test(FikaTimePicker::class);

        $this->assertCount(1, $component->get('times'));
        $component->call('removeTime', 0);
        $this->assertCount(1, $component->get('times'));
    }
}
