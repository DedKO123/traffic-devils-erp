<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function all(): Collection
    {
        return User::all();
    }

    public function getWithPagination(int $perPage, ?string $search): LengthAwarePaginator
    {
        return User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->whereHas('mentor', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    })
                        ->orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate($perPage);
    }

    public function getMentors(): Collection
    {
        return User::role('team_lead')->get();
    }

    public function create(UserDTO $userDTO): User
    {
        $user = new User();
        $user->name = $userDTO->name;
        $user->email = $userDTO->email;
        $user->password = Hash::make($userDTO->password);
        $user->mentor_id = $userDTO->mentor_id;
        $user->save();
        $user->assignRole($userDTO->role);

        return $user;
    }

    public function delete(User $user)
    {
        return $user->delete();
    }

    public function update(User $user, UserDTO $userDTO)
    {
        $user->name = $userDTO->name;
        $user->email = $userDTO->email;
        $user->password = Hash::make($userDTO->password) ?? $user->password;
        $user->mentor_id = $userDTO->mentor_id;
        $user->syncRoles([$userDTO->role]);
        $user->save();

        return $user;
    }
}
