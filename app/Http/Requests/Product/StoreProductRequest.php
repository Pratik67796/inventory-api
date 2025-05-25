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
            'price' => 'required|numeric|min:0|max:9999',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is required.',
            'name.string' => 'Product name must be a valid string.',
            'name.max' => 'Product name may not be greater than 255 characters.',

            'description.string' => 'Description must be a valid string.',

            'sku.string' => 'SKU must be a valid string.',
            'sku.unique' => 'This SKU already exists. Please use a different SKU.',

            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a numeric value.',
            'price.min' => 'Price cannot be less than 0.',
            'price.max' => 'Price cannot exceed 9999.',

            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.min' => 'Quantity cannot be negative.',

            'category_id.required' => 'Category selection is required.',
            'category_id.exists' => 'Selected category does not exist.',

            'supplier_id.required' => 'Supplier selection is required.',
            'supplier_id.exists' => 'Selected supplier does not exist.',
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
