<?php

namespace Callmeaf\Payment\Utilities\V1\Api\PaymentItem;

use Callmeaf\Base\Utilities\V1\Resources;

class PaymentItemResources extends Resources
{
    public function statusUpdate(): self
    {
        $this->data = [
            'relations' => [
                //
            ],
            'attributes' => [
                'id',
                'payment_id',
                'variation_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'price',
                'discount_price',
                'created_at_text',
                'updated_at_text',
            ],
        ];
        return $this;
    }
}
