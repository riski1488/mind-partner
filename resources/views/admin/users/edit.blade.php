@extends('layouts.app')

@section('title', 'Edit User - Admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>
    <div class="bg-white rounded-lg shadow p-6 max-w-lg mx-auto">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-3 py-2 border rounded" required>
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" value="{{ $user->email }}" class="w-full px-3 py-2 border rounded bg-gray-100" disabled>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Role</label>
                <select name="role" class="w-full px-3 py-2 border rounded" required>
                    <option value="user" @if($user->role=='user') selected @endif>User</option>
                    <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
                </select>
                @error('role')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.users') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection