/**
 * Editor Format Logic
 */
window.formatDoc = function(cmd, value = null) {
    document.execCommand(cmd, false, value);
    document.getElementById('postContent').focus();
};

/**
 * Table manipulation helpers
 */
function getSelectedElement() {
    if (window.getSelection) {
        var sel = window.getSelection();
        if (sel.rangeCount > 0) {
            return sel.getRangeAt(0).startContainer;
        }
    }
    return null;
}

function getClosestParent(node, tagName) {
    if (!node) return null;
    var curr = node;
    while (curr && curr.id !== 'postContent') {
        if (curr.nodeName === tagName.toUpperCase()) {
            return curr;
        }
        curr = curr.parentNode;
    }
    return null;
}

window.addTableRow = function() {
    var selEl = getSelectedElement();
    var tr = getClosestParent(selEl, 'tr');
    var table = getClosestParent(selEl, 'table');
    
    if (tr && table) {
        var cellCount = tr.cells.length;
        var newRow = table.insertRow(tr.rowIndex + 1);
        for (var i = 0; i < cellCount; i++) {
            var newCell = newRow.insertCell(i);
            newCell.className = "border border-gray-300 p-2.5";
            newCell.innerHTML = "&nbsp;";
        }
    } else {
        var html = '<table class="w-full border-collapse border border-gray-300 mb-4">' +
            '<thead><tr class="bg-gray-50">' +
            '<th class="border border-gray-300 p-2.5 text-left font-semibold text-gray-700">Dòng sứ</th>' +
            '<th class="border border-gray-300 p-2.5 text-left font-semibold text-gray-700">Giá/răng</th>' +
            '<th class="border border-gray-300 p-2.5 text-left font-semibold text-gray-700">Tuổi thọ</th>' +
            '<th class="border border-gray-300 p-2.5 text-left font-semibold text-gray-700">Đặc điểm</th>' +
            '</tr></thead>' +
            '<tbody><tr>' +
            '<td class="border border-gray-300 p-2.5">Sứ kim loại</td>' +
            '<td class="border border-gray-300 p-2.5">1-2.5 triệu</td>' +
            '<td class="border border-gray-300 p-2.5">5-8 năm</td>' +
            '<td class="border border-gray-300 p-2.5">Rẻ, đen viền nướu</td>' +
            '</tr></tbody></table>';
        formatDoc('insertHTML', html);
    }
};

window.addTableColumn = function() {
    var selEl = getSelectedElement();
    var td = getClosestParent(selEl, 'td') || getClosestParent(selEl, 'th');
    var table = getClosestParent(selEl, 'table');
    
    if (td && table) {
        var colIndex = td.cellIndex;
        for (var i = 0; i < table.rows.length; i++) {
            var row = table.rows[i];
            var isHeader = row.parentNode.nodeName === 'THEAD' || row.cells[colIndex].nodeName === 'TH';
            var newCell = isHeader ? document.createElement('th') : document.createElement('td');
            
            newCell.className = isHeader 
                ? "border border-gray-300 p-2.5 text-left font-semibold text-gray-700" 
                : "border border-gray-300 p-2.5";
            newCell.innerHTML = "&nbsp;";
            
            if (colIndex + 1 < row.cells.length) {
                row.insertBefore(newCell, row.cells[colIndex + 1]);
            } else {
                row.appendChild(newCell);
            }
        }
    }
};

window.deleteTableRow = function() {
    var selEl = getSelectedElement();
    var tr = getClosestParent(selEl, 'tr');
    var table = getClosestParent(selEl, 'table');
    if (tr && table) {
        table.deleteRow(tr.rowIndex);
    }
};

window.deleteTableColumn = function() {
    var selEl = getSelectedElement();
    var td = getClosestParent(selEl, 'td') || getClosestParent(selEl, 'th');
    var table = getClosestParent(selEl, 'table');
    if (td && table) {
        var colIndex = td.cellIndex;
        for (var i = 0; i < table.rows.length; i++) {
            var row = table.rows[i];
            if (row.cells.length > colIndex) {
                row.deleteCell(colIndex);
            }
        }
    }
};

