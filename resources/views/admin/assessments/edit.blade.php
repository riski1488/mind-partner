@extends('layouts.app')

@section('title', 'Edit Assessment - Admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Assessment</h1>
    <div class="bg-white rounded-lg shadow p-6 max-w-lg mx-auto">
        <form method="POST" action="{{ route('admin.assessments.update', $assessment) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Judul</label>
                <input type="text" value="{{ $assessment->title }}" class="w-full px-3 py-2 border rounded bg-gray-100" disabled>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Status</label>
                <select name="status" class="w-full px-3 py-2 border rounded" required>
                    <option value="pending" @if($assessment->status=='pending') selected @endif>Pending</option>
                    <option value="in_progress" @if($assessment->status=='in_progress') selected @endif>In Progress</option>
                    <option value="completed" @if($assessment->status=='completed') selected @endif>Completed</option>
                </select>
                @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Skor</label>
                <input type="number" name="score" min="0" max="100" value="{{ old('score', $assessment->score) }}" class="w-full px-3 py-2 border rounded">
                @error('score')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.assessments') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection 