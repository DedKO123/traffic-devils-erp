<form action="{{ route($route) }}" method="GET" class="mb-4 ms-2 mt-2">
    <div class="flex">
        <input type="text" name="search" class="px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-l-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:text-gray-200">
        <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-r-md hover:bg-gray-700">
            {{ __('Search') }}
        </button>
    </div>
</form>
