@extends('layouts.app')

@section('title')
    Home
@endsection

@section('head')
    @include('meta::manager')
@endsection

@section('content')
    <div class="w-full h-full relative">
        <div class="h-full w-full flex py-8">
            {{-- Left --}}
            <div>
            </div>
            {{-- Center --}}
            <div class="mx-auto max-w-xl flex-grow">
                <h1 class="text-3xl font-extrabold text-gray-800">Create fika</h1>
                <div class="flex flex-col items-center justify-center">
                    <form class="w-full" action="{{ route('fika.store') }}" method="post">
                    <label>
                        @csrf
                    </label>

                    <div class="mt-4">
                        <label for="slug">
                            <div>
                                <span class="text-gray-900 text-sm mr-1">/</span>
                                <input maxlength="32" placeholder="attractive-gamer" value="{{ old('slug', Illuminate\Support\Str::snake(Badcow\PhraseGenerator\PhraseGenerator::generate(), '-')) }}" class="text-sm placeholder-gray-400 text-gray-900 focus:outline-none" id="slug" name="slug" />
                            </div>
                            @error('slug')
                            <div class="mt-1 ml-3">
                                <strong class="text-xs text-red-300">
                                    {{ $message }}
                                </strong>
                            </div>
                            @enderror
                        </label>
                    </div>

                    <div class="mt-6">
                        <label for="title">
                            <p class="text-gray-700 m-3">What is the title?</p>
                            <input maxlength="64" placeholder="Is it fika? ☕" value="{{ old('title', 'Is it fika? ☕') }}" class="form-input placeholder-gray-400 text-gray-700 text-3xl w-full bg-gray-100 shadow-inner transition-all duration-150 focus:outline-none focus:shadow-outline" id="title" name="title" />
                            @error('title')
                            <div class="mt-1">
                                <strong class="text-xs text-red-300">
                                    {{ $message }}
                                </strong>
                            </div>
                            @enderror
                        </label>
                    </div>

                    <div class="mt-6">
                        <label for="times">
                            <span class="text-gray-700">at</span>
                            <livewire:fika-time-picker />
                        </label>
                    </div>

                    <div class="mt-8">
                        <livewire:form-accordion />
                    </div>


                    <div class="my-8">
                        <x-submit-button value="Create fika" />
                    </div>
                </form>
                </div>
            </div>
            {{-- Right --}}
            <div>
            </div>
        </div>
    </div>
@endsection
