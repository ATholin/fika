<div>
    <div class="max-w-lg w-full lg:flex shadow-md rounded-lg">
        <div class="h-48 w-48 lg:h-auto rounded-l-lg flex-none bg-cover text-center overflow-hidden" style="background-image: url('{{ $recipe->image_url }}')" title="Woman holding a mug">
        </div>
        <a target="_blank" href="{{ $recipe->source_url }}" class="flex-1 bg-white p-4 flex rounded-r-lg flex-col justify-between leading-normal">
            <div class="mb-6">
                <div class="text-gray-900 font-bold mb-2">{{ $recipe->name }}</div>
                <p class="text-gray-700 text-sm">
                    {{ $recipe->description }}
                </p>
            </div>
            <div class="flex items-center">
                <p class="text-gray-600 leading-none">{{ $recipe->source }}</p>
            </div>
        </a>
    </div>
</div>
