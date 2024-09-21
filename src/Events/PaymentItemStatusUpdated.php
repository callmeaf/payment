<?php

namespace Callmeaf\Payment\Events;

use Callmeaf\Payment\Models\PaymentItem;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentItemStatusUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public PaymentItem $paymentItem)
    {

    }
}