window.createCustomTable = function() {
    var rowsInput = document.getElementById('tblRows').value;
    var colsInput = document.getElementById('tblCols').value;
    var minRows = parseInt(document.getElementById('tblRows').getAttribute('min')) || 1;
    var maxRows = parseInt(document.getElementById('tblRows').getAttribute('max')) || 100;
    var minCols = parseInt(document.getElementById('tblCols').getAttribute('min')) || 1;
    var maxCols = parseInt(document.getElementById('tblCols').getAttribute('max')) || 20;

    var rows = parseInt(rowsInput);
    var cols = parseInt(colsInput);
    
    if (isNaN(rows) || isNaN(cols) || rows < minRows || cols < minCols || rows > maxRows || cols > maxCols) {
        alert(`Số dòng (từ ${minRows} đến ${maxRows}) và số cột (từ ${minCols} đến ${maxCols}) không hợp lệ`);
        return;
    }
    
    var html = '<table class="w-full border-collapse border border-gray-300 mb-4" style="table-layout: fixed; width: 100%; border-collapse: collapse;">';
    html += '<tbody>';
    for (var r = 0; r < rows; r++) {
        html += '<tr>';
        for (var c = 0; c < cols; c++) {
            html += '<td class="border border-gray-300 p-2.5" style="word-break: break-word;">&nbsp;</td>';
        }
        html += '</tr>';
    }
    html += '</tbody></table>';
    
    formatDoc('insertHTML', html);
};

window.insertChecklist = function() {
    formatDoc('insertHTML', '<ul class="checklist-list" style="list-style: none; padding-left: 0; margin-left: 0; margin-bottom: 1rem;"><li class="checklist-item" style="list-style-type: none; display: flex; align-items: center; gap: 8px; margin-bottom: 0.5rem;"><input type="checkbox" style="margin: 0; transform: scale(1.1); accent-color: #2563eb;">&nbsp;</li></ul>');
};

/**
 * Dropdown Logic
 */
window.toggleDropdown = function(id) {
    if (id !== 'textColorDropdown') document.getElementById('textColorDropdown').classList.add('hidden');
    if (id !== 'bgColorDropdown') document.getElementById('bgColorDropdown').classList.add('hidden');
    if (id !== 'tableGeneratorDropdown') document.getElementById('tableGeneratorDropdown').classList.add('hidden');
    
    const el = document.getElementById(id);
    el.classList.toggle('hidden');
};

document.addEventListener('click', function(event) {
    const textContainer = document.getElementById('textColorContainer');
    const bgContainer = document.getElementById('bgColorContainer');
    const tblContainer = document.getElementById('tableGeneratorContainer');
    const popover = document.getElementById('linkPopover');
    
    if (textContainer && !textContainer.contains(event.target)) {
        document.getElementById('textColorDropdown').classList.add('hidden');
    }
    if (bgContainer && !bgContainer.contains(event.target)) {
        document.getElementById('bgColorDropdown').classList.add('hidden');
    }
    if (tblContainer && !tblContainer.contains(event.target)) {
        document.getElementById('tableGeneratorDropdown').classList.add('hidden');
    }
    if (popover && !popover.contains(event.target) && !event.target.closest('button[onclick="showLinkPopover()"]')) {
        popover.classList.add('hidden');
    }
});

let savedSelectionRange = null;

window.showLinkPopover = function() {
    const selection = window.getSelection();
    if (selection.rangeCount > 0) {
        const range = selection.getRangeAt(0);
        const container = document.getElementById('postContent');
        if (!container.contains(range.commonAncestorContainer)) {
            alert("Vui lòng bôi đen văn bản trong trình soạn thảo trước");
            return;
        }
        
        savedSelectionRange = range.cloneRange();
        let rect = range.getBoundingClientRect();
        const popover = document.getElementById('linkPopover');
        
        if (rect.top === 0 && rect.left === 0) {
            let parent = range.startContainer;
            if (parent.nodeType === Node.TEXT_NODE) parent = parent.parentNode;
            rect = parent.getBoundingClientRect();
        }
        
        let currentUrl = '';
        let parentNode = range.commonAncestorContainer;
        if (parentNode.nodeType === Node.TEXT_NODE) parentNode = parentNode.parentNode;
        if (parentNode.tagName === 'A') {
            currentUrl = parentNode.getAttribute('href');
        }
        
        document.getElementById('linkPopoverInput').value = currentUrl;
        
        const wrapper = container.closest('.relative');
        const wrapperRect = wrapper.getBoundingClientRect();
        
        const left = rect.left - wrapperRect.left;
        const top = rect.bottom - wrapperRect.top + 5;
        
        popover.style.left = left + 'px';
        popover.style.top = top + 'px';
        popover.classList.remove('hidden');
        
        setTimeout(() => {
            const input = document.getElementById('linkPopoverInput');
            input.focus();
            input.select();
        }, 50);
    } else {
        alert("Vui lòng bôi đen văn bản để chèn liên kết");
    }
};

window.savePopoverLink = function() {
    const url = document.getElementById('linkPopoverInput').value.trim();
    const popover = document.getElementById('linkPopover');
    popover.classList.add('hidden');
    
    if (savedSelectionRange) {
        const selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(savedSelectionRange);
        
        if (url) {
            formatDoc('createLink', url);
        } else {
            formatDoc('unlink');
        }
        
        savedSelectionRange = null;
    }
};

/**
 * Preview Modal Logic
 */
window.openPreview = function() {
    const modal = document.getElementById('previewModal');
    
    document.getElementById('previewTitle').innerText = document.getElementById('postTitle').value || 'Chưa có tiêu đề';
    document.getElementById('previewBody').innerHTML = document.getElementById('postContent').innerHTML;
    
    const today = new Date();
    document.getElementById('previewDate').innerText = today.toLocaleDateString('vi-VN');
    
    const statsStr = document.getElementById('readingStats').innerText || '';
    const stats = statsStr.split(' - ');
    if(stats.length > 1) {
        document.getElementById('previewReadTime').innerText = stats[1].trim();
    }
    
    modal.classList.remove('hidden');
    setTimeout(() => { modal.classList.remove('opacity-0'); }, 10);
    document.body.style.overflow = 'hidden';
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
        container.style.maxWidth = '375px';
        btnMobile.className = 'flex items-center gap-2 px-3 py-1 rounded-md text-xs font-semibold transition-colors bg-[#2563eb] text-white';
        btnDesktop.className = 'flex items-center gap-2 px-3 py-1 rounded-md text-xs font-semibold transition-colors text-gray-400 hover:text-white';
    }
};

