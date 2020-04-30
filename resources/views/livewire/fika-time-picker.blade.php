<div xmlns:wire="http://www.w3.org/1999/xhtml">
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
                <label for="times[{{ $id }}][start]">
                    <input type="time" wire:model="times.{{$id}}.start" class="form-input text-lg bg-gray-100" name="times[{{ $id }}][start]" id="times[{{ $id }}][start]" />
                </label>
                <span class="mx-1"></span>
                <label for="times[{{ $id }}][end]">
                    <input type="time" wire:model="times.{{$id}}.end" class="form-input text-lg bg-gray-100" name="times[{{ $id }}][end]" id="times[{{ $id }}][end]" />
                </label>
                <button wire:click.prevent="removeTime({{ $id }})">
                    <i class="ml-2 fa fa-times text-red-500 hover:text-red-600"></i>
                </button>
            </div>
            @error("times.{$id}.start")
                <div class="mt-1">
                    <strong class="text-xs text-red-300">
                        {{ $message }}
                    </strong>
                </div>
            @enderror
            @error("times.{$id}.end")
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
