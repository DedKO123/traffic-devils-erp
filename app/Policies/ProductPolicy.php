<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Product $product)
    {
        return $user->hasRole('admin') ||
            ($user->hasRole('buyer') && $user->id === $product->user_id) ||
            ($user->hasRole('team_lead') && ($user->id === $product->user_id || $user->id === $product->user->mentor_id));
    }

    public function delete(User $user, Product $product)
    {
        return $user->hasRole('admin') ||
            ($user->hasRole('buyer') && $user->id === $product->user_id) ||
            ($user->hasRole('team_lead') && ($user->id === $product->user_id || $user->id === $product->user->mentor_id));
    }
}
