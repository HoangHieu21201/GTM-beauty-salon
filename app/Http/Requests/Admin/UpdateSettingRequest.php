<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'footer_brand_desc' => 'nullable|string',
            'footer_copyright' => 'nullable|string',
            'site_logo_base64' => 'nullable|string',
            'site_logo_existing' => 'nullable|string',
            'footer_col_1_title' => 'nullable|string|max:255',
            'footer_col_2_title' => 'nullable|string|max:255',
            'footer_col_3_title' => 'nullable|string|max:255',
            'footer_col_1_links' => 'nullable|array',
            'footer_col_2_links' => 'nullable|array',
            'footer_col_3_links' => 'nullable|array',
            'footer_socials_links' => 'nullable|array',
        ];
    }
}
