<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::where('is_admin', false)->count();
        $productCount = Product::count();
        $orderCount = Order::count();
        $pendingOrderCount = Order::where('status', 'pending')->count(); // Bạn có thể điều chỉnh 'pending' nếu tên trạng thái khác
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'userCount',
            'productCount',
            'orderCount',
            'pendingOrderCount',
            'recentOrders'
        ));
    }
}
