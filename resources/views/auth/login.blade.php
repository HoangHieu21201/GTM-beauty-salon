@extends('layouts.auth')

@section('title', 'Đăng nhập')

@section('content')
<div class="min-h-[calc(100vh-160px)] flex items-center justify-center bg-bg py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-[460px] space-y-8 bg-card p-8 rounded-[var(--radius)] shadow-[var(--shadow)] border border-border">
        <div>
            <h2 class="mt-2 text-center text-3xl font-extrabold text-primary">
                Đăng nhập tài khoản
            </h2>
            <p class="mt-2 text-center text-sm text-muted">
                Hoặc
                <a href="{{ route('register') }}" class="font-medium text-accent hover:text-primary transition-colors">
                    đăng ký tài khoản mới
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST" novalidate>
            @csrf
            <div class="rounded-md space-y-[9px]">
                <div class="relative pb-5">
                    <label for="email" class="block text-sm font-medium text-text">Địa chỉ Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="mt-1 appearance-none relative block w-full px-3 py-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-border' }} placeholder-muted text-text rounded-[var(--radius)] focus:outline-none focus:ring-primary focus:border-primary sm:text-sm" placeholder="Nhập email của bạn" value="{{ old('email') }}">
                    @error('email')
                        <p class="absolute bottom-0 left-0 text-[13px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative pb-5">
                    <label for="password" class="block text-sm font-medium text-text">Mật khẩu</label>
                    <div class="relative mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none relative block w-full px-3 py-2 pr-10 border {{ $errors->has('password') ? 'border-red-500' : 'border-border' }} placeholder-muted text-text rounded-[var(--radius)] focus:outline-none focus:ring-primary focus:border-primary sm:text-sm" placeholder="Nhập mật khẩu">
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none z-20" onmousedown="event.preventDefault();" onclick="const input = this.previousElementSibling; const icon = this.querySelector('i'); if(input.type === 'password'){input.type = 'text'; icon.classList.replace('pi-eye', 'pi-eye-slash');} else {input.type = 'password'; icon.classList.replace('pi-eye-slash', 'pi-eye');}">
                            <i class="pi pi-eye text-[16px]"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="absolute bottom-0 left-0 text-[13px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-text">
                        Ghi nhớ đăng nhập
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-accent hover:text-primary transition-colors">
                        Quên mật khẩu?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-medium rounded-[var(--radius)] text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="pi pi-sign-in text-white/70 group-hover:text-white transition-colors"></i>
                    </span>
                    Đăng nhập
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
