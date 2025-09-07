<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $laptop->brand }} {{ $laptop->model }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('laptops.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Laptops
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            @if($laptop->image)
                                <img src="{{ asset('storage/' . $laptop->image) }}" alt="{{ $laptop->brand }} {{ $laptop->model }}" class="w-full rounded-lg shadow-md">
                            @else
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold mb-4">{{ $laptop->brand }} {{ $laptop->model }}</h1>
                            <div class="mb-4">
                                <span class="font-bold">Year:</span> {{ $laptop->year }}
                            </div>
                            <div class="mb-6">
                                <span class="font-bold">Description:</span>
                                <p class="mt-2">{{ $laptop->description }}</p>
                            </div>
                            
                            <div class="flex space-x-4">
                                <a href="{{ route('laptops.edit', $laptop) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                
                                <form action="{{ route('laptops.destroy', $laptop) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this laptop?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
