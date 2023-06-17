<?php

namespace App\Utilities;

class Utility
{
    const USER_ACTIVE = 'ACTIVE';

    const USER_BANNED = 'BANNED';

    const ALL_USER_STATUS = [self::USER_ACTIVE, self::USER_BANNED];

    const SUPER_ADMIN = 'SUPER_ADMIN';

    const ADMIN = 'ADMIN';

    const USER = 'USER';

    const ADMIN_USER_TYPES = [self::SUPER_ADMIN, self::ADMIN, self::USER];
}
