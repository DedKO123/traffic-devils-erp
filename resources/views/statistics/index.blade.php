<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users Statistic') }}
        </h2>
    </x-slot>
    <div class="relative overflow-x-auto">
        @include('components.search-form', ['route' => 'statistics.index'])
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">User name</th>
                <th scope="col" class="px-6 py-3">User email</th>
                <th scope="col" class="px-6 py-3">Number of products</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($statistics as $statistic)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $statistic->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $statistic->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $statistic->product_count }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('statistics.show', $statistic->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                            More
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $statistics->links() }}
</x-app-layout>
