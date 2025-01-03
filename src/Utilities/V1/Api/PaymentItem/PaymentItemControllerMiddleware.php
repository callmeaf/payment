<?php

namespace Callmeaf\Payment\Utilities\V1\Api\PaymentItem;

use Callmeaf\Base\Http\Controllers\BaseController;
use Callmeaf\Base\Utilities\V1\ControllerMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class PaymentItemControllerMiddleware extends ControllerMiddleware
{
    public function __invoke(): array
    {
        return [
            new Middleware(middleware: 'auth:sanctum')
        ];
    }
}
