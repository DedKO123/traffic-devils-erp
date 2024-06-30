<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="relative overflow-x-auto">
        @can('manage user', App\Models\User::class)
            <div class="flex justify-end mb-4 mt-2 me-2">
                <a href="{{ route('users.create') }}" class="px-2 py-1 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                    {{ __('Create User') }}
                </a>
            </div>
        @endcan

        @include('components.search-form', ['route' => 'users.index'])

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">User name</th>
                <th scope="col" class="px-6 py-3">User email</th>
                <th scope="col" class="px-6 py-3">Mentor</th>
                <th scope="col" class="px-6 py-3">Role</th>
                @can('manage user', App\Models\User::class)
                    <th scope="col" class="px-6 py-3">Actions</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->mentor?->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->getRoleNames()?->first() ? \App\RolesEnum::ROLES_NAMES[$user->getRoleNames()->first()] : '' }}
                    </td>
                    @can('manage user', $user)
                        <td class="px-6 py-4">
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700">
                                    {{ __('Actions') }}
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                                    <a href="{{ route('users.edit', $user->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ __('Edit') }}
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="return confirm('Are you sure?')">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->appends(request()->input())->links() }}
</x-app-layout>

