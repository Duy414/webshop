@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Chi tiết Đơn hàng #{{ $order->id }}</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5>Thông tin khách hàng</h5>
            <p><strong>Tên:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5>Thông tin đơn hàng</h5>
            <p><strong>Trạng thái:</strong> 
                <span class="badge bg-{{ $order->status_color }}">
                    {{ $order->status_text }}
                </span>
            </p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total) }} ₫</p>
            <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">Sản phẩm</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item->price) }} ₫</td>
                        <td>{{ number_format($item->price * $item['quantity']) }} ₫</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    @if(in_array($order->status, ['pending', 'processing']))
    <div class="mt-4">
        <form method="POST" action="{{ route('admin.orders.update-status', $order) }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label>Cập nhật trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Đã giao hàng</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="cancelled">Hủy đơn hàng</option>
                    </select>
                </div>
                <div class="col-md-6 align-self-end">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
    @endif
</div>
@endsection