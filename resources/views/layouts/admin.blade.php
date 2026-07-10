<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="https://unpkg.com/primeicons@7.0.0/primeicons.css" integrity="sha384-hNrzZtGh6HtRBhu3vrg8Fu0z8K9T70OblwsOAYzfQ4oQvZhpdfZCnKOpeqAVYh9N" crossorigin="anonymous" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex text-sm" style="background-color: var(--bg);">
    <!-- Sidebar -->
    <x-admin.sidebar />

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto">
        <main class="flex-1 px-[32px] py-[28px]">
            @yield('content')
        </main>
    </div>
    <!-- Global Toast Container -->
    <div id="globalToastContainer" class="fixed top-[28px] right-[32px] z-[9999] flex flex-col gap-3 pointer-events-none"></div>
    <div id="globalConfirmModal" class="fixed inset-0 z-[9998] hidden items-center justify-center bg-black/45 px-4 opacity-0 transition-opacity duration-200">
        <div class="w-full max-w-[420px] rounded-xl bg-white shadow-xl border border-gray-100 overflow-hidden transform scale-95 transition-transform duration-200">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3">
                <span class="w-9 h-9 rounded-full bg-red-50 text-red-500 flex items-center justify-center">
                    <i class="pi pi-exclamation-triangle text-[15px]"></i>
                </span>
                <div>
                    <h2 class="text-[16px] font-bold text-gray-900" id="globalConfirmTitle">Xác nhận thao tác</h2>
                    <p class="text-[13px] text-gray-500 mt-0.5" id="globalConfirmMessage">Bạn có chắc chắn muốn tiếp tục?</p>
                </div>
            </div>
            <div class="px-5 py-4 flex items-center justify-end gap-3 bg-gray-50">
                <button type="button" id="globalConfirmCancel" class="px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 text-[13px] font-bold hover:bg-gray-100 transition-colors">
                    Hủy
                </button>
                <button type="button" id="globalConfirmAccept" class="px-4 py-2 rounded-lg bg-red-500 text-white text-[13px] font-bold hover:bg-red-600 transition-colors flex items-center gap-2">
                    <i class="pi pi-trash text-[12px]"></i> Xóa
                </button>
            </div>
        </div>
    </div>

    <script>
        window.showToast = function(message, type = 'success') {
            const container = document.getElementById('globalToastContainer');
            
            const toast = document.createElement('div');
            toast.className = `flex items-center justify-between gap-4 px-4 py-3 rounded-lg shadow-[0_4px_12px_rgba(0,0,0,0.05)] border pointer-events-auto transform transition-all duration-300 translate-x-full opacity-0 min-w-[250px]`;
            
            let icon = 'pi-info-circle';
            if (type === 'success') {
                toast.classList.add('bg-[#f0fdf4]', 'border-[#bbf7d0]', 'text-[#16a34a]');
                icon = 'pi-check';
            } else if (type === 'error') {
                toast.classList.add('bg-[#fef2f2]', 'border-[#fecaca]', 'text-[#dc2626]');
                icon = 'pi-times-circle';
            } else if (type === 'warning') {
                toast.classList.add('bg-[#fffbeb]', 'border-[#fde68a]', 'text-[#d97706]');
                icon = 'pi-exclamation-triangle';
            } else {
                toast.classList.add('bg-white', 'border-gray-200', 'text-gray-700');
            }

            const content = document.createElement('div');
            content.className = 'flex items-center gap-2';
            content.innerHTML = `<i class="pi ${icon} text-[15px]"></i>`;

            const text = document.createElement('span');
            text.className = 'text-[14px] font-bold';
            text.textContent = message;
            content.appendChild(text);

            const closeButton = document.createElement('button');
            closeButton.type = 'button';
            closeButton.className = 'text-current opacity-60 hover:opacity-100 transition-opacity ml-4';
            closeButton.innerHTML = '<i class="pi pi-times text-[12px]"></i>';
            closeButton.addEventListener('click', () => toast.remove());

            toast.appendChild(content);
            toast.appendChild(closeButton);
            
            container.appendChild(toast);
            
            // Animate in
            requestAnimationFrame(() => {
                setTimeout(() => {
                    toast.classList.remove('translate-x-full', 'opacity-0');
                }, 10);
            });
            
            // Auto remove after 3s
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        };

        window.confirmAction = function(options = {}) {
            const modal = document.getElementById('globalConfirmModal');
            const panel = modal?.querySelector('div');
            const title = document.getElementById('globalConfirmTitle');
            const message = document.getElementById('globalConfirmMessage');
            const cancelButton = document.getElementById('globalConfirmCancel');
            const acceptButton = document.getElementById('globalConfirmAccept');

            if (!modal || !panel || !title || !message || !cancelButton || !acceptButton) {
                return Promise.resolve(false);
            }

            title.textContent = options.title || 'Xác nhận thao tác';
            message.textContent = options.message || 'Bạn có chắc chắn muốn tiếp tục?';
            acceptButton.innerHTML = options.acceptHtml || '<i class="pi pi-trash text-[12px]"></i> Xóa';

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-0');
                panel.classList.remove('scale-95');
            });

            return new Promise((resolve) => {
                const close = (result) => {
                    modal.classList.add('opacity-0');
                    panel.classList.add('scale-95');
                    setTimeout(() => {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }, 200);

                    cancelButton.removeEventListener('click', onCancel);
                    acceptButton.removeEventListener('click', onAccept);
                    modal.removeEventListener('click', onBackdrop);
                    resolve(result);
                };

                const onCancel = () => close(false);
                const onAccept = () => close(true);
                const onBackdrop = (event) => {
                    if (event.target === modal) close(false);
                };

                cancelButton.addEventListener('click', onCancel);
                acceptButton.addEventListener('click', onAccept);
                modal.addEventListener('click', onBackdrop);
            });
        };

        document.addEventListener('DOMContentLoaded', () => {
            @if (session('success'))
                window.showToast(@json(session('success')), 'success');
            @endif

            @if (session('warning'))
                window.showToast(@json(session('warning')), 'warning');
            @endif

            @if (session('error'))
                window.showToast(@json(session('error')), 'error');
            @endif

            @if ($errors->any())
                window.showToast(@json($errors->first()), 'error');
            @endif

            document.querySelectorAll('form[data-confirm-submit]').forEach((form) => {
                form.addEventListener('submit', async (event) => {
                    if (form.dataset.confirmed === '1') {
                        return;
                    }

                    event.preventDefault();
                    const confirmed = await window.confirmAction({
                        title: form.dataset.confirmTitle,
                        message: form.dataset.confirmMessage,
                    });

                    if (confirmed) {
                        form.dataset.confirmed = '1';
                        form.requestSubmit();
                    }
                });
            });

            document.querySelectorAll('form[data-loading-submit]').forEach((form) => {
                form.addEventListener('submit', (event) => {
                    if (event.defaultPrevented) {
                        return;
                    }

                    const button = form.querySelector('[type="submit"]');

                    if (!button || button.disabled) {
                        return;
                    }

                    button.dataset.originalHtml = button.innerHTML;
                    button.disabled = true;
                    button.classList.add('opacity-80', 'cursor-not-allowed');
                    button.innerHTML = '<i class="pi pi-spin pi-spinner"></i> Đang lưu...';
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
