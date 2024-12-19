<?php

namespace Callmeaf\Payment\Utilities\V1\Api\Payment;

use Callmeaf\Base\Utilities\V1\FormRequestValidator;

class PaymentFormRequestValidator extends FormRequestValidator
{
    public function index(): array
    {
        return [
            'ref_code' => false,
            'tr_code' => false,
        ];
    }

    public function store(): array
    {
        return [
            'variations_ids' => true,
            'variations_ids.*' => true,
        ];
    }

    public function show(): array
    {
        return [];
    }

    public function update(): array
    {
        return [
            'variations_ids' => true,
            'variations_ids.*' => true,
        ];
    }

    public function statusUpdate(): array
    {
        return [
            'status' => true,
        ];
    }

    public function destroy(): array
    {
        return [];
    }

    public function restore(): array
    {
        return [];
    }

    public function trashed(): array
    {
        return [
            'ref_code' => false,
            'tr_code' => false,
        ];
    }

    public function forceDestroy(): array
    {
        return [];
    }

    public function documentsUpdate(): array
    {
        return [
            'documents' => true,
            'documents.*' => true,
        ];
    }
}
