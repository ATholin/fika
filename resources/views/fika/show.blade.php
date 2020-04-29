@extends('layouts.app')

@section('title')
    {{ $fika->title }}
@endsection

@section('content')
    <div class="absolute right-0 top-0 hidden xl:block md:m-8 text-right text-gray-500 hover:text-gray-600">
        <h3 class="font-medium">Fika times</h3>
        @foreach($fika->times as $time)
            <p>{{ $time->start }}</p>
        @endforeach
    </div>
    <div class="w-1/2 relative max-w-5xl mx-auto flex flex-col justify-center items-center h-full">
        <img class="absolute h-full opacity-25" src="{{ asset('img/cup.svg') }}" />
        <div class="relative mb-32">
            <h1 class="text-gray-700 font-bold text-3xl">{{ $fika->title }}</h1>

            <timer slug="{{ $fika->slug }}"></timer>
        </div>
    </div>
@endsection
