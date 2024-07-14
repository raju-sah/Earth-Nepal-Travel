<?php

namespace App\Enums;

enum UserType: string
{
    case SuperAdmin = 'SuperAdmin';
    case Admin = 'Admin';
    case Staff = 'Staff';
    case Customer = 'Customer';
}
