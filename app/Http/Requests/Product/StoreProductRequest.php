<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
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
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'nullable|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a string.',
            'name.max' => 'The product name may not be greater than 255 characters.',
            'description.string' => 'The description must be a string.',
            'sku.string' => 'The SKU must be a string.',
            'sku.unique' => 'The SKU has already been taken.',
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be at least 0.',
            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'The quantity must be a whole number.',
            'quantity.min' => 'The quantity must be at least 0.', // Change to 1 if needed
            'category_id.required' => 'The category is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'supplier_id.required' => 'The supplier is required.',
            'supplier_id.exists' => 'The selected supplier is invalid.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // it will show error if you cant pass validation rules
        throw new HttpResponseException(response()->json([
            'data' => ['errors' => $validator->errors()]
        ], 422));
    }
}
