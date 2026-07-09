<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="https://unpkg.com/primeicons@7.0.0/primeicons.css" />
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

            toast.innerHTML = `
                <div class="flex items-center gap-2">
                    <i class="pi ${icon} text-[15px]"></i>
                    <span class="text-[14px] font-bold">${message}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-current opacity-60 hover:opacity-100 transition-opacity ml-4">
                    <i class="pi pi-times text-[12px]"></i>
                </button>
            `;
            
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
    </script>
    
    @stack('scripts')
</body>
</html>
