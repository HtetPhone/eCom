<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $price = request()->price ;
        return [
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:2',
            'price' => 'required|numeric|min:0',
            'd_price' => 'nullable|numeric|min:0|lt:'.$price,
            'in_stock' => 'required|numeric|integer|min:0',
            'categories' => 'required|array|min:1'
        ];
    }
}
