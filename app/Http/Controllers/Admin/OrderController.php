<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng
     */
    public function index()
    {
        $orders = Order::with('user')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Hiển thị chi tiết đơn hàng
     */
    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product']);
        
        return view('admin.orders.show', compact('order'));
    }


    
    /**
     * Cập nhật trạng thái đơn hàng
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    /**
     * Hủy đơn hàng
     */
    public function cancel(Order $order)
    {
        // Chỉ hủy các đơn hàng ở trạng thái chưa hoàn thành
        if (in_array($order->status, ['pending', 'processing'])) {
            $order->update(['status' => 'cancelled']);
            
            // Có thể thêm logic hoàn trả số lượng tồn kho tại đây
            return back()->with('success', 'Đơn hàng đã được hủy thành công!');
        }

        return back()->with('error', 'Không thể hủy đơn hàng ở trạng thái hiện tại');
    }

    /**
     * Xuất dữ liệu đơn hàng (Excel/CSV)
     */
    public function export()
    {
        // Triển khai logic xuất file tại đây
        // Sử dụng package như Laravel Excel hoặc tự tạo CSV
    }
}