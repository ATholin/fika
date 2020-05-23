<?php

use App\Http\Livewire\FikaTimePicker;
use Livewire\Livewire;

it('can set initial times', function () {

    Livewire::test(FikaTimePicker::class, ['times' => [
        'start' => '22:30',
        'end' => '23:30',
    ]])
        ->assertSet('times', [
            'start' => '22:30',
            'end' => '23:30',
        ]);
});

it('can add time', function () {
    $component = Livewire::test(FikaTimePicker::class);

    $component->call('addTime');

    $this->assertCount(2, $component->get('times'));
});

it('can add max 5 times', function () {
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
});

it('can remove time', function () {
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
});

it ('can have min 1 time', function () {
    $component = Livewire::test(FikaTimePicker::class);

    $this->assertCount(1, $component->get('times'));
    $component->call('removeTime', 0);
    $this->assertCount(1, $component->get('times'));
});
