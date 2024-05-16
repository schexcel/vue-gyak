<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;

class StoreDrinkRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1|max:100',
            'price' => 'required|integer|min:1|max:5000',
            'discounted_price' => 'nullable|integer|min:1|max:5000|lt:price',
            'flavor_id' => 'required|exists:App\Models\Flavor,id',
            'ingredients' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            Response::json([
                'data' => $validator->errors(),
                'success' => false,
                'message' => 'Validation error'
            ])
        );
    }
}
