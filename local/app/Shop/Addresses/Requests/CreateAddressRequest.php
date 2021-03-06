<?php

namespace App\Shop\Addresses\Requests;

use App\Shop\Base\BaseFormRequest;

class CreateAddressRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => ['required'],
            'address_1' => ['required'],
        ];
    }
}
