@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Danh sách sản phẩm</h1>
    <form action="{{ route('products.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" 
                name="search" 
                class="form-control" 
                placeholder="Tìm kiếm..." 
                value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn" type="submit" title="Tìm kiếm">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($products as $product)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <a href="{{ route('products.show', $product['id']) }}" class="card h-100 shadow-sm">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Ảnh sản phẩm">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">Không có ảnh</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-success fw-bold">{{ number_format($product->price) }} VNĐ</p>
                        <p class="card-text">
                            @if($product->stock > 0)
                                <span class="badge bg-success">Còn hàng ({{ $product->stock }})</span>
                            @else
                                <span class="badge bg-danger">Hết hàng</span>
                            @endif
                        </p>
                        <p class="card-text text-truncate">{{ $product->description }}</p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>
</div>
@endsection