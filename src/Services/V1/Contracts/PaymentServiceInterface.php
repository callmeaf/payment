<?php

namespace Callmeaf\Payment\Services\V1\Contracts;

use Callmeaf\Base\Services\V1\Contracts\BaseServiceInterface;
use Callmeaf\Payment\Services\V1\PaymentService;

interface PaymentServiceInterface extends BaseServiceInterface
{
    public function createByVariationsIds(?array $variationsIds = []): PaymentService;
    public function newRefCode(): ?string;
    public function newTrCode(): ?string;
}
