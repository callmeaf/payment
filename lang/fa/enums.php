<?php

use Callmeaf\Payment\Enums\PaymentItemStatus;
use Callmeaf\Payment\Enums\PaymentItemType;
use Callmeaf\Payment\Enums\PaymentMethod;
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
    PaymentMethod::class => [
        PaymentMethod::CASH->name => 'نقد',
        PaymentMethod::CREDIT_CARD->name => 'کارت به کارت',
        PaymentMethod::WALLET->name => 'کیف پول',
        PaymentMethod::GATEWAY->name => 'درگاه بانکی',
    ],
];
