<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateInventoryRequest extends FormRequest
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
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:add,reduce',
            'notes' => 'nullable|string|max:5',
        ];
    }

    public function messages(): array
    {
        // not working
        return [
            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'The quantity must be a whole number.',
            'quantity.min' => 'The quantity must be at least 1.',
            'operation.required' => 'The operation type is required.',
            'operation.in' => 'The operation must be either "add" or "reduce".',
            'notes.max' => 'Notes cannot exceed 500 characters.',
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
