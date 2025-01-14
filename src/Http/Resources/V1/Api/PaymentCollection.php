<?php

namespace Callmeaf\Payment\Http\Resources\V1\Api;

use Callmeaf\Media\Http\Resources\V1\Api\MediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentCollection extends ResourceCollection
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
            'data' => $this->collection->map(fn($product) => toArrayResource(data: [
                'id' => fn() => $product->id,
                'user_id' => fn() => $product->user_id,
                'status' => fn() => $product->status,
                'status_text' => fn() => $product->statusText,
                'type' => fn() => $product->type,
                'type_text' => fn() => $product->typeText,
                'method' => fn() => $product->method,
                'method_text' => fn() => $product->methodText,
                'tr_code' => fn() => $product->tr_code,
                'total_price' => fn() => $product->total_price,
                'total_price_text' => fn() => $product->totalPriceText,
                'created_at' => fn() => $product->created_at,
                'created_at_text' => fn() => $product->createdAtText,
                'updated_at' => fn() => $product->updated_at,
                'updated_at_text' => fn() => $product->updatedAtText,
                'deleted_at' => fn() => $product->deleted_at,
                'deleted_at_text' => fn() => $product->deletedAtText,
                // documents,
            ],only: $this->only)),
        ];
    }
}
