@props([
    'action', 
    'message' => 'Bạn có chắc chắn muốn xóa bản ghi này? Hành động này không thể hoàn tác.',
    'title' => 'Xác nhận xóa'
])

<form action="{{ $action }}" method="POST" class="inline" 
      data-confirm-submit="true" 
      data-confirm-title="{{ $title }}" 
      data-confirm-message="{{ $message }}" 
      data-confirm-type="danger"
      data-confirm-accept-html="Xóa">
    @csrf
    @method('DELETE')
    <button type="submit" {{ $attributes->merge(['class' => 'text-red-500 hover:text-red-700 transition-colors p-1 flex items-center justify-center', 'title' => 'Xóa']) }}>
        {!! $slot->isEmpty() ? '<i class="pi pi-trash"></i>' : $slot !!}
    </button>
</form>
