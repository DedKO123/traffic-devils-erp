<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('products.store') }}" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('POST')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:text-gray-200" required>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price</label>
                <input type="number" name="price" id="price" min="0" step="any"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:text-gray-200" required>
            </div>
            <div class="mt-6 flex justify-between">
                <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700">
                    {{ __('Back') }}
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                    {{ __('Create') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
