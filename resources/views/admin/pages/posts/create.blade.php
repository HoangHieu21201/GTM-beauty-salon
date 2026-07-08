@extends('layouts.admin')

@section('title', 'Viết bài mới - Review Thẩm Mỹ Admin')

@section('content')
    <!-- Top Header Bar -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ url('/admin/posts') }}" class="text-gray-500 hover:text-gray-800 transition-colors">
                <i class="pi pi-arrow-left text-[18px]"></i>
            </a>
            <h1 class="text-[24px] font-bold text-[#1F2733] flex items-center gap-3">
                Thêm bài viết mới
                <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-gray-100 text-gray-500 uppercase tracking-wider">Nháp</span>
            </h1>
        </div>
        <div class="flex items-center gap-5">
            <div class="text-sm text-gray-500 font-medium" id="readingStats">0 từ - 0 phút đọc</div>
            <div class="flex gap-2">
                <button type="button" onclick="openPreview()" class="px-4 py-2 font-semibold text-sm bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-2 shadow-sm">
                    <i class="pi pi-eye"></i> Xem trước
                </button>
                <button type="button" class="px-4 py-2 font-semibold text-sm bg-primary border border-primary text-white rounded-lg hover:bg-primary-dark transition-colors flex items-center gap-2 shadow-sm">
                    <i class="pi pi-check"></i> Lưu bài viết
                </button>
            </div>
        </div>
    </div>

    <!-- Main 2-Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- LEFT COLUMN (Main Content) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Editor Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lg:p-8">
                <!-- Title & Slug -->
                <div class="mb-6">
                    <input type="text" id="postTitle" value="Bọc răng sứ giá bao nhiêu? Bảng giá 2026 và 5 điều phải hỏi trước khi làm" class="w-full text-[22px] font-bold text-[#1f2937] placeholder-gray-400 border border-gray-200 rounded-xl px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary transition-colors mb-3 outline-none shadow-sm">
                    
                    <div class="flex items-center gap-2 text-[13px] text-gray-500 font-mono">
                        <i class="pi pi-at text-gray-400"></i>
                        <span>/bai-viet/</span>
                        <span id="postSlug" class="text-primary px-2 py-1 border border-dashed border-gray-300 rounded bg-gray-50/50">boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam</span>
                    </div>
                </div>

                <!-- Short Description -->
                <div class="mb-6">
                    <div class="flex justify-between items-end mb-2">
                        <label class="text-[12px] font-bold text-[#4b5563] uppercase tracking-wider">
                            Mô tả ngắn <span class="text-gray-400 font-normal normal-case tracking-normal ml-1">(hiển thị ở danh sách & mặc định làm meta description)</span>
                        </label>
                    </div>
                    <textarea id="postExcerpt" rows="3" class="w-full bg-white border border-gray-200 rounded-xl p-3 text-[14px] text-[#4b5563] focus:border-primary focus:ring-1 focus:ring-primary transition resize-none outline-none shadow-sm">Giá bọc răng sứ chênh từ 1 đến 15 triệu mỗi răng — vì sao? Phân tích từng dòng sứ, cảnh báo bọc sứ giá rẻ và 5 câu hỏi bắt buộc trước khi để nha sĩ mài răng thật của bạn.</textarea>
                    <div class="text-right mt-2 font-bold text-[13px] text-orange-500 transition-colors" id="excerptCounter">170/160</div>
                </div>

                <!-- WYSIWYG Editor Mockup -->
                <div>
                    <!-- Editor Toolbar Info -->
                    <div class="flex items-center gap-4 mb-3">
                        <button class="text-[13px] font-semibold text-primary border border-blue-200 hover:bg-blue-50 bg-white px-3 py-1.5 rounded-lg transition-colors flex items-center gap-2 shadow-sm">
                            <i class="pi pi-list"></i> Chèn mẫu Toplist
                        </button>
                        <span class="text-[13px] text-gray-400 flex items-center gap-2">
                            <i class="pi pi-image"></i> Kéo-thả / dán ảnh vào editor để upload S3
                        </span>
                    </div>
                    
                    <!-- Editor Box -->
                    <div class="border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">
                        <!-- Toolbar -->
                        <div class="border-b border-gray-200 bg-white p-3 flex flex-wrap items-center gap-x-1 gap-y-2">
                            <button type="button" onclick="formatDoc('undo')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors" title="Undo"><i class="pi pi-undo"></i></button>
                            <button type="button" onclick="formatDoc('redo')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors" title="Redo"><i class="pi pi-refresh"></i></button>
                            
                            <div class="w-px h-5 bg-gray-200 mx-2"></div>
                            
                            <div class="relative flex items-center">
                                <select onchange="formatDoc('formatBlock', this.value)" class="appearance-none text-[14px] bg-transparent border-0 py-1 pl-2 pr-6 font-semibold text-gray-700 focus:ring-0 cursor-pointer outline-none">
                                    <option value="p">Văn bản</option>
                                    <option value="H2">Tiêu đề 2</option>
                                    <option value="H3">Tiêu đề 3</option>
                                </select>
                                <div class="absolute right-0 pointer-events-none flex flex-col justify-center text-[10px] text-gray-600">
                                    <i class="pi pi-caret-up -mb-1"></i>
                                    <i class="pi pi-caret-down"></i>
                                </div>
                            </div>

                            <div class="w-px h-5 bg-gray-200 mx-2"></div>

                            <button type="button" onclick="formatDoc('bold')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 font-bold transition-colors">B</button>
                            <button type="button" onclick="formatDoc('italic')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 italic font-serif transition-colors">I</button>
                            <button type="button" onclick="formatDoc('underline')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 underline transition-colors">U</button>
                            <button type="button" onclick="formatDoc('strikeThrough')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 line-through transition-colors">S</button>
                            
                            <div class="w-px h-5 bg-gray-200 mx-2"></div>

                            @php
                                $editorColors = [
                                    '#000000', '#e60000', '#ff9900', '#ffff00', '#008a00', '#0066cc',
                                    '#9933ff', '#ffffff', '#facccc', '#ffebcc', '#ffffcc', '#cce8cc',
                                    '#cce0f5', '#ebd6ff', '#bbbbbb', '#f06666', '#ffc266', '#ffff66',
                                    '#66b966', '#66a3e0', '#c285ff', '#888888', '#a10000', '#b26b00',
                                    '#b2b200', '#006100', '#0047b2', '#6b24b2', '#444444', '#5c0000',
                                    '#5c3317', '#5c5c00', '#003300', '#002966', '#3d1466', 'transparent'
                                ];
                            @endphp

                            <div class="relative z-10" id="textColorContainer">
                                <button type="button" onclick="toggleDropdown('textColorDropdown')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 font-bold transition-colors border-b-2 border-black focus:bg-gray-100">A</button>
                                <div id="textColorDropdown" class="absolute top-full left-0 mt-1 hidden bg-white p-2.5 rounded-xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.15)] border border-gray-100">
                                    <div class="grid grid-cols-6 gap-1 w-max">
                                        @foreach($editorColors as $color)
                                        <button type="button" onclick="formatDoc('foreColor', '{{ $color }}'); toggleDropdown('textColorDropdown');" class="w-5 h-5 rounded-sm hover:scale-110 transition-transform {{ $color === '#ffffff' || $color === 'transparent' ? 'border border-gray-200' : '' }}" style="background-color: {{ $color }}"></button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <div class="relative z-10 mx-1" id="bgColorContainer">
                                <button type="button" onclick="toggleDropdown('bgColorDropdown')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 bg-gray-100 text-gray-400 font-bold transition-colors border border-gray-200 focus:bg-gray-200" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 2px, #e5e7eb 2px, #e5e7eb 4px);">A</button>
                                <div id="bgColorDropdown" class="absolute top-full left-0 mt-1 hidden bg-white p-2.5 rounded-xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.15)] border border-gray-100">
                                    <div class="grid grid-cols-6 gap-1 w-max">
                                        @foreach($editorColors as $color)
                                        <button type="button" onclick="formatDoc('hiliteColor', '{{ $color }}'); toggleDropdown('bgColorDropdown');" class="w-5 h-5 rounded-sm hover:scale-110 transition-transform {{ $color === '#ffffff' || $color === 'transparent' ? 'border border-gray-200' : '' }}" style="background-color: {{ $color }}"></button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="w-px h-5 bg-gray-200 mx-2"></div>

                            <button type="button" onclick="formatDoc('insertUnorderedList')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-list"></i></button>
                            <button type="button" onclick="formatDoc('justifyFull')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-align-justify"></i></button>
                            <button type="button" onclick="formatDoc('justifyLeft')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-align-left"></i></button>
                            <button type="button" onclick="formatDoc('justifyCenter')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-align-center"></i></button>
                            <button type="button" onclick="formatDoc('justifyRight')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-align-right"></i></button>

                            <div class="w-px h-5 bg-gray-200 mx-2"></div>
                            
                            <button type="button" onclick="formatDoc('formatBlock', 'blockquote')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 font-bold font-serif text-[18px]">"</button>
                            <button type="button" onclick="formatDoc('formatBlock', 'pre')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 font-bold font-mono">&lt;/&gt;</button>
                            <button type="button" onclick="const url=prompt('Nhập link liên kết:'); if(url) formatDoc('createLink', url)" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-link"></i></button>
                            <button type="button" onclick="const url=prompt('Nhập URL hình ảnh:'); if(url) formatDoc('insertImage', url)" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-image"></i></button>
                            <button type="button" onclick="const code=prompt('Nhập mã nhúng Video (Iframe):'); if(code) formatDoc('insertHTML', code)" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-video"></i></button>

                            <button type="button" onclick="formatDoc('removeFormat')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 font-serif italic transition-colors relative"><span class="absolute text-[10px] bottom-1 right-0 font-sans not-italic">x</span>T</button>
                        </div>
                        
                        <!-- Content Area -->
                        <div class="p-6 min-h-[500px] outline-none text-[15.5px] leading-relaxed text-[#4b5563] cursor-text caret-primary" contenteditable="true" id="postContent">
                            <p class="mb-4"><strong class="font-semibold text-gray-800">"Bọc răng sứ giá bao nhiêu?"</strong> là câu hỏi có câu trả lời dao động gấp 15 lần giữa các phòng khám — từ 1 triệu đến 15 triệu mỗi răng. Chênh lệch này có lý do chính đáng, và cũng có cả bẫy. Bài viết giúp bạn phân biệt hai thứ đó.</p>
                            
                            <h2 class="text-[22px] font-bold mt-8 mb-4 border-l-[3px] border-primary pl-4 text-gray-800">Bảng giá bọc răng sứ 2026</h2>
                            <table class="w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="border border-gray-300 p-2.5 text-left font-semibold text-gray-700">Dòng sứ</th>
                                        <th class="border border-gray-300 p-2.5 text-left font-semibold text-gray-700">Giá/răng</th>
                                        <th class="border border-gray-300 p-2.5 text-left font-semibold text-gray-700">Tuổi thọ</th>
                                        <th class="border border-gray-300 p-2.5 text-left font-semibold text-gray-700">Đặc điểm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-300 p-2.5"></td>
                                        <td class="border border-gray-300 p-2.5"></td>
                                        <td class="border border-gray-300 p-2.5"></td>
                                        <td class="border border-gray-300 p-2.5"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN (Sidebar & SEO) -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Box 1: Xuất bản & Thuộc tính -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-[14px] text-gray-800 flex items-center gap-2 mb-5 uppercase tracking-wider">
                    <i class="pi pi-send text-primary"></i> Thuộc tính
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-2">Trạng thái</label>
                        <select class="w-full bg-gray-50 border border-gray-200 rounded-lg p-2.5 text-[14px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary transition outline-none">
                            <option>Nháp</option>
                            <option>Đã đăng</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-2">Danh mục</label>
                        <select class="w-full bg-gray-50 border border-gray-200 rounded-lg p-2.5 text-[14px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary transition outline-none">
                            <option>-- Chọn danh mục --</option>
                            <option>Bọc răng sứ</option>
                            <option>Niềng răng</option>
                            <option>Trị mụn</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Box 2: Ảnh Bìa -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-[14px] text-gray-800 flex items-center gap-2 mb-5 uppercase tracking-wider">
                    <i class="pi pi-image text-primary"></i> Ảnh bìa
                </h3>
                
                <!-- Mockup of selected image -->
                <div class="relative w-full aspect-video rounded-lg overflow-hidden border border-gray-200 mb-3 group bg-gray-50">
                    <img src="https://picsum.photos/400/250?random=10" alt="Cover" class="w-full h-full object-cover">
                    <!-- Delete Button -->
                    <button class="absolute top-2 right-2 w-7 h-7 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600 shadow">
                        <i class="pi pi-times text-[12px]"></i>
                    </button>
                </div>
                
                <div class="flex gap-2">
                    <button class="px-4 py-2 text-[13px] font-bold bg-gray-50 border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-100 flex items-center gap-2 transition-colors">
                        <i class="pi pi-cloud-upload"></i> Tải ảnh
                    </button>
                    <input type="text" placeholder="Hoặc dán URL ảnh..." class="flex-1 bg-gray-50 border border-gray-200 rounded-lg px-3 text-[13px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition">
                </div>
            </div>

            <!-- Box 3: Meta Đính kèm -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-2">Cơ sở liên quan</label>
                        <select class="w-full bg-gray-50 border border-gray-200 rounded-lg p-2.5 text-[14px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary transition outline-none">
                            <option>-- Chọn cơ sở --</option>
                            <option>Bệnh viện Thẩm mỹ Hoàn Mỹ</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-2">
                            Tỉnh thành <span class="normal-case font-normal text-gray-400">(có thể chọn nhiều)</span>
                        </label>
                        <!-- Fake Multi-select UI -->
                        <div class="w-full bg-gray-50 border border-gray-200 rounded-lg p-2 flex flex-wrap gap-2 cursor-pointer hover:border-primary transition-colors">
                            <span class="flex items-center gap-1 bg-white border border-gray-200 px-2 py-1 rounded text-[13px] font-semibold text-gray-700 shadow-sm">
                                Hà Nội <i class="pi pi-times text-[10px] text-gray-400 hover:text-red-500 ml-1"></i>
                            </span>
                            <span class="flex items-center gap-1 bg-white border border-gray-200 px-2 py-1 rounded text-[13px] font-semibold text-gray-700 shadow-sm">
                                Hải Phòng <i class="pi pi-times text-[10px] text-gray-400 hover:text-red-500 ml-1"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Box 4: SEO Analyzer -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" id="seoAnalyzer">
                <!-- Header with Score -->
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-bold text-[16px] text-gray-800 flex items-center gap-2 uppercase tracking-wider">
                        <i class="pi pi-search text-primary"></i> SEO
                    </h3>
                    
                    <!-- Circular Score Chart -->
                    <div class="relative w-[50px] h-[50px] rounded-full flex items-center justify-center font-black text-[15px] shadow-inner" style="background: conic-gradient(#f59e0b 0%, #f59e0b 0%, #e5e7eb 0%, #e5e7eb 100%);" id="seoScoreRing">
                        <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center z-10" id="seoScoreText">0%</div>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    <!-- Focus Keyword -->
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-2">Từ khóa chính</label>
                        <input type="text" id="seoKeyword" placeholder="Nhập từ khóa cần SEO..." class="w-full bg-gray-50 border border-gray-200 rounded-lg p-2.5 text-[14px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary transition outline-none">
                    </div>

                    <!-- Meta Title -->
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-2">
                            Meta Title <span class="normal-case font-normal text-gray-400">(trống = dùng tiêu đề)</span>
                        </label>
                        <input type="text" id="seoTitle" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-2.5 text-[14px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary transition outline-none">
                        <div class="text-right mt-1 font-bold text-[12px] transition-colors" id="seoTitleCounter">0/65</div>
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-2">
                            Meta Description <span class="normal-case font-normal text-gray-400">(trống = dùng mô tả ngắn)</span>
                        </label>
                        <textarea id="seoDesc" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-3 text-[14px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary transition resize-none"></textarea>
                        <div class="text-right mt-1 font-bold text-[12px] transition-colors" id="seoDescCounter">0/160</div>
                    </div>

                    <!-- Google Preview -->
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-2">Xem trước kết quả tìm kiếm</label>
                        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                            <div class="flex items-center gap-3 mb-1">
                                <div class="w-7 h-7 bg-gray-100 rounded-full flex items-center justify-center text-gray-400">
                                    <i class="pi pi-globe text-[12px]"></i>
                                </div>
                                <div class="text-[12px] text-gray-600 truncate">
                                    sxtmhavydecor.click/bai-viet/<span id="previewSlug"></span>
                                </div>
                            </div>
                            <div class="text-[20px] text-[#1a0dab] hover:underline cursor-pointer mb-1 leading-tight" style="font-family: arial, sans-serif;" id="previewTitle">
                                Tiêu đề SEO sẽ hiển thị ở đây
                            </div>
                            <div class="text-[14px] text-[#4d5156] leading-snug" style="font-family: arial, sans-serif;" id="previewDesc">
                                Vui lòng cung cấp Meta Description hoặc Mô tả ngắn để Google có thể hiển thị đoạn mã trích dẫn này...
                            </div>
                        </div>
                    </div>

                    <!-- SEO Checklist -->
                    <div class="bg-gray-50 -mx-6 -mb-6 p-6 border-t border-gray-100">
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-4">Kết quả phân tích</label>
                        <ul class="space-y-3 text-[13.5px] font-medium" id="seoChecklist">
                            <!-- Checklist items will be generated by JS -->
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 z-[100] hidden bg-[#111827] flex-col transition-opacity duration-300 opacity-0">
        <!-- Topbar -->
        <div class="h-14 flex items-center justify-between px-4 border-b border-gray-800 shrink-0">
            <div class="flex items-center gap-2 text-white font-semibold text-sm">
                <i class="pi pi-eye"></i> Xem trước
            </div>
            
            <div class="flex items-center gap-1 bg-[#1f2937] p-1 rounded-lg">
                <button onclick="setPreviewMode('desktop')" id="btnPreviewDesktop" class="flex items-center gap-2 px-3 py-1 rounded-md text-xs font-semibold transition-colors bg-[#2563eb] text-white">
                    <i class="pi pi-desktop"></i> Desktop
                </button>
                <button onclick="setPreviewMode('mobile')" id="btnPreviewMobile" class="flex items-center gap-2 px-3 py-1 rounded-md text-xs font-semibold transition-colors text-gray-400 hover:text-white">
                    <i class="pi pi-mobile"></i> Mobile
                </button>
            </div>
            
            <button onclick="closePreview()" class="text-gray-400 hover:text-white transition-colors w-8 h-8 flex items-center justify-center rounded-full hover:bg-white/10">
                <i class="pi pi-times"></i>
            </button>
        </div>
        
        <!-- Content Area -->
        <div class="flex-1 overflow-y-auto p-4 md:p-8 flex justify-center w-full">
            <div id="previewContainer" class="bg-white rounded-xl shadow-2xl w-full max-w-[800px] transition duration-300 h-max overflow-hidden">
                <div class="p-6 md:p-10">
                    <div id="previewCat" class="inline-block px-2.5 py-1 bg-blue-50 text-[#2563eb] text-[11px] font-bold rounded mb-4 uppercase tracking-wider">BỌC RĂNG SỨ</div>
                    <h1 id="previewTitle" class="text-[28px] md:text-[32px] font-bold text-gray-900 mb-4 leading-tight">Tiêu đề bài viết</h1>
                    
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-[13px] text-gray-500 mb-8 font-medium">
                        <span class="flex items-center gap-1.5"><i class="pi pi-calendar text-[12px]"></i> <span id="previewDate"></span></span>
                        <span class="flex items-center gap-1.5"><i class="pi pi-eye text-[12px]"></i> 0 lượt xem</span>
                        <span class="flex items-center gap-1.5"><i class="pi pi-clock text-[12px]"></i> <span id="previewReadTime">0 phút đọc</span></span>
                    </div>
                    
                    <div class="w-full h-[250px] md:h-[400px] bg-gray-100 rounded-xl mb-8 overflow-hidden relative group">
                        <img id="previewImage" src="https://images.unsplash.com/photo-1546182990-dffeafbe841d?q=80&w=2059&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Preview Cover" />
                    </div>
                    
                    <div id="previewBody" class="prose max-w-none text-[#374151] text-[16px] leading-relaxed">
                        <!-- Content goes here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    /**
     * Editor Format Logic
     */
    window.formatDoc = function(cmd, value = null) {
        document.execCommand(cmd, false, value);
        document.getElementById('postContent').focus();
    };

    /**
     * Dropdown Logic
     */
    window.toggleDropdown = function(id) {
        // Hide others
        if (id !== 'textColorDropdown') document.getElementById('textColorDropdown').classList.add('hidden');
        if (id !== 'bgColorDropdown') document.getElementById('bgColorDropdown').classList.add('hidden');
        
        const el = document.getElementById(id);
        el.classList.toggle('hidden');
    };

    // Close dropdowns on outside click
    document.addEventListener('click', function(event) {
        const isClickInsideTextColor = document.getElementById('textColorContainer').contains(event.target);
        const isClickInsideBgColor = document.getElementById('bgColorContainer').contains(event.target);
        
        if (!isClickInsideTextColor) {
            document.getElementById('textColorDropdown').classList.add('hidden');
        }
        if (!isClickInsideBgColor) {
            document.getElementById('bgColorDropdown').classList.add('hidden');
        }
    });

    /**
     * Preview Modal Logic
     */
    window.openPreview = function() {
        const modal = document.getElementById('previewModal');
        
        // Populate data
        document.getElementById('previewTitle').innerText = document.getElementById('postTitle').value || 'Chưa có tiêu đề';
        document.getElementById('previewBody').innerHTML = document.getElementById('postContent').innerHTML;
        
        const today = new Date();
        document.getElementById('previewDate').innerText = today.toLocaleDateString('vi-VN');
        
        const stats = document.getElementById('readingStats').innerText.split(' - ');
        if(stats.length > 1) {
            document.getElementById('previewReadTime').innerText = stats[1].trim();
        }
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
        }, 10);
        document.body.style.overflow = 'hidden'; // prevent background scrolling
    };

    window.closePreview = function() {
        const modal = document.getElementById('previewModal');
        modal.classList.add('opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    };

    window.setPreviewMode = function(mode) {
        const container = document.getElementById('previewContainer');
        const btnDesktop = document.getElementById('btnPreviewDesktop');
        const btnMobile = document.getElementById('btnPreviewMobile');
        
        if (mode === 'desktop') {
            container.style.maxWidth = '800px';
            btnDesktop.className = 'flex items-center gap-2 px-3 py-1 rounded-md text-xs font-semibold transition-colors bg-[#2563eb] text-white';
            btnMobile.className = 'flex items-center gap-2 px-3 py-1 rounded-md text-xs font-semibold transition-colors text-gray-400 hover:text-white';
        } else {
            container.style.maxWidth = '375px'; // standard mobile width
            btnMobile.className = 'flex items-center gap-2 px-3 py-1 rounded-md text-xs font-semibold transition-colors bg-[#2563eb] text-white';
            btnDesktop.className = 'flex items-center gap-2 px-3 py-1 rounded-md text-xs font-semibold transition-colors text-gray-400 hover:text-white';
        }
    };

    /**
     * SEO Analyzer Logic (Mockup for Real-time scoring)
     */
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('postTitle');
        const slugSpan = document.getElementById('postSlug');
        const excerptInput = document.getElementById('postExcerpt');
        const excerptCounter = document.getElementById('excerptCounter');
        
        const contentDiv = document.getElementById('postContent');
        const readingStats = document.getElementById('readingStats');
        
        const keywordInput = document.getElementById('seoKeyword');
        const seoTitleInput = document.getElementById('seoTitle');
        const seoTitleCounter = document.getElementById('seoTitleCounter');
        const seoDescInput = document.getElementById('seoDesc');
        const seoDescCounter = document.getElementById('seoDescCounter');
        
        const previewTitle = document.getElementById('previewTitle');
        const previewDesc = document.getElementById('previewDesc');
        const previewSlug = document.getElementById('previewSlug');
        
        const scoreRing = document.getElementById('seoScoreRing');
        const scoreText = document.getElementById('seoScoreText');
        const checklist = document.getElementById('seoChecklist');

        // Utils
        const generateSlug = (text) => {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           
                .replace(/[^\w\-]+/g, '')       
                .replace(/\-\-+/g, '-')         
                .replace(/^-+/, '')             
                .replace(/-+$/, '');            
        };

        const countWords = (str) => {
            return str.trim().split(/\s+/).filter(word => word.length > 0).length;
        };

        const updateCounter = (el, count, max) => {
            el.innerText = `${count}/${max}`;
            if (count > max) {
                el.classList.add('text-orange-500');
                el.classList.remove('text-gray-400', 'text-green-600');
            } else if (count > 0) {
                el.classList.add('text-green-600');
                el.classList.remove('text-gray-400', 'text-orange-500');
            } else {
                el.classList.add('text-gray-400');
                el.classList.remove('text-green-600', 'text-orange-500');
            }
        };

        // Main Engine
        const analyzeSEO = () => {
            const title = titleInput.value;
            const excerpt = excerptInput.value;
            const content = contentDiv.innerText;
            const wordCount = countWords(content);
            const readTime = Math.max(1, Math.ceil(wordCount / 200)); // Average 200 wpm
            
            readingStats.innerText = `${wordCount} từ - ${readTime} phút đọc`;
            
            slugSpan.innerText = generateSlug(title) || 'tieu-de-bai-viet';
            previewSlug.innerText = generateSlug(title) || 'tieu-de-bai-viet';
            
            // Sync Excerpt Counter
            updateCounter(excerptCounter, excerpt.length, 160);

            // Sync SEO Meta (fallback to post title/excerpt)
            const metaTitle = seoTitleInput.value || title;
            const metaDesc = seoDescInput.value || excerpt;
            const keyword = keywordInput.value.toLowerCase().trim();

            updateCounter(seoTitleCounter, metaTitle.length, 65);
            updateCounter(seoDescCounter, metaDesc.length, 160);

            previewTitle.innerText = metaTitle || 'Tiêu đề SEO sẽ hiển thị ở đây';
            previewDesc.innerText = metaDesc || 'Vui lòng cung cấp Meta Description hoặc Mô tả ngắn để Google có thể hiển thị đoạn mã trích dẫn này...';

            // Scoring Logic
            let score = 0;
            let maxScore = 100;
            const checks = [];

            const addCheck = (condition, textPass, textFail) => {
                if (condition) {
                    checks.push(`<li class="flex items-start gap-2 text-green-600"><i class="pi pi-check-circle mt-0.5"></i> <span>${textPass}</span></li>`);
                    score += 15;
                } else {
                    checks.push(`<li class="flex items-start gap-2 text-orange-500"><i class="pi pi-circle mt-0.5"></i> <span>${textFail}</span></li>`);
                }
            };

            // Rule 1: Meta Title Length
            addCheck(metaTitle.length >= 30 && metaTitle.length <= 65, 
                `Meta title độ dài chuẩn (hiện ${metaTitle.length})`, 
                `Meta title nên từ 30-65 ký tự (hiện ${metaTitle.length})`);
            
            // Rule 2: Meta Desc Length
            addCheck(metaDesc.length >= 70 && metaDesc.length <= 160, 
                `Meta description độ dài chuẩn (hiện ${metaDesc.length})`, 
                `Meta description nên từ 70-160 ký tự (hiện ${metaDesc.length})`);

            // Rule 3: Content Length
            addCheck(wordCount >= 600, 
                `Nội dung đủ dài ≥ 600 từ (hiện ${wordCount})`, 
                `Nội dung quá ngắn < 600 từ (hiện ${wordCount})`);

            // Rule 4: Headings
            const h2Count = (contentDiv.innerHTML.match(/<h2/gi) || []).length;
            addCheck(h2Count >= 2, 
                `Có ≥ 2 thẻ H2 để tạo mục lục (hiện ${h2Count})`, 
                `Nên có ≥ 2 thẻ H2 để cấu trúc bài viết rõ ràng (hiện ${h2Count})`);

            // Rule 5: Focus Keyword (if provided)
            if (keyword) {
                const keywordInTitle = metaTitle.toLowerCase().includes(keyword);
                const keywordInDesc = metaDesc.toLowerCase().includes(keyword);
                const keywordInContent = content.toLowerCase().includes(keyword);
                
                addCheck(keywordInTitle, `Từ khóa xuất hiện trong meta title`, `Từ khóa chưa có trong meta title`);
                addCheck(keywordInDesc, `Từ khóa xuất hiện trong meta description`, `Từ khóa chưa có trong meta description`);
                addCheck(keywordInContent, `Từ khóa xuất hiện trong nội dung`, `Từ khóa chưa xuất hiện trong nội dung`);
                maxScore = 105; // 7 rules * 15
            } else {
                checks.push(`<li class="flex items-start gap-2 text-gray-400"><i class="pi pi-info-circle mt-0.5"></i> <span>Nhập từ khóa chính để đánh giá sâu hơn</span></li>`);
                maxScore = 60; // 4 rules * 15
            }

            // Calculate percentage
            const percentage = Math.round((score / maxScore) * 100) || 0;
            scoreText.innerText = `${percentage}%`;

            // Color gradient logic based on score
            let color = '#ef4444'; // Red < 50
            if (percentage >= 50 && percentage < 80) color = '#f59e0b'; // Orange
            if (percentage >= 80) color = '#10b981'; // Green

            if (percentage > 0) {
                scoreText.style.color = color;
                scoreRing.style.background = `conic-gradient(${color} ${percentage}%, #e5e7eb ${percentage}%)`;
            } else {
                scoreText.style.color = '#9ca3af';
                scoreRing.style.background = `#e5e7eb`;
            }

            // Render Checklist
            checklist.innerHTML = checks.join('');
        };

        // Event Listeners
        titleInput.addEventListener('input', analyzeSEO);
        excerptInput.addEventListener('input', analyzeSEO);
        contentDiv.addEventListener('input', analyzeSEO);
        keywordInput.addEventListener('input', analyzeSEO);
        seoTitleInput.addEventListener('input', analyzeSEO);
        seoDescInput.addEventListener('input', analyzeSEO);

        // Initial Run
        analyzeSEO();
    });
</script>
@endpush
