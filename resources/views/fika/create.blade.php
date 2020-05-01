@extends('layouts.app')

@section('title')
    Home
@endsection

@section('head')
    @include('meta::manager')
@endsection

@section('content')
    <div class="w-1/2 max-w-5xl mx-auto flex flex-col justify-center items-center h-full">
        <form class="w-full" action="{{ route('fika.store') }}" method="post">
            @csrf

            <div class="mt-4">
                <label for="slug">
                    <div>
                        <span class="text-gray-500 text-sm mr-1">/</span>
                        <input placeholder="/attractive-gamer" value="{{ old('slug', Illuminate\Support\Str::snake(Badcow\PhraseGenerator\PhraseGenerator::generate(), '-')) }}" class="text-sm placeholder-gray-400 text-gray-700 focus:outline-none" id="slug" name="slug" />
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
                    <p class="text-gray-500 m-3">What is the title?</p>
                    <input placeholder="Is it fika? ☕" value="{{ old('title', 'Is it fika? ☕') }}" class="form-input placeholder-gray-400 text-gray-700 text-3xl w-full bg-gray-100 shadow-inner transition-all duration-150 focus:outline-none focus:shadow-outline" id="title" name="title" />
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

{{--            <div class="mt-2">--}}
{{--                <label for="password">--}}
{{--                    <span>Password</span>--}}
{{--                    <input class="form-input w-full bg-gray-100 shadow-inner transition-all duration-150 focus:outline-none focus:shadow-outline" type="password" name="password" id="password" placeholder="69696969" />--}}
{{--                </label>--}}
{{--            </div>--}}


            <div class="mt-8">
                <label for="submit">
                    <button class="w-full py-3 bg-gray-100 shadow rounded-lg font-bold text-gray-600 text-3xl transition-all hover:shadow-none active:bg-gray-100 active:shadow-inner duration-200" type="submit" id="submit" value="Create fikaklocka">Create fikaklocka</button>
                </label>
            </div>
        </form>
    </div>
@endsection
