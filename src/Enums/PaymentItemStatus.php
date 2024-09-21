<?php

namespace Callmeaf\Payment\Enums;

enum PaymentItemStatus: int
{
    case DELIVERED = 1;
    case NOT_DELIVERED = 2;
}
