<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'name' => ['required', 'string', 'max:24'],
            'slug' => ['required', 'string', 'max:28', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('products', 'slug')],
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'description' => ['nullable', 'string', 'max:255'],
            'price' => ['sometimes', 'decimal:0,2', 'min:0'],
            'stock' => ['sometimes', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'name.max' => 'Product name cannot exceed 24 characters.',

            'slug.required' => 'Product slug is required.',
            'slug.max' => 'Product slug cannot exceed 28 characters.',
            'slug.regex' => 'Slug may only contain lowercase letters, numbers, and hyphens.',
            'slug.unique' => 'This product slug already exists.',

            'category_id.required' => 'Category is required.',
            'category_id.integer' => 'Category ID must be a number.',
            'category_id.exists' => 'Selected category does not exist.',

            'description.max' => 'Description cannot exceed 255 characters.',

            'price.decimal' => 'Price may have at most 2 decimal places.',
            'price.min' => 'Price cannot be negative.',

            'stock.integer' => 'Stock must be a whole number.',
            'stock.min' => 'Stock cannot be negative.',
        ];
    }
}
