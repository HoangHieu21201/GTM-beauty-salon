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
                    @php
                        $posts = [
                            ['Bọc răng sứ giá bao nhiêu? Bảng giá 2026 và 5 điều phải hỏi trước khi làm', 'Bọc răng sứ', 'Đã đăng', '05/07/26', 'https://picsum.photos/100/60?random=1'],
                            ['Niềng răng trong suốt hay mắc cài: chọn loại nào năm 2026?', 'Niềng răng', 'Đã đăng', '05/07/26', 'https://picsum.photos/100/60?random=2'],
                            ['Trị mụn chuẩn y khoa: lộ trình 3 tháng sạch mụn, hạn chế tái phát', 'Trị mụn', 'Đã đăng', '05/07/26', 'https://picsum.photos/100/60?random=3'],
                            ['Trẻ hóa da công nghệ cao: so sánh HIFU, RF và Laser chi tiết 2026', 'Trẻ hóa da', 'Đã đăng', '05/07/26', 'https://picsum.photos/100/60?random=4'],
                            ['Hút mỡ bụng 2026: chi phí, công nghệ và những sự thật ít ai nói', 'Hút mỡ', 'Đã đăng', '05/07/26', 'https://picsum.photos/100/60?random=5'],
                        ];
                    @endphp
                    
                    @foreach($posts as $post)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="py-3">
                            <div class="w-[60px] h-[40px] rounded overflow-hidden border border-gray-100 bg-gray-50 flex-shrink-0">
                                <img src="{{ $post[4] }}" alt="cover" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-3 pr-4">
                            <a href="#" class="font-bold text-primary hover:text-primary-dark transition-colors">{{ $post[0] }}</a>
                        </td>
                        <td class="py-3 text-gray-500 text-[13.5px]">{{ $post[1] }}</td>
                        <td class="py-3">
                            @if($post[2] == 'Đã đăng')
                                <span class="text-[12px] font-bold px-2.5 py-1 rounded bg-green-100 text-green-700">Đã đăng</span>
                            @endif
                        </td>
                        <td class="py-3 text-gray-500 text-[13.5px]">{{ $post[3] }}</td>
                        <td class="py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ url('/admin/posts/1/edit') }}" class="w-8 h-8 flex items-center justify-center rounded-full text-primary hover:bg-blue-50 transition-all duration-300" title="Sửa">
                                    <i class="pi pi-pencil text-[14px]"></i>
                                </a>
                                <button class="w-8 h-8 flex items-center justify-center rounded-full text-red-500 hover:bg-red-50 transition-all duration-300" title="Xóa">
                                    <i class="pi pi-trash text-[14px]"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
