<?php

namespace App\Services;

use App\DTO\ProductDTO;
use App\Models\Product;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function getWithPagination(User $user, ?string $search, int $perPage = 10): LengthAwarePaginator
    {
        $query = Product::query()
            ->select('products.*', 'users.name as user_name', 'users.email as user_email')
            ->leftJoin('users', 'products.user_id', '=', 'users.id');
        if($user->hasRole('team_lead')) {
            $query->where('users.mentor_id', $user->id)
            ->orWhere('users.id', $user->id);
        } else if($user->hasRole('buyer')) {
            $query->where('users.id', $user->id);
        }
        return $query
            ->when($search, function ($query, $search) {
                $query
                    ->where('products.name', 'like', '%' . $search . '%')
                    ->orWhere('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate($perPage);
    }

    public function store(ProductDTO $productDTO): void
    {
        Product::create([
            'name' => $productDTO->name,
            'price' => $productDTO->price,
            'user_id' => $productDTO->user_id,
        ]);
    }

    public function update(ProductDTO $productDTO, Product $product): void
    {
        $product->update([
            'name' => $productDTO->name,
            'price' => $productDTO->price,
            'user_id' => $productDTO->user_id,
        ]);
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
