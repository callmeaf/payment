<?php

namespace Callmeaf\Payment\Enums;

enum PaymentItemType: int
{
    case DIGITAL = 1;
    case PHYSICAL = 2;
}
