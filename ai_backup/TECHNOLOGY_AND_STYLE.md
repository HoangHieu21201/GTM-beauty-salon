# Technology and Style Guide

## 1. Technologies
- **Framework**: Laravel 11 + PHP 8.x
- **Template Engine**: Laravel Blade
- **CSS Framework**: TailwindCSS v4
- **Asset Bundler**: Vite (No continuous `npm run dev` required locally unless tweaking CSS classes, use `npm run build` to update static styles).

## 2. UI Architecture (Blade Components)
To ensure style synchronization across the project, we use Blade Components structured by feature/role.

### Directory Structure
```text
resources/views/
├── components/          # Nơi chứa các mảnh ghép (Dùng thẻ <x-...>)
│   ├── admin/           # Ví dụ: sidebar.blade.php
│   ├── client/          # Ví dụ: header.blade.php
│   └── ui/              # Reusable low-level UI (buttons, inputs)
├── layouts/             # Nơi chứa khung nền (Dùng @extends)
│   ├── admin.blade.php
│   └── client.blade.php
├── admin/
│   └── pages/           # Chứa các trang nội dung thực tế của admin (Ví dụ: dashboard.blade.php)
└── client/
    └── pages/           # Chứa các trang nội dung thực tế của người dùng (Ví dụ: home.blade.php)
```

### Component Usage
- **Layouts**: `@extends('layouts.admin')` or `@extends('layouts.client')`
- **Admin Components**: `<x-admin.sidebar />`
- **UI Components**: `<x-ui.button>`

## 3. Style Guidelines
We use global CSS variables defined in `app.css` mapped to Tailwind v4 `@theme`.

### Tailwind Custom Classes
You must use these Tailwind classes instead of raw hex codes:
- **Backgrounds**: `bg-primary`, `bg-primary-dark`, `bg-primary-soft`, `bg-accent`, `bg-card`, `bg-bg`
- **Text Colors**: `text-primary`, `text-accent`, `text-star`, `text-text`, `text-muted`
- **Borders**: `border-border`
- **Border Radius**: `rounded-[var(--radius)]` (or configure rounded utility in CSS if needed).

### CSS Variables (`:root`)
- `--primary`: #1668dc
- `--primary-dark`: #0f4fb0
- `--primary-soft`: #e8f1ff
- `--accent`: #ff7a00
- `--star`: #f5a623
- `--text`: #1f2733
- `--muted`: #6b7785
- `--bg`: #f1f4f8
- `--card`: #ffffff
- `--border`: #e6e9ee
- `--radius`: 10px
- `--shadow`: 0 1px 3px rgba(16, 24, 40, .06), 0 1px 2px rgba(16, 24, 40, .04)
- `--shadow-hover`: 0 8px 24px rgba(16, 24, 40, .12)
