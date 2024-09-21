<?php

namespace Callmeaf\Payment\Http\Requests\V1\Api;

use Callmeaf\Payment\Enums\PaymentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PaymentStatusUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-payment.form_request_authorizers.payment'))->statusUpdate();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'status' => [new Enum(PaymentStatus::class)],
        ],filters: app(config("callmeaf-payment.validations.payment"))->statusUpdate());
    }

}
