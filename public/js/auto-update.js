// Hàm chính xử lý auto-update
function setupAutoUpdate() {
    document.querySelectorAll('[data-auto-update]').forEach(form => {
        // Xử lý sự kiện change/input cho tất cả các trường
        form.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('input', debounce(handleAutoUpdate, 500)); // Debounce 500ms
            field.addEventListener('change', handleAutoUpdate);
        });
    });
}

// Hàm xử lý khi có thay đổi
async function handleAutoUpdate(e) {
    const form = e.target.closest('form');
    if (!form) return;

    // Hiển thị loading (tuỳ chọn)
    const loader = document.getElementById('loading-indicator');
    if (loader) loader.style.display = 'block';

    try {
        const formData = new FormData(form);
        const params = new URLSearchParams(formData);
        
        // Gọi API (GET/POST tuỳ backend)
        const response = await fetch(`${form.action}?${params.toString()}`, {
            method: 'GET', // Hoặc 'POST' nếu cần
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });

        if (!response.ok) throw new Error('Lỗi tải dữ liệu');
        
        const result = await response.json();
        
        // Cập nhật DOM mà không reload
        document.getElementById('result-container').innerHTML = result.html || result.message;
        
    } catch (error) {
        console.error('Auto-update error:', error);
        // Hiển thị lỗi trong UI (tuỳ chọn)
    } finally {
        if (loader) loader.style.display = 'none';
    }
}

// Hàm debounce để tránh gọi API liên tục
function debounce(func, delay) {
    let timeoutId;
    return function(...args) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => func.apply(this, args), delay);
    };
}

// Khởi tạo khi trang tải xong
document.addEventListener('DOMContentLoaded', setupAutoUpdate);