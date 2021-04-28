<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Services\BasketService;

class CheckoutRequest extends FormRequest
{
    /**
     * The route to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirectRoute = 'checkout.purchase';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return \app(BasketService::class)->count() > 0;
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData(): array
    {
        return $this->only([
            'client_name', 'client_address',
            'credit_card_number', 'credit_card_expiry', 'credit_card_cv',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'client_name' => [
                'bail', 'required', 'string', 'max:100',
            ],
            'client_address' => [
                'bail', 'required', 'string', 'max:300',
            ],
            'credit_card_number' => [
                'bail', 'required', 'string',
            ],
            'credit_card_expiry.year' => [
                'bail', 'required', 'string', 'regex:~^\\d{4}$~u',
            ],
            'credit_card_expiry.month' => [
                'bail', 'required', 'string', 'regex:~^\\d{2}$~u',
            ],
            'credit_card_cv' => [
                'bail', 'required', 'string', 'regex:~^\\d{3,4}$~u',
            ],
        ];
    }
}
