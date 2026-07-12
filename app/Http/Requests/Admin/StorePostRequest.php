<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:draft,published'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'keyword' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp,svg', 'max:5120'],
            'provinces' => ['nullable', 'array'],
            'provinces.*' => ['exists:provinces,id'],
            'salons' => ['nullable', 'array'],
            'salons.*' => ['exists:salons,id'],
        ];
    }
}
