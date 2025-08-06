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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 