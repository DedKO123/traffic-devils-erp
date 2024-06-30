<?php

namespace App\DTO;

class ProductDTO
{
    public function __construct(
        public string $name,
        public float $price,
        public int $user_id
    ) {
    }

    public static function fromRequest(array $data, int $userId): self
    {
        return new self(
            name: $data['name'],
            price: $data['price'],
            user_id: $userId
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'user_id' => $this->user_id,
        ];
    }
}
