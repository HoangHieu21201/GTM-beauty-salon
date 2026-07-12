<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClinicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'form_token' => ['required', 'string', 'size:36'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255', Rule::unique('salons', 'name')->whereNull('deleted_at')],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255', Rule::unique('salons', 'phone')->whereNull('deleted_at')],
            'website' => ['nullable', 'url', 'max:255', Rule::unique('salons', 'website')->whereNull('deleted_at')],
            'description' => ['nullable', 'string'],
            'score' => ['nullable', 'integer', 'min:0'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'review_count' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['nullable', 'in:active,inactive'],
            'images_synced' => ['nullable', 'boolean'],
            'image_files' => ['nullable', 'array', 'max:4'],
            'image_files.*' => ['file', 'mimes:jpg,jpeg,jfif,png,webp,gif,svg,avif', 'max:8192'],
            'existing_images' => ['nullable', 'array', 'max:4'],
            'existing_images.*' => ['string', 'max:500'],
            'image_url' => ['nullable', 'url', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên cơ sở.',
            'name.unique' => 'Tên cơ sở này đã tồn tại, vui lòng kiểm tra lại.',
            'phone.unique' => 'Số điện thoại này đã được sử dụng cho cơ sở khác.',
            'website.unique' => 'Website này đã được sử dụng cho cơ sở khác.',
            'website.url' => 'Website phải là một đường dẫn hợp lệ.',
            'rating.numeric' => 'Rating phải là số từ 0 đến 5.',
            'rating.min' => 'Rating phải là số từ 0 đến 5.',
            'rating.max' => 'Rating phải là số từ 0 đến 5.',
            'image_files.*.mimes' => 'Ảnh cơ sở phải là file ảnh JPG, PNG, WEBP, GIF, SVG hoặc AVIF.',
            'image_files.*.max' => 'Ảnh cơ sở không được vượt quá 8MB.',
            'image_url.url' => 'URL ảnh phải là một đường dẫn hợp lệ.',
            'form_token.required' => 'Phiên làm việc đã hết hạn, vui lòng tải lại trang.',
            'form_token.size' => 'Phiên làm việc không hợp lệ, vui lòng tải lại trang.',
        ];
    }
}
