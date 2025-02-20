<?php

namespace Callmeaf\Payment\Http\Requests\V1\Api;

use Callmeaf\Payment\Enums\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class PaymentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-payment.form_request_authorizers.payment'))->store();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'method' => [new Enum(PaymentMethod::class)],
            'variations_ids' => ['array'],
            'variations_ids.*' => [Rule::exists(config('callmeaf-variation.model'),'id')],
        ],filters: app(config("callmeaf-payment.validations.payment"))->store());
    }

}
