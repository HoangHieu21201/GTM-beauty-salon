@extends('layouts.admin')

@section('title', 'Sửa cơ sở thẩm mỹ - Review Thẩm Mỹ Admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-[24px] font-bold text-[#1F2733]">Sửa cơ sở</h1>
        <a href="{{ route('admin.clinics.index') }}" class="text-primary hover:text-primary-dark font-medium text-sm flex items-center gap-2">
            <i class="pi pi-arrow-left"></i> Quay lại
        </a>
    </div>

    <form action="{{ route('admin.clinics.update', $clinic) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-5" data-loading-submit data-clinic-form data-images-required-message="Vui lòng giữ lại ảnh hiện có, tải ảnh mới hoặc nhập URL ảnh.">
        @csrf
        @method('PUT')
        <input type="hidden" name="form_token" value="{{ $formToken }}">
        <input type="hidden" name="images_synced" value="1">
        <div class="flex-1 bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
            @error('form_token')
                <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
                    {{ $message }}
                </div>
            @enderror

            <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Tên cơ sở <span class="text-red-500">*</span></label>
                <input name="name" value="{{ old('name', $clinic->name) }}" type="text" class="{{ $inputClass('name') }}" placeholder="Nhập tên cơ sở..." data-required-message="Vui lòng nhập tên cơ sở." @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
                @error('name')
                    <p id="name-error" class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Địa chỉ</label>
                <input name="address" value="{{ old('address', $clinic->address) }}" type="text" class="{{ $inputClass('address') }}" placeholder="Nhập địa chỉ cơ sở..." @error('address') aria-invalid="true" aria-describedby="address-error" @enderror>
                @error('address')
                    <p id="address-error" class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Điện thoại</label>
                    <input name="phone" value="{{ old('phone', $clinic->phone) }}" type="text" class="{{ $inputClass('phone') }}" placeholder="Nhập số điện thoại..." @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror>
                    @error('phone')
                        <p id="phone-error" class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Website</label>
                    <input name="website" value="{{ old('website', $clinic->website) }}" type="url" class="{{ $inputClass('website') }}" placeholder="https://..." @error('website') aria-invalid="true" aria-describedby="website-error" @enderror>
                    @error('website')
                        <p id="website-error" class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Mô tả</label>
                <textarea name="description" rows="4" class="{{ $inputClass('description', 'py-2.5') }}" placeholder="Nhập mô tả về cơ sở thẩm mỹ..." @error('description') aria-invalid="true" aria-describedby="description-error" @enderror>{{ old('description', $clinic->description) }}</textarea>
                @error('description')
                    <p id="description-error" class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Ảnh cơ sở</label>
                <div class="flex flex-wrap gap-3 mb-3" id="imagePreviewWrap">
                    @php
                        $clinicImages = [];
                        if ($clinic->image) {
                            $decodedImages = json_decode($clinic->image, true);
                            $clinicImages = is_array($decodedImages) ? $decodedImages : [$clinic->image];
                        }
                    @endphp
                    @foreach($clinicImages as $image)
                        <div data-existing-image-preview class="relative w-[110px] h-[75px] rounded-lg border border-gray-200">
                            <img src="{{ str_starts_with($image, 'http') ? $image : asset($image) }}" class="w-full h-full object-cover rounded-lg">
                            <input type="hidden" name="existing_images[]" value="{{ $image }}">
                            <button type="button" data-remove-preview class="absolute -top-2 -right-2 w-[18px] h-[18px] bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 shadow-sm">
                                <i class="pi pi-times text-[9px]"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="document.getElementById('image_file').click()" class="px-3 py-1.5 rounded-lg border border-gray-200 text-primary hover:bg-blue-50 text-sm font-semibold flex items-center gap-1.5 transition-colors bg-white">
                        <i class="pi pi-cloud-upload"></i> Tải ảnh lên
                    </button>
                    <input id="image_file" name="image_files[]" type="file" accept="image/*" multiple class="hidden">
                    <input name="image_url" value="{{ old('image_url') }}" type="text" class="flex-1 px-3 py-1.5 rounded-lg border {{ $errors->has('image_url') ? 'border-red-400 bg-red-50 text-red-700 focus:border-red-500' : 'border-gray-100 bg-gray-50 focus:bg-white focus:border-gray-200' }} text-sm outline-none" placeholder="hoặc dán URL ảnh rồi nhấn Enter" @error('image_url') aria-invalid="true" aria-describedby="image-url-error" @enderror>
                </div>
                @error('image_url')
                    <p id="image-url-error" class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                @enderror
                @error('image_files')
                    <p class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                @enderror
                @error('image_files.*')
                    <p class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="w-full lg:w-[320px] flex-shrink-0 space-y-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 space-y-5">
                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Điểm xếp hạng (score)</label>
                    <input name="score" value="{{ old('score', $clinic->score) }}" type="number" class="{{ $inputClass('score', 'mb-1') }}" placeholder="Ví dụ: 60" @error('score') aria-invalid="true" aria-describedby="score-error" @enderror>
                    <p class="text-[12px] text-gray-500 font-medium">Càng cao càng đứng đầu bảng xếp hạng.</p>
                    @error('score')
                        <p id="score-error" class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Rating (0-5)</label>
                        <input name="rating" value="{{ old('rating', $clinic->rating) }}" type="number" step="0.1" class="{{ $inputClass('rating') }}" placeholder="5.0" @error('rating') aria-invalid="true" aria-describedby="rating-error" @enderror>
                        @error('rating')
                            <p id="rating-error" class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Số đánh giá</label>
                        <input name="review_count" value="{{ old('review_count', $clinic->review_count) }}" type="number" data-clear-zero class="{{ $inputClass('review_count') }}" placeholder="500" @error('review_count') aria-invalid="true" aria-describedby="review-count-error" @enderror>
                        @error('review_count')
                            <p id="review-count-error" class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Danh mục</label>
                    <select name="category_id" class="{{ $selectClass('category_id') }}" @error('category_id') aria-invalid="true" aria-describedby="category-id-error" @enderror>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $clinic->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p id="category-id-error" class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-1">
                    <label class="flex items-center gap-3 cursor-pointer p-1">
                        <input name="is_featured" value="1" type="checkbox" @checked(old('is_featured', $clinic->is_featured)) class="w-[18px] h-[18px] rounded border-gray-300 accent-[#4D8AFF]">
                        <span class="text-[13px] font-bold text-gray-800">Cơ sở nổi bật</span>
                    </label>
                </div>

                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Trạng thái</label>
                    <select name="status" class="{{ $selectClass('status', $errors->has('status') ? '' : 'border-primary ring-2 ring-primary/10 text-gray-800') }}" @error('status') aria-invalid="true" aria-describedby="status-error" @enderror>
                        <option value="active" @selected(old('status', $clinic->status) === 'active')>Hiển thị</option>
                        <option value="inactive" @selected(old('status', $clinic->status) === 'inactive')>Ẩn</option>
                    </select>
                    @error('status')
                        <p id="status-error" class="mt-1.5 text-[12px] font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-1">
                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-2 rounded-lg transition-colors flex items-center justify-center gap-2 shadow-sm">
                        <i class="pi pi-save"></i> Lưu
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    const imageInput = document.getElementById('image_file');
    const imagePreviewWrap = document.getElementById('imagePreviewWrap');
    const selectedImages = new DataTransfer();
    const imageSyncUrl = @json(route('admin.clinics.images', $clinic, false));
    const csrfToken = @json(csrf_token());

    imageInput?.addEventListener('change', function () {
        selectedImages.items.clear();
        imagePreviewWrap.querySelectorAll('[data-existing-image-preview]').forEach((element) => element.remove());

        [...(this.files || [])].slice(0, 4 - selectedImages.files.length).forEach((file) => {
            selectedImages.items.add(file);
        });

        this.files = selectedImages.files;
        renderSelectedImages();
    });

    function renderSelectedImages() {
        imagePreviewWrap.querySelectorAll('[data-new-image-preview]').forEach((element) => element.remove());

        [...selectedImages.files].forEach((file, index) => {
            const url = URL.createObjectURL(file);
            imagePreviewWrap.insertAdjacentHTML('beforeend', `
                <div data-new-image-preview class="relative w-[110px] h-[75px] rounded-lg border border-gray-200">
                    <img src="${url}" class="w-full h-full object-cover rounded-lg">
                    <button type="button" data-remove-new-image="${index}" class="absolute -top-2 -right-2 w-[18px] h-[18px] bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 shadow-sm">
                        <i class="pi pi-times text-[9px]"></i>
                    </button>
                </div>
            `);
        });
    }

    imagePreviewWrap?.addEventListener('click', function (event) {
        const removeNewButton = event.target.closest('[data-remove-new-image]');

        if (removeNewButton) {
            const removeIndex = Number(removeNewButton.dataset.removeNewImage);
            const nextImages = new DataTransfer();

            [...selectedImages.files].forEach((file, index) => {
                if (index !== removeIndex) nextImages.items.add(file);
            });

            selectedImages.items.clear();
            [...nextImages.files].forEach((file) => selectedImages.items.add(file));
            imageInput.files = selectedImages.files;
            renderSelectedImages();
            return;
        }

        if (event.target.closest('[data-remove-preview]')) {
            const preview = event.target.closest('[data-existing-image-preview]');

            preview?.remove();
            syncExistingImages();
        }
    });

    function syncExistingImages() {
        const images = [...imagePreviewWrap.querySelectorAll('input[name="existing_images[]"]')]
            .map((input) => input.value)
            .filter(Boolean);

        fetch(imageSyncUrl, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                existing_images: images,
            }),
        }).then((response) => {
            if (!response.ok) {
                throw new Error('Image sync failed');
            }
        }).catch(() => {
            window.showToast?.('Không thể tự lưu ảnh vừa xóa. Vui lòng tải lại trang rồi thử lại.', 'error');
        });
    }

    document.querySelectorAll('[data-clear-zero]').forEach((input) => {
        input.addEventListener('focus', () => {
            if (input.value === '0') input.value = '';
        });

        input.addEventListener('blur', () => {
            if (input.value.trim() === '') input.value = '0';
        });
    });
</script>
@include('admin.pages.clinics.partials.client-validation')
@endpush
