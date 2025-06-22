<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm (có phân trang)
     */
    public function index(Request $request) // Thêm Request làm tham số
    {
        // Lấy giá trị tìm kiếm từ URL
        $search = $request->input('search');
        
        // Sửa đoạn truy vấn hiện tại của bạn
        $products = Product::query() // Bắt đầu bằng query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('description', 'LIKE', "%{$search}%");
            })
            // GIỮ NGUYÊN CÁC ĐIỀU KIỆN HIỆN TẠI CỦA BẠN
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:products',
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }


    /**
     * Hiển thị chi tiết sản phẩm
     */
    public function show(Product $product)
    {
        $product->load(['reviews.user']);

        return view('products.show', compact('product'));
    }
    public function create()
    {
        return view('admin.products.create');
    }

    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name' => 'required|max:255|unique:products,name,' . $product['id'],
        'description' => 'required|min:10',
        'price' => 'required|numeric|min:0.01',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Xử lý ảnh mới (nếu có)
    if ($request->hasFile('image')) {
        // Xoá ảnh cũ nếu tồn tại
        if ($product->image && file_exists(public_path('storage/' . $product->image))) {
            unlink(public_path('storage/' . $product->image));
        }

        // Lưu ảnh mới
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    // Cập nhật sản phẩm
    $product->update($validated);

    return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
}

}