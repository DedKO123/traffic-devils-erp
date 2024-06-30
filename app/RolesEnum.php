<?php

namespace App;

enum RolesEnum
{
    public const ADMIN = 'admin';
    public const TEAM_LEAD = 'team_lead';
    public const BUYER = 'buyer';

    public const ROLES = [
        self::ADMIN,
        self::TEAM_LEAD,
        self::BUYER,
    ];

    public const ROLES_NAMES = [
        self::ADMIN => 'Admin',
        self::TEAM_LEAD => 'Team Lead',
        self::BUYER => 'Buyer',
    ];
}
