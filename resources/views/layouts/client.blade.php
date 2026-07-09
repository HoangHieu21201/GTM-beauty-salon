<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Review Thẩm Mỹ')</title>
    <!-- PrimeIcons -->
    <link rel="stylesheet" href="https://unpkg.com/primeicons/primeicons.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col overflow-x-hidden">
    <x-client.layout.header />
    
    <!-- Thanh điều hướng danh mục độc lập (Sticky) -->
    <x-client.layout.catnav />
    
    <main class="flex-grow w-full">
        @yield('content')
    </main>

    <x-client.layout.footer />
</body>
</html>
