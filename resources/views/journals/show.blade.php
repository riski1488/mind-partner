@extends('layouts.app')

@section('title', $journal->title . ' - Mind Partner')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('journals.index') }}" class="hover:text-blue-600">
                <i class="fas fa-arrow-left mr-1"></i>Kembali ke Jurnal
            </a>
        </div>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $journal->title }}</h1>
                <p class="text-gray-600">{{ $journal->entry_date->format('d M Y') }} • {{ $journal->is_private ? 'Pribadi' : 'Publik' }}</p>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('journals.edit', $journal) }}" 
                   class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('journals.destroy', $journal) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurnal ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-red-300 shadow-sm text-sm leading-4 font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Journal Content -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Isi Jurnal</h2>
                
                <div class="prose max-w-none">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $journal->content }}</p>
                </div>
            </div>

            <!-- Image -->
            @if($journal->image_path)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Gambar</h2>
                    <div class="flex justify-center">
                        <img src="{{ asset('storage/' . $journal->image_path) }}" 
                             alt="{{ $journal->title }}" 
                             class="max-w-full h-auto rounded-lg shadow-lg">
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Journal Info -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Jurnal</h3>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Judul</span>
                        <span class="text-sm font-medium text-gray-900">{{ $journal->title }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Tanggal</span>
                        <span class="text-sm font-medium text-gray-900">{{ $journal->entry_date->format('d M Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $journal->is_private ? 'bg-gray-100 text-gray-800' : 'bg-green-100 text-green-800' }}">
                            @if($journal->is_private)
                                <i class="fas fa-lock mr-1"></i>Pribadi
                            @else
                                <i class="fas fa-globe mr-1"></i>Publik
                            @endif
                        </span>
                    </div>
                    
                    @if($journal->mood_score)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Skor Mood</span>
                            <div class="flex items-center">
                                <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($journal->mood_score / 10) * 100 }}%"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $journal->mood_score }}/10</span>
                            </div>
                        </div>
                    @endif
                    
                    @if($journal->mood_description)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Mood</span>
                            <div class="flex items-center">
                                <span class="mood-indicator mood-{{ $journal->mood_description }}"></span>
                                <span class="text-sm font-medium text-gray-900">{{ $journal->mood_description_label }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                
                <div class="space-y-2">
                    <a href="{{ route('journals.edit', $journal) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-edit mr-2"></i>Edit Jurnal
                    </a>
                    
                    <a href="{{ route('journals.index') }}" 
                       class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-list mr-2"></i>Lihat Semua
                    </a>
                    
                    <a href="{{ route('journals.create') }}" 
                       class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>Buat Jurnal Baru
                    </a>
                </div>
            </div>

            <!-- Journal Stats -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik</h3>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Dibuat</span>
                        <span class="text-sm font-medium text-gray-900">{{ $journal->created_at->format('d M Y H:i') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Terakhir diperbarui</span>
                        <span class="text-sm font-medium text-gray-900">{{ $journal->updated_at->format('d M Y H:i') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Panjang konten</span>
                        <span class="text-sm font-medium text-gray-900">{{ strlen($journal->content) }} karakter</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 