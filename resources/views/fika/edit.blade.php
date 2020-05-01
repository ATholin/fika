@extends('layouts.app')

@section('title')
    Home
@endsection

@section('head')
    @include('meta::manager')
@endsection

@section('content')
    <div class="w-full h-full relative">
        <div class="h-full w-full flex my-8">
            {{-- Left --}}
            <div>
            </div>
            {{-- Center --}}
            <div class="mx-auto max-w-xl flex-grow">
                <h1 class="text-3xl font-extrabold text-gray-800">Edit fika</h1>
                <div class="flex flex-col items-center justify-center">
                    <form class="w-full" action="{{ route('fika.update', $fika) }}" method="post">
                        <label>
                            @method('patch')
                        </label>
                        <label>
                            @csrf
                        </label>

                        <div class="mt-4">
                            <label for="slug">
                                <div>
                                    <span class="text-gray-900 text-sm mr-1">/</span>
                                    <input placeholder="attractive-gamer" value="{{ old('slug', $fika->slug) }}" class="text-sm placeholder-gray-400 text-gray-900 focus:outline-none" id="slug" name="slug" />
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
                                <input placeholder="Is it fika? ☕" value="{{ old('title', $fika->title) }}" class="form-input placeholder-gray-400 text-gray-700 text-3xl w-full bg-gray-100 shadow-inner transition-all duration-150 focus:outline-none focus:shadow-outline" id="title" name="title" />
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
                            <label for="password">
                    <span class="mb-3 flex flex-col">
                        <span class="text-gray-700">Password</span>
                        <span class="text-xs text-gray-600">This will be used to edit the page later. Do not re-use this password anywhere.</span>
                    </span>
                                <input class="form-input bg-gray-100 shadow-inner transition-all duration-150 focus:outline-none focus:shadow-outline" type="text" name="password" id="password" placeholder="69696969" />
                                @error('password')
                                <div class="mt-1">
                                    <strong class="text-xs text-red-300">
                                        {{ $message }}
                                    </strong>
                                </div>
                                @enderror
                            </label>
                        </div>


                        <div class="my-8">
                            <x-submit-button value="Update" />
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
