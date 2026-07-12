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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.showToast = function(message, type = 'success') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: type === 'error' ? 'error' : (type === 'warning' ? 'warning' : 'success'),
                title: message
            });
        };

        window.confirmAction = function(options = {}) {
            return Swal.fire({
                title: options.title || 'Xác nhận thao tác',
                text: options.message || 'Bạn có chắc chắn muốn tiếp tục?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#9ca3af',
                confirmButtonText: options.acceptHtml || 'Tiếp tục',
                cancelButtonText: 'Hủy',
            }).then((result) => {
                return result.isConfirmed;
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
                        acceptHtml: form.dataset.confirmAcceptHtml ? form.dataset.confirmAcceptHtml.replace(/<[^>]*>?/gm, '').trim() : 'Tiếp tục', // Strip HTML for SweetAlert button
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
