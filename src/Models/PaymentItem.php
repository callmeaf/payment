<?php

namespace Callmeaf\Payment\Models;

use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Contracts\HasResponseTitles;
use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\Payment\Enums\PaymentItemStatus;
use Callmeaf\Payment\Enums\PaymentItemType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model implements HasResponseTitles,HasEnum
{
    use HasDate,HasStatus,HasType;
    protected $fillable = [
        'user_id',
        'payment_id',
        'variation_id',
        'status',
        'type',
        'price',
        'discount_price',
    ];

    protected $casts = [
        'status' => PaymentItemStatus::class,
        'type' => PaymentItemType::class,
    ];

    public function priceText(): Attribute
    {
        return Attribute::get(
            fn() => currencyFormat(value: $this->price),
        );
    }

    public function discountPriceText(): Attribute
    {
        return Attribute::get(
            fn() => currencyFormat(value: $this->discount_price),
        );
    }

    public function responseTitles(ResponseTitle|string $key,string $default = ''): string
    {
        return [
            'store' => $this->ref_code ?? $default,
            'update' => $this->ref_code ?? $default,
            'status_update' => $this->ref_code ?? $default,
            'destroy' => $this->ref_code ?? $default,
            'restore' => $this->ref_code ?? $default,
            'force_destroy' => $this->ref_code ?? $default,
        ][$key instanceof ResponseTitle ? $key->value : $key];
    }

    public static function enumsLang(): array
    {
        return __('callmeaf-payment::enums');
    }
}
