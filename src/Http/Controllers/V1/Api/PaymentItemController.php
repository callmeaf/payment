<?php

namespace Callmeaf\Payment\Http\Controllers\V1\Api;

use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Payment\Events\PaymentItemStatusUpdated;
use Callmeaf\Payment\Http\Requests\V1\Api\PaymentItemStatusUpdateRequest;
use Callmeaf\Payment\Models\PaymentItem;
use Callmeaf\Payment\Services\V1\PaymentItemService;
use Callmeaf\Payment\Utilities\V1\Api\PaymentItem\PaymentItemResources;

class PaymentItemController extends ApiController
{
    protected PaymentItemService $paymentItemService;
    protected PaymentItemResources $paymentItemResources;
    public function __construct()
    {
        app(config('callmeaf-payment-item.middlewares.payment_item'))($this);
        $this->paymentItemService = app(config('callmeaf-payment-item.service'));
        $this->paymentItemResources = app(config('callmeaf-payment-item.resources.payment_item'));
    }

    public function statusUpdate(PaymentItemStatusUpdateRequest $request,PaymentItem $paymentItem)
    {
        try {
            $resources = $this->paymentItemResources->statusUpdate();
            $paymentItem = $this->paymentItemService->setModel($paymentItem)->update([
                'status' => $request->get('status'),
            ],events: [
                PaymentItemStatusUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'payment' => $paymentItem,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $paymentItem->responseTitles(ResponseTitle::STATUS_UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

}
