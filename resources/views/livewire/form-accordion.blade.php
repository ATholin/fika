<div>
    @if ($show)
        <button wire:click.prevent="toggle" class="text-gray-600 text-sm p-1">
            <span>Advanced</span>
            <i class="fa fa-caret-up"></i>
        </button>

        <div class="mt-4">

            <label for="password">
            <span class="mb-3 flex flex-col">
                <span class="text-gray-700">Password</span>
                <span class="text-xs text-gray-600">This will be used to edit the page later. Do not re-use this password anywhere.</span>
            </span>
                <input maxlength="16" class="form-input bg-gray-100 shadow-inner transition-all duration-150 focus:outline-none focus:shadow-outline" type="text" name="password" id="password" placeholder="69696969" />
                @error('password')
                <div class="mt-1">
                    <strong class="text-xs text-red-300">
                        {{ $message }}
                    </strong>
                </div>
                @enderror
            </label>
        </div>
    @else
        <button wire:click.prevent="toggle" class="text-gray-600 text-sm p-1">
            <span>Advanced</span>
            <i class="fa fa-caret-down"></i>
        </button>
    @endif
</div>
