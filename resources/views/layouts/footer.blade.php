<footer class="bg-gray-200 px-12 py-5 flex items-center justify-between">
    <div>
        @yield('footer')
    </div>
    <div class="text-right">
        <a href="{{ route('fika.create') }}" class="block font-medium text-gray-600 hover:text-gray-700">Fikaklocka {{ now()->year }}</a>
        <a href="https://github.com/ATholin" class="block text-gray-600 hover:text-gray-700">@ATholin</a>
    </div>
</footer>
