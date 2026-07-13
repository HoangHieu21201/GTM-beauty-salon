<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClinicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $clinic = $this->route('clinic');

        return [
            'form_token' => ['required', 'string', 'size:36'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255', Rule::unique('salons', 'name')->ignore($clinic?->id)->whereNull('deleted_at')],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', Rule::unique('salons', 'phone')->ignore($clinic?->id)->whereNull('deleted_at')],
            'website' => ['required', 'url', 'max:255', Rule::unique('salons', 'website')->ignore($clinic?->id)->whereNull('deleted_at')],
            'description' => ['required', 'string'],
            'score' => ['required', 'integer', 'min:0'],
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'review_count' => ['required', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['required', 'in:active,inactive'],
            'images_synced' => ['nullable', 'boolean'],
            'existing_images' => ['nullable', 'array', 'max:4', 'required_without_all:image_files,image_url'],
            'existing_images.*' => ['string', 'max:500'],
            'image_files' => ['nullable', 'array', 'max:4', 'required_without_all:existing_images,image_url'],
            'image_files.*' => ['file', 'mimes:jpg,jpeg,jfif,png,webp,gif,svg,avif', 'max:8192'],
            'image_url' => ['nullable', 'url', 'max:500', 'required_without_all:existing_images,image_files'],
        ];
    }

    public function messages(): array
    {
        return [
            'form_token.required' => 'Phiên làm việc đã hết hạn, vui lòng tải lại trang.',
            'form_token.size' => 'Phiên làm việc không hợp lệ, vui lòng tải lại trang.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'name.required' => 'Vui lòng nhập tên cơ sở.',
            'name.unique' => 'Tên cơ sở này đã tồn tại, vui lòng kiểm tra lại.',
            'address.required' => 'Vui lòng nhập địa chỉ cơ sở.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.unique' => 'Số điện thoại này đã được sử dụng cho cơ sở khác.',
            'website.required' => 'Vui lòng nhập website.',
            'website.url' => 'Website phải là một đường dẫn hợp lệ.',
            'website.unique' => 'Website này đã được sử dụng cho cơ sở khác.',
            'description.required' => 'Vui lòng nhập mô tả cơ sở.',
            'score.required' => 'Vui lòng nhập điểm xếp hạng.',
            'score.integer' => 'Điểm xếp hạng phải là số nguyên từ 0 trở lên.',
            'score.min' => 'Điểm xếp hạng phải là số nguyên từ 0 trở lên.',
            'rating.required' => 'Vui lòng nhập rating.',
            'rating.numeric' => 'Rating phải là số từ 0 đến 5.',
            'rating.min' => 'Rating phải là số từ 0 đến 5.',
            'rating.max' => 'Rating phải là số từ 0 đến 5.',
            'review_count.required' => 'Vui lòng nhập số đánh giá.',
            'review_count.integer' => 'Số đánh giá phải là số nguyên từ 0 trở lên.',
            'review_count.min' => 'Số đánh giá phải là số nguyên từ 0 trở lên.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'status.in' => 'Trạng thái không hợp lệ.',
            'existing_images.required_without_all' => 'Vui lòng giữ lại ảnh hiện có, tải ảnh mới hoặc nhập URL ảnh.',
            'image_files.required_without_all' => 'Vui lòng giữ lại ảnh hiện có, tải ảnh mới hoặc nhập URL ảnh.',
            'image_files.*.mimes' => 'Ảnh cơ sở phải là file ảnh JPG, PNG, WEBP, GIF, SVG hoặc AVIF.',
            'image_files.*.max' => 'Ảnh cơ sở không được vượt quá 8MB.',
            'image_url.required_without_all' => 'Vui lòng giữ lại ảnh hiện có, tải ảnh mới hoặc nhập URL ảnh.',
            'image_url.url' => 'URL ảnh phải là một đường dẫn hợp lệ.',
        ];
    }
}
