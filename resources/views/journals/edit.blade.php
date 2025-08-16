@extends('layouts.app')

@section('title', 'Edit Jurnal - Mind Partner')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('journals.show', $journal) }}" class="hover:text-blue-600">
                <i class="fas fa-arrow-left mr-1"></i>Kembali ke Jurnal
            </a>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">Edit Jurnal</h1>
        <p class="text-gray-600">Perbarui jurnal Anda</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('journals.update', $journal) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Judul Jurnal <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Contoh: Hari yang Menyenangkan"
                           value="{{ old('title', $journal->title) }}">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">
                        Isi Jurnal <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content" name="content" rows="8" required
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                              placeholder="Tuliskan perasaan, pengalaman, atau pikiran Anda hari ini...">{{ old('content', $journal->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mood Score -->
                <div>
                    <label for="mood_score" class="block text-sm font-medium text-gray-700">
                        Skor Mood (1-10)
                    </label>
                    <div class="mt-1 flex items-center space-x-4">
                        <input type="range" id="mood_score" name="mood_score" min="1" max="10" 
                               class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider"
                               value="{{ old('mood_score', $journal->mood_score ?? 5) }}">
                        <span id="mood_score_display" class="text-lg font-semibold text-gray-900 w-8 text-center">{{ old('mood_score', $journal->mood_score ?? 5) }}</span>
                    </div>
                    <div class="mt-2 flex justify-between text-xs text-gray-500">
                        <span>Sangat Buruk</span>
                        <span>Netral</span>
                        <span>Sangat Baik</span>
                    </div>
                    @error('mood_score')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mood Description -->
                <div>
                    <label for="mood_description" class="block text-sm font-medium text-gray-700">
                        Deskripsi Mood
                    </label>
                    <select id="mood_description" name="mood_description"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih mood</option>
                        <option value="very_happy" {{ old('mood_description', $journal->mood_description) == 'very_happy' ? 'selected' : '' }}>Sangat Bahagia</option>
                        <option value="happy" {{ old('mood_description', $journal->mood_description) == 'happy' ? 'selected' : '' }}>Bahagia</option>
                        <option value="neutral" {{ old('mood_description', $journal->mood_description) == 'neutral' ? 'selected' : '' }}>Netral</option>
                        <option value="sad" {{ old('mood_description', $journal->mood_description) == 'sad' ? 'selected' : '' }}>Sedih</option>
                        <option value="very_sad" {{ old('mood_description', $journal->mood_description) == 'very_sad' ? 'selected' : '' }}>Sangat Sedih</option>
                        <option value="anxious" {{ old('mood_description', $journal->mood_description) == 'anxious' ? 'selected' : '' }}>Cemas</option>
                        <option value="stressed" {{ old('mood_description', $journal->mood_description) == 'stressed' ? 'selected' : '' }}>Stres</option>
                    </select>
                    @error('mood_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Entry Date -->
                <div>
                    <label for="entry_date" class="block text-sm font-medium text-gray-700">
                        Tanggal Entri <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="entry_date" name="entry_date" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           value="{{ old('entry_date', $journal->entry_date->format('Y-m-d')) }}">
                    @error('entry_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Image -->
                @if($journal->image_path)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gambar Saat Ini</label>
                        <div class="mt-1 flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $journal->image_path) }}" 
                                 alt="Current image" 
                                 class="w-32 h-32 object-cover rounded-lg shadow">
                            <div>
                                <p class="text-sm text-gray-500">Gambar saat ini akan tetap ada jika tidak memilih gambar baru.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">
                        Gambar Baru (Opsional)
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Upload gambar baru</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                        </div>
                    </div>
                    <div id="image_preview" class="mt-2 hidden">
                        <img id="preview_img" src="" alt="Preview" class="max-w-xs rounded-lg shadow">
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Privacy -->
                <div>
                    <div class="flex items-center">
                        <input id="is_private" name="is_private" type="checkbox" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                               {{ old('is_private', $journal->is_private) ? 'checked' : '' }}>
                        <label for="is_private" class="ml-2 block text-sm text-gray-900">
                            Jurnal pribadi (hanya Anda yang bisa melihat)
                        </label>
                    </div>
                    @error('is_private')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('journals.show', $journal) }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 