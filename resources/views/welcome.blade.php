<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Welcome to the Laptop Shop</h1>
                    <p class="mb-4">Your one-stop shop for all laptop needs.</p>
                    <a href="{{ route('laptops.index') }}" class="text-indigo-600 hover:text-indigo-900">Browse Laptops</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>