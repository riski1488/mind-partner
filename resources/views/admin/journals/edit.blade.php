@extends('layouts.app')

@section('title', 'Edit Jurnal - Admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Jurnal</h1>
    <div class="bg-white rounded-lg shadow p-6 max-w-lg mx-auto">
        <form method="POST" action="{{ route('admin.journals.update', $journal) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Judul</label>
                <input type="text" value="{{ $journal->title }}" class="w-full px-3 py-2 border rounded bg-gray-100" disabled>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Status</label>
                <select name="is_private" class="w-full px-3 py-2 border rounded" required>
                    <option value="0" @if(!$journal->is_private) selected @endif>Public</option>
                    <option value="1" @if($journal->is_private) selected @endif>Private</option>
                </select>
                @error('is_private')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.journals') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
