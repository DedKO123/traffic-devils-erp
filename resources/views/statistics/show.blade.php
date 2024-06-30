<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Statistics') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white dark:bg-gray-800">
        <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
        <p>{{ __('Email:') }} {{ $user->email }}</p>
        <p>{{ __('Number of Products:') }} {{ $products?->count() }}</p>

        <h4 class="mt-4 font-semibold">{{ __('Products:') }}</h4>
        @if($products->isEmpty())
            <p>{{ __('No products found.') }}</p>
        @else
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">{{ __('Product Name') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('Date Created') }}</th>
                        <th scope="col" class="px-6 py-3">{{ __('Price') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ $product->created_at->format('d-m-Y') }}</td>
                            <td class="px-6 py-4">{{ $product->price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                {{ __('Back') }}
            </a>
        </div>
    </div>
</x-app-layout>