/**
 * SEO Analyzer Logic & General Editor Initialization
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

    const generateSlug = (text) => {
        let slug = text.toString().toLowerCase();
        slug = slug.replace(/á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/g, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/g, 'e');
        slug = slug.replace(/í|ì|ỉ|ĩ|ị/g, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/g, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/g, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/g, 'y');
        slug = slug.replace(/đ/g, 'd');
        slug = slug.replace(/[^\w\s-]/g, '').trim().replace(/[\s_]+/g, '-').replace(/-+/g, '-');
        return slug;
    };

    const countWords = (str) => {
        return str.trim().split(/\s+/).filter(word => word.length > 0).length;
    };

    const updateCounter = (el, count, max) => {
        if (!el) return;
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

    let initialSlug = null;
    const hiddenSlugEl = document.getElementById('hiddenSlug');
    if (hiddenSlugEl && hiddenSlugEl.value) {
        initialSlug = hiddenSlugEl.value; // Save initial slug for edit mode
    }

    const analyzeSEO = () => {
        if (!titleInput) return;
        
        const title = titleInput.value;
        const excerpt = excerptInput ? excerptInput.value : '';
        const content = contentDiv ? contentDiv.innerText : '';
        const wordCount = countWords(content);
        const readTime = Math.max(1, Math.ceil(wordCount / 200));
        
        if (readingStats) readingStats.innerText = `${wordCount} từ - ${readTime} phút đọc`;
        
        // Slug Logic
        const isEditMode = document.getElementById('createPostForm')?.action?.includes('PUT') || document.querySelector('input[name="_method"]')?.value === 'PUT';
        let slugVal = generateSlug(title);
        
        if (isEditMode) {
            // In Edit Mode, preserve the initial slug unless intentionally changed
            slugVal = slugVal || initialSlug || '';
        } else {
            // In Create Mode, empty title leaves slug empty
            slugVal = slugVal || '';
        }
        
        if (slugSpan) slugSpan.innerText = slugVal || 'tieu-de-bai-viet';
        if (previewSlug) previewSlug.innerText = slugVal || 'tieu-de-bai-viet';
        if (hiddenSlugEl) hiddenSlugEl.value = slugVal;
        
        updateCounter(excerptCounter, excerpt.length, 160);

        const metaTitle = (seoTitleInput && seoTitleInput.value) ? seoTitleInput.value : title;
        const metaDesc = (seoDescInput && seoDescInput.value) ? seoDescInput.value : excerpt;
        const keyword = (keywordInput && keywordInput.value) ? keywordInput.value.toLowerCase().trim() : '';

        updateCounter(seoTitleCounter, metaTitle.length, 65);
        updateCounter(seoDescCounter, metaDesc.length, 160);

        if (previewTitle) previewTitle.innerText = metaTitle || 'Tiêu đề SEO sẽ hiển thị ở đây';
        if (previewDesc) previewDesc.innerText = metaDesc || 'Vui lòng cung cấp Meta Description hoặc Mô tả ngắn để Google có thể hiển thị đoạn mã trích dẫn này...';

        if (!scoreRing || !scoreText || !checklist) return;

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

        addCheck(metaTitle.length >= 30 && metaTitle.length <= 65, `Meta title độ dài chuẩn (hiện ${metaTitle.length})`, `Meta title nên từ 30-65 ký tự (hiện ${metaTitle.length})`);
        addCheck(metaDesc.length >= 70 && metaDesc.length <= 160, `Meta description độ dài chuẩn (hiện ${metaDesc.length})`, `Meta description nên từ 70-160 ký tự (hiện ${metaDesc.length})`);
        addCheck(wordCount >= 600, `Nội dung đủ dài ≥ 600 từ (hiện ${wordCount})`, `Nội dung quá ngắn < 600 từ (hiện ${wordCount})`);

        const h2Count = contentDiv ? (contentDiv.innerHTML.match(/<h2/gi) || []).length : 0;
        addCheck(h2Count >= 2, `Có ≥ 2 thẻ H2 (hiện ${h2Count})`, `Nên có ≥ 2 thẻ H2 (hiện ${h2Count})`);

        if (keyword) {
            const keywordInTitle = metaTitle.toLowerCase().includes(keyword);
            const keywordInDesc = metaDesc.toLowerCase().includes(keyword);
            const keywordInContent = content.toLowerCase().includes(keyword);
            
            addCheck(keywordInTitle, `Từ khóa xuất hiện trong meta title`, `Từ khóa chưa có trong meta title`);
            addCheck(keywordInDesc, `Từ khóa xuất hiện trong meta description`, `Từ khóa chưa có trong meta description`);
            addCheck(keywordInContent, `Từ khóa xuất hiện trong nội dung`, `Từ khóa chưa xuất hiện trong nội dung`);
            maxScore = 105;
        } else {
            checks.push(`<li class="flex items-start gap-2 text-gray-400"><i class="pi pi-info-circle mt-0.5"></i> <span>Nhập từ khóa chính để đánh giá sâu hơn</span></li>`);
            maxScore = 60;
        }

        const percentage = Math.round((score / maxScore) * 100) || 0;
        scoreText.innerText = `${percentage}%`;

        let color = '#ef4444';
        if (percentage >= 50 && percentage < 80) color = '#f59e0b';
        if (percentage >= 80) color = '#10b981';

        if (percentage > 0) {
            scoreText.style.color = color;
            scoreRing.style.background = `conic-gradient(${color} ${percentage}%, #e5e7eb ${percentage}%)`;
        } else {
            scoreText.style.color = '#9ca3af';
            scoreRing.style.background = `#e5e7eb`;
        }

        checklist.innerHTML = checks.join('');
    };

    if (titleInput) titleInput.addEventListener('input', analyzeSEO);
    if (excerptInput) excerptInput.addEventListener('input', analyzeSEO);
    if (contentDiv) contentDiv.addEventListener('input', analyzeSEO);
    if (keywordInput) keywordInput.addEventListener('input', analyzeSEO);
    if (seoTitleInput) seoTitleInput.addEventListener('input', analyzeSEO);
    if (seoDescInput) seoDescInput.addEventListener('input', analyzeSEO);

    const thumbnailInput = document.getElementById('postThumbnail');
    const thumbnailPreview = document.querySelector('img[alt="Cover"]');
    if (thumbnailInput && thumbnailPreview) {
        thumbnailInput.addEventListener('input', function() {
            thumbnailPreview.src = this.value || 'https://picsum.photos/400/250?random=10';
        });
    }

    const coverInput = document.getElementById('coverImageInput');
    const deleteCoverBtn = document.getElementById('deleteCoverBtn');
    const removeThumbnailInput = document.getElementById('removeThumbnailInput');

    if (coverInput && thumbnailPreview) {
        coverInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    thumbnailPreview.src = event.target.result;
                };
                reader.readAsDataURL(file);
                if (removeThumbnailInput) removeThumbnailInput.value = '0';
            }
        });
    }
    
    if (deleteCoverBtn && thumbnailPreview) {
        deleteCoverBtn.addEventListener('click', function() {
            thumbnailPreview.src = 'https://picsum.photos/400/250?random=10';
            if (coverInput) coverInput.value = '';
            if (thumbnailInput) thumbnailInput.value = '';
            if (removeThumbnailInput) removeThumbnailInput.value = '1';
        });
    }

    const editorFileInput = document.getElementById('editorImageInput');
    if (editorFileInput) {
        editorFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('image', file);
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                
                fetch('/admin/posts/upload-image', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.url) {
                        formatDoc('insertImage', data.url);
                    } else {
                        alert('Upload failed');
                    }
                })
                .catch(err => {
                    console.error('Upload Error:', err);
                    alert('Upload failed');
                })
                .finally(() => {
                    e.target.value = '';
                });
            }
        });
    }

    if (contentDiv) {
        contentDiv.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const selection = window.getSelection();
                if (selection.rangeCount > 0) {
                    const range = selection.getRangeAt(0);
                    let container = range.startContainer;
                    
                    let blockquote = null;
                    let temp = container;
                    while (temp && temp !== this) {
                        if (temp.tagName === 'BLOCKQUOTE') {
                            blockquote = temp;
                            break;
                        }
                        temp = temp.parentNode;
                    }
                    
                    if (blockquote) {
                        e.preventDefault();
                        
                        const endRange = document.createRange();
                        endRange.setStart(range.startContainer, range.startOffset);
                        endRange.setEndAfter(blockquote.lastChild || blockquote);
                        
                        const extracted = endRange.extractContents();
                        
                        const p = document.createElement('p');
                        p.appendChild(extracted);
                        
                        if (p.textContent.trim() === '' && p.querySelectorAll('img, iframe, table').length === 0) {
                            p.innerHTML = '<br>';
                        }
                        
                        blockquote.parentNode.insertBefore(p, blockquote.nextSibling);
                        
                        const newRange = document.createRange();
                        newRange.selectNodeContents(p);
                        newRange.collapse(true);
                        selection.removeAllRanges();
                        selection.addRange(newRange);
                    }
                }
            }
        });
    }

    let isDirty = false;
    const AUTO_SAVE_KEY = 'gtm_editor_draft_' + window.location.pathname;

    const markDirty = () => { isDirty = true; };
    if (titleInput) titleInput.addEventListener('input', markDirty);
    if (excerptInput) excerptInput.addEventListener('input', markDirty);
    if (contentDiv) contentDiv.addEventListener('input', markDirty);

    window.addEventListener('beforeunload', function(e) {
        if (isDirty && !window.isSubmitting) {
            e.preventDefault();
            e.returnValue = 'Bạn chưa lưu thay đổi. Bạn có chắc chắn muốn rời đi?';
        }
    });

    const saveDraftToLocalStorage = () => {
        const selectCategory = document.querySelector('select[name="category_id"]');
        const selectStatus = document.querySelector('select[name="status"]');
        const draft = {
            title: titleInput ? titleInput.value : '',
            excerpt: excerptInput ? excerptInput.value : '',
            content: contentDiv ? contentDiv.innerHTML : '',
            categoryId: selectCategory ? selectCategory.value : '',
            status: selectStatus ? selectStatus.value : '',
            keyword: keywordInput ? keywordInput.value : '',
            metaTitle: seoTitleInput ? seoTitleInput.value : '',
            metaDesc: seoDescInput ? seoDescInput.value : '',
            timestamp: Date.now()
        };
        localStorage.setItem(AUTO_SAVE_KEY, JSON.stringify(draft));
    };

    let autosaveTimeout = null;
    const triggerAutoSave = () => {
        markDirty();
        if (autosaveTimeout) clearTimeout(autosaveTimeout);
        autosaveTimeout = setTimeout(saveDraftToLocalStorage, 1000); 
    };

    if (titleInput) titleInput.addEventListener('input', triggerAutoSave);
    if (excerptInput) excerptInput.addEventListener('input', triggerAutoSave);
    if (contentDiv) contentDiv.addEventListener('input', triggerAutoSave);
    if (keywordInput) keywordInput.addEventListener('input', triggerAutoSave);
    if (seoTitleInput) seoTitleInput.addEventListener('input', triggerAutoSave);
    if (seoDescInput) seoDescInput.addEventListener('input', triggerAutoSave);
    
    const selectCategory = document.querySelector('select[name="category_id"]');
    const selectStatus = document.querySelector('select[name="status"]');
    if (selectCategory) selectCategory.addEventListener('change', triggerAutoSave);
    if (selectStatus) selectStatus.addEventListener('change', triggerAutoSave);

    const savedDraftStr = localStorage.getItem(AUTO_SAVE_KEY);
    if (savedDraftStr) {
        try {
            const draft = JSON.parse(savedDraftStr);
            const currentContent = contentDiv ? contentDiv.innerHTML.trim() : '';
            const draftContent = draft.content ? draft.content.trim() : '';

            if (draftContent && draftContent !== currentContent && draftContent !== '<br>' && draftContent !== '<p><br></p>') {
                const restoreBanner = document.createElement('div');
                restoreBanner.className = 'mb-6 p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-700 text-sm font-semibold flex items-center justify-between shadow-sm';
                restoreBanner.innerHTML = `
                    <div class="flex items-center gap-2">
                        <i class="pi pi-info-circle"></i>
                        <span>Phát hiện bản nháp được lưu tự động lúc ${new Date(draft.timestamp).toLocaleTimeString('vi-VN')}. Khôi phục lại nội dung?</span>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" id="btnRestoreDraft" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold transition-colors">Khôi phục</button>
                        <button type="button" id="btnDiscardDraft" class="px-3 py-1.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-xs font-bold transition-colors">Bỏ qua</button>
                    </div>
                `;

                const formEl = document.getElementById('createPostForm') || document.querySelector('form.post-form');
                if (formEl) {
                    formEl.parentNode.insertBefore(restoreBanner, formEl);

                    document.getElementById('btnRestoreDraft').addEventListener('click', function() {
                        if (titleInput) titleInput.value = draft.title;
                        if (excerptInput) excerptInput.value = draft.excerpt;
                        if (contentDiv) contentDiv.innerHTML = draft.content;
                        if (selectCategory) selectCategory.value = draft.categoryId;
                        if (selectStatus) selectStatus.value = draft.status;
                        if (keywordInput) keywordInput.value = draft.keyword;
                        if (seoTitleInput) seoTitleInput.value = draft.metaTitle;
                        if (seoDescInput) seoDescInput.value = draft.metaDesc;

                        analyzeSEO();
                        restoreBanner.remove();
                        if (window.showToast) window.showToast('Khôi phục bản nháp tự động thành công!', 'success');
                    });

                    document.getElementById('btnDiscardDraft').addEventListener('click', function() {
                        localStorage.removeItem(AUTO_SAVE_KEY);
                        restoreBanner.remove();
                    });
                }
            }
        } catch (e) {
            console.error("Lỗi phân tích bản nháp:", e);
        }
    }

    const form = document.getElementById('createPostForm') || document.querySelector('form.post-form');
    if (form) {
        form.addEventListener('submit', function() {
            window.isSubmitting = true;
            isDirty = false;
            const hiddenContent = document.getElementById('hiddenContent');
            if (hiddenContent && contentDiv) hiddenContent.value = contentDiv.innerHTML;
        });
    }

    analyzeSEO();
});
