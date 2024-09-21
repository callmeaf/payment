<?php

namespace Callmeaf\Payment\Utilities\V1\Api\Payment;

use Callmeaf\Base\Utilities\V1\Contracts\SearcherInterface;
use Illuminate\Database\Eloquent\Builder;

class PaymentSearcher implements SearcherInterface
{
    public function apply(Builder $query, array $filters = []): void
    {
        $filters = collect($filters)->filter(fn($item) => strlen(trim($item)));
        if($value = $filters->get('ref_code')) {
            $query->where('ref_code','like',searcherLikeValue($value));
        }
        if($value = $filters->get('tr_code')) {
            $query->where('tr_code','like',searcherLikeValue($value));
        }
    }
}
