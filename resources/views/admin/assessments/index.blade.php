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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 