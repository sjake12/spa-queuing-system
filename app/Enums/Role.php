<?php

namespace App\Enums;

enum Role: string
{
    // assign and edit office - view, add, edit, delete user - start and end clearance
    case MasterAdmin = 'master_admin';

    // view, add, edit, delete events
    case Admin = 'admin';

    // view events, view payments, view clearances
    case User = 'user';
}
