<?php

return [
    'model' => \Callmeaf\Payment\Models\Payment::class,
    'model_resource' => \Callmeaf\Payment\Http\Resources\V1\Api\PaymentResource::class,
    'model_resource_collection' => \Callmeaf\Payment\Http\Resources\V1\Api\PaymentCollection::class,
    'service' => \Callmeaf\Payment\Services\V1\PaymentService::class,
    'default_values' => [
        'status' => \Callmeaf\Payment\Enums\PaymentStatus::PENDING,
        'type' => \Callmeaf\Payment\Enums\PaymentType::BUY,
        'method' => \Callmeaf\Payment\Enums\PaymentMethod::GATEWAY,
    ],
    'events' => [
        \Callmeaf\Payment\Events\PaymentIndexed::class => [
            // listeners
        ],
        \Callmeaf\Payment\Events\PaymentStored::class => [
            // listeners
        ],
        \Callmeaf\Payment\Events\PaymentShowed::class => [
            // listeners
        ],
        \Callmeaf\Payment\Events\PaymentUpdated::class => [
            // listeners
        ],
        \Callmeaf\Payment\Events\PaymentStatusUpdated::class => [
            // listeners
        ],
        \Callmeaf\Payment\Events\PaymentDestroyed::class => [
            // listeners
        ],
        \Callmeaf\Payment\Events\PaymentRestored::class => [
            // listeners
        ],
        \Callmeaf\Payment\Events\PaymentTrashed::class => [
            // listeners
        ],
        \Callmeaf\Payment\Events\PaymentForceDestroyed::class => [
            // listeners
        ],
        \Callmeaf\Payment\Events\PaymentDocumentsUpdated::class => [
            // listeners
        ],
    ],
    'validations' => [
        'payment' => \Callmeaf\Payment\Utilities\V1\Api\Payment\PaymentFormRequestValidator::class,
    ],
    'resources' => [
      'payment' => \Callmeaf\Payment\Utilities\V1\Api\Payment\PaymentResources::class,
    ],
    'controllers' => [
        'payments' => \Callmeaf\Payment\Http\Controllers\V1\Api\PaymentController::class,
    ],
    'form_request_authorizers' => [
        'payment' => \Callmeaf\Payment\Utilities\V1\Api\Payment\PaymentFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'payment' => \Callmeaf\Payment\Utilities\V1\Api\Payment\PaymentControllerMiddleware::class,
    ],
    'searcher' => \Callmeaf\Payment\Utilities\V1\Api\Payment\PaymentSearcher::class,
    'prefix_tr_code' => 'callmeaf-',
    // current length without calculate prefix_tr_code
    'tr_code_length' => 6,
];
