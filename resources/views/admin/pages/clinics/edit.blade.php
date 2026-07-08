@extends('layouts.admin')

@section('title', 'Sửa cơ sở thẩm mỹ - Review Thẩm Mỹ Admin')

@section('content')
    <!-- Top Header Bar -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-[24px] font-bold text-[#1F2733]">Sửa cơ sở</h1>
        <a href="{{ url('/admin/clinics') }}" class="text-primary hover:text-primary-dark font-medium text-sm flex items-center gap-2">
            <i class="pi pi-arrow-left"></i> Quay lại
        </a>
    </div>

    <form action="#" method="POST" class="flex flex-col lg:flex-row gap-5">
        <!-- Left Column -->
        <div class="flex-1 bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
            
            <!-- Tên cơ sở -->
            <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Tên cơ sở <span class="text-red-500">*</span></label>
                <input type="text" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="Nhập tên cơ sở...">
            </div>

            <!-- Địa chỉ -->
            <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Địa chỉ</label>
                <input type="text" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="Nhập địa chỉ cơ sở...">
            </div>

            <!-- Điện thoại & Website -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Điện thoại</label>
                    <input type="text" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="Nhập số điện thoại...">
                </div>
                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Website</label>
                    <input type="url" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="https://...">
                </div>
            </div>

            <!-- Mô tả -->
            <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Mô tả</label>
                <textarea rows="4" class="w-full px-3 py-2.5 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="Nhập mô tả về cơ sở thẩm mỹ..."></textarea>
            </div>

            <!-- Ảnh cơ sở -->
            <div>
                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Ảnh cơ sở</label>
                <div class="flex flex-wrap gap-3 mb-3">
                    <!-- Image Mockup -->
                    <div class="relative w-[110px] h-[75px] rounded-lg border border-gray-200">
                        <img src="https://picsum.photos/200/150?random=1" class="w-full h-full object-cover rounded-lg">
                        <button type="button" class="absolute -top-2 -right-2 w-[18px] h-[18px] bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 shadow-sm">
                            <i class="pi pi-times text-[9px]"></i>
                        </button>
                    </div>
                    <div class="relative w-[110px] h-[75px] rounded-lg border border-gray-200">
                        <img src="https://picsum.photos/200/150?random=2" class="w-full h-full object-cover grayscale rounded-lg">
                        <button type="button" class="absolute -top-2 -right-2 w-[18px] h-[18px] bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 shadow-sm">
                            <i class="pi pi-times text-[9px]"></i>
                        </button>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" class="px-3 py-1.5 rounded-lg border border-gray-200 text-primary hover:bg-blue-50 text-sm font-semibold flex items-center gap-1.5 transition-colors bg-white">
                        <i class="pi pi-cloud-upload"></i> Tải ảnh lên
                    </button>
                    <input type="text" class="flex-1 px-3 py-1.5 rounded-lg border border-gray-100 bg-gray-50 text-sm outline-none focus:bg-white focus:border-gray-200" placeholder="hoặc dán URL ảnh rồi nhấn Enter">
                </div>
            </div>
            
        </div>

        <!-- Right Column -->
        <div class="w-full lg:w-[320px] flex-shrink-0 space-y-5">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 space-y-5">
                
                <!-- Điểm xếp hạng -->
                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Điểm xếp hạng (score)</label>
                    <input type="number" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm mb-1" placeholder="Ví dụ: 60">
                    <p class="text-[12px] text-gray-500 font-medium">Càng cao càng đứng đầu bảng xếp hạng.</p>
                </div>

                <!-- Rating & Số đánh giá -->
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Rating (0-5)</label>
                        <input type="number" step="0.1" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="5.0">
                    </div>
                    <div class="flex-1">
                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Số đánh giá</label>
                        <input type="number" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-sm" placeholder="500">
                    </div>
                </div>

                <!-- Danh mục -->
                <div class="relative" id="categoryDropdownWrapper">
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Danh mục</label>
                    <button type="button" onclick="toggleDropdown('categoryDropdown')" class="w-full px-3 py-2 rounded-lg border border-gray-200 bg-white flex justify-between items-center text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition text-gray-700 text-left">
                        <span class="truncate">Chọn danh mục</span>
                        <i class="pi pi-chevron-down text-gray-400 text-[12px]"></i>
                    </button>
                    <!-- Dropdown Content -->
                    <div id="categoryDropdown" class="hidden absolute top-full left-0 right-0 mt-2 bg-white border border-gray-100 shadow-[0_10px_40px_rgba(0,0,0,0.08)] rounded-xl z-50 overflow-hidden">
                        <div class="p-3 border-b border-gray-50">
                            <div class="relative">
                                <input type="text" class="w-full pl-3 pr-8 py-2 border border-gray-200 rounded-lg text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Tìm kiếm...">
                                <i class="pi pi-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>
                        <div class="max-h-[220px] overflow-y-auto p-2 scrollbar-thin">
                            <!-- Options -->
                            <label class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <input type="checkbox" class="w-[18px] h-[18px] rounded border-gray-300 accent-[#4D8AFF]">
                                <span class="text-sm text-gray-700">Niềng răng</span>
                            </label>
                            <label class="flex items-center gap-3 px-3 py-2 bg-blue-50/40 hover:bg-blue-50/80 rounded-lg cursor-pointer">
                                <input type="checkbox" checked class="w-[18px] h-[18px] rounded border-gray-300 accent-[#4D8AFF]">
                                <span class="text-sm text-primary font-medium">Nâng mũi</span>
                            </label>
                            <label class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <input type="checkbox" class="w-[18px] h-[18px] rounded border-gray-300 accent-[#4D8AFF]">
                                <span class="text-sm text-gray-700">Phẫu thuật thẩm mỹ</span>
                            </label>
                            <label class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <input type="checkbox" class="w-[18px] h-[18px] rounded border-gray-300 accent-[#4D8AFF]">
                                <span class="text-sm text-gray-700">Trẻ hóa da</span>
                            </label>
                            <label class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <input type="checkbox" class="w-[18px] h-[18px] rounded border-gray-300 accent-[#4D8AFF]">
                                <span class="text-sm text-gray-700">Bọc răng sứ</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Cơ sở nổi bật -->
                <div class="pt-1">
                    <label class="flex items-center gap-3 cursor-pointer p-1">
                        <input type="checkbox" checked class="w-[18px] h-[18px] rounded border-gray-300 accent-[#4D8AFF]">
                        <span class="text-[13px] font-bold text-gray-800">Cơ sở nổi bật</span>
                    </label>
                </div>

                <!-- Trạng thái -->
                <div class="relative" id="statusDropdownWrapper">
                    <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Trạng thái</label>
                    <button type="button" onclick="toggleDropdown('statusDropdown')" class="w-full px-3 py-2 rounded-lg border border-primary bg-white flex justify-between items-center text-sm ring-2 ring-primary/10 outline-none transition text-gray-800">
                        <span>Hiển thị</span>
                        <i class="pi pi-chevron-down text-gray-400 text-[12px]"></i>
                    </button>
                    <!-- Dropdown Content -->
                    <div id="statusDropdown" class="hidden absolute top-full left-0 right-0 mt-2 bg-white border border-gray-100 shadow-[0_10px_40px_rgba(0,0,0,0.08)] rounded-xl z-50 overflow-hidden py-1">
                        <button type="button" class="w-full text-left px-3 py-2 hover:bg-blue-50/80 text-sm text-primary font-medium transition-colors bg-blue-50/40">Hiển thị</button>
                        <button type="button" class="w-full text-left px-3 py-2 hover:bg-gray-50 text-sm text-gray-700 transition-colors">Ẩn</button>
                    </div>
                </div>

                <!-- Nút Lưu -->
                <div class="pt-1">
                    <button type="button" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-2 rounded-lg transition-colors flex items-center justify-center gap-2 shadow-sm">
                        <i class="pi pi-save"></i> Lưu
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const isHidden = dropdown.classList.contains('hidden');
        
        // Hide all other dropdowns
        document.querySelectorAll('[id$="Dropdown"]').forEach(el => el.classList.add('hidden'));
        
        if (isHidden) {
            dropdown.classList.remove('hidden');
            // If it's the category dropdown, maybe simulate focus state on the button
            const button = document.querySelector(`[onclick="toggleDropdown('${id}')"]`);
            if(button && !button.classList.contains('border-primary')) {
                 // For status dropdown which already has border-primary in the mock, this is optional
                 // We can leave it as CSS handles :focus, but since we use click, let's keep it simple.
            }
        }
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('#categoryDropdownWrapper') && !e.target.closest('#statusDropdownWrapper')) {
            document.querySelectorAll('[id$="Dropdown"]').forEach(el => el.classList.add('hidden'));
        }
    });
</script>
@endpush
