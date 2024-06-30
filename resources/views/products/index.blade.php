<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="relative overflow-x-auto">

        <div class="flex justify-end mb-4 mt-2 me-2">
            <a href="{{ route('products.create') }}"
               class="px-2 py-1 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                {{ __('Create Product') }}
            </a>
        </div>
        @include('components.search-form', ['route' => 'products.index'])
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">{{ __('Product Name') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('User Name') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('User Email') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('Price') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('Date Created') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->name }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->user_name }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $product->user_email }}</td>
                    <td class="px-6 py-4">{{ $product->price }}</td>
                    <td class="px-6 py-4">{{ $product->created_at->format('d-m-Y') }}</td>
                    @canany(['update', 'delete'], $product)
                        <td class="px-6 py-4">
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open"
                                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700">
                                    {{ __('Actions') }}
                                </button>
                                <div x-show="open" @click.away="open = false"
                                     class="absolute right-0 bottom-full mb-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                          class="block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                onclick="return confirm('{{ __('Are you sure you want to delete this product?') }}')">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    @endcanany
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
</x-app-layout>
