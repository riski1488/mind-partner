@extends('layouts.app')

@section('title', 'Kelola Jurnal - Admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Kelola Jurnal</h1>
    <div class="bg-white rounded-lg shadow p-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Judul</th>
                    <th class="px-4 py-2">Mood</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($journals as $journal)
                <tr>
                    <td class="px-4 py-2">{{ $journal->user->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $journal->title }}</td>
                    <td class="px-4 py-2">{{ $journal->mood_description_label }}</td>
                    <td class="px-4 py-2">{{ $journal->entry_date->format('d-m-Y') }}</td>
                    <td class="px-4 py-2">{{ $journal->is_private ? 'Private' : 'Public' }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('admin.journals.edit', $journal) }}" class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.journals.destroy', $journal) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jurnal ini?')">
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