@extends('layouts.admin')

@section('title', 'Người dùng - Review Thẩm Mỹ Admin')

@section('content')
<div class="mb-6">
    <h1 class="text-[24px] font-bold text-[#1F2733]">Người dùng quản trị</h1>
</div>

@if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-600 rounded-[var(--radius)] p-4 text-sm mb-6">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
                    @foreach($users as $user)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-all duration-300">
                        <td class="py-4 px-5 text-[#1F2733]">{{ $user->name }}</td>
                        <td class="py-4 px-5 text-gray-500">{{ $user->email }}</td>
                        <td class="py-4 px-5">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-bold {{ $user->role && $user->role->name === 'superadmin' ? 'bg-green-100 text-green-700' : 'bg-[#EBF3FF] text-[#1668DC]' }}">
                                {{ $user->role ? $user->role->name : 'N/A' }}
                            </span>
                        </td>
                        <td class="py-4 px-5 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button class="text-blue-400 hover:text-blue-600 transition-colors p-1" title="Sửa" onclick="openEditModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}', {{ $user->role_id ?? 'null' }})">
                                    <i class="pi pi-pencil"></i>
                                </button>
                                @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" data-confirm-submit data-confirm-title="Xóa người dùng" data-confirm-message="Bạn có chắc chắn muốn xóa người dùng '{{ $user->name }}' này?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition-colors p-1" title="Xóa">
                                        <i class="pi pi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Cột phải: Form tạo người dùng -->
    <div class="bg-white rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 p-6">
        <h2 class="text-[18px] font-bold text-[#1F2733] mb-5">Tạo người dùng</h2>
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[13px] font-bold text-[#1F2733] mb-1">Tên</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-200 rounded-md p-2.5 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" />
            </div>
            <div>
                <label class="block text-[13px] font-bold text-[#1F2733] mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-200 rounded-md p-2.5 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" />
            </div>
            <div>
                <label class="block text-[13px] font-bold text-[#1F2733] mb-1">Mật khẩu</label>
                <input type="password" name="password" required class="w-full border border-gray-200 rounded-md p-2.5 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" />
            </div>
            <div>
                <label class="block text-[13px] font-bold text-[#1F2733] mb-1">Vai trò</label>
                <div class="flex gap-2">
                    <select name="role_id" id="role_id_select" required class="flex-1 border border-gray-200 rounded-md p-2.5 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors bg-white text-[#1F2733] cursor-pointer appearance-none">
                        <option value="">-- Chọn vai trò --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-2 flex gap-2">
                    <input type="text" id="new_role_name" placeholder="Tên vai trò mới..." class="flex-1 border border-gray-200 rounded-md p-2 text-[13px] focus:outline-none focus:border-primary" />
                    <button type="button" onclick="addNewRole()" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-2 rounded-md font-bold transition-colors" title="Thêm vai trò mới">
                        <i class="pi pi-plus text-[12px]"></i>
                    </button>
                </div>
            </div>
            <div class="pt-2">
                <button type="submit" class="w-full bg-primary hover:bg-[#1557b0] text-white rounded-md py-2.5 text-[14px] font-medium flex items-center justify-center gap-2 transition-colors shadow-sm">
                    <i class="pi pi-plus text-[12px]"></i> Tạo người dùng
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black/50 transition-opacity">
    <div class="bg-white rounded-xl shadow-lg w-[400px] p-6 relative">
        <button onclick="closeEditModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-1">
            <i class="pi pi-times"></i>
        </button>
        <h2 class="text-[18px] font-bold text-[#1F2733] mb-5">Sửa người dùng</h2>
        <form id="editForm" action="" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-[13px] font-bold text-[#1F2733] mb-1">Tên</label>
                <input type="text" name="name" id="edit_name" required class="w-full border border-gray-200 rounded-md p-2.5 text-[14px] focus:outline-none focus:border-primary" />
            </div>
            <div>
                <label class="block text-[13px] font-bold text-[#1F2733] mb-1">Email</label>
                <input type="email" name="email" id="edit_email" required class="w-full border border-gray-200 rounded-md p-2.5 text-[14px] focus:outline-none focus:border-primary" />
            </div>
            <div>
                <label class="block text-[13px] font-bold text-[#1F2733] mb-1">Vai trò</label>
                <select name="role_id" id="edit_role_id" required class="w-full border border-gray-200 rounded-md p-2.5 text-[14px] focus:outline-none focus:border-primary bg-white appearance-none cursor-pointer">
                    <option value="">-- Chọn vai trò --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[13px] font-bold text-[#1F2733] mb-1">Mật khẩu mới</label>
                <input type="password" name="password" placeholder="Để trống nếu không đổi" class="w-full border border-gray-200 rounded-md p-2.5 text-[14px] focus:outline-none focus:border-primary" />
            </div>
            <div class="pt-2 flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md font-medium transition-colors">Hủy</button>
                <button type="submit" class="px-4 py-2 bg-primary hover:bg-[#1557b0] text-white rounded-md font-medium transition-colors">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openEditModal(id, name, email, role_id) {
        document.getElementById('editForm').action = `/admin/users/${id}`;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        if(role_id) {
            document.getElementById('edit_role_id').value = role_id;
        }
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function addNewRole() {
        const roleInput = document.getElementById('new_role_name');
        const roleName = roleInput.value.trim();
        if (!roleName) return;

        fetch('{{ route('admin.roles.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ name: roleName })
        })
        .then(response => response.json().then(data => ({status: response.status, body: data})))
        .then(({status, body}) => {
            if (status === 200 && body.success) {
                // Add to main select
                const option = new Option(body.role.name, body.role.id, false, true);
                document.getElementById('role_id_select').add(option);
                
                // Add to edit select
                const editOption = new Option(body.role.name, body.role.id);
                document.getElementById('edit_role_id').add(editOption);

                roleInput.value = '';
                if(window.showToast) window.showToast('Đã thêm vai trò: ' + body.role.name, 'success');
            } else {
                if(body.message) {
                    if(window.showToast) window.showToast(body.message, 'error');
                } else {
                    if(window.showToast) window.showToast('Có lỗi xảy ra, tên vai trò có thể bị trùng', 'error');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if(window.showToast) window.showToast('Lỗi khi kết nối mạng', 'error');
        });
    }
</script>
<style>
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
    }
</style>
@endpush
