<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Hệ thống quản lý</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            padding: 5px 10px;
            border-bottom: 1px solid #333;
            display: flex;
            gap: 8px;
            z-index: 998;
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
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h5>HỆ HỆ HỆ</h5>
        <a href="javascript:void(0)" onclick="openTab('diem-danh', '{{ route('diem-danh') }}')">Điểm danh</a>
        <a href="javascript:void(0)" onclick="openTab('phieu-danh-gia', '{{ route('phieu-danh-gia') }}')">Phiếu đánh giá</a>
        <a href="javascript:void(0)" onclick="openTab('lich-tuan', '{{ route('lich-tuan') }}')">Lịch theo tuần</a>
        <a href="javascript:void(0)" onclick="openTab('info', '{{ route('info') }}')">Thông tin cá nhân</a>
        <a href="javascript:void(0)" onclick="openTab('home', '{{ route('home') }}')">Nhập điểm</a>
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
    @yield('scripts')
    <script>
        const tabs = {};

        function openTab(key, url) {
            if (tabs[key]) {
                activateTab(key);
                return;
            }

            const tabButton = document.createElement('button');
            tabButton.classList.add('tab-button');
            tabButton.id = `tab-btn-${key}`;
            tabButton.innerHTML = key.replace(/-/g, ' ').toUpperCase();

            const closeBtn = document.createElement('span');
            closeBtn.innerHTML = '×';
            closeBtn.classList.add('tab-close');
            closeBtn.onclick = function (e) {
                e.stopPropagation();
                removeTab(key);
            };

            tabButton.appendChild(closeBtn);
            tabButton.onclick = () => activateTab(key);
            document.getElementById('tab-bar').appendChild(tabButton);

            tabs[key] = { url };
            activateTab(key);
        }

        function activateTab(key) {
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            const btn = document.getElementById(`tab-btn-${key}`);
            if (btn) btn.classList.add('active');

            fetch(tabs[key].url)
                .then(res => res.text())
                .then(html => {
                    const temp = document.createElement('div');
                    temp.innerHTML = html;

                    const pageContent = temp.querySelector('#page-content');
                    document.getElementById('tab-content').innerHTML = pageContent ? pageContent.innerHTML : 'Không thể tải nội dung.';

                    // Chạy lại tất cả script trong nội dung mới
                    temp.querySelectorAll('script').forEach(oldScript => {
                        const newScript = document.createElement('script');
                        if (oldScript.src) {
                            newScript.src = oldScript.src;
                        } else {
                            newScript.textContent = oldScript.textContent;
                        }
                        document.body.appendChild(newScript);
                    });

                    temp.querySelectorAll('style').forEach(oldStyle => {
                        const newStyle = document.createElement('style');
                        if (oldStyle.src) {
                            newStyle.src = oldStyle.src;
                        } else {
                            newStyle.textContent = oldStyle.textContent;
                        }
                        document.body.appendChild(newStyle);
                    });
                })
                .catch(err => {
                    document.getElementById('tab-content').innerHTML = '<p>Lỗi khi tải nội dung.</p>';
                    console.error(err);
                });
        }

        function removeTab(key) {
            delete tabs[key];
            const btn = document.getElementById(`tab-btn-${key}`);
            if (btn) btn.remove();
            document.getElementById('tab-content').innerHTML = '<p>Đã đóng tab.</p>';
        }
    </script>
</body>
</html>
