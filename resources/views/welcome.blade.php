@extends('layouts.app')

@section('title', 'Mind Partner - Layanan Kesehatan Mental')

@section('content')
<div class="min-h-screen">
    <!-- Hero Section -->
    <section class="gradient-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="mb-8">
                    <i class="fas fa-brain text-6xl mb-4"></i>
                    <h1 class="text-5xl font-bold mb-4">Mind Partner</h1>
                    <p class="text-xl opacity-90 max-w-2xl mx-auto">
                        Platform kesehatan mental yang membantu Anda memahami dan mengelola kesehatan mental dengan lebih baik.
                        Mulai perjalanan menuju kesehatan mental yang lebih baik bersama kami.
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            <i class="fas fa-user-plus mr-2"></i>Mulai Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition-colors">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Kami menyediakan berbagai fitur untuk membantu Anda mengelola kesehatan mental dengan lebih baik.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Assessment Feature -->
                <div class="card-hover bg-white p-8 rounded-xl shadow-lg border border-gray-200">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-clipboard-list text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 text-center">Assessment Mental</h3>
                    <p class="text-gray-600 text-center">
                        Lakukan assessment kesehatan mental untuk memahami kondisi mental Anda saat ini dan dapatkan rekomendasi yang tepat.
                    </p>
                </div>
                
                <!-- Journal Feature -->
                <div class="card-hover bg-white p-8 rounded-xl shadow-lg border border-gray-200">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-book text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 text-center">Jurnal Harian</h3>
                    <p class="text-gray-600 text-center">
                        Catat perasaan dan pengalaman harian Anda dalam jurnal digital yang aman dan pribadi.
                    </p>
                </div>
                
                <!-- Mood Tracking Feature -->
                <div class="card-hover bg-white p-8 rounded-xl shadow-lg border border-gray-200">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-chart-line text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 text-center">Tracking Mood</h3>
                    <p class="text-gray-600 text-center">
                        Pantau perubahan mood dan emosi Anda dari waktu ke waktu dengan grafik yang informatif.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div class="card-hover bg-white p-6 rounded-xl shadow-lg">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-users text-xl text-purple-600"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">1000+</h3>
                    <p class="text-gray-600">Pengguna Aktif</p>
                </div>
                
                <div class="card-hover bg-white p-6 rounded-xl shadow-lg">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-clipboard-list text-xl text-blue-600"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">5000+</h3>
                    <p class="text-gray-600">Assessment Selesai</p>
                </div>
                
                <div class="card-hover bg-white p-6 rounded-xl shadow-lg">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-book text-xl text-green-600"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">10000+</h3>
                    <p class="text-gray-600">Jurnal Dibuat</p>
                </div>
                
                <div class="card-hover bg-white p-6 rounded-xl shadow-lg">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <i class="fas fa-star text-xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">4.8</h3>
                    <p class="text-gray-600">Rating Pengguna</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Bagaimana Cara Kerjanya?</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Ikuti langkah-langkah sederhana untuk memulai perjalanan kesehatan mental Anda.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <span class="text-2xl font-bold text-purple-600">1</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Daftar & Login</h3>
                    <p class="text-gray-600">
                        Buat akun baru atau login ke akun yang sudah ada untuk mengakses semua fitur.
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <span class="text-2xl font-bold text-blue-600">2</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Lakukan Assessment</h3>
                    <p class="text-gray-600">
                        Pilih dan lakukan assessment kesehatan mental yang sesuai dengan kebutuhan Anda.
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <span class="text-2xl font-bold text-green-600">3</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Kelola & Pantau</h3>
                    <p class="text-gray-600">
                        Kelola jurnal harian dan pantau perkembangan kesehatan mental Anda secara berkala.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-4">Mulai Perjalanan Kesehatan Mental Anda</h2>
            <p class="text-xl opacity-90 mb-8">
                Bergabunglah dengan ribuan orang yang telah mempercayai Mind Partner untuk mengelola kesehatan mental mereka.
            </p>
            
            @auth
                <a href="{{ route('dashboard') }}" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors inline-block">
                    <i class="fas fa-tachometer-alt mr-2"></i>Buka Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors inline-block">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                </a>
            @endauth
        </div>
    </section>
</div>
@endsection
