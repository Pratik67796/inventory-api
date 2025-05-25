<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateProductRequest extends FormRequest
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
        'name.required' => 'The product name is required.',
        'name.string' => 'The product name must be a string.',
        'name.max' => 'The product name must not exceed 255 characters.',

        'description.string' => 'The description must be a string.',

        'sku.string' => 'The SKU must be a string.',
        'sku.unique' => 'This SKU is already in use. Please choose another.',

        'price.required' => 'The price is required.',
        'price.numeric' => 'The price must be a numeric value.',
        'price.min' => 'The price must be at least 0.',
        'price.max' => 'The price may not be greater than 9999.',

        'quantity.required' => 'The quantity is required.',
        'quantity.integer' => 'The quantity must be an integer.',
        'quantity.min' => 'The quantity cannot be negative.',

        'category_id.required' => 'The category is required.',
        'category_id.exists' => 'The selected category does not exist.',

        'supplier_id.required' => 'The supplier is required.',
        'supplier_id.exists' => 'The selected supplier does not exist.',
    ];
}


    protected function failedValidation(Validator $validator)
    {
        // it will show error if you cant pass validation rules
        throw new HttpResponseException(response()->json([
            'data' => ['errors' => $validator->errors()]
        ], 422));
    }
    

    protected function prepareForValidation(): void
    {
        $productId = $this->route('id');

        $product = Product::where('id', $productId)
            ->whereNull('deleted_at')
            ->first();

        if (!$product) {
            throw new HttpResponseException(response()->json([
                'data' => ['errors' => ['id' => ['product Id not found or has been deleted.']]]
            ], 404));
        }
    }
}
