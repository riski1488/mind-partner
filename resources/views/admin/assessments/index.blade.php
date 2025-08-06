@extends('layouts.app')

@section('title', 'Kelola Assessment - Admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Kelola Assessment</h1>
    <div class="bg-white rounded-lg shadow p-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Judul</th>
                    <th class="px-4 py-2">Kategori</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Skor</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assessments as $assessment)
                <tr>
                    <td class="px-4 py-2">{{ $assessment->user->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $assessment->title }}</td>
                    <td class="px-4 py-2">{{ $assessment->category_label }}</td>
                    <td class="px-4 py-2">{{ $assessment->status_label }}</td>
                    <td class="px-4 py-2">{{ $assessment->score ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $assessment->created_at->format('d-m-Y') }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('admin.assessments.edit', $assessment) }}" class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.assessments.destroy', $assessment) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus assessment ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 