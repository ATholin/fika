@extends('layouts.app')

@section('title')
    Home
@endsection

@section('head')
    @include('meta::manager')
@endsection

@section('content')
    <div class="w-full h-full relative">
        <div class="h-full w-full flex">
            {{-- Left --}}
            <div>
            </div>
            {{-- Center --}}
            <div class="mx-auto max-w-xl flex items-center justify-center h-full flex-grow">
                <form class="w-full" action="{{ route('fika.edit.auth', $fika) }}" method="post">
                        <label>
                            @csrf
                        </label>

                        <div class="mt-8">
                            <label for="password">
                                <span class="block mb-4 font-bold text-center text-2xl text-gray-600">Enter Password</span>
                                <input class="form-input w-full bg-gray-100 shadow-inner transition-all duration-150 focus:outline-none focus:shadow-outline" type="text" name="password" id="password" placeholder="69696969" />
                                @error('password')
                                <div class="mt-1">
                                    <strong class="text-xs text-red-300">
                                        {{ $message }}
                                    </strong>
                                </div>
                                @enderror
                            </label>
                        </div>


                        <div class="my-4">
                            <x-submit-button value="Submit" />
                        </div>
                    </form>
            </div>
            {{-- Right --}}
            <div>
            </div>
        </div>
    </div>
@endsection
