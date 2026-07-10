@extends('layouts.admin')

@section('title', 'Sửa cơ sở thẩm mỹ - Review Thẩm Mỹ Admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-[24px] font-bold text-[#1F2733]">Sửa cơ sở</h1>
        <a href="{{ route('admin.clinics.index') }}" class="text-primary hover:text-primary-dark font-medium text-sm flex items-center gap-2">
            <i class="pi pi-arrow-left"></i> Quay lại
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-100 rounded-lg p-4 mb-6 text-[14px] text-red-700 font-medium">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.clinics.update', $clinic) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-5">
        @csrf
        @method('PUT')
        <input type="hidden" name="images_synced" value="1">
        <div class="flex-1 bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
            <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Tên cơ sở <span class="text-red-500">*</span></label>
                <input name="name" value="{{ old('name', $clinic->name) }}" type="text" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="Nhập tên cơ sở...">
            </div>

            <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Địa chỉ</label>
                <input name="address" value="{{ old('address', $clinic->address) }}" type="text" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="Nhập địa chỉ cơ sở...">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Điện thoại</label>
                    <input name="phone" value="{{ old('phone', $clinic->phone) }}" type="text" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="Nhập số điện thoại...">
                </div>
                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Website</label>
                    <input name="website" value="{{ old('website', $clinic->website) }}" type="url" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="https://...">
                </div>
            </div>

            <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Mô tả</label>
                <textarea name="description" rows="4" class="w-full px-3 py-2.5 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="Nhập mô tả về cơ sở thẩm mỹ...">{{ old('description', $clinic->description) }}</textarea>
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
                    <input name="image_url" value="{{ old('image_url') }}" type="text" class="flex-1 px-3 py-1.5 rounded-lg border border-gray-100 bg-gray-50 text-sm outline-none focus:bg-white focus:border-gray-200" placeholder="hoặc dán URL ảnh rồi nhấn Enter">
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[320px] flex-shrink-0 space-y-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 space-y-5">
                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Điểm xếp hạng (score)</label>
                    <input name="score" value="{{ old('score', $clinic->score) }}" type="number" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm mb-1" placeholder="Ví dụ: 60">
                    <p class="text-[12px] text-gray-500 font-medium">Càng cao càng đứng đầu bảng xếp hạng.</p>
                </div>

                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Rating (0-5)</label>
                        <input name="rating" value="{{ old('rating', $clinic->rating) }}" type="number" step="0.1" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="5.0">
                    </div>
                    <div class="flex-1">
                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Số đánh giá</label>
                        <input name="review_count" value="{{ old('review_count', $clinic->review_count) }}" type="number" data-clear-zero class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="500">
                    </div>
                </div>

                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Danh mục</label>
                    <select name="category_id" class="w-full px-3 py-2 rounded-lg border border-gray-200 bg-white text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-gray-700">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $clinic->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-1">
                    <label class="flex items-center gap-3 cursor-pointer p-1">
                        <input name="is_featured" value="1" type="checkbox" @checked(old('is_featured', $clinic->is_featured)) class="w-[18px] h-[18px] rounded border-gray-300 accent-[#4D8AFF]">
                        <span class="text-[13px] font-bold text-gray-800">Cơ sở nổi bật</span>
                    </label>
                </div>

                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Trạng thái</label>
                    <select name="status" class="w-full px-3 py-2 rounded-lg border border-primary bg-white text-sm ring-2 ring-primary/10 outline-none transition text-gray-800">
                        <option value="active" @selected(old('status', $clinic->status) === 'active')>Hiển thị</option>
                        <option value="inactive" @selected(old('status', $clinic->status) === 'inactive')>Ẩn</option>
                    </select>
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
            alert('Không thể tự lưu ảnh vừa xóa. Vui lòng tải lại trang rồi thử lại.');
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
@endpush
