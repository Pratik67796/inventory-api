<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateCategoryRequest extends FormRequest
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
            'description' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'description.required' => 'Description is required.',
            'description.string' => 'Description must be a string',
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
        $categoryId = $this->route('id');

        $category = Category::where('id', $categoryId)
            ->whereNull('deleted_at')
            ->first();

        if (!$category) {
            throw new HttpResponseException(response()->json([
                'data' => ['errors' => ['id' => ['Category Id not found or has been deleted.']]]
            ], 404));
        }
    }

}
