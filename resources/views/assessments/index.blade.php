@extends('layouts.app')

@section('title', 'Assessment - Mind Partner')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Assessment Kesehatan Mental</h1>
            <p class="text-gray-600">Kelola dan pantau assessment kesehatan mental Anda</p>
        </div>
        <a href="{{ route('assessments.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
            <i class="fas fa-plus mr-2"></i>Buat Assessment
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select id="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-md">
                    <option value="">Semua Kategori</option>
                    <option value="anxiety" {{ request('category') == 'anxiety' ? 'selected' : '' }}>Kecemasan</option>
                    <option value="depression" {{ request('category') == 'depression' ? 'selected' : '' }}>Depresi</option>
                    <option value="stress" {{ request('category') == 'stress' ? 'selected' : '' }}>Stres</option>
                    <option value="mood" {{ request('category') == 'mood' ? 'selected' : '' }}>Suasana Hati</option>
                    <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>Umum</option>
                </select>
            </div>
            
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-md">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Sedang Berlangsung</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Cari</label>
                <input type="text" id="search" placeholder="Cari assessment..." value="{{ request('search') }}" 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
            </div>
        </div>
    </div>

    <!-- Assessments List -->
    <div class="bg-white rounded-lg shadow">
        @if($assessments->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Assessment
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Skor
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Dibuat
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($assessments as $assessment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-clipboard-list text-purple-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="{{ route('assessments.show', $assessment) }}" class="hover:text-purple-600">
                                                    {{ $assessment->title }}
                                                </a>
                                            </div>
                                            @if($assessment->description)
                                                <div class="text-sm text-gray-500 truncate max-w-xs">
                                                    {{ Str::limit($assessment->description, 50) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        {{ $assessment->category_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($assessment->status === 'completed') bg-green-100 text-green-800
                                        @elseif($assessment->status === 'in_progress') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $assessment->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($assessment->score)
                                        <div class="flex items-center">
                                            <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                                <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $assessment->score }}%"></div>
                                            </div>
                                            <span class="text-sm font-medium">{{ $assessment->score }}/100</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $assessment->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('assessments.show', $assessment) }}" class="text-purple-600 hover:text-purple-900">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('assessments.edit', $assessment) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('assessments.destroy', $assessment) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus assessment ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $assessments->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-clipboard-list text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada assessment</h3>
                <p class="text-gray-500 mb-6">Mulai dengan membuat assessment kesehatan mental pertama Anda.</p>
                <a href="{{ route('assessments.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                    <i class="fas fa-plus mr-2"></i>Buat Assessment Pertama
                </a>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const categoryFilter = document.getElementById('category');
        const statusFilter = document.getElementById('status');
        const searchInput = document.getElementById('search');
        
        function applyFilters() {
            const category = categoryFilter.value;
            const status = statusFilter.value;
            const search = searchInput.value;
            
            let url = new URL(window.location);
            
            if (category) url.searchParams.set('category', category);
            else url.searchParams.delete('category');
            
            if (status) url.searchParams.set('status', status);
            else url.searchParams.delete('status');
            
            if (search) url.searchParams.set('search', search);
            else url.searchParams.delete('search');
            
            window.location.href = url.toString();
        }
        
        categoryFilter.addEventListener('change', applyFilters);
        statusFilter.addEventListener('change', applyFilters);
        
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(applyFilters, 500);
        });
    });
</script>
@endpush
@endsection 