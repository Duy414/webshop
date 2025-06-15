@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Giỏ Hàng</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (count($cartItems) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                <tr>
                    <td>
                        {{ $item['name'] }}
                    </td>
                    <td>{{ number_format($item['price']) }}₫</td>
                    <td>
                        <form action="{{ route('cart.update', $item['id']) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Đây là phần quan trọng -->

                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                            <button type="submit">Cập nhật</button>
                        </form>




                    </td>
                    <td>{{ number_format($item['price'] * $item['quantity']) }}₫</td>
                    <td>
                        <form action="{{ route('cart.remove', ['id' => $item['id']]) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xoá không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Xoá</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Tổng cộng</strong></td>
                    <td colspan="2"><strong>{{ number_format($total) }}₫</strong></td>
                </tr>
            </tfoot>
        </table>
        
        <div class="d-flex justify-content-between">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Xóa toàn bộ giỏ hàng</button>
            </form>

            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Thanh toán</button>
            </form>

        </div>
    @else
        <div class="alert alert-info">
            Giỏ hàng của bạn đang trống!
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
    @endif
</div>
@endsection