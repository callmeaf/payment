<?php

namespace Callmeaf\Payment\Enums;

enum PaymentMethod: int
{
    case CASH = 1;
    case CREDIT_CARD = 2;
    case WALLET = 3;
    case GATEWAY = 4;
}
