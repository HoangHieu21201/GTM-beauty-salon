# GTM Beauty Salon System

This project is a complete beauty salon management system and customer booking portal built with Laravel. It features an admin dashboard for managing clinics, services, posts, comments, and settings, alongside a client-facing frontend for browsing and booking.

---

## 🇻🇳 Hướng Dẫn Cài Đặt và Deploy (Tiếng Việt)

Dưới đây là các bước chi tiết để chạy dự án này trên môi trường local (máy cá nhân) và cấu hình để đưa lên Server/Hosting (Deploy).

### 1. Cài đặt trên Local (Máy tính cá nhân)

1. **Yêu cầu hệ thống:**
   - PHP >= 8.2
   - Composer
   - MySQL (XAMPP, Laragon, v.v.)
   - Node.js & NPM

2. **Các bước cài đặt:**
   ```bash
   # 1. Clone hoặc tải source code về máy
   # 2. Mở terminal tại thư mục dự án và cài đặt các thư viện PHP
   composer install

   # 3. Tạo file cấu hình môi trường
   cp .env.example .env

   # 4. Mở file .env và cấu hình Database
   DB_DATABASE=ten_database_cua_ban
   DB_USERNAME=root
   DB_PASSWORD=

   # 5. Khởi tạo khoá ứng dụng
   php artisan key:generate

   # 6. Khởi tạo cơ sở dữ liệu (đã được cấu hình tự động import bảng chuẩn)
   php artisan migrate

   # 7. Cài đặt thư viện Frontend và build
   npm install
   npm run build

   # 8. Khởi chạy server
   php artisan serve
   ```

### 2. Hướng dẫn Deploy lên Server/Hosting (Linux)

Dự án đã được tối ưu hóa toàn bộ đường dẫn để tương thích 100% với hệ thống Linux (case-sensitive). Bạn chỉ cần thực hiện theo các bước sau:

1. **Chuẩn bị file .env:**
   - Xóa file `.env` hiện tại trên server (nếu có).
   - Đổi tên file `.env-deploy-sample` thành `.env` (hoặc copy nội dung của nó vào file `.env` mới).
   - Mở file `.env` và cập nhật thông tin:
     - `APP_URL=https://ten-mien-cua-ban.com`
     - Cập nhật thông tin `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` tương ứng với Hosting của bạn.

2. **Chạy các lệnh tối ưu trên Server:**
   Bật Terminal/SSH trên hosting và chạy lần lượt các lệnh sau tại thư mục gốc của dự án:
   ```bash
   # Tải các thư viện mà không bao gồm các gói dành cho dev
   composer install --optimize-autoloader --no-dev

   # Xoá toàn bộ cache cũ và tạo cache mới để tăng tốc độ website
   php artisan optimize:clear
   php artisan optimize
   php artisan view:cache

   # Tạo tự động các bảng cơ sở dữ liệu chuẩn xác
   php artisan migrate --force

   # Chú ý: Đảm bảo thư mục storage và bootstrap/cache có quyền ghi (chmod 775)
   chmod -R 775 storage bootstrap/cache
   ```

---

## 🇬🇧 Installation and Deployment Guide (English)

Below are detailed instructions for running this project on your local environment and configuring it for Server/Hosting deployment.

### 1. Local Installation

1. **System Requirements:**
   - PHP >= 8.2
   - Composer
   - MySQL
   - Node.js & NPM

2. **Installation Steps:**
   ```bash
   # 1. Clone or download the source code
   # 2. Open terminal in the project directory and install PHP dependencies
   composer install

   # 3. Create the environment configuration file
   cp .env.example .env

   # 4. Open .env and configure your Database connection
   DB_DATABASE=your_database_name
   DB_USERNAME=root
   DB_PASSWORD=

   # 5. Generate application key
   php artisan key:generate

   # 6. Initialize the database (migrations are configured to run raw SQL schema automatically)
   php artisan migrate

   # 7. Install Frontend libraries and build
   npm install
   npm run build

   # 8. Start the local server
   php artisan serve
   ```

### 2. Server/Hosting Deployment Guide (Linux)

This project’s file paths have been fully optimized to be 100% compatible with Linux systems (case-sensitive). Follow these steps to deploy:

1. **Prepare the .env file:**
   - Delete the existing `.env` on your server (if any).
   - Rename the `.env-deploy-sample` file to `.env` (or copy its contents into a new `.env` file).
   - Open the `.env` file and update the following values:
     - `APP_URL=https://your-domain.com`
     - Update the `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` to match your Hosting credentials.

2. **Run optimization commands on the Server:**
   Open Terminal/SSH on your hosting and run the following commands sequentially in the project root:
   ```bash
   # Install dependencies without dev packages for maximum performance
   composer install --optimize-autoloader --no-dev

   # Clear all old caches and generate new ones to speed up the website
   php artisan optimize:clear
   php artisan optimize
   php artisan view:cache

   # Automatically create the exact database schema
   php artisan migrate --force

   # Note: Ensure the storage and bootstrap/cache directories have write permissions (chmod 775)
   chmod -R 775 storage bootstrap/cache
   ```
