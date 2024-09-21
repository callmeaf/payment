<?php

namespace Callmeaf\Payment\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;

class PaymentIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return app(config('callmeaf-payment.form_request_authorizers.payment'))->index();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return validationManager(rules: [
            'ref_code' => [],
            'tr_code' => [],
        ],filters: [
            ... app(config("callmeaf-payment.validations.payment"))->index(),
            ...config('callmeaf-base.default_searcher_validation'),
        ]);
    }

}
