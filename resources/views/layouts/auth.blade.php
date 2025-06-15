<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-hover: #2e59d9;
            --text-color: #5a5c69;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fc 0%, #e9ecef 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 0;
            font-size: 1.1rem; /* Tăng kích thước font chung */
        }
        
        .auth-container {
            max-width: 1400px; /* Tăng chiều rộng tối đa */
            width: 100%;
            margin: 0 auto;
        }
        
        .auth-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            overflow: hidden;
            height: 100%;
        }
        
        .auth-left {
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .auth-left h2 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 2.2rem; /* Tăng kích thước tiêu đề */
        }
        
        .auth-left p {
            font-size: 1.3rem; /* Tăng kích thước văn bản */
            opacity: 0.9;
            line-height: 1.6;
        }
        
        .auth-left ul {
            margin-top: 1.5rem;
            padding-left: 1.5rem;
        }
        
        .auth-left ul li {
            margin-bottom: 0.8rem;
            font-size: 1.3rem; /* Tăng kích thước danh sách */
        }
        
        .auth-left .icon-list {
            display: flex;
            margin-top: 2rem;
            gap: 1.5rem;
        }
        
        .auth-left .icon-list i {
            font-size: 2rem; /* Tăng kích thước icon */
            opacity: 0.8;
        }
        
        .auth-right {
            padding: 3.5rem; /* Tăng padding */
            background: white;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 2.5rem; /* Tăng khoảng cách */
        }
        
        .logo img {
            height: 80px; /* Tăng kích thước logo */
        }
        
        .auth-header {
            margin-bottom: 2.5rem; /* Tăng khoảng cách */
            text-align: center;
        }
        
        .auth-header h1 {
            font-weight: 700;
            font-size: 2.5rem; /* Tăng kích thước tiêu đề */
            color: var(--text-color);
            margin-bottom: 1rem; /* Tăng khoảng cách */
        }
        
        .auth-header p {
            color: #858796;
            font-size: 1.4rem; /* Tăng kích thước văn bản */
        }
        
        /* TĂNG KÍCH THƯỚC CÁC Ô NHẬP LIỆU */
        .form-label {
            font-weight: 1800;
            color: var(--text-color);
            margin-bottom: 0.8rem; /* Tăng khoảng cách */
            font-size: 1.4rem; /* Tăng kích thước nhãn */
        }
        
        .form-control {
            padding: 1.2rem 1.5rem; /* Tăng padding - làm ô to hơn */
            border-radius: 10px;
            border: 1px solid #d1d3e2;
            font-size: 1rem; /* Tăng kích thước chữ */
            height: auto;
            line-height: 1.6;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.3rem rgba(78, 115, 223, 0.25); /* Tăng độ nổi bật khi focus */
        }
        
        .input-group-text {
            padding: 1.2rem 1.5rem; /* Tăng padding cho icon */
            font-size: 1.5rem; /* Tăng kích thước icon */
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 1.2rem; /* Tăng padding nút */
            font-size: 1.5rem; /* Tăng kích thước chữ nút */
            font-weight: 600;
            border-radius: 10px;
            height: auto;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        .auth-footer {
            margin-top: 2.5rem; /* Tăng khoảng cách */
            text-align: center;
            color: #858796;
            font-size: 1.3rem; /* Tăng kích thước chữ footer */
        }
        
        .auth-footer a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            font-size: 1.3rem; /* Tăng kích thước chữ link */
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 2rem 0; /* Tăng khoảng cách */
            color: #858796;
            font-size: 1.3rem; /* Tăng kích thước chữ */
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 2px solid #e3e6f0; /* Tăng độ dày đường kẻ */
        }
        
        .divider:not(:empty)::before {
            margin-right: 1.5rem; /* Tăng khoảng cách */
        }
        
        .divider:not(:empty)::after {
            margin-left: 1.5rem; /* Tăng khoảng cách */
        }
        
        .social-login {
            display: flex;
            gap: 1.5rem; /* Tăng khoảng cách */
            justify-content: center;
        }
        
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px; /* Tăng kích thước nút */
            height: 60px; /* Tăng kích thước nút */
            border-radius: 50%;
            border: 2px solid #e3e6f0; /* Tăng độ dày viền */
            background: white;
            color: #4e73df;
            font-size: 1.8rem; /* Tăng kích thước icon */
            transition: all 0.3s;
        }
        
        .social-btn:hover {
            background: #f8f9fc;
            transform: translateY(-2px);
        }
        
        /* TĂNG KÍCH THƯỚC THÔNG BÁO */
        .alert {
            padding: 1.5rem; /* Tăng padding */
            font-size: 1.3rem; /* Tăng kích thước chữ */
            margin-bottom: 1.5rem; /* Tăng khoảng cách */
        }
        
        .alert ul {
            margin-bottom: 0;
        }
        
        .btn-close {
            transform: scale(1.5); /* Tăng kích thước nút đóng */
            margin-right: 0.5rem;
        }
        
        /* TĂNG KÍCH THƯỚC CHECKBOX */
        .form-check-input {
            width: 1.5em; /* Tăng kích thước */
            height: 1.5em; /* Tăng kích thước */
            margin-top: 0.2em;
        }
        
        .form-check-label {
            font-size: 1.3rem; /* Tăng kích thước nhãn */
            margin-left: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="row g-0">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="auth-card auth-left">
                    <h2>Chào mừng đến với {{ config('app.name', 'Laravel') }}</h2>
                    <p>Hệ thống quản lý và mua sắm sản phẩm chuyên nghiệp</p>
                    
                    <ul>
                        <li>Quản lý đơn hàng dễ dàng</li>
                        <li>Theo dõi lịch sử mua hàng</li>
                        <li>Nhận thông báo khuyến mãi đặc biệt</li>
                        <li>Hỗ trợ khách hàng 24/7</li>
                    </ul>
                    
                    <div class="icon-list">
                        <i class="fas fa-shipping-fast"></i>
                        <i class="fas fa-gift"></i>
                        <i class="fas fa-headset"></i>
                        <i class="fas fa-shield-alt"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="auth-card auth-right">
                    <div class="logo">
                        <img src="https://via.placeholder.com/250x80?text=LOGO" alt="Logo">
                    </div>
                    
                    <div class="auth-header">
                        @yield('auth-header')
                    </div>
                    
                    <!-- Hiển thị thông báo lỗi -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <!-- Hiển thị thông báo thành công -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @yield('content')
                    
                    <div class="auth-footer">
                        @yield('auth-footer')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script tùy chỉnh -->
    <script>
        // Toggle hiển thị mật khẩu
        document.querySelectorAll('.password-toggle').forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const passwordInput = document.getElementById(this.dataset.target);
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>