@extends('layouts.admin')

@section('title', 'Bình luận - Review Thẩm Mỹ Admin')

@section('content')
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-[24px] font-bold text-[#1F2733] mb-4">Bình luận</h1>
        
        <!-- Filters -->
        <div class="flex items-center gap-2 mb-2">
            <button onclick="switchTab('pending')" id="tab-pending" class="tab-btn px-4 py-2 text-[14px] font-medium text-white bg-primary border border-primary rounded-full shadow-sm transition-all duration-300">Chờ duyệt</button>
            <button onclick="switchTab('approved')" id="tab-approved" class="tab-btn px-4 py-2 text-[14px] font-medium text-gray-700 bg-white border border-gray-200 rounded-full hover:bg-gray-50 shadow-sm transition-all duration-300">Đã duyệt</button>
            <button onclick="switchTab('all')" id="tab-all" class="tab-btn px-4 py-2 text-[14px] font-medium text-gray-700 bg-white border border-gray-200 rounded-full hover:bg-gray-50 shadow-sm transition-all duration-300">Tất cả</button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-xl shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[900px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-[11px] uppercase tracking-wider font-bold text-gray-500">
                        <th class="py-4 px-5 w-[45%]">BÌNH LUẬN</th>
                        <th class="py-4 px-5 w-[25%]">BÀI VIẾT</th>
                        <th class="py-4 px-5 w-[10%]">TRẠNG THÁI</th>
                        <th class="py-4 px-5 w-[12%]">NGÀY GỬI</th>
                        <th class="py-4 px-5 w-[8%] text-center"></th>
                    </tr>
                </thead>
                <tbody class="text-[14px]" id="comments-tbody">
                    <!-- Comment 1: Chờ duyệt -->
                    <tr class="comment-row border-b border-gray-50 hover:bg-gray-50/50 transition-all duration-500 opacity-100 align-top" data-status="pending">
                        <td class="py-4 px-5">
                            <div class="font-bold text-[#1F2733] mb-1">Khách ẩn danh</div>
                            <div class="text-gray-700 leading-relaxed mb-3">
                                Bình luận này đang chờ kiểm duyệt (demo).
                            </div>

                            <!-- Inline Reply Box (Hidden by default) -->
                            <div id="reply-box-1" class="hidden bg-gray-50 rounded-lg p-3 border border-gray-200 mt-2 transition-all">
                                <textarea rows="3" class="w-full border border-gray-200 rounded-md p-3 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors resize-none placeholder-gray-400" placeholder="Nội dung trả lời..."></textarea>
                                <div class="flex items-center gap-2 mt-3">
                                    <button class="bg-[#6B9DFE] hover:bg-[#5a8af0] text-white px-4 py-2 rounded-md text-[14px] font-medium transition-colors flex items-center gap-2 shadow-sm" onclick="window.showToast('Đã gửi câu trả lời!', 'success'); toggleReplyBox('1')">
                                        <i class="pi pi-send text-[12px]"></i> Gửi trả lời
                                    </button>
                                    <button class="text-gray-600 hover:bg-gray-200 px-4 py-2 rounded-md text-[14px] font-medium transition-colors" onclick="toggleReplyBox('1')">Hủy</button>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-5">
                            <a href="#" class="text-primary hover:underline font-medium text-[13px] leading-tight block">Hút mỡ bụng 2026: chi phí, công nghệ và những sự thật ít ai nói</a>
                        </td>
                        <td class="py-4 px-5">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-medium bg-amber-100 text-amber-700">
                                Chờ duyệt
                            </span>
                        </td>
                        <td class="py-4 px-5 text-gray-500 text-[13px]">
                            05/07/2026 09:35
                        </td>
                        <td class="py-4 px-5">
                            <div class="flex items-center justify-center gap-3">
                                <button onclick="toggleReplyBox('1')" class="text-primary hover:text-primary-dark transition-colors p-1" title="Trả lời">
                                    <i class="pi pi-reply"></i>
                                </button>
                                <button class="text-red-400 hover:text-red-600 transition-colors p-1" title="Xóa">
                                    <i class="pi pi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Comment 2: Đã duyệt -->
                    <tr class="comment-row hidden opacity-0 border-b border-gray-50 hover:bg-gray-50/50 transition-all duration-500 align-top" data-status="approved">
                        <td class="py-4 px-5">
                            <div class="font-bold text-[#1F2733] mb-1">Thu Hà</div>
                            <div class="text-gray-700 leading-relaxed mb-3">
                                Mình từng làm ở đây rồi, dịch vụ ổn, bác sĩ tư vấn kỹ.
                            </div>

                            <!-- Inline Reply Box -->
                            <div id="reply-box-2" class="hidden bg-gray-50 rounded-lg p-3 border border-gray-200 mt-2 transition-all">
                                <textarea rows="3" class="w-full border border-gray-200 rounded-md p-3 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors resize-none placeholder-gray-400" placeholder="Nội dung trả lời..."></textarea>
                                <div class="flex items-center gap-2 mt-3">
                                    <button class="bg-[#6B9DFE] hover:bg-[#5a8af0] text-white px-4 py-2 rounded-md text-[14px] font-medium transition-colors flex items-center gap-2 shadow-sm" onclick="window.showToast('Đã gửi câu trả lời!', 'success'); toggleReplyBox('2')">
                                        <i class="pi pi-send text-[12px]"></i> Gửi trả lời
                                    </button>
                                    <button class="text-gray-600 hover:bg-gray-200 px-4 py-2 rounded-md text-[14px] font-medium transition-colors" onclick="toggleReplyBox('2')">Hủy</button>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-5">
                            <a href="#" class="text-primary hover:underline font-medium text-[13px] leading-tight block">Hút mỡ bụng 2026: chi phí, công nghệ và những sự thật ít ai nói</a>
                        </td>
                        <td class="py-4 px-5">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-medium bg-green-100 text-green-700">
                                Đã duyệt
                            </span>
                        </td>
                        <td class="py-4 px-5 text-gray-500 text-[13px]">
                            05/07/2026 09:35
                        </td>
                        <td class="py-4 px-5">
                            <div class="flex items-center justify-center gap-3">
                                <button onclick="toggleReplyBox('2')" class="text-primary hover:text-primary-dark transition-colors p-1" title="Trả lời">
                                    <i class="pi pi-reply"></i>
                                </button>
                                <button class="text-red-400 hover:text-red-600 transition-colors p-1" title="Xóa">
                                    <i class="pi pi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Comment 3: Admin reply -->
                    <tr class="comment-row hidden opacity-0 border-b border-gray-50 hover:bg-gray-50/50 transition-all duration-500 align-top" data-status="approved">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-[#1F2733]">Quản trị viên</span>
                                <span class="bg-[#EBF3FF] text-[#1668DC] text-[11px] font-bold px-2 py-0.5 rounded">Admin</span>
                            </div>
                            <!-- Parent Reference -->
                            <div class="text-[12px] text-gray-400 flex items-start gap-1 mb-2 italic">
                                <i class="pi pi-share-alt mt-[2px] text-[10px]"></i>
                                <span>Trả lời "Minh Anh: Bài viết rất hữu ích, cho mình hỏi hút mỡ Vaser 2 vùng bụng..."</span>
                            </div>
                            <div class="text-gray-700 leading-relaxed mb-3">
                                Chào bạn, hút mỡ Vaser 2 vùng bụng trọn gói (gồm gây mê + áo định hình) dao động 50-80 triệu. Bạn liên hệ hotline của cơ sở để được thăm khám và báo giá chính xác nhé!
                            </div>
                        </td>
                        <td class="py-4 px-5">
                            <a href="#" class="text-primary hover:underline font-medium text-[13px] leading-tight block">Hút mỡ bụng 2026: chi phí, công nghệ và những sự thật ít ai nói</a>
                        </td>
                        <td class="py-4 px-5">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-medium bg-green-100 text-green-700">
                                Đã duyệt
                            </span>
                        </td>
                        <td class="py-4 px-5 text-gray-500 text-[13px]">
                            05/07/2026 09:35
                        </td>
                        <td class="py-4 px-5">
                            <div class="flex items-center justify-center gap-3">
                                <button class="text-red-400 hover:text-red-600 transition-colors p-1" title="Xóa">
                                    <i class="pi pi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Comment 4 -->
                    <tr class="comment-row hidden opacity-0 border-b border-gray-50 hover:bg-gray-50/50 transition-all duration-500 align-top" data-status="approved">
                        <td class="py-4 px-5">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-[#1F2733]">Minh Anh</span>
                                <span class="text-gray-400 text-[13px]">minhanh@example.com</span>
                            </div>
                            <div class="text-gray-700 leading-relaxed mb-3">
                                Bài viết rất hữu ích, cho mình hỏi hút mỡ Vaser 2 vùng bụng ở cơ sở top 1 tổng chi phí khoảng bao nhiêu ạ?
                            </div>

                            <!-- Inline Reply Box -->
                            <div id="reply-box-4" class="hidden bg-gray-50 rounded-lg p-3 border border-gray-200 mt-2 transition-all">
                                <textarea rows="3" class="w-full border border-gray-200 rounded-md p-3 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors resize-none placeholder-gray-400" placeholder="Nội dung trả lời..."></textarea>
                                <div class="flex items-center gap-2 mt-3">
                                    <button class="bg-[#6B9DFE] hover:bg-[#5a8af0] text-white px-4 py-2 rounded-md text-[14px] font-medium transition-colors flex items-center gap-2 shadow-sm" onclick="window.showToast('Đã gửi câu trả lời!', 'success'); toggleReplyBox('4')">
                                        <i class="pi pi-send text-[12px]"></i> Gửi trả lời
                                    </button>
                                    <button class="text-gray-600 hover:bg-gray-200 px-4 py-2 rounded-md text-[14px] font-medium transition-colors" onclick="toggleReplyBox('4')">Hủy</button>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-5">
                            <a href="#" class="text-primary hover:underline font-medium text-[13px] leading-tight block">Hút mỡ bụng 2026: chi phí, công nghệ và những sự thật ít ai nói</a>
                        </td>
                        <td class="py-4 px-5">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-medium bg-green-100 text-green-700">
                                Đã duyệt
                            </span>
                        </td>
                        <td class="py-4 px-5 text-gray-500 text-[13px]">
                            05/07/2026 09:35
                        </td>
                        <td class="py-4 px-5">
                            <div class="flex items-center justify-center gap-3">
                                <button onclick="toggleReplyBox('4')" class="text-primary hover:text-primary-dark transition-colors p-1" title="Trả lời">
                                    <i class="pi pi-reply"></i>
                                </button>
                                <button class="text-red-400 hover:text-red-600 transition-colors p-1" title="Xóa">
                                    <i class="pi pi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <!-- Empty state (Hidden by default) -->
            <div id="empty-state" class="hidden w-full p-12 text-center flex-col items-center justify-center">
                <i class="pi pi-inbox text-gray-300 text-5xl mb-4"></i>
                <h3 class="text-gray-900 text-lg font-medium">Không có bình luận nào</h3>
                <p class="text-gray-500 text-sm mt-1">Chưa có bình luận nào trong mục này.</p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function toggleReplyBox(commentId) {
        const box = document.getElementById(`reply-box-${commentId}`);
        const textarea = box.querySelector('textarea');
        
        if (box.classList.contains('hidden')) {
            box.classList.remove('hidden');
            setTimeout(() => {
                textarea.focus();
            }, 100);
        } else {
            box.classList.add('hidden');
            textarea.value = ''; 
        }
    }

    function switchTab(status) {
        // Cập nhật giao diện các nút tab
        const tabs = ['pending', 'approved', 'all'];
        const activeClasses = ['text-white', 'bg-primary', 'border-primary'];
        const inactiveClasses = ['text-gray-700', 'bg-white', 'border-gray-200', 'hover:bg-gray-50'];

        tabs.forEach(tab => {
            const btn = document.getElementById(`tab-${tab}`);
            if (tab === status) {
                // Tab active
                btn.classList.remove(...inactiveClasses);
                btn.classList.add(...activeClasses);
            } else {
                // Tab inactive
                btn.classList.remove(...activeClasses);
                btn.classList.add(...inactiveClasses);
            }
        });

        // Lọc các bình luận với hiệu ứng mượt mà
        const rows = document.querySelectorAll('.comment-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            
            if (status === 'all' || rowStatus === status) {
                row.classList.remove('hidden');
                visibleCount++;
                // Thêm một chút delay để hiệu ứng fade in có tác dụng
                setTimeout(() => {
                    row.classList.remove('opacity-0');
                    row.classList.add('opacity-100');
                }, 50);
            } else {
                row.classList.remove('opacity-100');
                row.classList.add('opacity-0');
                setTimeout(() => {
                    row.classList.add('hidden');
                }, 300); // 300ms tương ứng với duration-500 của tailwind hoặc duration-300 tự custom
            }
        });

        // Hiện Empty State nếu không có dữ liệu
        const emptyState = document.getElementById('empty-state');
        const tbody = document.getElementById('comments-tbody');
        setTimeout(() => {
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
                emptyState.classList.add('flex');
            } else {
                emptyState.classList.add('hidden');
                emptyState.classList.remove('flex');
            }
        }, 300);
    }
</script>
@endpush
