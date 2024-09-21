<?php

namespace Callmeaf\Payment\Utilities\V1\Api\PaymentItem;

use Callmeaf\Base\Utilities\V1\FormRequestValidator;

class PaymentItemFormRequestValidator extends FormRequestValidator
{
    public function statusUpdate(): array
    {
        return [
            'status' => true,
        ];
    }

}
