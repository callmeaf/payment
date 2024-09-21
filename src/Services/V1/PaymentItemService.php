<?php

namespace Callmeaf\Payment\Services\V1;

use Callmeaf\Base\Services\V1\BaseService;
use Callmeaf\Payment\Services\V1\Contracts\PaymentItemServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PaymentItemService extends BaseService implements PaymentItemServiceInterface
{
    public function __construct(?Builder $query = null, ?Model $model = null, ?Collection $collection = null, ?JsonResource $resource = null, ?ResourceCollection $resourceCollection = null, array $defaultData = [],?string $searcher = null)
    {
        parent::__construct($query, $model, $collection, $resource, $resourceCollection, $defaultData,$searcher);
        $this->query = app(config('callmeaf-payment-item.model'))->query();
        $this->resource = config('callmeaf-payment-item.model_resource');
        $this->resourceCollection = config('callmeaf-payment-item.model_resource_collection');
        $this->defaultData = config('callmeaf-payment-item.default_values');
        $this->searcher = config('callmeaf-payment-item.searcher');
    }

}
