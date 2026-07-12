<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim($this->input('name', '')),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($this->route('category'))],
            'parent_id' => ['nullable', 'integer', Rule::exists('categories', 'id')->whereNull('deleted_at')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'parent_id.exists' => 'Danh mục cha không hợp lệ.',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $name = $this->input('name', '');
            $parentId = $this->input('parent_id') ? (int) $this->input('parent_id') : null;
            $category = $this->route('category');

            if ($name === '') {
                $validator->errors()->add('name', 'Vui lòng nhập tên danh mục.');
                return;
            }

            if ($category && $parentId === $category->id) {
                $validator->errors()->add('parent_id', 'Danh mục cha không được là chính nó.');
            }

            if ($parentId) {
                $parent = Category::find($parentId);

                if ($parent && $parent->parent_id) {
                    $validator->errors()->add('parent_id', 'Chỉ hỗ trợ danh mục tối đa 2 cấp.');
                }
            }

            if ($category && $parentId && $category->children()->exists()) {
                $validator->errors()->add('parent_id', 'Danh mục đang có danh mục con nên không thể chuyển thành danh mục con.');
            }
        });
    }
}
