<?php

namespace Callmeaf\Payment\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;

class PaymentItemStatusUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-payment-item.form_request_authorizers.payment_item'))->statusUpdate();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [

        ],filters: app(config("callmeaf-payment-item.validations.payment_item"))->statusUpdate());
    }

}
