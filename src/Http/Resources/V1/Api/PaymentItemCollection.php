<?php

namespace Callmeaf\Payment\Http\Resources\V1\Api;

use Callmeaf\Media\Http\Resources\V1\Api\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentItemCollection extends ResourceCollection
{
    public function __construct($resource,protected array|int $only = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(fn($paymentItem) => toArrayResource(data: [
                'id' => fn() => $paymentItem->id,
                'payment_id' => fn() => $paymentItem->payment_id,
                'variation_id' => fn() => $paymentItem->variation_id,
                'status' => fn() => $paymentItem->status,
                'status_text' => fn() => $paymentItem->statusText,
                'type' => fn() => $paymentItem->type,
                'type_text' => fn() => $paymentItem->typeText,
                'price' => fn() => $paymentItem->price,
                'price_text' => fn() => $paymentItem->priceText,
                'discount_price' => fn() => $paymentItem->discount_price,
                'discount_price_text' => fn() => $paymentItem->discountPriceText,
                'created_at' => fn() => $paymentItem->created_at,
                'created_at_text' => fn() => $paymentItem->createdAtText,
                'updated_at' => fn() => $paymentItem->updated_at,
                'updated_at_text' => fn() => $paymentItem->updatedAtText,
            ],only: $this->only)),
        ];
    }
}
