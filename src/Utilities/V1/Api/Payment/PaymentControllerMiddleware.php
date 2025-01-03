<?php

namespace Callmeaf\Payment\Utilities\V1\Api\Payment;

use Callmeaf\Base\Http\Controllers\BaseController;
use Callmeaf\Base\Utilities\V1\ControllerMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class PaymentControllerMiddleware extends ControllerMiddleware
{
    public function __invoke(): array
    {
        // TODO: SUPERADMIN MIDDLEWARE FOR FORCE DESTROY AND RESTORE
        return [
            new Middleware(middleware: 'auth:sanctum'),
        ];
    }
}
