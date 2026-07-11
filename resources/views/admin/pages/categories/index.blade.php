@extends('layouts.admin')

@section('title', 'Danh mục - Review Thẩm Mỹ Admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-[24px] font-bold text-[#1F2733] mb-1">Danh mục</h1>
        <p class="text-sm text-gray-500">Menu trang public hiển thị 2 cấp: danh mục gốc là mục cha trên thanh menu, mục nào có "Danh mục cha" sẽ nằm trong dropdown của cha đó.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3">
            <div class="bg-white rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[750px]">
                    <thead>
                        <tr class="bg-white border-b border-gray-100 text-[11px] uppercase tracking-wider font-bold text-gray-500">
                            <th class="py-3 px-4 w-[40%]">Tên danh mục</th>
                            <th class="py-3 px-4 w-[30%]">Slug</th>
                            <th class="py-3 px-4 w-[25%]">Danh mục cha</th>
                            <th class="py-3 px-4 w-[5%] text-center"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm" id="categoriesTableBody">
                        @forelse($categories as $category)
                            @php
                                $isChild = filled($category->parent_id);
                                $slug = \Illuminate\Support\Str::slug($category->name);
                            @endphp
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group" data-category-row="{{ $category->id }}">
                                <td class="py-3 px-4">
                                    <div class="{{ $isChild ? 'flex items-center gap-3 pl-6' : '' }}">
                                        @if($isChild)
                                            <i class="pi pi-angle-right text-gray-400 text-xs"></i>
                                        @endif
                                        <input
                                            type="text"
                                            name="name"
                                            value="{{ $category->name }}"
                                            data-original-value="{{ $category->name }}"
                                            data-category-name
                                            data-update-url="{{ route('admin.categories.update', $category) }}"
                                            class="inline-edit-input w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-[14px] text-gray-800"
                                        >
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="text-gray-500 text-[14px]" data-category-slug>/{{ $slug }}</span>
                                </td>
                                <td class="py-3 px-4">
                                    <select
                                        name="parent_id"
                                        data-original-value="{{ $category->parent_id }}"
                                        data-category-parent
                                        data-update-url="{{ route('admin.categories.update', $category) }}"
                                        @disabled($category->parent_id === null && $category->children->count() > 0)
                                        class="inline-edit-select w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary text-[14px] text-gray-600 transition-colors cursor-pointer disabled:bg-gray-100 disabled:cursor-not-allowed"
                                    >
                                        <option value="">— Danh mục gốc —</option>
                                        @foreach($rootCategories as $rootCategory)
                                            @if($rootCategory->id !== $category->id)
                                                <option value="{{ $rootCategory->id }}" @selected($category->parent_id === $rootCategory->id)>{{ $rootCategory->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <button
                                        type="button"
                                        data-delete-category
                                        data-delete-url="{{ route('admin.categories.destroy', $category) }}"
                                        class="text-red-400 hover:text-red-600 transition-colors p-2"
                                        title="Xóa"
                                    >
                                        <i class="pi pi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 px-4 text-center text-gray-500 text-[14px]">Chưa có danh mục nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 p-5 sticky top-[28px]">
                <h3 class="font-bold text-[16px] text-[#1F2733] mb-4">Thêm danh mục</h3>

                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4" data-loading-submit>
                    @csrf
                    <div>
                        <label class="block text-[13px] font-bold text-[#1F2733] mb-1.5">Tên</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-gray-400"
                            placeholder="VD: Nâng mũi"
                        >
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-[#1F2733] mb-1.5">Danh mục cha</label>
                        <select name="parent_id" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-[14px] text-gray-600 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors bg-white">
                            <option value="">— Danh mục gốc —</option>
                            @foreach($rootCategories as $rootCategory)
                                <option value="{{ $rootCategory->id }}" @selected((string) old('parent_id') === (string) $rootCategory->id)>{{ $rootCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-[#6B9DFE] hover:bg-[#5a8af0] text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2 shadow-sm text-[14px]">
                        <i class="pi pi-plus text-[12px]"></i> Thêm
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = @json(csrf_token());

        document.querySelectorAll('[data-category-name]').forEach((input) => {
            input.addEventListener('blur', function () {
                saveCategory(this.closest('[data-category-row]'), 'name');
            });

            input.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    this.blur();
                }
            });
        });

        document.querySelectorAll('[data-category-parent]').forEach((select) => {
            select.addEventListener('change', function () {
                saveCategory(this.closest('[data-category-row]'), 'parent_id');
            });
        });

        document.querySelectorAll('[data-delete-category]').forEach((button) => {
            button.addEventListener('click', async function () {
                const confirmed = window.confirmAction
                    ? await window.confirmAction({
                        title: 'Xóa danh mục',
                        message: 'Bạn có chắc chắn muốn xóa danh mục này?',
                    })
                    : window.confirm('Bạn có chắc chắn muốn xóa danh mục này?');

                if (!confirmed) return;

                deleteCategory(this);
            });
        });

        async function saveCategory(row, changedField) {
            if (!row) return;

            const nameInput = row.querySelector('[data-category-name]');
            const parentSelect = row.querySelector('[data-category-parent]');
            const name = nameInput.value.trim();
            const parentId = parentSelect.value;

            if (name === '') {
                rollbackField(nameInput, 'Tên danh mục không được để trống.');
                return;
            }

            const originalName = nameInput.dataset.originalValue || '';
            const originalParentId = parentSelect.dataset.originalValue || '';

            if (name === originalName && parentId === originalParentId) {
                nameInput.value = originalName;
                parentSelect.value = originalParentId;
                return;
            }

            setRowBusy(row, true);

            try {
                const response = await fetch(nameInput.dataset.updateUrl, {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        name: name,
                        parent_id: parentId || null,
                    }),
                });

                const payload = await response.json().catch(() => ({}));

                if (!response.ok) {
                    throw new Error(firstValidationMessage(payload) || payload.message || 'Không thể lưu danh mục.');
                }

                nameInput.value = payload.category.name;
                nameInput.dataset.originalValue = payload.category.name;
                parentSelect.dataset.originalValue = payload.category.parent_id || '';

                const slug = row.querySelector('[data-category-slug]');
                if (slug) slug.textContent = '/' + payload.category.slug;

                markSaved(changedField === 'parent_id' ? parentSelect : nameInput);
                window.showToast?.(payload.message || 'Đã lưu thay đổi.', 'success');

                if (changedField === 'parent_id') {
                    setTimeout(() => window.location.reload(), 450);
                }
            } catch (error) {
                if (changedField === 'parent_id') {
                    parentSelect.value = originalParentId;
                } else {
                    nameInput.value = originalName;
                }

                window.showToast?.(error.message, 'error');
            } finally {
                setRowBusy(row, false);
            }
        }

        async function deleteCategory(button) {
            const row = button.closest('[data-category-row]');
            const originalHtml = button.innerHTML;

            button.disabled = true;
            button.innerHTML = '<i class="pi pi-spin pi-spinner"></i>';

            try {
                const response = await fetch(button.dataset.deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                });

                const payload = await response.json().catch(() => ({}));

                if (!response.ok) {
                    throw new Error(firstValidationMessage(payload) || payload.message || 'Không thể xóa danh mục.');
                }

                row?.remove();
                window.showToast?.(payload.message || 'Đã xóa danh mục thành công.', 'success');
            } catch (error) {
                button.disabled = false;
                button.innerHTML = originalHtml;
                window.showToast?.(error.message, 'error');
            }
        }

        function rollbackField(input, message) {
            input.classList.add('bg-red-50', 'text-red-600');
            window.showToast?.(message, 'error');

            setTimeout(() => {
                input.value = input.dataset.originalValue || '';
                input.classList.remove('bg-red-50', 'text-red-600');
            }, 500);
        }

        function markSaved(input) {
            input.classList.add('bg-green-50', 'text-green-700');
            setTimeout(() => {
                input.classList.remove('bg-green-50', 'text-green-700');
            }, 600);
        }

        function setRowBusy(row, busy) {
            row.querySelectorAll('input, select, button').forEach((element) => {
                element.disabled = busy;
                element.classList.toggle('opacity-70', busy);
                element.classList.toggle('cursor-not-allowed', busy);
            });
        }

        function firstValidationMessage(payload) {
            if (!payload.errors) return null;

            const firstKey = Object.keys(payload.errors)[0];
            return firstKey ? payload.errors[firstKey][0] : null;
        }
    });
</script>
@endpush
