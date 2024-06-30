<?php

namespace App\DTO;

final class UserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $password = null,
        public ?int $mentor_id = null,
        public string $role,
    )
    {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            mentor_id: $data['mentor_id'] ?? null,
            role: $data['role'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'mentor_id' => $this->mentor_id,
            'role' => $this->role,
        ];
    }
}
