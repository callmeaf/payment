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
use Callmeaf\Payment\Enums\PaymentMethod;
use Callmeaf\Payment\Enums\PaymentStatus;
use Callmeaf\Payment\Enums\PaymentType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'method',
        'tr_code',
        'total_price',
    ];

    protected $casts = [
        'status' => PaymentStatus::class,
        'type' => PaymentType::class,
        'method' => PaymentMethod::class,
    ];

    protected static function booted(): void
    {
        static::creating(function(Model $model) {
            $model->forceFill([
                'user_id' => $model->user_id ?? authId(),
                'tr_code' => $model->tr_code ?? app(config('callmeaf-payment.service'))->newTrCode(),
            ]);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('callmeaf-user.model'));
    }

    public function totalPriceText(): Attribute
    {
        return Attribute::get(
            fn() => currencyFormat(value: $this->total_price),
        );
    }

    public function methodText(): Attribute
    {
        return Attribute::make(
            get: fn() => enumTranslator($this->method,$this::enumsLang()),
        );
    }

    public function responseTitles(ResponseTitle|string $key,string $default = ''): string
    {
        return [
            'store' => $this->tr_code ?? $default,
            'update' => $this->tr_code ?? $default,
            'status_update' => $this->tr_code ?? $default,
            'destroy' => $this->tr_code ?? $default,
            'restore' => $this->tr_code ?? $default,
            'force_destroy' => $this->tr_code ?? $default,
        ][$key instanceof ResponseTitle ? $key->value : $key];
    }

    public static function enumsLang(): array
    {
        return __('callmeaf-payment::enums');
    }

}
