<?php

namespace Callmeaf\Payment\Utilities\V1\Api\PaymentItem;

use Callmeaf\Base\Utilities\V1\FormRequestAuthorizer;
use Callmeaf\Permission\Enums\PermissionName;

class PaymentItemFormRequestAuthorizer extends FormRequestAuthorizer
{
    public function statusUpdate(): bool
    {
        return userCan(PermissionName::PAYMENT_UPDATE);
    }
}
