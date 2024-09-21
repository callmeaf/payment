<?php

namespace Callmeaf\Payment\Enums;

enum PaymentStatus: int
{
    case PAYED = 1;
    case CANCELLED = 2;
    case PENDING = 3;
    case REFUND = 4;
}
