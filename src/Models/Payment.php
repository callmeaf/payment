<?php

namespace Callmeaf\Payment\Models;

use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Contracts\HasResponseTitles;
use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasMediaMethod;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\Base\Traits\Metaable;
use Callmeaf\Payment\Enums\PaymentStatus;
use Callmeaf\Payment\Enums\PaymentType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Payment extends Model implements HasResponseTitles,HasEnum,HasMedia
{
    use HasDate,HasStatus,HasType,SoftDeletes,InteractsWithMedia,HasMediaMethod,Metaable;
    protected $fillable = [
        'user_id',
        'status',
        'type',
        'ref_code',
        'tr_code',
        'total_price',
        'total_discount_price',
    ];

    protected $casts = [
        'status' => PaymentStatus::class,
        'type' => PaymentType::class,
    ];

    protected static function booted(): void
    {
        static::creating(function(Model $model) {
            $model->forceFill([
                'user_id' => $model->user_id ?? authId(),
                'ref_code' => $model->ref_code ?? app(config('callmeaf-payment.service'))->newRefCode(),
                'tr_code' => $model->tr_code ?? app(config('callmeaf-payment.service'))->newTrCode(),
            ]);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('callmeaf-user.model'));
    }

    public function items(): HasMany
    {
        return $this->hasMany(config('callmeaf-payment-item.model'));
    }

    public function totalPriceText(): Attribute
    {
        return Attribute::get(
            fn() => currencyFormat(value: $this->total_price),
        );
    }

    public function totalDiscountPriceText(): Attribute
    {
        return Attribute::get(
            fn() => currencyFormat(value: $this->total_discount_price),
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
