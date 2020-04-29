<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FikaTimePicker extends Component
{
    public $times = [];

    public function mount(array $times = []) {
        if (empty($times)) {
            $times = [now('Europe/Stockholm')->format('H:i')];
        }

        $this->times = old('times', $times);
    }

    public function render()
    {
        return view('livewire.fika-time-picker', [
            'dates' => $this->times,
        ]);

    }

    public function removeTime(int $i): void
    {
        if (! $this->canRemoveTime()) {
            return;
        }

        unset($this->times[$i]);

        $this->times = array_values($this->times);
    }

    public function addTime(): void
    {
        if (! $this->canAddMoreTimes()) {
            return;
        }

        $this->times[] = now()->format('H:i');
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
