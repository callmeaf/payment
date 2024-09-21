<?php

namespace Callmeaf\Payment\Utilities\V1\Api\Payment;

use Callmeaf\Base\Utilities\V1\Resources;

class PaymentResources extends Resources
{
    public function index(): self
    {
        $this->data = [
            'relations' => [
                'user',
            ],
            'columns' => [
                'id',
                'user_id',
                'type',
                'status',
                'ref_code',
                'tr_code',
                'total_price',
                'total_discount_price',
                'created_at',
                'updated_at',
            ],
            'attributes' => [
                'id',
                'user_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'ref_code',
                'tr_code',
                'total_price',
                'total_price_text',
                'total_discount_price',
                'total_discount_price_text',
                'created_at_text',
                'updated_at_text',
                'user',
                '!user' => [
                    'id',
                    'mobile',
                    'email',
                    'first_name',
                    'last_name',
                ],
            ],
        ];
        return $this;
    }

    public function store(): self
    {
        $this->data = [
            'relations' => [
                'user',
            ],
            'attributes' => [
                'id',
                'user_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'ref_code',
                'tr_code',
                'total_price',
                'total_price_text',
                'total_discount_price',
                'total_discount_price_text',
                'created_at_text',
                'updated_at_text',
                'user',
                '!user' => [
                    'id',
                    'mobile',
                    'email',
                    'first_name',
                    'last_name',
                ],
            ],
        ];
        return $this;
    }

    public function show(): self
    {
        $this->data = [
            'relations' => [
                'user',
                'items',
                'media',
            ],
            'attributes' => [
                'id',
                'user_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'ref_code',
                'tr_code',
                'total_price',
                'total_price_text',
                'total_discount_price',
                'total_discount_price_text',
                'created_at_text',
                'updated_at_text',
                'user',
                '!user' => [
                    'id',
                    'mobile',
                    'email',
                    'first_name',
                    'last_name',
                ],
                'items',
                '!items' => [
                    'id',
                    'status',
                    'status_text',
                    'type',
                    'type_text',
                    'price',
                    'price_text',
                    'discount_price',
                    'discount_price_text',
                ],
                'documents',
                '!documents' => [
                    'id',
                    'url'
                ],
            ],
        ];
        return $this;
    }

    public function update(): self
    {
        $this->data = [
            'relations' => [
                'user'
            ],
            'attributes' => [
                'id',
                'user_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'ref_code',
                'tr_code',
                'total_price',
                'total_price_text',
                'total_discount_price',
                'total_discount_price_text',
                'created_at_text',
                'updated_at_text',
                'user',
                '!user' => [
                    'id',
                    'mobile',
                    'email',
                    'first_name',
                    'last_name',
                ],
            ],
        ];
        return $this;
    }

    public function statusUpdate(): self
    {
        $this->data = [
            'relations' => [
                'user'
            ],
            'attributes' => [
                'id',
                'user_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'ref_code',
                'tr_code',
                'total_price',
                'total_price_text',
                'total_discount_price',
                'total_discount_price_text',
                'created_at_text',
                'updated_at_text',
                'user',
                '!user' => [
                    'id',
                    'mobile',
                    'email',
                    'first_name',
                    'last_name',
                ],
            ],
        ];
        return $this;
    }

    public function destroy(): self
    {
        $this->data = [
            'relations' => [
                'user'
            ],
            'attributes' => [
                'id',
                'user_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'ref_code',
                'tr_code',
                'total_price',
                'total_price_text',
                'total_discount_price',
                'total_discount_price_text',
                'created_at_text',
                'updated_at_text',
                'deleted_at',
                'deleted_at_text',
                'user',
                '!user' => [
                    'id',
                    'mobile',
                    'email',
                    'first_name',
                    'last_name',
                ],
            ],
        ];
        return $this;
    }

    public function restore(): self
    {
        $this->data = [
            'id_column' => 'id',
            'columns' => [
                'id',
                'user_id',
                'type',
                'status',
                'ref_code',
                'tr_code',
                'total_price',
                'total_discount_price',
                'created_at',
                'updated_at',
            ],
            'relations' => [
                'user'
            ],
            'attributes' => [
                'id',
                'user_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'ref_code',
                'tr_code',
                'total_price',
                'total_price_text',
                'total_discount_price',
                'total_discount_price_text',
                'created_at_text',
                'updated_at_text',
                'user',
                '!user' => [
                    'id',
                    'mobile',
                    'email',
                    'first_name',
                    'last_name',
                ],
            ],
        ];
        return $this;
    }

    public function trashed(): self
    {
        $this->data = [
            'relations' => [
                'user',
            ],
            'columns' => [
                'id',
                'user_id',
                'type',
                'status',
                'ref_code',
                'tr_code',
                'total_price',
                'total_discount_price',
                'created_at',
                'updated_at',
                'deleted_at',
            ],
            'attributes' => [
                'id',
                'user_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'ref_code',
                'tr_code',
                'total_price',
                'total_price_text',
                'total_discount_price',
                'total_discount_price_text',
                'created_at_text',
                'updated_at_text',
                'deleted_at',
                'deleted_at_text',
                'user',
                '!user' => [
                    'id',
                    'mobile',
                    'email',
                    'first_name',
                    'last_name',
                ],
            ],
        ];
        return $this;
    }

    public function forceDestroy(): self
    {
        $this->data = [
            'id_column' => 'id',
            'columns' => [
                'id',
                'ref_code',
            ],
            'relations' => [],
            'attributes' => [
                'id',
            ],
        ];
        return $this;
    }

    public function documentsUpdate(): self
    {
        $this->data = [
            'relations' => [
                'user',
                'media',
            ],
            'attributes' => [
                'id',
                'user_id',
                'type',
                'type_text',
                'status',
                'status_text',
                'ref_code',
                'tr_code',
                'total_price',
                'total_price_text',
                'total_discount_price',
                'total_discount_price_text',
                'created_at_text',
                'updated_at_text',
                'user',
                '!user' => [
                    'id',
                    'mobile',
                    'email',
                    'first_name',
                    'last_name',
                ],
                'documents',
                '!documents' => [
                    'id',
                    'url'
                ],
            ],
        ];
        return $this;
    }
}
