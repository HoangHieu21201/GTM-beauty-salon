@extends('layouts.admin')

@section('title', 'Người dùng - Review Thẩm Mỹ Admin')

@section('content')
<div class="mb-6">
    <h1 class="text-[24px] font-bold text-[#1F2733]">Người dùng quản trị</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
    <!-- Cột trái: Bảng danh sách người dùng -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-[11px] uppercase tracking-wider font-bold text-gray-500">
                        <th class="py-4 px-5">TÊN</th>
                        <th class="py-4 px-5">EMAIL</th>
                        <th class="py-4 px-5">VAI TRÒ</th>
                        <th class="py-4 px-5 text-center"></th>
                    </tr>
                </thead>
                <tbody class="text-[14px]">
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-all duration-300">
                        <td class="py-4 px-5 text-[#1F2733]">admin</td>
                        <td class="py-4 px-5 text-gray-500">nguyendong09052005@gmail.com</td>
                        <td class="py-4 px-5">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-bold bg-[#EBF3FF] text-[#1668DC]">
                                admin
                            </span>
                        </td>
                        <td class="py-4 px-5 text-center">
                            <button class="text-red-400 hover:text-red-600 transition-colors p-1" title="Xóa" onclick="confirmDelete(this)">
                                <i class="pi pi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-all duration-300">
                        <td class="py-4 px-5 text-[#1F2733]">Quản trị viên</td>
                        <td class="py-4 px-5 text-gray-500">admin@example.com</td>
                        <td class="py-4 px-5">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-bold bg-green-100 text-green-700">
                                superadmin
                            </span>
                        </td>
                        <td class="py-4 px-5 text-center">
                            <button class="text-red-400 hover:text-red-600 transition-colors p-1" title="Xóa" onclick="confirmDelete(this)">
                                <i class="pi pi-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Cột phải: Form tạo người dùng -->
    <div class="bg-white rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 p-6">
        <h2 class="text-[18px] font-bold text-[#1F2733] mb-5">Tạo người dùng</h2>
        <form action="#" method="POST" class="space-y-4">
            <div>
                <label class="block text-[13px] font-bold text-[#1F2733] mb-1">Tên</label>
                <input type="text" class="w-full border border-gray-200 rounded-md p-2.5 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" />
            </div>
            <div>
                <label class="block text-[13px] font-bold text-[#1F2733] mb-1">Email</label>
                <input type="email" class="w-full border border-gray-200 rounded-md p-2.5 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" />
            </div>
            <div>
                <label class="block text-[13px] font-bold text-[#1F2733] mb-1">Mật khẩu</label>
                <input type="password" class="w-full border border-gray-200 rounded-md p-2.5 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" />
            </div>
            <div>
                <label class="block text-[13px] font-bold text-[#1F2733] mb-1">Vai trò</label>
                <select class="w-full border border-gray-200 rounded-md p-2.5 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors bg-white text-[#1F2733] cursor-pointer appearance-none">
                    <option value="admin">admin</option>
                    <option value="superadmin">superadmin</option>
                </select>
            </div>
            <div class="pt-2">
                <button type="button" class="w-full bg-primary hover:bg-[#1557b0] text-white rounded-md py-2.5 text-[14px] font-medium flex items-center justify-center gap-2 transition-colors shadow-sm" onclick="window.showToast('Đã tạo người dùng mới!', 'success')">
                    <i class="pi pi-plus text-[12px]"></i> Tạo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(btn) {
        if(confirm('Bạn có chắc chắn muốn xóa người dùng này?')) {
            // Giả lập xóa thành công
            const row = btn.closest('tr');
            row.style.opacity = '0';
            setTimeout(() => {
                row.remove();
                window.showToast('Đã xóa người dùng', 'success');
            }, 300);
        }
    }
</script>
<!-- Tinh chỉnh nhỏ cho cái mũi tên select -->
<style>
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
    }
</style>
@endpush
