<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laptops') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Съобщения за успех и грешки -->
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <!-- Бутон за добавяне на нов лаптоп -->
                    <div class="mb-4">
                        <a href="{{ route('laptops.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add New Laptop
                        </a>
                    </div>
                    
                    <!-- Списък с лаптопи -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($laptops as $laptop)
                            <div class="border rounded-lg overflow-hidden shadow-md">
                                @if($laptop->image)
                                    <img src="{{ asset('storage/' . $laptop->image) }}" alt="{{ $laptop->brand }} {{ $laptop->model }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold">{{ $laptop->brand }} {{ $laptop->model }}</h3>
                                    <p class="text-sm text-gray-600">Year: {{ $laptop->year }}</p>
                                    <div class="mt-2 truncate">{{ $laptop->description }}</div>
                                    <div class="mt-4 flex justify-between">
                                        <a href="{{ route('laptops.show', $laptop) }}" class="text-blue-500 hover:underline">View Details</a>
                                        <div class="space-x-2">
                                            <a href="{{ route('laptops.edit', $laptop) }}" class="text-yellow-500 hover:underline">Edit</a>
                                            <form action="{{ route('laptops.destroy', $laptop) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this laptop?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-10">
                                <p class="text-gray-500">No laptops found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>