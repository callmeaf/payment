<?php

use Callmeaf\Payment\Enums\PaymentItemStatus;
use Callmeaf\Payment\Enums\PaymentItemType;
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
    PaymentItemStatus::class => [
        PaymentItemStatus::DELIVERED->name => 'Delivered',
        PaymentItemStatus::NOT_DELIVERED->name => 'Not Delivered',
    ],
    PaymentItemType::class => [
        PaymentItemType::DIGITAL->name => 'Digital',
        PaymentItemType::PHYSICAL->name => 'Physical',
    ],
];
