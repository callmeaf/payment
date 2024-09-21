<?php

namespace Callmeaf\Payment\Utilities\V1\Api\Payment;

use Callmeaf\Base\Utilities\V1\FormRequestAuthorizer;
use Callmeaf\Permission\Enums\PermissionName;

class PaymentFormRequestAuthorizer extends FormRequestAuthorizer
{
    public function index(): bool
    {
        return true;
    }

    public function create(): bool
    {
        return userCan(PermissionName::PAYMENT_STORE);
    }

    public function store(): bool
    {
        return userCan(PermissionName::PAYMENT_STORE);
    }

    public function show(): bool
    {
        return userCan(PermissionName::PAYMENT_SHOW);
    }

    public function edit(): bool
    {
        return userCan(PermissionName::PAYMENT_UPDATE);
    }

    public function update(): bool
    {
        return userCan(PermissionName::PAYMENT_UPDATE);
    }

    public function statusUpdate(): bool
    {
        return userCan(PermissionName::PAYMENT_UPDATE);
    }

    public function destroy(): bool
    {
        return userCan(PermissionName::PAYMENT_DESTROY);
    }

    public function trashed(): bool
    {
        return userCan(PermissionName::PAYMENT_TRASHED);
    }

    public function restore(): bool
    {
        return userCan(PermissionName::PAYMENT_RESTORE);
    }

    public function forceDestroy(): bool
    {
        return userCan(PermissionName::PAYMENT_FORCE_DESTROY);
    }

    public function documentsUpdate(): bool
    {
        return userCan(PermissionName::PAYMENT_STORE);
    }

}
