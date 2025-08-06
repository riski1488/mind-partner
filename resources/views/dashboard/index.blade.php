@extends('layouts.app')

@section('title', 'Dashboard - Mind Partner')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Selamat datang, {{ auth()->user()->name }}! 👋</h1>
                <p class="opacity-90">Bagaimana perasaan Anda hari ini? Mari kita pantau kesehatan mental Anda.</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-brain text-6xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Total Assessments -->
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Assessment</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalAssessments }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clipboard-list text-xl text-purple-600"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center">
                    <span class="text-sm text-gray-500">Selesai: {{ $completedAssessments }}</span>
                    @if($totalAssessments > 0)
                        <span class="ml-2 text-sm text-green-600">
                            ({{ round(($completedAssessments / $totalAssessments) * 100) }}%)
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Total Journals -->
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Jurnal</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalJournals }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-book text-xl text-blue-600"></i>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm text-gray-500">Entri terakhir: {{ $recentJournals->count() > 0 ? $recentJournals->first()->created_at->diffForHumans() : 'Belum ada' }}</p>
            </div>
        </div>

        <!-- Average Mood -->
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Rata-rata Mood</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $moodStats && $moodStats->avg_mood ? round($moodStats->avg_mood, 1) : 'N/A' }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-xl text-green-600"></i>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm text-gray-500">
                    {{ $moodStats && $moodStats->total_entries ? $moodStats->total_entries . ' entri' : 'Belum ada data' }}
                </p>
            </div>
        </div>

        <!-- Streak -->
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Streak</p>
                    <p class="text-2xl font-bold text-gray-900">0 hari</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-fire text-xl text-yellow-600"></i>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm text-gray-500">Mulai streak Anda hari ini!</p>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Assessments -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Assessment Terbaru</h2>
                <a href="{{ route('assessments.index') }}" class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                    Lihat Semua
                </a>
            </div>
            
            @if($recentAssessments->count() > 0)
                <div class="space-y-4">
                    @foreach($recentAssessments as $assessment)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-clipboard-list text-purple-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $assessment->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $assessment->category_label }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($assessment->status === 'completed') bg-green-100 text-green-800
                                    @elseif($assessment->status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $assessment->status_label }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-clipboard-list text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada assessment</p>
                    <a href="{{ route('assessments.create') }}" class="mt-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                        <i class="fas fa-plus mr-2"></i>Buat Assessment
                    </a>
                </div>
            @endif
        </div>

        <!-- Recent Journals -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Jurnal Terbaru</h2>
                <a href="{{ route('journals.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                    Lihat Semua
                </a>
            </div>
            
            @if($recentJournals->count() > 0)
                <div class="space-y-4">
                    @foreach($recentJournals as $journal)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-book text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $journal->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $journal->entry_date->format('d M Y') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                @if($journal->mood_description)
                                    <span class="mood-indicator mood-{{ $journal->mood_description }}"></span>
                                    <span class="text-sm text-gray-500">{{ $journal->mood_description_label }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-book text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada jurnal</p>
                    <a href="{{ route('journals.create') }}" class="mt-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>Buat Jurnal
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('assessments.create') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-clipboard-list text-purple-600"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">Buat Assessment</h3>
                    <p class="text-sm text-gray-500">Evaluasi kesehatan mental</p>
                </div>
            </a>
            
            <a href="{{ route('journals.create') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-book text-blue-600"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">Tulis Jurnal</h3>
                    <p class="text-sm text-gray-500">Catat perasaan hari ini</p>
                </div>
            </a>
            
            <a href="{{ route('assessments.index') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-chart-bar text-green-600"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">Lihat Progress</h3>
                    <p class="text-sm text-gray-500">Pantau perkembangan</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection 