<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Hiển thị form gửi phản hồi
     */
    public function create()
    {
        return view('feedbacks.create');
    }

    /**
     * Lưu phản hồi mới vào database
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|min:10|max:1000'
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'message' => $request->message
        ]);

        return redirect()->route('feedback.create')
            ->with('success', 'Phản hồi của bạn đã được gửi thành công!');
    }
    public function index()
    {
        // Ví dụ: Lấy tất cả phản hồi và truyền qua view
        $feedbacks = Feedback::with('user')->latest()->paginate(15);
        return view('admin.feedbacks.index', compact('feedbacks'));
    }
}