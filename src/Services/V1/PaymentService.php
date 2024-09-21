<?php

namespace Callmeaf\Payment\Services\V1;

use Callmeaf\Base\Services\V1\BaseService;
use Callmeaf\Payment\Enums\PaymentItemType;
use Callmeaf\Payment\Services\V1\Contracts\PaymentServiceInterface;
use Callmeaf\Variation\Services\V1\VariationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;

class PaymentService extends BaseService implements PaymentServiceInterface
{
    public function __construct(?Builder $query = null, ?Model $model = null, ?Collection $collection = null, ?JsonResource $resource = null, ?ResourceCollection $resourceCollection = null, array $defaultData = [],?string $searcher = null)
    {
        parent::__construct($query, $model, $collection, $resource, $resourceCollection, $defaultData,$searcher);
        $this->query = app(config('callmeaf-payment.model'))->query();
        $this->resource = config('callmeaf-payment.model_resource');
        $this->resourceCollection = config('callmeaf-payment.model_resource_collection');
        $this->defaultData = config('callmeaf-payment.default_values');
        $this->searcher = config('callmeaf-payment.searcher');
    }

    public function createByVariationsIds(?array $variationsIds = []): PaymentService
    {
        if(!is_array($variationsIds)) {
            $variationsIds = array_filter([$variationsIds]);
        }
        /**
         * @var VariationService $variationService
         */
        $variationService = app(config('callmeaf-variation.service'));
        $variations = $variationService->where('id',$variationsIds)->all(perPage: 0,page: 0)->getCollection();
        /**
         * @var PaymentItemService $paymentItemService
         */
        $paymentItemService = app(config('callmeaf-payment-item.service'));
        foreach ($variations as $variation) {
            $paymentItemService->create([
                'payment_id' => $this->model->id,
                'variation_id' => $variation->id,
                'type' => $variation->isDigital() ? PaymentItemType::DIGITAL : PaymentItemType::PHYSICAL,
                'price' => $variation->price,
                'discount_price' => $variation->discount_price,
            ]);
        }
        $this->update([
            'total_price' => $variations->sum(fn($variation) => $variation->price),
            'total_discount_price' => $variations->sum(fn($variation) => $variation->discount_price)
        ]);
        return $this;
    }

    public function newRefCode(): ?string
    {
        $refCode = randomId(length: config('callmeaf-payment.ref_code_length'),prefix: config('callmeaf-payment.prefix_ref_code'));
        if(is_null($refCode)) {
            return null;
        }
        if($this->freshQuery()->where(column: 'ref_code',valueOrOperation: $refCode)->exists()) {
            return  $this->newRefCode();
        }
        return $refCode;
    }

    public function newTrCode(): ?string
    {
        $trCode = randomId(length: config('callmeaf-payment.tr_code_length'),prefix: config('callmeaf-payment.prefix_tr_code'));
        if(is_null($trCode)) {
            return null;
        }
        if($this->freshQuery()->where(column: 'tr_code',valueOrOperation: $trCode)->exists()) {
            return  $this->newRefCode();
        }
        return $trCode;
    }
}
