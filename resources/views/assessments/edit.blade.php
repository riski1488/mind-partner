@extends('layouts.app')

@section('title', 'Edit Assessment - Mind Partner')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('assessments.show', $assessment) }}" class="hover:text-purple-600">
                <i class="fas fa-arrow-left mr-1"></i>Kembali ke Assessment
            </a>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">Edit Assessment</h1>
        <p class="text-gray-600">Perbarui informasi assessment kesehatan mental Anda</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('assessments.update', $assessment) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Judul Assessment <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
                           placeholder="Contoh: Assessment Kecemasan Harian"
                           value="{{ old('title', $assessment->title) }}">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select id="category" name="category" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        <option value="">Pilih kategori</option>
                        <option value="anxiety" {{ old('category', $assessment->category) == 'anxiety' ? 'selected' : '' }}>Kecemasan</option>
                        <option value="depression" {{ old('category', $assessment->category) == 'depression' ? 'selected' : '' }}>Depresi</option>
                        <option value="stress" {{ old('category', $assessment->category) == 'stress' ? 'selected' : '' }}>Stres</option>
                        <option value="mood" {{ old('category', $assessment->category) == 'mood' ? 'selected' : '' }}>Suasana Hati</option>
                        <option value="general" {{ old('category', $assessment->category) == 'general' ? 'selected' : '' }}>Umum</option>
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        Deskripsi
                    </label>
                    <textarea id="description" name="description" rows="4"
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
                              placeholder="Jelaskan tujuan dan detail assessment ini...">{{ old('description', $assessment->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                        <option value="pending" {{ old('status', $assessment->status) == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="in_progress" {{ old('status', $assessment->status) == 'in_progress' ? 'selected' : '' }}>Sedang Berlangsung</option>
                        <option value="completed" {{ old('status', $assessment->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Score -->
                <div>
                    <label for="score" class="block text-sm font-medium text-gray-700">
                        Skor (0-100)
                    </label>
                    <input type="number" id="score" name="score" min="0" max="100"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
                           placeholder="Masukkan skor assessment (0-100)"
                           value="{{ old('score', $assessment->score) }}">
                    @error('score')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Kosongkan jika belum ada skor</p>
                </div>

                <!-- Category Information -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Informasi Kategori:</h3>
                    <div id="category-info" class="text-sm text-gray-600">
                        <p>Pilih kategori untuk melihat informasi lebih lanjut.</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('assessments.show', $assessment) }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const categoryInfo = document.getElementById('category-info');
        
        const categoryDescriptions = {
            'anxiety': 'Assessment ini akan membantu mengidentifikasi tingkat kecemasan Anda. Pertanyaan akan fokus pada gejala kecemasan seperti kekhawatiran berlebihan, ketegangan, dan reaksi fisik terhadap stres.',
            'depression': 'Assessment ini dirancang untuk mengukur gejala depresi. Pertanyaan akan mencakup suasana hati, energi, tidur, dan minat dalam aktivitas sehari-hari.',
            'stress': 'Assessment ini akan mengukur tingkat stres Anda. Pertanyaan akan fokus pada sumber stres, reaksi terhadap stres, dan kemampuan mengelola tekanan.',
            'mood': 'Assessment ini akan membantu melacak perubahan suasana hati Anda dari waktu ke waktu. Pertanyaan akan mencakup emosi, energi, dan kesejahteraan umum.',
            'general': 'Assessment umum untuk kesehatan mental secara keseluruhan. Pertanyaan akan mencakup berbagai aspek kesehatan mental dan kesejahteraan.'
        };
        
        function updateCategoryInfo() {
            const selectedCategory = categorySelect.value;
            if (selectedCategory && categoryDescriptions[selectedCategory]) {
                categoryInfo.innerHTML = `<p>${categoryDescriptions[selectedCategory]}</p>`;
            } else {
                categoryInfo.innerHTML = '<p>Pilih kategori untuk melihat informasi lebih lanjut.</p>';
            }
        }
        
        categorySelect.addEventListener('change', updateCategoryInfo);
        updateCategoryInfo(); // Initial call
    });
</script>
@endpush
@endsection 