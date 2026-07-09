@extends('layouts.client')
@section('title', $clinic['name'] . ' - Chi tiết cơ sở')

@section('content')
<div style="background-color: #F1F4F8;" class="min-h-screen pb-12">
    <div style="max-width: 1200px;" class="mx-auto px-4 pt-4">
        <!-- Breadcrumb -->
        <div class="mb-5">
            <x-client.ui.breadcrumb :items="$breadcrumb" />
        </div>

        <!-- Main Layout Grid -->
        <div style="display: grid; grid-template-columns: 1fr 320px; gap: 24px; align-items: start;">
            
            <!-- Left Column (Main) -->
            <div class="flex flex-col w-full overflow-hidden">
                
                <!-- Gallery -->
                <div style="display: flex; gap: 8px; height: 320px; margin-bottom: 18px;">
                    <!-- Big -->
                    <div style="flex: 1; min-width: 540px; height: 320px; border-radius: 12px; overflow: hidden; background: #f3f4f6;">
                        <img src="{{ $clinic['images'][0] }}" style="width: 100%; height: 100%; object-fit: cover; cursor: pointer;" class="hover:scale-105 transition-transform duration-500" alt="{{ $clinic['name'] }}">
                    </div>
                    <!-- Thumbs -->
                    <div style="width: 272px; flex-shrink: 0; height: 320px; display: flex; flex-direction: column; gap: 8px;">
                        <!-- Thumb 1 (Active) -->
                        <button type="button" style="flex: 1; min-height: 0; border-radius: 8px; overflow: hidden; border: 2px solid #1668DC; position: relative; cursor: pointer; padding: 0;" aria-label="Xem ảnh 1">
                            <img src="{{ $clinic['images'][0] }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Thumb 1">
                        </button>
                        <!-- Thumb 2 (Inactive) -->
                        <button type="button" class="hover:opacity-100 transition-opacity" style="flex: 1; min-height: 0; border-radius: 8px; overflow: hidden; border: 2px solid transparent; opacity: 0.7; background: #f3f4f6; cursor: pointer; padding: 0;" aria-label="Xem ảnh 2">
                            <img src="{{ $clinic['images'][1] ?? $clinic['images'][0] }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Thumb 2">
                        </button>
                        <!-- Thumb 3 (Inactive) -->
                        <button type="button" class="hover:opacity-100 transition-opacity" style="flex: 1; min-height: 0; border-radius: 8px; overflow: hidden; border: 2px solid transparent; opacity: 0.7; background: #f3f4f6; cursor: pointer; padding: 0;" aria-label="Xem ảnh 3">
                            <img src="{{ $clinic['images'][2] ?? $clinic['images'][0] }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Thumb 3">
                        </button>
                        <!-- Thumb 4 (Inactive) -->
                        <button type="button" class="hover:opacity-100 transition-opacity" style="flex: 1; min-height: 0; border-radius: 8px; overflow: hidden; border: 2px solid transparent; opacity: 0.7; background: #f3f4f6; cursor: pointer; padding: 0;" aria-label="Xem ảnh 4">
                            <img src="{{ $clinic['images'][3] ?? $clinic['images'][0] }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Thumb 4">
                        </button>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-white shadow-sm border" style="border-radius: 12px; padding: 22px; border-color: #e2e8f0;">
                    <!-- Tags -->
                    <div style="margin-bottom: 10px;" class="flex flex-wrap gap-2">
                        @foreach(explode(' · ', $clinic['category']) as $cat)
                            <span class="font-medium px-3 py-1" style="background-color: #E8F1FF; color: #1668DC; font-size: 13px; border-radius: 6px;">{{ $cat }}</span>
                        @endforeach
                    </div>
                    
                    <!-- Title -->
                    <h1 style="font-size: 26px; font-weight: 700; color: #1F2733; margin-bottom: 12px; line-height: 1.3;">{{ $clinic['name'] }}</h1>
                    
                    <!-- Meta -->
                    <div class="flex items-center flex-wrap gap-4 mb-6 pb-6 border-b border-dashed" style="border-color: #e2e8f0;">
                        <div class="flex items-center gap-1.5" style="font-size: 14px;">
                            <div class="flex gap-0.5" style="color: #F59E0B;">
                                @for($i = 0; $i < 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                @endfor
                            </div>
                            <span class="font-bold text-[#1F2733]">{{ number_format($clinic['rating'], 1) }}/5</span>
                            <span style="color: #64748b;">· {{ $clinic['votes'] }} bình chọn</span>
                        </div>
                        <span class="text-white font-bold px-3 py-1.5 shadow-sm leading-none flex items-center" style="background-color: #1668DC; font-size: 13px; border-radius: 9999px;">
                            Điểm xếp hạng: {{ $clinic['score'] }}
                        </span>
                    </div>

                    <!-- Intro -->
                    <h3 style="font-size: 17px; font-weight: 700; color: #1F2733; margin: 18px 0 8px;">Giới thiệu</h3>
                    
                    <p style="font-size: 15px; color: #333333; margin: 15px 0;">
                        {{ $clinic['description'] }}
                    </p>
                </div>
            </div>

            <!-- Right Column (Sidebar) -->
            <aside style="display: flex; flex-direction: column; gap: 24px; position: sticky; top: 80px;">
                
                <!-- Contact Card -->
                <div class="bg-white shadow-sm border" style="border-radius: 12px; padding: 20px; border-color: #e2e8f0; display: flex; flex-direction: column; gap: 16px;">
                    <h3 style="font-size: 16px; font-weight: 700; color: #1F2733; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <i class="pi pi-id-card" style="color: #1668DC; font-size: 18px;"></i> Thông tin liên hệ
                    </h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div style="padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                            <div style="color: #64748b; font-size: 13px; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                                <i class="pi pi-map-marker"></i> Địa chỉ
                            </div>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($clinic['address']) }}" target="_blank" rel="noopener" style="color: #1F2733; font-weight: 700; font-size: 14px; text-decoration: none; display: flex; align-items: center; justify-content: space-between; gap: 4px;" title="Mở trên Google Maps">
                                <span>{{ $clinic['address'] }}</span> 
                                <i class="pi pi-external-link" style="font-size: 11px; color: #94a3b8;"></i>
                            </a>
                        </div>
                        
                        <div style="padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                            <div style="color: #64748b; font-size: 13px; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                                <i class="pi pi-phone"></i> Điện thoại
                            </div>
                            <a href="tel:{{ $clinic['phone'] }}" style="color: #1F2733; font-weight: 700; font-size: 14px; text-decoration: none; display: block;" title="Bấm để gọi">{{ $clinic['phone'] }}</a>
                        </div>
                        
                        <div style="padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                            <div style="color: #64748b; font-size: 13px; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                                <i class="pi pi-globe"></i> Website
                            </div>
                            <a href="https://{{ $clinic['website'] }}" target="_blank" rel="noopener" style="color: #1F2733; font-weight: 700; font-size: 14px; text-decoration: none; display: flex; align-items: center; justify-content: space-between; gap: 4px;">
                                <span>{{ $clinic['website'] }}</span> 
                                <i class="pi pi-external-link" style="font-size: 11px; color: #94a3b8;"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 12px; margin-top: 4px;">
                        <a href="tel:{{ $clinic['phone'] }}" style="flex: 1; background-color: #10b981; color: white; font-size: 14px; font-weight: 700; padding: 10px 0; border-radius: 8px; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
                            <i class="pi pi-phone"></i> Gọi ngay
                        </a>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($clinic['address']) }}" target="_blank" rel="noopener" style="flex: 1; background-color: #1668DC; color: white; font-size: 14px; font-weight: 700; padding: 10px 0; border-radius: 8px; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
                            <i class="pi pi-map"></i> Chỉ đường
                        </a>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 12px; margin-top: 4px; padding-top: 16px; border-top: 1px dashed #e2e8f0;">
                        <span style="color: #64748b; font-size: 13px;">Chia sẻ:</span>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <button type="button" title="Chia sẻ Facebook" style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; color: #1668DC; background: #f8fafc; cursor: pointer;">
                                <i class="pi pi-facebook"></i>
                            </button>
                            <button type="button" title="Copy liên kết" style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; background: #f8fafc; cursor: pointer;">
                                <i class="pi pi-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Map Card -->
                <div class="bg-white shadow-sm border" style="border-radius: 12px; padding: 16px; padding-bottom: 12px; border-color: #e2e8f0; display: flex; flex-direction: column; gap: 12px;">
                    <h3 style="font-size: 15px; font-weight: 700; color: #1F2733; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <i class="pi pi-map" style="color: #1668DC;"></i> Bản đồ
                    </h3>
                    <div style="width: 100%; height: 230px; border-radius: 8px; overflow: hidden; position: relative; border: 1px solid #e2e8f0; background: #e5e7eb;">
                        <iframe width="100%" height="100%" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Bản đồ vị trí cơ sở" style="border: 0;" src="https://www.google.com/maps?q=B%E1%BB%87nh%20vi%E1%BB%87n%20Th%E1%BA%A9m%20m%E1%BB%B9%20Kim%20C%C6%B0%C6%A1ng%2C%20100%20%C4%90%C6%B0%E1%BB%9Dng%20Th%E1%BA%A9m%20M%E1%BB%B9%2C%20H%C3%A0%20N%E1%BB%99i&output=embed&hl=vi&z=16"></iframe>
                    </div>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($clinic['address']) }}" target="_blank" rel="noopener" style="text-align: center; color: #1668DC; font-size: 13px; font-weight: 500; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 4px; margin-top: 4px;">
                        Mở bản đồ lớn <i class="pi pi-external-link" style="font-size: 10px;"></i>
                    </a>
                </div>

                <!-- Back Button -->
                <a href="{{ url('/bang-xep-hang') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 2px solid #1668DC; color: #1668DC; font-weight: 700; font-size: 14px; display: flex; align-items: center; justify-content: center; text-decoration: none; background: white;">
                    <span style="margin-right: 6px;">&larr;</span> Về bảng xếp hạng
                </a>

            </aside>
        </div>
    </div>
</div>
@endsection
