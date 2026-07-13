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
                    @forelse($comments as $comment)
                        <tr class="comment-row border-b border-gray-50 hover:bg-gray-50/50 transition-all duration-500 opacity-100 align-top {{ $comment->status == 0 ? '' : 'hidden opacity-0' }}" data-status="{{ $comment->status == 1 ? 'approved' : 'pending' }}">
                            <td class="py-4 px-5">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-bold text-[#1F2733]">{{ $comment->name }}</span>
                                    @if($comment->email)
                                        <span class="text-gray-400 text-[13px]">{{ $comment->email }}</span>
                                    @endif
                                    @if($comment->user_id && $comment->user && $comment->user->role_id == 1)
                                        <span class="bg-[#EBF3FF] text-[#1668DC] text-[11px] font-bold px-2 py-0.5 rounded">Admin</span>
                                    @endif
                                </div>

                                @if($comment->parent_id && $comment->parent)
                                    <div class="text-[12px] text-gray-400 flex items-start gap-1 mb-2 italic">
                                        <i class="pi pi-share-alt mt-[2px] text-[10px]"></i>
                                        <span>Trả lời "{{ $comment->parent->name }}: {{ Str::limit($comment->parent->content, 50) }}"</span>
                                    </div>
                                @endif

                                <div class="text-gray-700 leading-relaxed mb-3">
                                    {!! nl2br(e($comment->content)) !!}
                                </div>

                                <!-- Inline Reply Box (Hidden by default) -->
                                <form id="reply-box-{{ $comment->id }}" action="{{ route('admin.comments.reply', $comment->id) }}" method="POST" class="hidden bg-gray-50 rounded-lg p-3 border border-gray-200 mt-2 transition-all">
                                    @csrf
                                    <textarea name="content" rows="3" class="w-full border border-gray-200 rounded-md p-3 text-[14px] focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors resize-none placeholder-gray-400" placeholder="Nội dung trả lời..." required></textarea>
                                    <div class="flex items-center gap-2 mt-3">
                                        <button type="submit" class="bg-[#6B9DFE] hover:bg-[#5a8af0] text-white px-4 py-2 rounded-md text-[14px] font-medium transition-colors flex items-center gap-2 shadow-sm">
                                            <i class="pi pi-send text-[12px]"></i> Gửi trả lời
                                        </button>
                                        <button type="button" class="text-gray-600 hover:bg-gray-200 px-4 py-2 rounded-md text-[14px] font-medium transition-colors" onclick="toggleReplyBox('{{ $comment->id }}')">Hủy</button>
                                    </div>
                                </form>
                            </td>
                            <td class="py-4 px-5">
                                @if($comment->post)
                                    <a href="{{ url('/bai-viet/chi-tiet/' . $comment->post->slug) }}" target="_blank" class="text-primary hover:underline font-medium text-[13px] leading-tight block">
                                        {{ $comment->post->title }}
                                    </a>
                                @else
                                    <span class="text-gray-400 italic text-[13px]">Bài viết đã bị xóa</span>
                                @endif
                            </td>
                            <td class="py-4 px-5">
                                @if($comment->status == 0)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-medium bg-amber-100 text-amber-700">
                                        Chờ duyệt
                                    </span>
                                @elseif($comment->status == 1)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-medium bg-green-100 text-green-700">
                                        Đã duyệt
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[12px] font-medium bg-gray-100 text-gray-700">
                                        {{ $comment->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-5 text-gray-500 text-[13px]">
                                {{ $comment->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="py-4 px-5">
                                <div class="flex items-center justify-center gap-3">
                                    @if($comment->status == 0)
                                        <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" class="inline"
                                            data-confirm-submit="true"
                                            data-confirm-title="Xác nhận duyệt"
                                            data-confirm-message="Bạn có chắc chắn muốn duyệt bình luận này?"
                                            data-confirm-type="success"
                                            data-confirm-icon="question"
                                            data-confirm-accept-html="Duyệt">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-500 hover:text-green-700 transition-colors p-1" title="Duyệt">
                                                <i class="pi pi-check text-[15px]"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <button onclick="toggleReplyBox('{{ $comment->id }}')" class="text-primary hover:text-primary-dark transition-colors p-1" title="Trả lời">
                                        <i class="pi pi-reply"></i>
                                    </button>
                                    <x-admin.delete-form 
                                        :action="route('admin.comments.destroy', $comment->id)" 
                                        message="Bạn có chắc chắn muốn xóa bình luận này?"
                                        class="text-red-400 hover:text-red-600 transition-colors p-1">
                                        <i class="pi pi-trash"></i>
                                    </x-admin.delete-form>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
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
            if (btn) {
                if (tab === status) {
                    btn.classList.remove(...inactiveClasses);
                    btn.classList.add(...activeClasses);
                } else {
                    btn.classList.remove(...activeClasses);
                    btn.classList.add(...inactiveClasses);
                }
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
                setTimeout(() => {
                    row.classList.remove('opacity-0');
                    row.classList.add('opacity-100');
                }, 50);
            } else {
                row.classList.remove('opacity-100');
                row.classList.add('opacity-0');
                setTimeout(() => {
                    row.classList.add('hidden');
                }, 300);
            }
        });

        // Hiện Empty State nếu không có dữ liệu
        const emptyState = document.getElementById('empty-state');
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

    // Tự động kích hoạt tab pending khi load trang
    document.addEventListener('DOMContentLoaded', function() {
        switchTab('pending');
    });
</script>
@endpush
