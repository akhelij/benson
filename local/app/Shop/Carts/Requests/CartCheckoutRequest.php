<?php

namespace App\Shop\Cart\Requests;

use App\Shop\Base\BaseFormRequest;

/**
 * Class CartCheckoutRequest
 * @package App\Shop\Cart\Requests
 * @codeCoverageIgnore
 */
class CartCheckoutRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'courier' => ['required'],
            'billing_address' => ['required'],
            'payment' => ['required'],
            'passive_name'     => ['required',"regex:/^([a-zA-Z0-9' -])*$/u",'max:110'],
            'passive_email'    => ['required', 'email'],
            'passive_phone' => ['required'],
            'passive_city' => ['required',"regex:/^([a-zA-Z0-9' -])*$/u",'max:255'],
            'passive_country' => ['required',"regex:/^([a-zA-Z0-9' -])*$/u",'max:255'],
            'passive_address' => ['required',"regex:/^([a-zA-Z0-9' -,°])*$/u"]
         
        ];
    }

    public function messages(){
        return [

            'passive_name.required' => 'Veuillez saisir votre nom complet',
            'passive_email.required' => 'Veuillez saisir votre email',
            'passive_phone.required' => 'Veuillez saisir le téléphone',
            'passive_city.required' => 'Veuillez saisir la ville',
            'passive_country.required' => 'Veuillez saisir le pays',
            'passive_address.required' => 'Veuillez saisir votre adresse',
            'billing_address.required' => 'Veuillez saisir votre adresse de livraison',
            'payment.required' => 'Veuillez choisir votre mode de paiement',

            'passive_name.regex' => 'Veuillez éviter les caractéres spéciaux dans la saisi de votre nom',
            'passive_city.regex' => 'Veuillez éviter les caractéres spéciaux dans la saisi de la ville',
            'passive_country.regex' => 'Veuillez éviter les caractéres spéciaux dans la saisi du pays',
            'passive_address.regex' => 'Veuillez éviter les caractéres spéciaux dans la saisi de l\'adresse',

            'passive_name.max' => 'Votre nom est trop long',
            'passive_address.max' => 'Votre adresse est trop longue',
            'passive_city.max' => 'Votre ville est trop longue',
            'passive_country.max' => 'Votre pays est trop long',
            

        ];
    }
}
