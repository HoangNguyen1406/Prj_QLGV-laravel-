<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hệ thống quản lý</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background-color: #1a1a2e;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 200px;
            height: 100vh;
            background-color: #0f0f1f;
            padding-top: 60px;
        }

        .sidebar h5 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: #ccc;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #333;
            color: #fff;
        }

        .top-bar {
            position: fixed;
            top: 0;
            left: 200px;
            right: 0;
            height: 60px;
            background-color: #121220;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 999;
            border-bottom: 1px solid #333;
        }

        .top-bar input[type="text"] {
            background-color: #2c2c3c;
            border: none;
            padding: 5px 10px;
            color: white;
            width: 250px;
            border-radius: 4px;
        }

        .main-content {
            margin-left: 200px;
            padding-top: 110px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .tab-bar {
            position: fixed;
        top: 60px;
        left: 200px;
        right: 0;
        background-color: #191930;
        padding: 6px 12px;
        border-bottom: 1px solid #333;
        z-index: 998;
        display: flex;
        flex-wrap: nowrap; 
        overflow-x: auto; 
        gap: 8px;
        white-space: nowrap; 
        }

        .tab-button {
            background-color: #2a2a40;
            color: #ccc;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .tab-button.active {
            background-color: #0d6efd;
            color: white;
        }

        .tab-close {
            margin-left: 6px;
            color: red;
            font-weight: bold;
            cursor: pointer;
        }

        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 12px 20px;
            background: #dc3545;
            color: white;
            border-radius: 4px;
            z-index: 10000;
        }

        .toast-success {
            background: #28a745;
        }

        .tab-loading {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 200px;
    }

    .tab-loading .spinner {
        border: 4px solid rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        border-top: 4px solid #3498db;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin-bottom: 10px;
    }

    .tab-error {
        padding: 20px;
        background: #f8d7da;
        color: #721c24;
        border-radius: 5px;
        text-align: center;
    }

    .tab-error .retry-btn {
        margin-top: 10px;
        padding: 5px 15px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h5>HỆ HỆ HỆ</h5>
    <a href="javascript:void(0)" onclick="openTab('diem-danh', '{{ route('diem-danh.index') }}')">Điểm danh</a>
    <a href="javascript:void(0)" onclick="openTab('phieu-danh-gia', '{{ route('phieu-danh-gia') }}')">Phiếu đánh giá</a>
    <a href="javascript:void(0)" onclick="openTab('lich-tuan', '{{ route('lich-tuan') }}')">Lịch theo tuần</a>
    <a href="javascript:void(0)" onclick="openTab('info', '{{ route('info') }}')">Thông tin cá nhân</a>
    <a href="javascript:void(0)" onclick="openTab('nhap-diem', '/nhap-diem.index');">Nhập điểm</a>
</div>

<!-- Topbar -->
<div class="top-bar">
    <input type="text" placeholder="Tìm kiếm...">

    <div class="d-flex align-items-center gap-3">
        <a href="#">🔔</a>
        <a href="#">✉️</a>

        <div class="dropdown">
            <a href="#" class="text-white dropdown-toggle" data-bs-toggle="dropdown">
                👤 {{ Auth::check() ? Auth::user()->name : 'Khách' }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                @auth
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Đăng xuất</button>
                        </form>
                    </li>
                @else
                    <li><a class="dropdown-item" href="{{ route('login') }}">Đăng nhập</a></li>
                @endauth
            </ul>
        </div>
    </div>
</div>

<!-- Tab Bar -->
<div class="tab-bar" id="tab-bar"></div>

<!-- Nội dung chính -->
<div class="main-content">
    <div id="tab-content">
          @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/layout-app.js') }}"></script>
</body>
</html>