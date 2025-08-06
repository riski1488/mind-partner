@extends('layouts.app')

@section('title', 'Jurnal - Mind Partner')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Jurnal Harian</h1>
            <p class="text-gray-600">Catat dan kelola perasaan serta pengalaman harian Anda</p>
        </div>
        <a href="{{ route('journals.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Buat Jurnal
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="mood" class="block text-sm font-medium text-gray-700">Mood</label>
                <select id="mood" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                    <option value="">Semua Mood</option>
                    <option value="very_happy">Sangat Bahagia</option>
                    <option value="happy">Bahagia</option>
                    <option value="neutral">Netral</option>
                    <option value="sad">Sedih</option>
                    <option value="very_sad">Sangat Sedih</option>
                    <option value="anxious">Cemas</option>
                    <option value="stressed">Stres</option>
                </select>
            </div>
            
            <div>
                <label for="privacy" class="block text-sm font-medium text-gray-700">Privasi</label>
                <select id="privacy" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                    <option value="">Semua</option>
                    <option value="public">Publik</option>
                    <option value="private">Pribadi</option>
                </select>
            </div>
            
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="date" 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Cari</label>
                <input type="text" id="search" placeholder="Cari jurnal..." 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
        </div>
    </div>

    <!-- Journals List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($journals->count() > 0)
            @foreach($journals as $journal)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover">
                    @if($journal->image_path)
                        <div class="h-48 bg-gray-200">
                            <img src="{{ asset('storage/' . $journal->image_path) }}" 
                                 alt="{{ $journal->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-900">
                                <a href="{{ route('journals.show', $journal) }}" class="hover:text-blue-600">
                                    {{ $journal->title }}
                                </a>
                            </h3>
                            @if($journal->is_private)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-lock mr-1"></i>Pribadi
                                </span>
                            @endif
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit($journal->content, 150) }}
                        </p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                @if($journal->mood_description)
                                    <span class="mood-indicator mood-{{ $journal->mood_description }}"></span>
                                    <span class="text-sm text-gray-500">{{ $journal->mood_description_label }}</span>
                                @endif
                            </div>
                            
                            @if($journal->mood_score)
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-900">{{ $journal->mood_score }}/10</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $journal->entry_date->format('d M Y') }}</span>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('journals.show', $journal) }}" class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('journals.edit', $journal) }}" class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('journals.destroy', $journal) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurnal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-span-full text-center py-12">
                <i class="fas fa-book text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada jurnal</h3>
                <p class="text-gray-500 mb-6">Mulai dengan menulis jurnal pertama Anda untuk melacak perasaan dan pengalaman harian.</p>
                <a href="{{ route('journals.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Buat Jurnal Pertama
                </a>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($journals->count() > 0)
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 rounded-lg shadow">
            {{ $journals->links() }}
        </div>
    @endif
</div>

@push('scripts')
<script>
    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const moodFilter = document.getElementById('mood');
        const privacyFilter = document.getElementById('privacy');
        const dateFilter = document.getElementById('date');
        const searchInput = document.getElementById('search');
        
        function applyFilters() {
            const mood = moodFilter.value;
            const privacy = privacyFilter.value;
            const date = dateFilter.value;
            const search = searchInput.value;
            
            let url = new URL(window.location);
            
            if (mood) url.searchParams.set('mood', mood);
            else url.searchParams.delete('mood');
            
            if (privacy) url.searchParams.set('privacy', privacy);
            else url.searchParams.delete('privacy');
            
            if (date) url.searchParams.set('date', date);
            else url.searchParams.delete('date');
            
            if (search) url.searchParams.set('search', search);
            else url.searchParams.delete('search');
            
            window.location.href = url.toString();
        }
        
        moodFilter.addEventListener('change', applyFilters);
        privacyFilter.addEventListener('change', applyFilters);
        dateFilter.addEventListener('change', applyFilters);
        
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(applyFilters, 500);
        });
    });
</script>
@endpush
@endsection 