@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chi tiết đặt hàng {{ $order->id }}</h1>
    
    <div class="card">
        <div class="card-header">
            <h3>Thông tin đặt hàng</h3>
        </div>
        <div class="card-body">
            <p><strong>Tình trạng:</strong> {{ $order->status }}</p>
            <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Tổng số tiền:</strong> {{ number_format($order->total) }} VND</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3>Các mặt hàng đặt</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ number_format($item->price) }} VND</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item->price * $item['quantity']) }} VND</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection