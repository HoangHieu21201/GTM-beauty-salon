// Tự động cuộn mượt lên đầu trang khi chuyển trang
document.addEventListener('DOMContentLoaded', () => {
    // Tránh việc kẹt thanh cuộn ở vị trí cũ (bottom) khi load trang mới
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'instant'
    });
});
