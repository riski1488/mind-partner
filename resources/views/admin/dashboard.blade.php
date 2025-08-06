@extends('layouts.app')

@section('title', 'Admin Dashboard - Mind Partner')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Admin Dashboard</h1>
                <p class="opacity-90">Selamat datang di panel admin Mind Partner</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-cog text-6xl opacity-20"></i>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Pengguna</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-xl text-blue-600"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500">Admin: {{ $userStats['admin'] ?? 0 }}</span>
                    <span class="text-gray-500">User: {{ $userStats['user'] ?? 0 }}</span>
                </div>
            </div>
        </div>

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
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500">Selesai: {{ $assessmentStats['completed'] ?? 0 }}</span>
                    <span class="text-gray-500">Berlangsung: {{ $assessmentStats['in_progress'] ?? 0 }}</span>
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
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-book text-xl text-green-600"></i>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm text-gray-500">Jurnal harian pengguna</p>
            </div>
        </div>

        <!-- System Health -->
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Status Sistem</p>
                    <p class="text-2xl font-bold text-green-600">Aktif</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-heart text-xl text-green-600"></i>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm text-gray-500">Semua sistem berjalan normal</p>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Users -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Pengguna Terbaru</h2>
                <a href="{{ route('admin.users') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                    Lihat Semua
                </a>
            </div>
            
            @if($recentUsers->count() > 0)
                <div class="space-y-4">
                    @foreach($recentUsers as $user)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <img class="h-10 w-10 rounded-full" src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=7C3AED&background=EBF4FF' }}" alt="{{ $user->name }}">
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $user->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada pengguna</p>
                </div>
            @endif
        </div>

        <!-- Recent Assessments -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Assessment Terbaru</h2>
                <a href="{{ route('admin.assessments') }}" class="text-purple-600 hover:text-purple-700 text-sm font-medium">
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
                                    <p class="text-sm text-gray-500">{{ $assessment->user->name }}</p>
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
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.users') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-users text-blue-600"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">Kelola Pengguna</h3>
                    <p class="text-sm text-gray-500">Lihat dan kelola semua pengguna</p>
                </div>
            </a>
            
            <a href="{{ route('admin.assessments') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-clipboard-list text-purple-600"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">Kelola Assessment</h3>
                    <p class="text-sm text-gray-500">Lihat semua assessment</p>
                </div>
            </a>
            
            <a href="{{ route('admin.journals') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-book text-green-600"></i>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900">Kelola Jurnal</h3>
                    <p class="text-sm text-gray-500">Lihat semua jurnal</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection 