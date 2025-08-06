@extends('layouts.app')

@section('title', $assessment->title . ' - Mind Partner')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('assessments.index') }}" class="hover:text-purple-600">
                <i class="fas fa-arrow-left mr-1"></i>Kembali ke Assessment
            </a>
        </div>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $assessment->title }}</h1>
                <p class="text-gray-600">{{ $assessment->category_label }} • {{ $assessment->status_label }}</p>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('assessments.edit', $assessment) }}" 
                   class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('assessments.destroy', $assessment) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus assessment ini?')">
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
            <!-- Assessment Details -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Detail Assessment</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $assessment->title }}</p>
                    </div>
                    
                    @if($assessment->description)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $assessment->description }}</p>
                        </div>
                    @endif
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori</label>
                            <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ $assessment->category_label }}
                            </span>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($assessment->status === 'completed') bg-green-100 text-green-800
                                @elseif($assessment->status === 'in_progress') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $assessment->status_label }}
                            </span>
                        </div>
                    </div>
                    
                    @if($assessment->score)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Skor</label>
                            <div class="mt-2 flex items-center">
                                <div class="flex-1 bg-gray-200 rounded-full h-3 mr-3">
                                    <div class="bg-purple-600 h-3 rounded-full" style="width: {{ $assessment->score }}%"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $assessment->score }}/100</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Assessment Progress -->
            @if($assessment->status !== 'completed')
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Progress Assessment</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Status Assessment</span>
                            <span class="text-sm text-gray-500">
                                @if($assessment->status === 'pending')
                                    Belum dimulai
                                @elseif($assessment->status === 'in_progress')
                                    Sedang berlangsung
                                @endif
                            </span>
                        </div>
                        
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full transition-all duration-300"
                                 style="width: {{ $assessment->status === 'completed' ? '100' : ($assessment->status === 'in_progress' ? '50' : '0') }}%"></div>
                        </div>
                        
                        <div class="text-center">
                            <a href="{{ route('assessments.edit', $assessment) }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                                <i class="fas fa-play mr-2"></i>Lanjutkan Assessment
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Assessment Info -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi</h3>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Dibuat</span>
                        <span class="text-sm font-medium text-gray-900">{{ $assessment->created_at->format('d M Y H:i') }}</span>
                    </div>
                    
                    @if($assessment->completed_at)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Selesai</span>
                            <span class="text-sm font-medium text-gray-900">{{ $assessment->completed_at->format('d M Y H:i') }}</span>
                        </div>
                    @endif
                    
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Terakhir diperbarui</span>
                        <span class="text-sm font-medium text-gray-900">{{ $assessment->updated_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                
                <div class="space-y-2">
                    <a href="{{ route('assessments.edit', $assessment) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-edit mr-2"></i>Edit Assessment
                    </a>
                    
                    @if($assessment->status !== 'completed')
                        <a href="{{ route('assessments.edit', $assessment) }}" 
                           class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                            <i class="fas fa-play mr-2"></i>Mulai Assessment
                        </a>
                    @endif
                    
                    <a href="{{ route('assessments.index') }}" 
                       class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-list mr-2"></i>Lihat Semua
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 