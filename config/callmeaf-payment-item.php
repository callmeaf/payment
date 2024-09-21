<?php

return [
    'model' => \Callmeaf\Payment\Models\PaymentItem::class,
    'model_resource' => \Callmeaf\Payment\Http\Resources\V1\Api\PaymentItemResource::class,
    'model_resource_collection' => \Callmeaf\Payment\Http\Resources\V1\Api\PaymentItemCollection::class,
    'service' => \Callmeaf\Payment\Services\V1\PaymentItemService::class,
    'default_values' => [
        'status' => \Callmeaf\Payment\Enums\PaymentItemStatus::NOT_DELIVERED,
    ],
    'events' => [
        \Callmeaf\Payment\Events\PaymentItemStatusUpdated::class => [
            // listeners
        ],
    ],
    'validations' => [
        'payment_item' => \Callmeaf\Payment\Utilities\V1\Api\PaymentItem\PaymentItemFormRequestValidator::class,
    ],
    'resources' => [
        'payment_item' => \Callmeaf\Payment\Utilities\V1\Api\PaymentItem\PaymentItemResources::class,
    ],
    'controllers' => [
        'payment_items' => \Callmeaf\Payment\Http\Controllers\V1\Api\PaymentItemController::class,
    ],
    'form_request_authorizers' => [
        'payment_item' => \Callmeaf\Payment\Utilities\V1\Api\PaymentItem\PaymentItemFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'payment_item' => \Callmeaf\Payment\Utilities\V1\Api\PaymentItem\PaymentItemControllerMiddleware::class,
    ],
];
