<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Review Thẩm Mỹ')</title>
    <!-- PrimeIcons -->
    <link rel="stylesheet" href="https://unpkg.com/primeicons@7.0.0/primeicons.css" integrity="sha384-hNrzZtGh6HtRBhu3vrg8Fu0z8K9T70OblwsOAYzfQ4oQvZhpdfZCnKOpeqAVYh9N" crossorigin="anonymous" />
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

    <script>
        document.addEventListener("error", function (e) {
            if (e.target && e.target.tagName && e.target.tagName.toLowerCase() === "img") {
                if (!e.target.dataset.fallbackApplied) {
                    e.target.dataset.fallbackApplied = "true";
                    e.target.src = "data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='600' viewBox='0 0 800 600'%3E%3Crect fill='%23f3f4f6' width='800' height='600'/%3E%3Cpath fill='%23d1d5db' d='M150,500 l150,-150 l80,80 l220,-220 l200,200 z'/%3E%3Ccircle fill='%23d1d5db' cx='300' cy='200' r='50'/%3E%3Ctext fill='%239ca3af' font-family='sans-serif' font-size='36' dy='240' font-weight='bold' x='50%25' y='50%25' text-anchor='middle'%3EH%C3%ACnh%20%E1%BA%A3nh%20l%E1%BB%97i%3C/text%3E%3C/svg%3E";
                }
            }
        }, true);
    </script>
</body>
</html>
