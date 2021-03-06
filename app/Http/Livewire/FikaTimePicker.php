<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FikaTimePicker extends Component
{
    public array $times = [];

    public function mount(array $times = []) {
        $times = old('times', $times);

        if (empty($times)) {
            $times = [[
                'start' => now('Europe/Stockholm')->format('H:i'),
                'end' => now('Europe/Stockholm')->addMinutes(30)->format('H:i')
            ]];
        }

        $this->times = $times;
    }

    public function render()
    {
        return view('livewire.fika-time-picker');

    }

    public function removeTime(int $i): void
    {
        if (! $this->canRemoveTime()) {
            return;
        }

        unset($this->times[$i]['start']);
        unset($this->times[$i]['end']);
        unset($this->times[$i]);

        $this->times = array_values($this->times);
    }

    public function addTime(): void
    {
        if (! $this->canAddMoreTimes()) {
            return;
        }

        $this->times[] = [
            'start' => now('Europe/Stockholm')->format('H:i'),
            'end' => now('Europe/Stockholm')->addMinutes(30)->format('H:i')
        ];
    }

    public function canAddMoreTimes(): bool
    {
        return count($this->times) < 5;
    }

    public function canRemoveTime()
    {
        return count($this->times) > 1;
    }
}
