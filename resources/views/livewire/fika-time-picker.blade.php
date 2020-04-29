<div>
    @error('times')
        <div class="mt-1">
            <strong class="text-xs text-red-300">
                {{ $message }}
            </strong>
        </div>
    @enderror
    @foreach ($times as $id => $time)

        <div class="mt-2">
            <div>
                <input type="time" value="{{ $time }}" class="form-input text-lg bg-gray-100" name="times[{{ $id }}]" />
                <button wire:click.prevent="removeTime({{ $id }})">
                    <i class="ml-2 fa fa-times text-red-500 hover:text-red-600"></i>
                </button>
            </div>
            @error("times.{$id}")
                <div class="mt-1">
                    <strong class="text-xs text-red-300">
                        {{ $message }}
                    </strong>
                </div>
            @enderror
        </div>
    @endforeach

    <div class="mt-2">
        @if ($this->canAddMoreTimes())
            <button wire:click.prevent="addTime" class="text-sm text-gray-600 hover:text-gray-800 underline">
                Add time
            </button>
        @endif
    </div>
</div>
