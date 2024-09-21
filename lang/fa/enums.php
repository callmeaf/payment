<?php

use Callmeaf\Payment\Enums\PaymentItemStatus;
use Callmeaf\Payment\Enums\PaymentItemType;
use Callmeaf\Payment\Enums\PaymentStatus;
use Callmeaf\Payment\Enums\PaymentType;

return [
    PaymentStatus::class => [
        PaymentStatus::PAYED->name => 'پرداخت شده',
        PaymentStatus::CANCELLED->name => 'لغو شده',
        PaymentStatus::PENDING->name => 'در انتظار پرداخت',
        PaymentStatus::REFUND->name => 'بازپرداخت',
    ],
    PaymentType::class => [
        PaymentType::BUY->name => 'خرید',
    ],
    PaymentItemStatus::class => [
        PaymentItemStatus::DELIVERED->name => 'تحویل داده شده',
        PaymentItemStatus::NOT_DELIVERED->name => 'تحویل داده نشده',
    ],
    PaymentItemType::class => [
        PaymentItemType::DIGITAL->name => 'دیجیتالی',
        PaymentItemType::PHYSICAL->name => 'فیزیکی',
    ],
];
