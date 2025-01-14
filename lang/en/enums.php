<?php

use Callmeaf\Payment\Enums\PaymentItemStatus;
use Callmeaf\Payment\Enums\PaymentItemType;
use Callmeaf\Payment\Enums\PaymentMethod;
use Callmeaf\Payment\Enums\PaymentStatus;
use Callmeaf\Payment\Enums\PaymentType;

return [
    PaymentStatus::class => [
        PaymentStatus::PAYED->name => 'Payed',
        PaymentStatus::CANCELLED->name => 'Cancelled',
        PaymentStatus::PENDING->name => 'Pending',
        PaymentStatus::REFUND->name => 'Refund',
    ],
    PaymentType::class => [
        PaymentType::BUY->name => 'Buy',
    ],
    PaymentMethod::class => [
        PaymentMethod::CASH->name => 'Cash',
        PaymentMethod::CREDIT_CARD->name => 'Credit Card',
        PaymentMethod::WALLET->name => 'Wallet',
        PaymentMethod::GATEWAY->name => 'Gateway',
    ],
];
