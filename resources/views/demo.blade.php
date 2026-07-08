<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Blade</title>
</head>
<body>
    <h1>Xin chào, {{ $name }}!</h1>
    <p>Chào mừng bạn đến với trang Demo sử dụng Laravel Blade.</p>

    <ul>
        @foreach($skills as $skill)
            <li>{{ $skill }}</li>
        @endforeach
    </ul>
</body>
</html>
