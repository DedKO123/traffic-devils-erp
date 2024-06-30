<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StatisticService
{
    public function getAllStatistic(User $user, ?string $search, int $perPage = 10): LengthAwarePaginator
    {
        $query = User::query()
            ->leftJoin('products', 'users.id', '=', 'products.user_id')
            ->select('users.id', 'users.name', 'users.email', DB::raw('COUNT(products.id) as product_count'));
        if ($user->hasRole('team_lead')) {
            $query->where('users.mentor_id', $user->id);
        } else if ($user->hasRole('buyer')) {
            $query->where('users.id', $user->id);
        }
        return $query->when($search, function ($query, $search) {
                $query
                ->where('users.name', 'like', '%' . $search . '%')
                ->orWhere('users.email', 'like', '%' . $search . '%');
                })
                ->groupBy('users.id', 'users.name', 'users.email')
                ->paginate($perPage);
    }

    public function show(User $user): array
    {
        $products = $user->products()->get();
        return [
            'user' => $user,
            'products' => $products,
        ];
    }
}
