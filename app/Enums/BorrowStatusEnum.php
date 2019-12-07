<?php

namespace App\Enums;

use App\Enums\BaseEnum;

final class BorrowStatusEnum extends BaseEnum
{

    const PENDING = 0;
    const ACCEPT = 1;
    const REJECT = 2;
    const OVER_DATED = 3;
    const RETURNED = 4;

}
