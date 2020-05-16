@extends('layouts.app')

@section('title')
    {{ $fika->title }}
@endsection

@section('head')
    @include('meta::manager', [
        'title' => "Fika - $fika->title"
    ])
@endsection

@section('content')
    <div class="w-full h-full relative">
        <div class="h-full w-full flex">
            {{-- Left --}}
            <div class="lg:w-1/6">
                <div class="hidden lg:block lg:m-4 xl:m-8 text-left text-gray-500 hover:text-gray-600">
                    <sidebar>
                        <slot>
                            @foreach($recipes as $recipe)
                                <div class="px-6 py-2">
                                    <x-recipe :recipe="$recipe"></x-recipe>
                                </div>
                            @endforeach
                        </slot>

                        <template v-slot:footer>
                            <p>Want your recipe here? <a class="text-red-400">Send an email!</a></p>
                        </template>
                    </sidebar>
                </div>
            </div>
            {{-- Center --}}
            <div class="flex-grow flex flex-col relative items-center justify-center">
                <img class="absolute h-full opacity-25" src="{{ asset('img/cup.svg') }}" />
                <div class="mb-24 relative">
                    <h1 class="text-gray-700 font-bold text-3xl">{{ $fika->title }}</h1>
                    <timer slug="{{ $fika->slug }}"></timer>
                </div>
            </div>
            {{-- Right --}}
            <div class="lg:w-1/6">
                @if (!empty($fika->password))
                    <div class="hidden lg:block md:m-8 text-right text-gray-500 hover:text-gray-600">
                        <a class="opacity-50 hover:opacity-100 px-5 py-2 bg-indigo-500 hover:bg-indigo-600 shadow rounded-lg font-bold text-white transition-all hover:shadow-none duration-100" href="{{ route('fika.edit', $fika) }}">Edit</a>
                    </div>
                @endif
                <div class="hidden lg:block md:m-8 text-right text-gray-500 hover:text-gray-600">
                    <h3 class="font-medium">Fika times</h3>
                    @foreach($fika->times as $time)
                        <p>{{ $time->start }} - {{ $time->end }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
