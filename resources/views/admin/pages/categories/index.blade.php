@extends('layouts.admin')

@section('title', 'Danh mục - Review Thẩm Mỹ Admin')

@section('content')
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-[24px] font-bold text-[#1F2733] mb-1">Danh mục</h1>
        <p class="text-sm text-gray-500">Menu trang public hiển thị 2 cấp: danh mục gốc là mục cha trên thanh menu, mục nào có "Danh mục cha" sẽ nằm trong dropdown của cha đó.</p>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Categories Table (Left Column) -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[750px]">
                    <thead>
                        <tr class="bg-white border-b border-gray-100 text-[11px] uppercase tracking-wider font-bold text-gray-500">
                            <th class="py-3 px-4 w-[40%]">TÊN DANH MỤC</th>
                            <th class="py-3 px-4 w-[30%]">SLUG</th>
                            <th class="py-3 px-4 w-[25%]">DANH MỤC CHA</th>
                            <th class="py-3 px-4 w-[5%] text-center"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <!-- Parent Category 1 -->
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group">
                            <td class="py-3 px-4">
                                <input type="text" class="inline-edit-input w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-[14px] text-gray-800" value="Phẫu thuật thẩm mỹ" data-original-value="Phẫu thuật thẩm mỹ">
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-gray-500 text-[14px]">/phau-thuat-tham-my</span>
                            </td>
                            <td class="py-3 px-4">
                                <select class="inline-edit-select w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary text-[14px] text-gray-600 transition-colors cursor-pointer" data-original-value="">
                                    <option value="">&mdash; Danh mục gốc &mdash;</option>
                                    <option value="1">Chăm sóc da</option>
                                    <option value="2">Răng - Hàm - Mặt</option>
                                </select>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <button class="text-red-400 hover:text-red-600 transition-colors p-2" title="Xóa">
                                    <i class="pi pi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Child 1.1 -->
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3 pl-6">
                                    <i class="pi pi-angle-right text-gray-400 text-xs"></i>
                                    <input type="text" class="inline-edit-input w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-[14px] text-gray-800" value="Nâng mũi" data-original-value="Nâng mũi">
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-gray-500 text-[14px]">/nang-mui</span>
                            </td>
                            <td class="py-3 px-4">
                                <select class="inline-edit-select w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary text-[14px] text-gray-600 transition-colors cursor-pointer" data-original-value="3">
                                    <option value="">&mdash; Danh mục gốc &mdash;</option>
                                    <option value="3" selected>Phẫu thuật thẩm mỹ</option>
                                    <option value="1">Chăm sóc da</option>
                                    <option value="2">Răng - Hàm - Mặt</option>
                                </select>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <button class="text-red-400 hover:text-red-600 transition-colors p-2" title="Xóa">
                                    <i class="pi pi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Child 1.2 -->
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3 pl-6">
                                    <i class="pi pi-angle-right text-gray-400 text-xs"></i>
                                    <input type="text" class="inline-edit-input w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-[14px] text-gray-800" value="Nâng ngực" data-original-value="Nâng ngực">
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-gray-500 text-[14px]">/nang-nguc</span>
                            </td>
                            <td class="py-3 px-4">
                                <select class="inline-edit-select w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary text-[14px] text-gray-600 transition-colors cursor-pointer" data-original-value="3">
                                    <option value="">&mdash; Danh mục gốc &mdash;</option>
                                    <option value="3" selected>Phẫu thuật thẩm mỹ</option>
                                    <option value="1">Chăm sóc da</option>
                                    <option value="2">Răng - Hàm - Mặt</option>
                                </select>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <button class="text-red-400 hover:text-red-600 transition-colors p-2" title="Xóa">
                                    <i class="pi pi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Child 1.3 -->
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3 pl-6">
                                    <i class="pi pi-angle-right text-gray-400 text-xs"></i>
                                    <input type="text" class="inline-edit-input w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-[14px] text-gray-800" value="Cắt mí" data-original-value="Cắt mí">
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-gray-500 text-[14px]">/cat-mi</span>
                            </td>
                            <td class="py-3 px-4">
                                <select class="inline-edit-select w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary text-[14px] text-gray-600 transition-colors cursor-pointer" data-original-value="3">
                                    <option value="">&mdash; Danh mục gốc &mdash;</option>
                                    <option value="3" selected>Phẫu thuật thẩm mỹ</option>
                                    <option value="1">Chăm sóc da</option>
                                    <option value="2">Răng - Hàm - Mặt</option>
                                </select>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <button class="text-red-400 hover:text-red-600 transition-colors p-2" title="Xóa">
                                    <i class="pi pi-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Parent Category 2 -->
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group">
                            <td class="py-3 px-4">
                                <input type="text" class="inline-edit-input w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-[14px] text-gray-800" value="Chăm sóc da" data-original-value="Chăm sóc da">
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-gray-500 text-[14px]">/cham-soc-da</span>
                            </td>
                            <td class="py-3 px-4">
                                <select class="inline-edit-select w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary text-[14px] text-gray-600 transition-colors cursor-pointer" data-original-value="">
                                    <option value="" selected>&mdash; Danh mục gốc &mdash;</option>
                                    <option value="3">Phẫu thuật thẩm mỹ</option>
                                    <option value="2">Răng - Hàm - Mặt</option>
                                </select>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <button class="text-red-400 hover:text-red-600 transition-colors p-2" title="Xóa">
                                    <i class="pi pi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Child 2.1 -->
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3 pl-6">
                                    <i class="pi pi-angle-right text-gray-400 text-xs"></i>
                                    <input type="text" class="inline-edit-input w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-[14px] text-gray-800" value="Trẻ hóa da" data-original-value="Trẻ hóa da">
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-gray-500 text-[14px]">/tre-hoa-da</span>
                            </td>
                            <td class="py-3 px-4">
                                <select class="inline-edit-select w-full border border-gray-200 bg-white rounded-md px-3 py-2 outline-none focus:border-primary focus:ring-1 focus:ring-primary text-[14px] text-gray-600 transition-colors cursor-pointer" data-original-value="1">
                                    <option value="">&mdash; Danh mục gốc &mdash;</option>
                                    <option value="3">Phẫu thuật thẩm mỹ</option>
                                    <option value="1" selected>Chăm sóc da</option>
                                    <option value="2">Răng - Hàm - Mặt</option>
                                </select>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <button class="text-red-400 hover:text-red-600 transition-colors p-2" title="Xóa">
                                    <i class="pi pi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Category Form (Right Column) -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 p-5 sticky top-[28px]">
                <h3 class="font-bold text-[16px] text-[#1F2733] mb-4">Thêm danh mục</h3>
                
                <form action="#" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-[13px] font-bold text-[#1F2733] mb-1.5">Tên</label>
                        <input type="text" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors placeholder:text-gray-400" placeholder="VD: Nâng mũi">
                    </div>
                    
                    <div>
                        <label class="block text-[13px] font-bold text-[#1F2733] mb-1.5">Danh mục cha</label>
                        <select class="w-full border border-gray-200 rounded-lg px-3 py-2 text-[14px] text-gray-600 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors bg-white">
                            <option value="">&mdash; Danh mục gốc &mdash;</option>
                            <option value="3">Phẫu thuật thẩm mỹ</option>
                            <option value="1">Chăm sóc da</option>
                            <option value="2">Răng - Hàm - Mặt</option>
                        </select>
                    </div>

                    <button type="button" onclick="window.showToast('Thêm thành công', 'success')" class="w-full bg-[#6B9DFE] hover:bg-[#5a8af0] text-white font-semibold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2 shadow-sm text-[14px]">
                        <i class="pi pi-plus text-[12px]"></i> Thêm
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Setup inline editing for Text Inputs
        const textInputs = document.querySelectorAll('.inline-edit-input');
        
        textInputs.forEach(input => {
            // Validate and save on blur
            input.addEventListener('blur', function() {
                validateAndSaveInput(this);
            });

            // Validate and save on Enter key
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.blur(); // Triggers the blur event
                }
            });
        });

        function validateAndSaveInput(input) {
            const newValue = input.value.trim();
            const originalValue = input.getAttribute('data-original-value');

            // Skip if not changed
            if (newValue === originalValue) {
                input.value = originalValue; // Reset formatting if any
                return;
            }

            // Validation: Cannot be empty
            if (newValue === '') {
                if(window.showToast) {
                    window.showToast('Tên danh mục không được để trống!', 'error');
                }
                
                // Rollback with visual feedback
                input.classList.add('bg-red-50', 'text-red-600');
                setTimeout(() => {
                    input.value = originalValue;
                    input.classList.remove('bg-red-50', 'text-red-600');
                }, 500);
                
                return;
            }

            // Simulate API Call / Save successful
            input.setAttribute('data-original-value', newValue);
            
            // Update slug format temporarily just for visual demo
            const slugCell = input.closest('tr').querySelector('td:nth-child(2) span');
            if(slugCell) {
                const newSlug = '/' + newValue.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                slugCell.textContent = newSlug;
            }
            
            // Visual success feedback
            input.classList.add('bg-green-50', 'text-green-700');
            setTimeout(() => {
                input.classList.remove('bg-green-50', 'text-green-700');
            }, 600);
            
            if(window.showToast) {
                window.showToast('Đã lưu thay đổi!', 'success');
            }
        }

        // Setup inline editing for Select Dropdowns
        const selects = document.querySelectorAll('.inline-edit-select');
        
        selects.forEach(select => {
            select.addEventListener('change', function() {
                const newValue = this.value;
                const originalValue = this.getAttribute('data-original-value');

                // Simulate API save
                this.setAttribute('data-original-value', newValue);
                
                // Visual success feedback
                this.classList.add('bg-green-50', 'text-green-700');
                setTimeout(() => {
                    this.classList.remove('bg-green-50', 'text-green-700');
                }, 600);

                if(window.showToast) {
                    window.showToast('Đã thay đổi danh mục cha!', 'success');
                }
            });
        });
    });
</script>
@endpush
