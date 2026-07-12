@extends('layouts.admin')

@section('title', 'Bài viết - Review Thẩm Mỹ Admin')

@section('content')
    <!-- Top Area -->
    <x-admin.page-header title="Bài viết">
        <x-admin.button variant="primary" icon="pi pi-plus" onclick="window.location.href='{{ url('/admin/posts/create') }}'">Viết bài</x-admin.button>
    </x-admin.page-header>

    <!-- Table Section -->
    <div class="bg-white p-4 lg:p-6 rounded-card shadow-sm border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-[14px] border-collapse min-w-[800px]">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="py-3 font-bold text-gray-500 uppercase text-[11px] tracking-wider w-16">Ảnh</th>
                        <th class="py-3 font-bold text-gray-500 uppercase text-[11px] tracking-wider w-[45%]">Tiêu đề</th>
                        <th class="py-3 font-bold text-gray-500 uppercase text-[11px] tracking-wider">Danh mục</th>
                        <th class="py-3 font-bold text-gray-500 uppercase text-[11px] tracking-wider">Trạng thái</th>
                        <th class="py-3 font-bold text-gray-500 uppercase text-[11px] tracking-wider">Ngày</th>
                        <th class="py-3 font-bold text-gray-500 uppercase text-[11px] tracking-wider text-right"></th>
                    </tr>
                </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($posts as $post)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="py-3">
                                <div class="w-[60px] h-[40px] rounded overflow-hidden border border-gray-100 bg-gray-50 flex-shrink-0">
                                    <img src="{{ $post->thumbnail ?? 'https://picsum.photos/100/60?random=1' }}" alt="cover" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="py-3 pr-4">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="font-bold text-primary hover:text-primary-dark transition-colors">{{ $post->title }}</a>
                            </td>
                            <td class="py-3 text-gray-500 text-[13.5px]">{{ $post->category->name ?? 'N/A' }}</td>
                            <td class="py-3">
                                @if($post->status == 'published')
                                    <span class="text-[12px] font-bold px-2.5 py-1 rounded bg-green-100 text-green-700">Đã đăng</span>
                                @else
                                    <span class="text-[12px] font-bold px-2.5 py-1 rounded bg-gray-100 text-gray-700 font-medium">Nháp</span>
                                @endif
                            </td>
                            <td class="py-3 text-gray-500 text-[13.5px]">{{ $post->created_at->format('d/m/y') }}</td>
                            <td class="py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="w-8 h-8 flex items-center justify-center rounded-full text-primary hover:bg-blue-50 transition-all duration-300" title="Sửa">
                                        <i class="pi pi-pencil text-[14px]"></i>
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-full text-red-500 hover:bg-red-50 transition-all duration-300" title="Xóa">
                                            <i class="pi pi-trash text-[14px]"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-400 font-medium">
                                Chưa có bài viết nào trong hệ thống. <a href="{{ route('admin.posts.create') }}" class="text-primary hover:underline font-bold">Hãy tạo bài viết mới!</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Clear all editor drafts on successful save
        for (let i = 0; i < localStorage.length; i++) {
            const key = localStorage.key(i);
            if (key && key.startsWith('gtm_editor_draft_')) {
                localStorage.removeItem(key);
                i--; // Adjust index because key was removed
            }
        }
    });
</script>
@endpush
