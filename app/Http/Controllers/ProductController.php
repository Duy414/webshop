<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm (có phân trang)
     */
    public function index()
    {
        $products = Product::where('stock', '>', 0) // Chỉ hiển thị sản phẩm còn hàng
            ->orderBy('created_at', 'desc')
            ->paginate(12);

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
        // Kiểm tra tồn tại sản phẩm (tự động bởi Route Model Binding)
        if ($product->stock <= 0) {
            abort(404, 'Sản phẩm đã hết hàng');
        }

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