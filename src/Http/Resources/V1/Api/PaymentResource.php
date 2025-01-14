<?php

namespace Callmeaf\Payment\Http\Resources\V1\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function __construct($resource,protected array|int $only = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return toArrayResource(data: [
            'id' => fn() => $this->id,
            'user_id' => fn() => $this->user_id,
            'status' => fn() => $this->status,
            'status_text' => fn() => $this->statusText,
            'type' => fn() => $this->type,
            'type_text' => fn() => $this->typeText,
            'method' => fn() => $this->method,
            'method_text' => fn() => $this->methodText,
            'tr_code' => fn() => $this->tr_code,
            'total_price' => fn() => $this->total_price,
            'total_price_text' => fn() => $this->totalPriceText,
            'created_at' => fn() => $this->created_at,
            'created_at_text' => fn() => $this->createdAtText,
            'updated_at' => fn() => $this->updated_at,
            'updated_at_text' => fn() => $this->updatedAtText,
            'deleted_at' => fn() => $this->deleted_at,
            'deleted_at_text' => fn() => $this->deletedAtText,
            'user' => fn() => $this->user ? new (config('callmeaf-user.model_resource'))($this->user,only: $this->only['!user'] ?? []) : null,
            'documents' => fn() => $this->documents?->count() ? new (config('callmeaf-media.model_resource_collection'))($this->documents,only: $this->only['!documents'] ?? []) : null,
        ],only: $this->only);
    }
}
