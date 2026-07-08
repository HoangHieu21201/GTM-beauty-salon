@extends('layouts.admin')

@section('title', 'Cơ sở thẩm mỹ - Review Thẩm Mỹ Admin')

@section('content')
    <!-- Top Area -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-[24px] font-bold text-[#1F2733]">Cơ sở thẩm mỹ</h1>
        <div class="flex items-center gap-4">
            <a href="{{ url('/admin/clinics/create') }}" class="px-4 py-2 font-semibold text-sm bg-primary border border-primary text-white rounded-lg hover:bg-primary-dark transition-colors flex items-center gap-2 shadow-sm">
                <i class="pi pi-plus"></i> Thêm cơ sở
            </a>
        </div>
    </div>

    <!-- Info Banner -->
    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6 text-[14px] text-blue-700 font-medium">
        Kéo biểu tượng <i class="pi pi-bars mx-1 text-sm text-blue-500"></i> để sắp lại thứ hạng — thay đổi được lưu tự động (điểm số tự tính lại theo thứ tự).
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="py-3 px-4 font-bold text-gray-500 uppercase text-[11px] tracking-wider w-20 text-center">#</th>
                    <th class="py-3 px-4 font-bold text-gray-500 uppercase text-[11px] tracking-wider">TÊN</th>
                    <th class="py-3 px-4 font-bold text-gray-500 uppercase text-[11px] tracking-wider text-center w-24">ĐIỂM</th>
                    <th class="py-3 px-4 font-bold text-gray-500 uppercase text-[11px] tracking-wider text-center w-28">RATING</th>
                    <th class="py-3 px-4 font-bold text-gray-500 uppercase text-[11px] tracking-wider text-center w-32">NỔI BẬT</th>
                    <th class="py-3 px-4 font-bold text-gray-500 uppercase text-[11px] tracking-wider text-right w-24"></th>
                </tr>
            </thead>
            <tbody id="sortableList" class="divide-y divide-gray-100">
                @php
                    $clinics = [
                        ['Bệnh viện Thẩm mỹ Kim Cương', 60, '5.0', true],
                        ['Thẩm mỹ viện Ngọc Dung', 50, '4.7', true],
                        ['Bệnh viện Thẩm mỹ Á Âu', 40, '4.4', true],
                        ['Thẩm mỹ viện Đông Á', 30, '4.1', false],
                        ['Bệnh viện Thẩm mỹ Hoàn Mỹ', 20, '3.8', false],
                        ['Thẩm mỹ viện Sài Gòn Venus', 10, '3.5', false],
                    ];
                @endphp
                @foreach($clinics as $index => $clinic)
                <tr class="hover:bg-gray-50/50 transition-colors group draggable-row">
                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-4">
                            <i class="pi pi-bars text-gray-400 cursor-move hover:text-black drag-handle p-2 -m-2"></i>
                            <span class="font-bold text-primary rank-number text-[14px]">{{ $index + 1 }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-4 font-bold text-primary text-[14px]">{{ $clinic[0] }}</td>
                    <td class="py-3 px-4 text-center font-bold text-gray-700 score-number text-[14px]">{{ $clinic[1] }}</td>
                    <td class="py-3 px-4 text-center text-[13.5px] text-gray-600 font-medium">{{ $clinic[2] }} <span class="text-gray-500">★</span></td>
                    <td class="py-3 px-4 text-center">
                        @if($clinic[3])
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-orange-100 text-orange-600 uppercase">Nổi bật</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ url('/admin/clinics/1/edit') }}" class="w-8 h-8 flex items-center justify-center rounded-full text-primary hover:bg-blue-50 transition-colors"><i class="pi pi-pencil text-[13px]"></i></a>
                            <button class="w-8 h-8 flex items-center justify-center rounded-full text-red-500 hover:bg-red-50 transition-colors"><i class="pi pi-trash text-[13px]"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
<script>
    // Drag and Drop Logic
    document.addEventListener('DOMContentLoaded', () => {
        setupSortable('sortableList');
    });

    function setupSortable(listId) {
        const list = document.getElementById(listId);
        if (!list) return;

        let draggedItem = null;

        list.addEventListener('mousedown', (e) => {
            if (e.target.closest('.drag-handle')) {
                const row = e.target.closest('.draggable-row');
                if (row) row.setAttribute('draggable', 'true');
            }
        });

        list.addEventListener('mouseup', (e) => {
            const row = e.target.closest('.draggable-row');
            if (row) row.setAttribute('draggable', 'false');
        });

        list.addEventListener('dragstart', (e) => {
            const row = e.target.closest('.draggable-row');
            if (row) {
                draggedItem = row;
                // Defer adding classes so the cloned image for drag doesn't have them
                setTimeout(() => {
                    draggedItem.classList.add('opacity-40', 'bg-blue-50');
                }, 0);
            }
        });

        list.addEventListener('dragend', (e) => {
            if (draggedItem) {
                draggedItem.classList.remove('opacity-40', 'bg-blue-50');
                draggedItem.setAttribute('draggable', 'false');
                draggedItem = null;
                updateRankings(list);
                showToast();
            }
        });

        list.addEventListener('dragover', (e) => {
            e.preventDefault(); // Necessary to allow dropping
            const afterElement = getDragAfterElement(list, e.clientY);
            const row = e.target.closest('.draggable-row');
            if (draggedItem && row && row !== draggedItem) {
                if (afterElement == null) {
                    list.appendChild(draggedItem);
                } else {
                    list.insertBefore(draggedItem, afterElement);
                }
            }
        });

        function getDragAfterElement(container, y) {
            const draggableElements = [...container.querySelectorAll('.draggable-row:not(.opacity-40)')];

            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;
                if (offset < 0 && offset > closest.offset) {
                    return { offset: offset, element: child };
                } else {
                    return closest;
                }
            }, { offset: Number.NEGATIVE_INFINITY }).element;
        }

        function updateRankings(container) {
            const rows = container.querySelectorAll('.draggable-row');
            let baseScore = rows.length * 10;
            rows.forEach((row, index) => {
                row.querySelector('.rank-number').innerText = index + 1;
                row.querySelector('.score-number').innerText = baseScore - (index * 10);
            });
        }

        function showToast() {
            if(window.showToast) {
                window.showToast('Đã cập nhật thứ hạng', 'success');
            }
        }
    }
</script>
@endpush
