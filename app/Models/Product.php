<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Các thuộc tính có thể gán giá trị hàng loạt (mass assignable).
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image'
    ];

    /**
     * Ép kiểu dữ liệu cho các thuộc tính.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',  // Đảm bảo định dạng số thập phân
        'stock' => 'integer'     // Ép kiểu số nguyên
    ];
    
    /**
     * Các trường ngày tháng tự động (timestamps).
     * Mặc định Laravel sẽ tự quản lý created_at và updated_at
     */
    // public $timestamps = true; // Mặc định đã được bật
}