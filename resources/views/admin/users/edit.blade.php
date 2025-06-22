@extends('layouts.admin')

@section('title', 'Chỉnh sửa Người dùng')

@section('content')
<div class="container">
    <h1>Chỉnh sửa thông tin người dùng</h1>
    
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_admin" name="is_admin" 
                       value="1" {{ $user->is_admin ? 'checked' : '' }}>
                <label class="form-check-label" for="is_admin">
                    Quyền Admin
                </label>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection