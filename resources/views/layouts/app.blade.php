<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-image: url('{{ asset('storage/backgrounds/bg.jpg') }}');
            background-size: cover; /* ảnh phủ toàn bộ */
            background-repeat: no-repeat;
            background-attachment: fixed; /* cuộn không di ảnh */
            background-position: center center;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Cửa Hàng Đồ Lưu Niệm</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/feedback">Đánh giá</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="/cart" class="btn btn-outline-light me-2">
                        <i class="bi bi-cart"></i> Giỏ hàng
                    </a>
                    <a href="/login" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right"></i> Đăng Nhập
                    </a>
                    <a href="/register" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right"></i> Đăng Ký
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Về chúng tôi</h5>
                    <p>Cửa hàng chuyên cung cấp sản phẩm chất lượng với giá tốt nhất thị trường.</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <a href="https://www.google.com/maps/place/Phenikaa+University/@20.9796717,105.7445669,14z/data=!4m6!3m5!1s0x313452efff394ce3:0x391a39d4325be464!8m2!3d20.9626112!4d105.7486864!16s%2Fg%2F1220whsz?entry=ttu&g_ep=EgoyMDI1MDYxMS4wIKXMDSoASAFQAw%3D%3D" class="bi bi-geo-alt">Đại học Phenikaa Hà Nội</a>
                    <p><i class="bi bi-telephone"></i> 0123 456 789</p>
                </div>
                <div class="col-md-4">
                    <h5>Theo dõi chúng tôi</h5>
                    <div class="d-flex gap-3 fs-4">
                        <a href="https://www.facebook.com/" class="text-white"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/" class="text-white"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/" class="text-white"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                &copy; {{ date('Y') }} Cửa hàng đồ lưu niệm. Tất cả quyền được bảo lưu.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>