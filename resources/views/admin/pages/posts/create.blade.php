@extends('layouts.admin')

@section('title', 'Viết bài mới - Review Thẩm Mỹ Admin')

@section('content')
    <style>
        #postContent h2 {
            font-size: 24px !important;
            font-weight: 700 !important;
            margin-top: 1.75rem !important;
            margin-bottom: 1rem !important;
            border-left: 4px solid #2563eb !important;
            padding-left: 1rem !important;
            color: #1f2937 !important;
            line-height: 1.4 !important;
            display: block !important;
        }
        #postContent h3 {
            font-size: 18px !important;
            font-weight: 700 !important;
            margin-top: 1.5rem !important;
            margin-bottom: 0.75rem !important;
            color: #1f2937 !important;
            line-height: 1.4 !important;
            display: block !important;
        }
        #postContent table {
            table-layout: fixed !important;
            width: 100% !important;
            border-collapse: collapse !important;
        }
        #postContent td, #postContent th {
            word-break: break-word !important;
        }
        #postContent blockquote {
            border-left: 4px solid #2563eb !important;
            padding-left: 1rem !important;
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
            padding-right: 0.75rem !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
            font-size: 15px !important;
            color: #4b5563 !important;
            background-color: #eff6ff !important;
            border-top-right-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
            display: block !important;
        }
        #postContent ul.checklist-list {
            list-style: none !important;
            padding-left: 0 !important;
            margin-left: 0 !important;
        }
        #postContent ul.checklist-list li {
            list-style-type: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            margin-bottom: 0.5rem !important;
        }
        #postContent ul:not(.checklist-list) {
            list-style-type: disc !important;
            padding-left: 2rem !important;
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
            display: block !important;
        }
        #postContent ol {
            list-style-type: decimal !important;
            padding-left: 2rem !important;
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
            display: block !important;
        }
        #postContent li {
            display: list-item !important;
            margin-bottom: 0.25rem !important;
        }
        #postContent ul.checklist-list li {
            display: flex !important;
        }
        #postContent a {
            color: #2563eb !important;
            text-decoration: underline !important;
            font-weight: 500 !important;
        }
    </style>
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold flex items-center gap-2 shadow-sm">
            <i class="pi pi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm font-semibold shadow-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.store') }}" method="POST" id="createPostForm" enctype="multipart/form-data">
        @csrf

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
                    <button type="submit" class="px-4 py-2 font-semibold text-sm bg-primary border border-primary text-white rounded-lg hover:bg-primary-dark transition-colors flex items-center gap-2 shadow-sm">
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
                        <input type="text" id="postTitle" name="title" value="{{ old('title') }}" placeholder="Nhập tiêu đề bài viết..." class="w-full text-[22px] font-bold text-[#1f2937] placeholder-gray-400 border border-gray-200 rounded-xl px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary transition-colors mb-3 outline-none shadow-sm">
                        
                        <div class="flex items-center gap-2 text-[13px] text-gray-500 font-mono">
                            <i class="pi pi-at text-gray-400"></i>
                            <span>/bai-viet/</span>
                            <span id="postSlug" class="text-primary px-2 py-1 border border-dashed border-gray-300 rounded bg-gray-50/50">nhap-tieu-de-bai-viet</span>
                            <input type="hidden" name="slug" id="hiddenSlug" value="{{ old('slug') }}">
                        </div>
                    </div>

                <!-- Short Description -->
                <div class="mb-6">
                    <div class="flex justify-between items-end mb-2">
                        <label class="text-[12px] font-bold text-[#4b5563] uppercase tracking-wider">
                            Mô tả ngắn <span class="text-gray-400 font-normal normal-case tracking-normal ml-1">(hiển thị ở danh sách & mặc định làm meta description)</span>
                        </label>
                    </div>
                    <textarea id="postExcerpt" name="short_description" rows="3" class="w-full bg-white border border-gray-200 rounded-xl p-3 text-[14px] text-[#4b5563] focus:border-primary focus:ring-1 focus:ring-primary transition resize-none outline-none shadow-sm">{{ old('short_description') }}</textarea>
                    <div class="text-right mt-2 font-bold text-[13px] text-orange-500 transition-colors" id="excerptCounter">0/160</div>
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
                    <div class="border border-gray-200 rounded-xl bg-white shadow-sm relative">
                        <!-- Toolbar -->
                        <div class="sticky top-0 z-20 border-b border-gray-200 bg-white p-3 flex flex-wrap items-center gap-x-1 gap-y-2 rounded-t-xl shadow-[0_2px_10px_rgba(0,0,0,0.03)]" style="position: sticky; top: 0; z-index: 20; background-color: #ffffff;">
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

                            <button type="button" onclick="formatDoc('insertOrderedList')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors" title="Danh sách số">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6h10M10 12h10M10 18h10" />
                                    <text x="2" y="9" font-family="sans-serif" font-size="8px" font-weight="bold" fill="currentColor">1</text>
                                    <text x="2" y="15" font-family="sans-serif" font-size="8px" font-weight="bold" fill="currentColor">2</text>
                                </svg>
                            </button>
                            <button type="button" onclick="formatDoc('insertUnorderedList')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors" title="Danh sách dấu chấm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <circle cx="4" cy="6" r="1.5" fill="currentColor"/>
                                    <circle cx="4" cy="12" r="1.5" fill="currentColor"/>
                                    <circle cx="4" cy="18" r="1.5" fill="currentColor"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 6h12M9 12h12M9 18h12" />
                                </svg>
                            </button>
                            <button type="button" onclick="insertChecklist()" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors" title="Danh sách công việc (Checklist)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </button>
                            <button type="button" onclick="formatDoc('justifyFull')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-align-justify"></i></button>
                            <button type="button" onclick="formatDoc('justifyLeft')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-align-left"></i></button>
                            <button type="button" onclick="formatDoc('justifyCenter')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-align-center"></i></button>
                            <button type="button" onclick="formatDoc('justifyRight')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-align-right"></i></button>

                            <div class="w-px h-5 bg-gray-200 mx-2"></div>
                            
                            <button type="button" onclick="formatDoc('formatBlock', 'blockquote')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 font-bold font-serif text-[18px]">"</button>
                            <button type="button" onclick="formatDoc('formatBlock', 'pre')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 font-bold font-mono">&lt;/&gt;</button>
                             <button type="button" onmousedown="event.preventDefault()" onclick="showLinkPopover()" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors" title="Chèn liên kết"><i class="pi pi-link"></i></button>
                            <button type="button" onclick="document.getElementById('editorImageInput').click()" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors" title="Chèn ảnh từ máy tính"><i class="pi pi-image"></i></button>
                             <input type="file" id="editorImageInput" accept="image/*" class="hidden" style="display: none;">
                             <button type="button" onclick="const code=prompt('Nhập mã nhúng Video (Iframe):'); if(code) formatDoc('insertHTML', code)" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 transition-colors"><i class="pi pi-video"></i></button>

                            <button type="button" onclick="formatDoc('removeFormat')" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100 text-gray-700 font-serif italic transition-colors relative" title="Xóa định dạng"><span class="absolute text-[10px] bottom-1 right-0 font-sans not-italic">x</span>T</button>

                            <div class="w-px h-5 bg-gray-200 mx-2"></div>
                            
                            <!-- Table Tools -->
                            <div class="relative z-10 mx-1" id="tableGeneratorContainer">
                                <button type="button" onclick="toggleDropdown('tableGeneratorDropdown')" class="px-2.5 h-8 flex items-center justify-center rounded border border-gray-200 hover:bg-gray-100 text-gray-700 text-xs font-semibold gap-1.5 transition-colors focus:bg-gray-100 shadow-sm" title="Tạo bảng">
                                    <i class="pi pi-table text-primary"></i> Bảng
                                </button>
                                <div id="tableGeneratorDropdown" class="absolute top-full right-0 mt-1 hidden bg-white p-4 rounded-xl shadow-[0_4px_25px_-5px_rgba(0,0,0,0.15)] border border-gray-100 space-y-3" style="width: 250px !important; min-width: 250px !important; box-sizing: border-box; text-align: left;">
                                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider" style="font-size: 12px; margin-bottom: 8px;">Tạo bảng mới</div>
                                    <div class="grid grid-cols-2 gap-3" style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; margin-bottom: 12px;">
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-400 uppercase mb-1" style="font-size: 11px; display: block; margin-bottom: 4px;">Số dòng</label>
                                            <input type="number" id="tblRows" value="3" min="1" max="20" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-2.5 py-1.5 text-xs text-gray-700 outline-none focus:bg-white focus:border-primary transition-all" style="width: 100%; box-sizing: border-box; padding: 6px 10px; border-radius: 8px; border: 1px solid #e5e7eb;">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-400 uppercase mb-1" style="font-size: 11px; display: block; margin-bottom: 4px;">Số cột</label>
                                            <input type="number" id="tblCols" value="4" min="1" max="10" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-2.5 py-1.5 text-xs text-gray-700 outline-none focus:bg-white focus:border-primary transition-all" style="width: 100%; box-sizing: border-box; padding: 6px 10px; border-radius: 8px; border: 1px solid #e5e7eb;">
                                        </div>
                                    </div>
                                    <button type="button" onclick="createCustomTable(); toggleDropdown('tableGeneratorDropdown');" class="w-full py-2 bg-primary hover:bg-primary-dark text-white rounded-lg text-xs font-bold transition-colors shadow-sm flex items-center justify-center gap-1.5" style="width: 100%; padding: 8px 16px; border-radius: 8px; display: flex; align-items: center; justify-content: center; gap: 6px; font-weight: bold; font-size: 12px;">
                                        <i class="pi pi-plus-circle"></i> Chèn bảng
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Content Area -->
                        <div class="p-6 min-h-[500px] outline-none text-[15.5px] leading-relaxed text-[#4b5563] cursor-text caret-primary" contenteditable="true" id="postContent">
                            {!! old('content') !!}
                        </div>
                        <input type="hidden" name="content" id="hiddenContent" value="{{ old('content') }}">

                        <!-- Link Popover -->
                        <div id="linkPopover" class="absolute hidden bg-white border border-gray-200 rounded-lg shadow-[0_4px_12px_rgba(0,0,0,0.1)] p-2 z-30 flex items-center gap-2" style="width: 280px !important; box-sizing: border-box;">
                            <span class="text-xs text-gray-500 font-semibold flex-shrink-0" style="font-size: 12px; color: #6b7280; font-weight: 600;">Enter link:</span>
                            <input type="text" id="linkPopoverInput" onkeydown="if(event.key==='Enter'){event.preventDefault();savePopoverLink();}" class="flex-1 bg-gray-50 border border-gray-200 rounded px-2.5 py-1 text-xs text-gray-700 outline-none focus:bg-white focus:border-primary transition-all" placeholder="https://" style="width: 140px; font-size: 12px; padding: 4px 8px; border: 1px solid #e5e7eb; border-radius: 4px; box-sizing: border-box;">
                            <button type="button" onclick="savePopoverLink()" class="text-primary hover:text-primary-dark font-bold text-xs px-2 py-1" style="color: #2563eb; font-weight: 700; font-size: 12px; background: none; border: none; cursor: pointer;">Save</button>
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
                        <select name="status" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-2.5 text-[14px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary transition outline-none">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Nháp</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-2">Danh mục</label>
                        <select name="category_id" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-2.5 text-[14px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary transition outline-none">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
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
                    <img src="{{ old('thumbnail', 'https://picsum.photos/400/250?random=10') }}" alt="Cover" class="w-full h-full object-cover">
                    <!-- Delete Button -->
                    <button type="button" onclick="document.getElementById('postThumbnail').value=''; document.querySelector('img[alt=\'Cover\']').src='https://picsum.photos/400/250?random=10';" class="absolute top-2 right-2 w-7 h-7 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600 shadow">
                        <i class="pi pi-times text-[12px]"></i>
                    </button>
                </div>
                
                <div class="flex gap-2">
                    <button type="button" onclick="document.getElementById('coverImageInput').click()" class="px-4 py-2 text-[13px] font-bold bg-gray-50 border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-100 flex items-center gap-2 transition-colors flex-shrink-0">
                        <i class="pi pi-cloud-upload"></i> Chọn file
                    </button>
                    <input type="file" name="thumbnail_file" id="coverImageInput" accept="image/*" class="hidden" style="display: none;">
                    <input type="text" name="thumbnail" id="postThumbnail" value="{{ old('thumbnail') }}" placeholder="Hoặc dán URL ảnh..." class="flex-1 bg-gray-50 border border-gray-200 rounded-lg px-3 text-[13px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition">
                </div>
            </div>

            <!-- Box 3: Meta Đính kèm -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-2">Cơ sở liên quan</label>
                        <select name="salons[]" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-2.5 text-[14px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary transition outline-none">
                            <option value="">-- Chọn cơ sở --</option>
                            @foreach($salons as $salon)
                                <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                            @endforeach
                        </select>
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
                        <input type="text" id="seoKeyword" name="keyword" value="{{ old('keyword') }}" placeholder="Nhập từ khóa cần SEO..." class="w-full bg-gray-50 border border-gray-200 rounded-lg p-2.5 text-[14px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary transition outline-none">
                    </div>

                    <!-- Meta Title -->
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-2">
                            Meta Title <span class="normal-case font-normal text-gray-400">(trống = dùng tiêu đề)</span>
                        </label>
                        <input type="text" id="seoTitle" name="meta_title" value="{{ old('meta_title') }}" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-2.5 text-[14px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary transition outline-none">
                        <div class="text-right mt-1 font-bold text-[12px] transition-colors" id="seoTitleCounter">0/65</div>
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-2">
                            Meta Description <span class="normal-case font-normal text-gray-400">(trống = dùng mô tả ngắn)</span>
                        </label>
                        <textarea id="seoDesc" name="meta_description" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-lg p-3 text-[14px] text-gray-700 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary transition resize-none">{{ old('meta_description') }}</textarea>
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
    </form>

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
    // Create form specific initialization if needed
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('createPostForm');
        if (form) {
            form.addEventListener('submit', function() {
                // AUTO_SAVE_KEY clearing is now handled after successful response, 
                // but since it's a standard form submission, we can't easily wait for the response here.
                // We will rely on server success redirection to clear it, but for a standard form, it redirects anyway.
                // It's usually better to just keep it if it failed.
            });
        }
    });
</script>
<script src="{{ asset('js/admin/editor.js') }}"></script>
@endpush
