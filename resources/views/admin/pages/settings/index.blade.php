@extends('layouts.admin')

@section('title', 'Cấu hình Website')

@push('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@section('content')
<div x-data="settingsData()" x-init="init()" x-cloak>
    <x-admin.page-header title="Cấu hình Website" subtitle="Quản lý logo, footer và các cài đặt chung" />

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
            <i class="pi pi-check-circle text-xl"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 mb-8">
        @csrf
        
        <!-- ======================= -->
        <!-- QUẢN LÝ LOGO -->
        <!-- ======================= -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i class="pi pi-image"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Quản lý Logo (Header & Footer)</h3>
            </div>
            
            <div class="p-6">
                <!-- Chuyển tab -->
                <div class="flex gap-4 mb-6 border-b border-slate-200 pb-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" x-model="logoMode" value="existing" class="text-blue-600 focus:ring-blue-500">
                        <span class="text-sm font-semibold text-slate-700">Chọn từ Thư viện</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" x-model="logoMode" value="upload" class="text-blue-600 focus:ring-blue-500">
                        <span class="text-sm font-semibold text-slate-700">Tải ảnh lên (Mới)</span>
                    </label>
                </div>

                <!-- Input ẩn lưu logo -->
                <input type="hidden" name="site_logo_existing" :value="logoMode === 'existing' ? selectedLogo : ''">
                <input type="hidden" name="site_logo_base64" :value="logoMode === 'upload' ? uploadedBase64 : ''">

                <!-- Tab: Thư viện -->
                <div x-show="logoMode === 'existing'">
                    <div class="flex flex-wrap gap-4" x-show="logos.length > 0">
                        <template x-for="logo in logos" :key="logo">
                            <div class="relative group w-32 h-32 shrink-0 border-2 rounded-xl flex items-center justify-center p-2 bg-slate-50 cursor-pointer overflow-hidden transition-all"
                                 :class="selectedLogo === logo ? 'border-blue-500 shadow-[0_0_0_3px_rgba(59,130,246,0.2)]' : 'border-slate-200 hover:border-blue-300'"
                                 @click="selectedLogo = logo">
                                <img :src="'/' + logo" class="max-w-full max-h-full object-contain">
                                
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center gap-2 transition-opacity">
                                    <button type="button" @click.stop="deleteLogo(logo)" class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition" title="Xóa vĩnh viễn">
                                        <i class="pi pi-trash text-sm"></i>
                                    </button>
                                </div>
                                <div x-show="selectedLogo === logo" class="absolute top-2 right-2 w-6 h-6 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                    <i class="pi pi-check text-xs"></i>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div x-show="logos.length === 0" class="w-full mt-2 py-8 text-center text-slate-500 text-sm border-2 border-dashed border-slate-200 rounded-xl">
                        Thư viện trống. Hãy chuyển sang tab Tải ảnh lên.
                    </div>
                </div>

                <!-- Tab: Upload -->
                <div x-show="logoMode === 'upload'" class="pt-4" style="display: none;">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        <!-- Cột Trái: Nút chọn ảnh -->
                        <div class="md:col-span-1 space-y-3">
                            <label class="block text-sm font-bold text-slate-700">1. Chọn file ảnh</label>
                            <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl flex flex-col items-center justify-center text-center relative hover:bg-slate-100 transition-colors cursor-pointer group h-[160px]">
                                <i class="pi pi-upload text-3xl text-slate-400 group-hover:text-blue-500 mb-2 transition-colors"></i>
                                <span class="text-sm font-semibold text-slate-600 group-hover:text-blue-600 transition-colors">Nhấn để chọn file ảnh</span>
                                <span class="text-[11px] text-slate-400 mt-1">Hỗ trợ JPG, PNG, WEBP</span>
                                <!-- Input tàng hình bọc toàn bộ khung -->
                                <input type="file" accept="image/*" @change="initCropper($event.target)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" title="Chọn file ảnh">
                            </div>
                        </div>

                        <!-- Cột Phải: Xem trước và Nút cắt -->
                        <div class="md:col-span-2 space-y-3" x-show="hasImageToCrop" style="display: none;">
                            <label class="block text-sm font-bold text-slate-700">2. Xem trước & Cắt ảnh</label>
                            <div class="p-4 border-2 border-slate-200 bg-white rounded-xl shadow-sm flex flex-col sm:flex-row items-center gap-6 h-auto min-h-[160px]">
                                <!-- Khung vuông hiện ảnh -->
                                <div class="w-32 h-32 shrink-0 bg-slate-50 border border-slate-200 rounded-lg p-2 flex items-center justify-center overflow-hidden relative">
                                    <div x-show="!uploadedBase64" class="absolute inset-0 flex items-center justify-center text-slate-300 opacity-50 z-0">
                                        <i class="pi pi-image text-4xl"></i>
                                    </div>
                                    <img :src="uploadedBase64 || rawImageBase64" class="max-h-full max-w-full object-contain relative z-10 rounded shadow-sm bg-white">
                                </div>
                                <!-- Nội dung & Nút Cắt -->
                                <div class="flex-1 space-y-4 text-center sm:text-left w-full">
                                    <div>
                                        <p class="text-sm text-slate-700 font-bold mb-1"><i class="pi pi-check-circle text-green-500"></i> Ảnh đã sẵn sàng</p>
                                        <p class="text-[13px] text-slate-500">Tiến hành cắt lại khung hình nếu cần thiết.</p>
                                    </div>
                                    <button type="button" @click="openCropper()" class="w-full sm:w-auto px-6 py-2.5 rounded-lg font-bold text-sm text-white bg-primary hover:bg-[#1557b0] transition-all flex items-center justify-center gap-2 shadow-md">
                                        <i class="pi pi-crop"></i> CHỈNH SỬA & CẮT ẢNH
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                        <!-- Giao diện Cropper To (Chỉ hiện khi isCropping === true) -->
                        <div x-show="isCropping" class="border border-slate-300 rounded-xl overflow-hidden shadow-xl bg-white mt-6 ring-4 ring-slate-100" style="display: none;">
                            <div class="px-5 py-4 border-b border-slate-200 bg-slate-50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                                <div>
                                    <h4 class="font-bold text-slate-800 flex items-center gap-2 text-lg"><i class="pi pi-crop"></i> Công cụ cắt ảnh</h4>
                                    <p class="text-xs text-slate-500 mt-1"><i class="pi pi-info-circle"></i> Giữ phím <b>Ctrl + Lăn chuột</b> để phóng to/thu nhỏ ảnh.</p>
                                </div>
                                <button type="button" @click="cancelCrop()" class="text-slate-400 hover:text-red-600 transition-colors w-8 h-8 flex items-center justify-center rounded-full hover:bg-red-50" title="Đóng công cụ cắt">
                                    <i class="pi pi-times text-xl"></i>
                                </button>
                            </div>
                            
                            <!-- Khung cropper to -->
                            <div class="w-full h-[250px] bg-[#1e293b] relative flex items-center justify-center">
                                <img id="crop-image" class="block max-w-full max-h-full">
                            </div>
                            
                            <!-- Actions -->
                            <div class="p-4 bg-slate-50 flex items-center justify-end gap-3 border-t border-slate-200">
                                <button type="button" @click="cancelCrop()" class="px-6 py-2.5 rounded-lg font-bold text-sm text-slate-600 bg-white border border-slate-300 hover:bg-slate-100 transition-all">
                                    Hủy bỏ
                                </button>
                                <button type="button" @click="saveCrop()" class="px-6 py-2.5 rounded-lg font-bold text-sm text-white bg-primary border border-primary hover:bg-[#1557b0] transition-all flex items-center gap-2 shadow-sm">
                                    <i class="pi pi-check"></i> LƯU MẪU CẮT
                                </button>
                            </div>
                        </div>

                </div>
            </div>
        </div>

        <!-- ======================= -->
        <!-- LIVE PREVIEW LOGO -->
        <!-- ======================= -->
        <div class="bg-slate-50 rounded-xl border border-slate-200 overflow-hidden mb-8 mt-6 max-w-2xl">
            <div class="px-4 py-3 border-b border-slate-200 bg-white flex justify-between items-center">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest"><i class="pi pi-image mr-2"></i>Xem trước Logo trên Header</span>
                <span class="text-[11px] text-green-600 bg-green-50 px-2 py-0.5 rounded font-bold border border-green-200">Real-time</span>
            </div>
            
            <div class="p-8 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjZjhmOGY4Ij48L3JlY3Q+CjxyZWN0IHg9IjQiIHk9IjQiIHdpZHRoPSI0IiBoZWlnaHQ9IjQiIGZpbGw9IiNmOGY4ZjgiPjwvcmVjdD4KPC9zdmc+')] flex items-center justify-center">
                <!-- Vùng trắng mô phỏng không gian header thực tế chứa logo -->
                <div class="bg-white shadow-sm border border-gray-100 p-2 flex items-center justify-center min-w-[220px] h-[64px]">
                    <template x-if="getPreviewLogo()">
                        <img :src="getPreviewLogo()" alt="Logo" class="object-contain" style="max-width: 200px; max-height: 48px;">
                    </template>
                    <template x-if="!getPreviewLogo()">
                        <div class="flex items-center gap-2">
                            <svg viewBox="0 0 48 48" aria-hidden="true" class="w-10 h-10">
                                <defs><linearGradient id="rtmGradH2" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#3f86ff"></stop><stop offset="1" stop-color="#1668dc"></stop></linearGradient></defs>
                                <path d="M24 5 C13.5 5 5 12.3 5 21.5 C5 30.7 13.5 38 24 38 c1.6 0 3.2-.2 4.7-.5 L36.5 42 l-1.2-7.4 C40.3 31.4 43 26.8 43 21.5 43 12.3 34.5 5 24 5 Z" fill="url(#rtmGradH2)"></path>
                                <polygon points="24,12.5 26.2,18.4 32.6,18.7 27.6,22.7 29.3,28.8 24,25.3 18.7,28.8 20.4,22.7 15.4,18.7 21.8,18.4" fill="#fff"></polygon>
                                <path d="M39 1 l1.5 3.9 3.9 1.5 -3.9 1.5 -1.5 3.9 -1.5 -3.9 -3.9 -1.5 3.9 -1.5 Z" fill="#ff7a00"></path>
                            </svg>
                            <span class="text-xl font-bold text-gray-800">Review <span class="text-[#3f86ff]">Thẩm Mỹ</span></span>
                        </div>
                    </template>
                </div>
            </div>
            <div class="px-4 py-2 bg-white border-t border-slate-100 text-[11px] text-slate-400 text-center">
                Khung trắng minh họa kích thước thực tế của logo khi hiển thị trên thanh điều hướng (Tối đa: 200x48px)
            </div>
        </div>

        <!-- ======================= -->
        <!-- FOOTER BUILDER CỨNG -->
        <!-- ======================= -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mt-12">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                    <i class="pi pi-bars"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Footer Builder (Xây dựng Footer)</h3>
            </div>

            <div class="p-6 space-y-8">
                
                <!-- Brand Desc & Copyright -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Giới thiệu (Dưới Logo Footer)</label>
                        <textarea x-model="footerBrandDesc" name="footer_brand_desc" rows="2" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nội dung Bản quyền (Copyright)</label>
                        <input x-model="footerCopyright" type="text" name="footer_copyright" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                    </div>
                </div>

                <div class="border-t border-slate-200 my-6"></div>

                <!-- 3 Cột Liên Kết -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <template x-for="(col, index) in footerCols" :key="index">
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="w-6 h-6 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold" x-text="'Cột ' + (index+2)"></span>
                                <input type="text" x-model="col.title" :name="'footer_col_' + (index+1) + '_title'" placeholder="Tiêu đề cột..." class="flex-1 px-3 py-1.5 border border-slate-200 rounded-lg text-sm font-semibold focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div class="space-y-3">
                                <template x-for="(link, linkIndex) in col.links" :key="linkIndex">
                                    <div class="flex gap-2">
                                        <input type="text" x-model="link.text" :name="'footer_col_' + (index+1) + '_links[' + linkIndex + '][label]'" placeholder="Nhãn (Vd: Giới thiệu)" class="w-1/2 px-3 py-1.5 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-blue-500">
                                        <input type="text" x-model="link.url" :name="'footer_col_' + (index+1) + '_links[' + linkIndex + '][url]'" placeholder="URL (Vd: /gioi-thieu)" class="w-1/2 px-3 py-1.5 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-blue-500 text-blue-600 font-mono">
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="border-t border-slate-200 my-6"></div>

                <!-- Cột Mạng Xã Hội -->
                <div class="mt-8">
                    <h4 class="text-base font-bold text-slate-800 mb-4 border-b border-slate-200 pb-2">Mạng xã hội (Cột phải cùng)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <template x-for="(social, idx) in footerSocials" :key="idx">
                            <div class="flex flex-col gap-3 bg-slate-50 border border-slate-200 p-4 rounded-xl shadow-sm hover:border-blue-300 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 flex items-center justify-center bg-white border border-slate-200 rounded-lg shrink-0 shadow-sm">
                                        <i class="pi text-xl text-blue-600" :class="social.icon"></i>
                                    </div>
                                    <select x-model="social.icon" :name="'footer_socials_links[' + idx + '][icon]'" class="flex-1 px-3 py-2 border border-slate-200 rounded-lg text-sm bg-white text-slate-700 font-medium focus:ring-2 focus:ring-blue-500">
                                        <option value="pi-facebook">Facebook</option>
                                        <option value="pi-youtube">YouTube</option>
                                        <option value="pi-twitter">Twitter (X)</option>
                                        <option value="pi-instagram">Instagram</option>
                                        <option value="pi-tiktok">TikTok</option>
                                        <option value="pi-comment">Zalo/Chat</option>
                                        <option value="pi-globe">Website</option>
                                    </select>
                                </div>
                                <input type="text" x-model="social.title" :name="'footer_socials_links[' + idx + '][title]'" placeholder="Tiêu đề (Vd: Theo dõi Facebook)" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                                <input type="text" x-model="social.url" :name="'footer_socials_links[' + idx + '][url]'" placeholder="Đường dẫn (https://...)" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 text-blue-600 font-mono">
                            </div>
                        </template>
                    </div>
                </div>

            </div>
        </div>



        <!-- ======================= -->
        <!-- LIVE PREVIEW FOOTER -->
        <!-- ======================= -->
        <div class="bg-slate-100 rounded-2xl border border-slate-300 shadow-inner overflow-hidden mb-8">
            <div class="px-6 py-3 border-b border-slate-300 bg-slate-200/50 flex justify-between items-center">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest"><i class="pi pi-desktop mr-2"></i>Live Preview (1:1)</span>
                <span class="text-[11px] text-slate-400 bg-slate-200 px-2 rounded">Cập nhật Real-time</span>
            </div>
            
            <!-- Vùng Render HTML Y hệt Frontend -->
            <div class="w-full overflow-x-auto bg-white">
                <div class="min-w-[1000px]">
                    <footer class="bg-[#0F2A4A] w-full text-[#94a3b8] relative pt-12">
                        <div class="max-w-[1200px] mx-auto px-4 pb-10">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 border-b border-white/10 pb-10">
                                <!-- Brand -->
                                <div class="col-span-1 md:col-span-4 pr-8">
                                    <a href="#" class="logo text-white mb-4 block" style="pointer-events: none;">
                                        <!-- Logo Fallback SVG / Selected Logo -->
                                        <template x-if="getPreviewLogo()">
                                            <img :src="getPreviewLogo()" alt="Logo" class="h-10 object-contain">
                                        </template>
                                        <template x-if="!getPreviewLogo()">
                                            <div class="flex items-center gap-2">
                                                <svg viewBox="0 0 48 48" aria-hidden="true" class="w-10 h-10">
                                                    <defs><linearGradient id="rtmGradF" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#3f86ff"></stop><stop offset="1" stop-color="#1668dc"></stop></linearGradient></defs>
                                                    <path d="M24 5 C13.5 5 5 12.3 5 21.5 C5 30.7 13.5 38 24 38 c1.6 0 3.2-.2 4.7-.5 L36.5 42 l-1.2-7.4 C40.3 31.4 43 26.8 43 21.5 43 12.3 34.5 5 24 5 Z" fill="url(#rtmGradF)"></path>
                                                    <polygon points="24,12.5 26.2,18.4 32.6,18.7 27.6,22.7 29.3,28.8 24,25.3 18.7,28.8 20.4,22.7 15.4,18.7 21.8,18.4" fill="#fff"></polygon>
                                                    <path d="M39 1 l1.5 3.9 3.9 1.5 -3.9 1.5 -1.5 3.9 -1.5 -3.9 -3.9 -1.5 3.9 -1.5 Z" fill="#ff7a00"></path>
                                                </svg>
                                                <span class="text-xl font-bold">Review <span class="text-[#3f86ff]">Thẩm Mỹ</span></span>
                                            </div>
                                        </template>
                                    </a>
                                    <p class="text-[14px] leading-relaxed text-[#94a3b8]" x-text="footerBrandDesc"></p>
                                </div>

                                <!-- Dynamic Columns -->
                                <template x-for="col in footerCols">
                                    <div class="col-span-1 md:col-span-2" x-show="col.title || col.links.some(l => l.text)">
                                        <h3 class="text-white font-bold text-[15px] mb-4" x-text="col.title"></h3>
                                        <ul class="space-y-3 text-[14px]">
                                            <template x-for="link in col.links">
                                                <li x-show="link.text"><a href="#" class="hover:text-white transition-colors" x-text="link.text" style="pointer-events: none;"></a></li>
                                            </template>
                                        </ul>
                                    </div>
                                </template>

                                <!-- Kết nối -->
                                <div class="col-span-1 md:col-span-2" x-show="footerSocials.some(s => s.url)">
                                    <h3 class="text-white font-bold text-[15px] mb-4">Kết nối</h3>
                                    <div class="flex gap-4">
                                        <template x-for="social in footerSocials">
                                            <a x-show="social.url" href="#" class="text-[#94a3b8] hover:text-white transition-colors" :title="social.title" style="pointer-events: none;">
                                                <i class="pi text-xl" :class="social.icon"></i>
                                            </a>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-6 text-[13px] text-center md:text-left text-[#64748b]" x-html="footerCopyright"></div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex justify-end gap-3 sticky bottom-4 z-50">
            <button type="submit" class="px-8 py-3 rounded-xl font-bold text-sm text-white bg-primary border border-primary hover:bg-[#1557b0] shadow-lg hover:shadow-xl transition-all flex items-center gap-2">
                <i class="pi pi-save text-lg"></i> LƯU CẤU HÌNH VÀ CẬP NHẬT GIAO DIỆN
            </button>
        </div>
    </form>
</div>

<style>
    [x-cloak] { display: none !important; }
    /* Font Awesome icons mapped slightly into PrimeIcons for social dropdown preview */
    select option { font-family: 'primeicons', sans-serif; }
</style>

<script>
function settingsData() {
    return {
        logoMode: 'existing',
        selectedLogo: @json($settings['site_logo'] ?? ''),
        uploadedBase64: '',
        cropper: null,
        hasImageToCrop: false,
        isCropping: false,
        rawImageBase64: '',
        logos: @json($logos ?? []),

        footerBrandDesc: @json($settings['footer_brand_desc'] ?? 'Đánh giá khách quan, xếp hạng minh bạch các cơ sở thẩm mỹ.'),
        footerCopyright: @json($settings['footer_copyright'] ?? '&copy; 2026 Review Thẩm Mỹ &mdash; Hệ thống đánh giá & xếp hạng cơ sở thẩm mỹ.'),
        footerCols: @json(json_decode($settings['footer_columns'] ?? '[]', true)),
        footerSocials: @json(json_decode($settings['footer_socials'] ?? '[]', true)),

        init() {
            // Ensure data arrays are robust
            if (!this.footerCols || this.footerCols.length === 0) {
                this.footerCols = [
                    {title: 'Về chúng tôi', links: [{text: 'Giới thiệu', url: '/ve-chung-toi#gioi-thieu'}, {text: 'Liên hệ', url: '/ve-chung-toi#lien-he'}, {text: 'Hợp tác', url: '/ve-chung-toi#hop-tac'}]},
                    {title: 'Danh mục', links: [{text: 'Phẫu thuật thẩm mỹ', url: '/bai-viet?type=main&cat=phau-thuat-tham-my'}, {text: 'Chăm sóc da', url: '/bai-viet?type=main&cat=cham-soc-da'}, {text: 'Răng - Hàm - Mặt', url: '/bai-viet?type=main&cat=rang-ham-mat'}, {text: 'Bài viết theo tỉnh thành', url: '/tinh-thanh'}]},
                    {title: 'Chính sách', links: [{text: 'Điều khoản sử dụng', url: '/chinh-sach#dieu-khoan-su-dung'}, {text: 'Chính sách bảo mật', url: '/chinh-sach#chinh-sach-bao-mat'}, {text: 'Tiêu chí đánh giá', url: '/chinh-sach#tieu-chi-danh-gia'}]}
                ];
            }
            while (this.footerCols.length < 3) this.footerCols.push({title: '', links: []});
            for(let i=0; i<3; i++) {
                while(this.footerCols[i].links.length < 5) this.footerCols[i].links.push({text: '', url: ''});
            }

            if (!this.footerSocials || this.footerSocials.length === 0) {
                this.footerSocials = [
                    {icon: 'pi-facebook', url: '#', title: 'Facebook'},
                    {icon: 'pi-comment', url: '#', title: 'Zalo'},
                    {icon: 'pi-youtube', url: '#', title: 'YouTube'}
                ];
            }
            while(this.footerSocials.length < 5) this.footerSocials.push({icon: 'pi-link', url: '', title: ''});
        },

        initCropper(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.rawImageBase64 = e.target.result;
                    this.hasImageToCrop = true;
                    this.uploadedBase64 = ''; // Reset crop state
                };
                reader.readAsDataURL(input.files[0]);
            }
        },

        openCropper() {
            this.isCropping = true;
            this.$nextTick(() => {
                const img = document.getElementById('crop-image');
                img.src = this.rawImageBase64;
                if (this.cropper) {
                    this.cropper.destroy();
                }
                this.cropper = new Cropper(img, {
                    viewMode: 1,
                    dragMode: 'move',
                    aspectRatio: NaN,
                    initialAspectRatio: NaN,
                    autoCropArea: 0.9,
                    restore: false,
                    guides: true,
                    center: true,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false,
                    zoomOnWheel: false, // Turn off default zoom on wheel
                });

                // Lắng nghe sự kiện Ctrl + Lăn chuột
                if (!this._wheelListenerAdded) {
                    img.parentElement.addEventListener('wheel', (e) => {
                        if (e.ctrlKey && this.cropper) {
                            e.preventDefault(); // Chặn cuộn trang
                            this.cropper.zoom(e.deltaY > 0 ? -0.1 : 0.1);
                        }
                    }, { passive: false });
                    this._wheelListenerAdded = true;
                }
            });
        },

        cancelCrop() {
            this.isCropping = false;
            if (this.cropper) {
                this.cropper.destroy();
                this.cropper = null;
            }
        },

        saveCrop() {
            if (this.cropper) {
                this.uploadedBase64 = this.cropper.getCroppedCanvas({
                    maxWidth: 4096,
                    maxHeight: 4096
                }).toDataURL('image/png');
                this.isCropping = false;
                if(window.showToast) {
                    window.showToast('Đã áp dụng mẫu cắt!', 'success');
                } else {
                    alert('Đã áp dụng ảnh cắt tạm thời. Nhấn "Lưu cấu hình" để cập nhật chính thức.');
                }
            }
        },

        getPreviewLogo() {
            if (this.logoMode === 'upload' && this.uploadedBase64) return this.uploadedBase64;
            if (this.logoMode === 'existing' && this.selectedLogo) {
                // Return selected logo, ensure it handles absolute/relative paths
                return this.selectedLogo.startsWith('uploads/') ? '/' + this.selectedLogo : this.selectedLogo;
            }
            return ''; // Causes fallback
        },

        async deleteLogo(path) {
            if(confirm('Bạn có chắc chắn muốn xóa vĩnh viễn logo này khỏi máy chủ?')) {
                try {
                    const res = await fetch('{{ route("admin.settings.logo.delete") }}', {
                        method: 'DELETE',
                        headers: { 
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({path: path})
                    });
                    const data = await res.json();
                    if(data.success) {
                        this.logos = this.logos.filter(l => l !== path);
                        if(this.selectedLogo === path) this.selectedLogo = '';
                        window.showToast('Đã xóa logo thành công!', 'success');
                    } else {
                        window.showToast('Không thể xóa logo!', 'error');
                    }
                } catch(e) {
                    window.showToast('Lỗi mạng khi xóa logo', 'error');
                }
            }
        }
    }
}
</script>
@endsection
