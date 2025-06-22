<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark text-white vh-100 p-3" style="width: 250px; position: fixed;">
            <h4 class="py-3 text-center">Quản lý trang web</h4>
            <hr>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                        <i class="bi bi-speedometer2 me-2"></i> Bảng điều khuyển
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="nav-link text-white">
                        <i class="bi bi-box-seam me-2"></i> Sản Phẩm
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}" class="nav-link text-white">
                        <i class="bi bi-cart-check me-2"></i> Đơn Hàng
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="nav-link text-white">
                        <i class="bi bi-people me-2"></i> Người Dùng
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.feedbacks.index') }}" class="nav-link text-white">
                        <i class="bi bi-chat-dots me-2"></i> Phản Hồi
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="flex-grow-1" style="margin-left: 250px;">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">
                <div class="container-fluid justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('user.profile.edit') }}">
                                    <i class="bi bi-person me-2"></i> Hồ sơ
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Page Content -->
            <main class="container-fluid p-4">
                @yield('content')
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>