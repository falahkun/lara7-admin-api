<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_subtotal' => 'required|string',
            'order_self_pickup' => 'required|integer',
            'order_scheduled' => 'required|integer|in:1,0',
            'order_scheduled_date' => 'string',
            'product_id' => 'required|array',
        ];
    }
}
